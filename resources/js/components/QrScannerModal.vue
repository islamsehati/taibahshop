<script setup lang="ts">
import { ref, watch, onUnmounted, nextTick } from 'vue';
import { X, Camera, ZapOff, RefreshCw } from 'lucide-vue-next';
import jsQR from 'jsqr';

const props = defineProps<{
  modelValue: boolean;
}>();

const emit = defineEmits<{
  'update:modelValue': [value: boolean];
  'scanned': [code: string];
}>();

const videoRef = ref<HTMLVideoElement | null>(null);
const canvasRef = ref<HTMLCanvasElement | null>(null);
const scannerStatus = ref<'idle' | 'loading' | 'scanning' | 'error'>('idle');
const errorMessage = ref('');
const errorDetail = ref('');
const lastScanned = ref('');
let stream: MediaStream | null = null;
let animationId: number | null = null;

async function startScanner() {
  scannerStatus.value = 'loading';
  errorMessage.value = '';
  errorDetail.value = '';
  lastScanned.value = '';

  await nextTick();
  await new Promise(r => setTimeout(r, 300));

  // Cek browser support
  if (!navigator?.mediaDevices?.getUserMedia) {
    scannerStatus.value = 'error';
    errorMessage.value = 'Browser tidak mendukung akses kamera.';
    errorDetail.value = 'Pastikan menggunakan HTTPS dan browser modern (Chrome/Safari/Firefox).';
    return;
  }

  try {
    // Minta akses kamera — coba dengan constraint dulu, fallback minimal
    try {
      stream = await navigator.mediaDevices.getUserMedia({
        video: {
          facingMode: { ideal: 'environment' },
          width: { ideal: 1280 },
          height: { ideal: 720 },
        },
      });
    } catch {
      stream = await navigator.mediaDevices.getUserMedia({ video: true });
    }

    if (!videoRef.value) {
      scannerStatus.value = 'error';
      errorMessage.value = 'Elemen video tidak ditemukan.';
      return;
    }

    const video = videoRef.value;

    // Reset element — penting di macOS Chrome
    video.srcObject = null;
    video.load();
    await nextTick();

    video.srcObject = stream;

    // Tunggu metadata — selalu resolve, tidak pernah reject
    await new Promise<void>((resolve) => {
      if (video.readyState >= video.HAVE_METADATA) {
        resolve();
        return;
      }
      const onMeta = () => {
        video.removeEventListener('loadedmetadata', onMeta);
        resolve();
      };
      video.addEventListener('loadedmetadata', onMeta);
      setTimeout(() => {
        video.removeEventListener('loadedmetadata', onMeta);
        resolve();
      }, 5000);
    });

    try {
      await video.play();
    } catch (playErr) {
      console.warn('video.play() suppressed:', playErr);
    }

    scannerStatus.value = 'scanning';
    scanLoop();

  } catch (err: any) {
    scannerStatus.value = 'error';

    const name    = err?.name ?? err?.type ?? '';
    const message = err?.message ?? '';

    if (name === 'NotAllowedError' || name === 'PermissionDeniedError') {
      errorMessage.value = 'Akses kamera ditolak.';
      errorDetail.value  = 'Buka System Settings → Privacy & Security → Camera → aktifkan Chrome. Lalu restart browser.';
    } else if (name === 'NotFoundError' || name === 'DevicesNotFoundError') {
      errorMessage.value = 'Kamera tidak ditemukan.';
      errorDetail.value  = 'Pastikan perangkat memiliki kamera dan tidak digunakan aplikasi lain.';
    } else if (name === 'NotReadableError' || name === 'TrackStartError') {
      errorMessage.value = 'Kamera sedang dipakai aplikasi lain.';
      errorDetail.value  = 'Tutup Zoom, FaceTime, atau aplikasi kamera lain lalu coba lagi.';
    } else if (name === 'OverconstrainedError') {
      errorMessage.value = 'Kamera tidak mendukung resolusi yang diminta.';
      errorDetail.value  = 'Klik "Coba Lagi" — sistem akan fallback ke resolusi default.';
    } else {
      errorMessage.value = 'Gagal memulai kamera.';
      errorDetail.value  = message
        ? `Detail: ${message}`
        : 'Pastikan tidak ada aplikasi lain yang menggunakan kamera, lalu coba lagi.';
    }
  }
}

function scanLoop() {
  if (!videoRef.value || !canvasRef.value) return;

  const video  = videoRef.value;
  const canvas = canvasRef.value;
  const ctx    = canvas.getContext('2d', { willReadFrequently: true });
  if (!ctx) return;

  function tick() {
    if (!stream?.active) return;

    if (!video || video.readyState < video.HAVE_ENOUGH_DATA) {
      animationId = requestAnimationFrame(tick);
      return;
    }

    canvas.width  = video.videoWidth;
    canvas.height = video.videoHeight;
    ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

    const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
    const result    = jsQR(imageData.data, imageData.width, imageData.height, {
      inversionAttempts: 'attemptBoth',
    });

    if (result?.data) {
      handleScanResult(result.data);
      return;
    }

    animationId = requestAnimationFrame(tick);
  }

  animationId = requestAnimationFrame(tick);
}

function handleScanResult(code: string) {
  if (!code || code === lastScanned.value) return;
  lastScanned.value = code;

  if (navigator.vibrate) navigator.vibrate(100);

  stopScanner();
  emit('scanned', code);
  emit('update:modelValue', false);
}

function stopScanner() {
  if (animationId !== null) {
    cancelAnimationFrame(animationId);
    animationId = null;
  }
  if (stream) {
    stream.getTracks().forEach(t => t.stop());
    stream = null;
  }
  scannerStatus.value = 'idle';
}

function close() {
  stopScanner();
  emit('update:modelValue', false);
}

watch(() => props.modelValue, (val) => {
  if (val) startScanner();
  else stopScanner();
});

onUnmounted(() => stopScanner());
</script>

<template>
  <Transition name="fade">
    <div
      v-if="modelValue"
      class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm p-4"
      @click.self="close"
    >
      <div class="relative w-full max-w-sm bg-gray-950 rounded-2xl overflow-hidden shadow-2xl border border-gray-700">

        <!-- HEADER -->
        <div class="flex items-center justify-between px-4 py-3 border-b border-gray-800">
          <div class="flex items-center gap-2">
            <Camera class="size-5 text-blue-400" />
            <span class="text-white font-semibold text-sm">Scan QR / Barcode</span>
          </div>
          <button
            @click="close"
            class="p-1 rounded-full hover:bg-gray-800 text-gray-400 hover:text-white transition"
          >
            <X class="size-5" />
          </button>
        </div>

        <!-- SCANNER AREA -->
        <div class="relative bg-black aspect-square w-full overflow-hidden">

          <video
            ref="videoRef"
            class="absolute inset-0 w-full h-full object-cover"
            autoplay
            muted
            playsinline
          />

          <canvas ref="canvasRef" class="hidden" />

          <!-- Scanning overlay -->
          <div v-if="scannerStatus === 'scanning'" class="absolute inset-0 flex items-center justify-center">
            <div class="absolute inset-0 bg-black/30" />
            <div class="relative z-10 w-56 h-56">
              <span class="absolute top-0 left-0 w-8 h-8 border-t-4 border-l-4 border-blue-400 rounded-tl-md" />
              <span class="absolute top-0 right-0 w-8 h-8 border-t-4 border-r-4 border-blue-400 rounded-tr-md" />
              <span class="absolute bottom-0 left-0 w-8 h-8 border-b-4 border-l-4 border-blue-400 rounded-bl-md" />
              <span class="absolute bottom-0 right-0 w-8 h-8 border-b-4 border-r-4 border-blue-400 rounded-br-md" />
              <div class="absolute inset-x-2 top-0 h-0.5 bg-blue-400/80 rounded animate-scan-line shadow-[0_0_8px_2px_rgba(96,165,250,0.6)]" />
            </div>
          </div>

          <!-- Loading -->
          <div
            v-if="scannerStatus === 'loading'"
            class="absolute inset-0 flex flex-col items-center justify-center bg-black/60 gap-3"
          >
            <div class="size-10 border-4 border-blue-400 border-t-transparent rounded-full animate-spin" />
            <p class="text-white text-sm">Memulai kamera...</p>
          </div>

          <!-- Error -->
          <div
            v-if="scannerStatus === 'error'"
            class="absolute inset-0 flex flex-col items-center justify-center bg-black/85 gap-3 px-6 text-center"
          >
            <ZapOff class="size-12 text-red-400 flex-shrink-0" />
            <div>
              <p class="text-red-300 text-sm font-semibold leading-relaxed">{{ errorMessage }}</p>
              <p v-if="errorDetail" class="text-gray-400 text-xs mt-1 leading-relaxed">{{ errorDetail }}</p>
            </div>
            <button
              @click="startScanner"
              class="flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded-lg transition mt-1"
            >
              <RefreshCw class="size-4" />
              Coba Lagi
            </button>
          </div>

        </div>

        <!-- FOOTER -->
        <div class="px-4 py-3 text-center border-t border-gray-800">
          <p class="text-gray-400 text-xs">Arahkan kamera ke QR Code atau Barcode pada nota</p>
        </div>

      </div>
    </div>
  </Transition>
</template>

<style scoped>
.fade-enter-active, .fade-leave-active { transition: opacity 0.2s ease; }
.fade-enter-from, .fade-leave-to { opacity: 0; }

@keyframes scan-line {
  0%   { top: 4px; }
  50%  { top: calc(100% - 4px); }
  100% { top: 4px; }
}
.animate-scan-line { animation: scan-line 2s ease-in-out infinite; }
</style>