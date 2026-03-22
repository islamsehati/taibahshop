<script setup lang="ts">
import AppLayout from '@/layouts/app/AppSidebarLayout.vue';
import type { BreadcrumbItemType } from '@/types';
import { Toaster } from '@/components/ui/sonner';
import 'vue-sonner/style.css'; // vue-sonner v2 requires this import
import { computed, onBeforeMount, onBeforeUnmount, onMounted } from 'vue';

interface Props {
    breadcrumbs?: BreadcrumbItemType[];
}

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});

// onBeforeUnmount(() => localStorage.removeItem("csrf_token"));
onMounted(() => {

  const justLoggedIn = localStorage.getItem("just_logged_in");
  if (justLoggedIn) {
    localStorage.removeItem("just_logged_in");
    console.log("🔁 Reload sekali karena baru login");
    window.location.reload(); // reload penuh hanya sekali
  }

  // const metaToken = document
  //   .querySelector('meta[name="csrf-token"]')
  //   ?.getAttribute("content");
  // if (metaToken) {
  //   localStorage.setItem("csrf_token", metaToken);
  // }
});

const backgroundImageUrl = computed(() => {
  // GANTI sesuai file di storage
  return "url('/storage/background/my-bg.png')"
})
</script>

<template>
  <div class="relative min-h-screen overflow-hidden">

    <!-- BACKGROUND IMAGE -->
    <div
      class="absolute inset-0 bg-cover bg-center scale-105"
      :style="{ backgroundImage: backgroundImageUrl }"
    />

    <!-- BLUR OVERLAY -->
    <div class="absolute inset-0 backdrop-blur-2xl bg-white/30 dark:bg-black/40" />

    <!-- CONTENT -->
    <AppLayout
      :breadcrumbs="breadcrumbs"
      class="relative z-10"
    >
      <slot />
      <Toaster position="top-right" richColors />
    </AppLayout>

  </div>
</template>

