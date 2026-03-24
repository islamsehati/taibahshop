<template>
  <div
    v-if="open"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 dark:bg-white/50 transition-opacity duration-300"
  >
    <div
      class="bg-white dark:bg-black w-full max-w-2xl h-full max-h-screen overflow-y-auto shadow-lg py-6 transform transition-all duration-300 scale-100"
    >
      <!-- Header -->
      <div class="grid grid-cols-3 items-center pb-2 mb-4 px-6">
        <h3 class="text-start text-transparent">.</h3>
        <h3 class="text-lg font-semibold text-center">Checkout</h3>
        <button
          @click="$emit('update:open', false)"
          class="text-end text-gray-500 dark:text-gray-200 hover:text-gray-700 dark:hover:text-gray-50 text-sm"
        >
          ✕
        </button>
      </div>

      <!-- Form -->
      <div class="space-y-3 overflow-y-auto px-6 pt-2">
        <!-- Customer -->
        <SearchableSelect
          v-model="customerID"
          :items="props.users"
          label="Customer"
          value-key="id"
          :label-formatter="user => user.username ? `${user.name} • ${user.username}` : user.name"
        />

        <!-- Atas Nama (customer umum) -->
        <!-- <div v-if="isGeneralCustomer"> -->
        <div>
          <label class="block text-sm mb-1">Atas Nama</label>
          <input
            type="text"
            v-model="userAlias"
            placeholder="Nama yang tercantum di nota"
            class="p-2 border rounded w-full"
          />
        </div>

        <!-- Tanggal & Waktu -->
        <div>
          <label class="block text-sm mb-1">Tanggal & Waktu</label>
          <input
            type="datetime-local"
            v-model="date"
            class="p-2 border rounded w-full"
          />
        </div>

        <!-- Tipe Pesanan -->
        <div>
          <label class="block text-sm mb-2">Tipe Pesanan</label>
          <div class="grid grid-cols-3 gap-2">
            <label
              v-for="opt in orderTypeOptions"
              :key="opt.value"
              class="cursor-pointer border rounded-lg transition"
              :class="{
                'border-gray-800 bg-gray-100 dark:border-white dark:bg-neutral-900': orderType === opt.value,
                'border-gray-300 hover:border-gray-500 dark:border-neutral-700': orderType !== opt.value
              }"
            >
              <input type="radio" class="hidden" :value="opt.value" v-model="orderType" />
              <div class="block m-2 items-center">
                <component :is="opt.icon" class="w-6 h-6 mx-auto" />
                <div class="font-medium text-sm text-center">{{ opt.title }}</div>
                <div class="text-xs text-gray-500 dark:text-gray-400 text-center">{{ opt.desc }}</div>
              </div>
            </label>
          </div>
        </div>

        <!-- Catatan -->
        <div>
          <label class="block text-sm mb-1">Catatan</label>
          <Textarea v-model="notes" rows="2" />
        </div>

        <!-- Diskon, Biaya+, Pajak -->
        <div class="w-full grid grid-cols-3 gap-2">
          <div>
            <label class="block text-sm mb-1">Diskon</label>
            <input
              type="text"
              inputmode="numeric"
              :value="formatCurrency(discount)"
              @input="onDiscountInput"
              class="p-2 border rounded w-full"
            />
          </div>
          <div>
            <label class="block text-sm mb-1">Biaya+</label>
            <input
              type="text"
              inputmode="numeric"
              :value="formatCurrency(charge)"
              @input="onChargeInput"
              class="p-2 border rounded w-full"
            />
          </div>
          <div>
            <label class="block text-sm mb-1">Pajak</label>
            <input
              type="text"
              inputmode="numeric"
              :value="formatCurrency(tax)"
              @input="onTaxInput"
              class="p-2 border rounded w-full"
            />
          </div>
        </div>

        <!-- Metode Pembayaran -->
        <div>
          <label class="block text-sm mb-1">Metode Pembayaran</label>
          <select
            v-model="paymentMethod"
            class="border rounded-md h-10 px-3 text-sm w-full
                  bg-white text-gray-900
                  focus-visible:ring-1 focus-visible:ring-primary
                  dark:bg-neutral-900 dark:text-gray-200 dark:border-neutral-700"
          >
            <option value="" disabled>Pilih Metode Pembayaran</option>
            <option v-for="opt in paymentOptions" :key="opt.value" :value="opt.value">
              {{ opt.label }}
            </option>
          </select>
        </div>

        <!-- Nominal Bayar -->
        <div>
          <label class="block text-sm mb-1">Nominal Bayar</label>
          <input
            type="text"
            inputmode="numeric"
            :value="formatCurrency(paidAmount)"
            @input="onPaidInput"
            class="p-2 border rounded w-full"
          />
        </div>

        <!-- Ringkasan -->
        <div class="border-t pt-4 mt-4 space-y-1 text-sm">
          <div class="flex justify-between font-bold">
            <div>Sub total</div>
            <div>Rp {{ formatPrice(subTotal) }}</div>
          </div>
          <div class="flex justify-between"><div>Diskon</div><div>Rp {{ formatPrice(discount) }}</div></div>
          <div class="flex justify-between"><div>Biaya+</div><div>Rp {{ formatPrice(charge) }}</div></div>
          <div class="flex justify-between"><div>Pajak</div><div>Rp {{ formatPrice(tax) }}</div></div>
          <div class="flex justify-between pb-2 font-medium"><div>Grand total</div><div>Rp {{ formatPrice(gTotal) }}</div></div>
          <div class="flex justify-between border-t pt-2 font-bold"><div>Bayar</div><div>Rp {{ formatPrice(paidAmount) }}</div></div>
          <div class="flex justify-between"><div>Kembalian</div><div>Rp {{ formatPrice(changeAmount) }}</div></div>
        </div>
      </div>

      <!-- Tombol -->
      <div class="flex gap-2 pt-3 pb-3 px-6 bg-white dark:bg-black">
        <button
          class="w-full bg-gray-800 dark:bg-white text-white dark:text-black rounded-md py-2 hover:bg-gray-700 dark:hover:bg-gray-400 disabled:opacity-50 disabled:cursor-not-allowed"
          @click="submitCheckout"
        >
          Confirm & Pay
        </button>
        <button
          class="w-full bg-gray-500 text-white rounded-md py-2 hover:bg-gray-600"
          @click="$emit('update:open', false)"
        >
          Cancel
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, watch } from "vue";
import { router } from "@inertiajs/vue3";
import { toast } from "vue-sonner";
import dayjs from "dayjs";
import utc from "dayjs/plugin/utc";
import timezone from "dayjs/plugin/timezone";
import SearchableSelect from "@/components/SearchableSelect.vue";
import { Textarea } from "@/components/ui/textarea";
import { ShoppingBag, Soup, Truck } from "lucide-vue-next";
dayjs.extend(utc);
dayjs.extend(timezone);

const appTimezone = Intl.DateTimeFormat().resolvedOptions().timeZone;

const props = defineProps({
  open: Boolean,
  items: Array,
  users: Array,
  customerID: Number,
  notes: String,
  paymentMethod: String,
  date: String,
  orderType: String,
});

const emit = defineEmits([
  "update:open",
  "done",
  "update:customerID",
  "update:notes",
  "update:paymentMethod",
  "update:date",
  "update:orderType",
]);

// --- State (gabungkan props → localStorage → default) ---
function readLS(key, fallback = "") {
  const val = localStorage.getItem(key);
  return val !== null ? val : fallback;
}

const customerID = ref(props.customerID ?? Number(readLS("pos_last_customer", 0)));
const userAlias = ref(readLS("pos_last_user_alias", ""));
const discount = ref(Number(readLS("pos_last_discount", 0)));
const charge = ref(Number(readLS("pos_last_charge", 0)));
const tax = ref(Number(readLS("pos_last_tax", 0)));
const paidAmount = ref(Number(readLS("pos_last_paid", 0)));
const notes = ref(props.notes?.trim() || "");
const paymentMethod = ref(props.paymentMethod?.trim() || "cash");
const orderType = ref(props.orderType?.trim() || null);
const date = ref(null);

// --- Watch props → refs (sinkron dari parent / processOrderText) ---
watch(() => props.notes, v => { if (v !== undefined) notes.value = v; });
watch(() => props.paymentMethod, v => { if (v !== undefined) paymentMethod.value = v; });
watch(() => props.orderType, v => { if (v !== undefined) orderType.value = v; });
watch(
  () => props.date,
  (v) => {
    if (v !== undefined && v !== null) {
      date.value = v;
    }
  },
  { immediate: true }
);

// --- Watch refs → emit & localStorage ---
function safeNumber(v) { const n = Number(v); return isNaN(n) || n < 0 ? 0 : n; }

watch(customerID, v => localStorage.setItem("pos_last_customer", safeNumber(v)), { immediate: true });
watch(userAlias, v => localStorage.setItem("pos_last_user_alias", v || ""), { immediate: true });
watch(discount, v => localStorage.setItem("pos_last_discount", safeNumber(v)), { immediate: true });
watch(charge, v => localStorage.setItem("pos_last_charge", safeNumber(v)), { immediate: true });
watch(tax, v => localStorage.setItem("pos_last_tax", safeNumber(v)), { immediate: true });
watch(paidAmount, v => localStorage.setItem("pos_last_paid", safeNumber(v)), { immediate: true });

watch(
  () => props.customerID,
  v => {
    if (typeof v === "number" && v > 0) {
      customerID.value = v;
    }
  },
  { immediate: true }
);

watch(notes, (v) => {
  const val = v ?? "";

  localStorage.setItem("pos_last_notes", val);

  if (val !== props.notes) {
    emit("update:notes", val);
  }
});

watch(paymentMethod, (v) => {
  const val = v || "cash";

  localStorage.setItem("pos_last_payment", val);

  if (val !== props.paymentMethod) {
    emit("update:paymentMethod", val);
  }
});

watch(orderType, (v) => {
  const val = typeof v === "string" && v.length ? v : null;

  if (val) {
    localStorage.setItem("pos_last_order_type", val);
  } else {
    localStorage.removeItem("pos_last_order_type");
  }

  const propVal =
    typeof props.orderType === "string" && props.orderType.length
      ? props.orderType
      : null;

  if (val !== propVal) {
    emit("update:orderType", val);
  }
});

watch(date, (v) => {
  if (!v) return;

  localStorage.setItem("pos_last_date", v);

  if (v !== props.date) {
    emit("update:date", v);
  }
});

watch(customerID, v => {
  localStorage.setItem("pos_last_customer", safeNumber(v));

  if (v !== props.customerID) {
    emit("update:customerID", v);
  }
});




// --- Computed ---
const subTotal = computed(() => (props.items || []).reduce((s, i) => s + safeNumber(i.subtotal), 0));
const gTotal = computed(() => subTotal.value - discount.value + charge.value + tax.value);
const changeAmount = computed(() => paidAmount.value - gTotal.value);

// --- Options ---
const paymentOptions = [
  { value: "cash", label: "Cash" },
  { value: "bank", label: "Bank" },
  { value: "ewallet", label: "e-Wallet" },
  { value: "qris", label: "QRIS" },
];
const orderTypeOptions = [
  { value: "dine_in", title: "Dine In", desc: "Makan di tempat (F&B)", icon: Soup },
  { value: "self_pickup", title: "Self Pickup", desc: "Ambil sendiri sesuai jadwal", icon: ShoppingBag },
  { value: "delivery", title: "Delivery", desc: "Diantarkan oleh penjual", icon: Truck },
  { value: "dine_in_m", title: "D-In bM", desc: "by Marketplace", icon: Soup },
  { value: "self_pickup_m", title: "SPickup bM", desc: "by Marketplace", icon: ShoppingBag },
  { value: "delivery_m", title: "Dlvr bM", desc: "by Marketplace", icon: Truck },
];

// --- Helpers ---
function formatCurrency(value) { return Number(value || 0).toLocaleString("id-ID"); }
function formatPrice(value) { return Number(value || 0).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }); }
function extractNumber(value) { return Number(String(value).replace(/\D/g, "")) || 0; }
function onDiscountInput(e) { const raw = extractNumber(e.target.value); discount.value = raw; e.target.value = formatCurrency(raw); }
function onChargeInput(e) { const raw = extractNumber(e.target.value); charge.value = raw; e.target.value = formatCurrency(raw); }
function onTaxInput(e) { const raw = extractNumber(e.target.value); tax.value = raw; e.target.value = formatCurrency(raw); }
function onPaidInput(e) { const raw = extractNumber(e.target.value); paidAmount.value = raw; e.target.value = formatCurrency(raw); }

const selectedCustomer = computed(() => props.users?.find(u => u.id === customerID.value) || null);
const isGeneralCustomer = computed(() => {
  if (!selectedCustomer.value) return false;
  const name = selectedCustomer.value.name?.toLowerCase();
  return name === "supplier umum" || name === "customer umum" || name === "pengguna umum";
});

// --- Submit Checkout ---
async function submitCheckout() {
  // if (isGeneralCustomer.value && !userAlias.value.trim()) {
  //  toast.error("Kolom Atas Nama wajib diisi.");
  //  return;
  // }
  if (!orderType.value) { toast("Pilih tipe pesanan."); return; }
  if (!props.items || !props.items.length) { toast("Keranjang kosong."); return; }
  if (gTotal.value <= 0) { toast("Total harus > 0."); return; }

  const payload = {
    user_id: customerID.value || null,
    user_alias: userAlias.value.trim() || null,
    date: date.value,
    type: orderType.value,
    notes: notes.value || null,
    payment_method: paymentMethod.value || "cash",
    sub_total: subTotal.value,
    discount: discount.value,
    charge: charge.value,
    tax: tax.value,
    grand_total: gTotal.value,
    paid_amount: paidAmount.value,
    change_amount: changeAmount.value,
    items: props.items || [],
  };

  // Backup LS
  localStorage.setItem("pos_last_checkout", JSON.stringify(payload));

  try {
    const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute("content");
    const res = await fetch("/pos/checkout", {
      method: "POST",
      credentials: "same-origin",
      headers: { "Content-Type": "application/json", "Accept": "application/json", "X-CSRF-TOKEN": token },
      body: JSON.stringify(payload),
    });
    if (!res.ok) {
      const errorData = await res.json().catch(() => ({})); 
      console.error("Server Error Detail:", errorData);
      throw new Error(errorData.message || "Checkout gagal");
    }

    const data = await res.json();
    if (data && data.ok) {
      emit("done", data);
      emit("update:open", false);

      // bersihkan LS
      [
        "pos_cart_v1","pos_last_checkout","pos_last_customer","pos_last_user_alias",
        "pos_last_notes","pos_last_discount","pos_last_charge","pos_last_tax",
        "pos_last_payment","pos_last_paid","pos_last_subtotal","pos_last_gtotal","pos_last_changeamount"
      ].forEach(k => localStorage.removeItem(k));

      // reset refs
      customerID.value = 0;
      userAlias.value = "";
      notes.value = "";
      date.value = dayjs().tz(appTimezone).format("YYYY-MM-DDTHH:mm");
      discount.value = 0;
      charge.value = 0;
      tax.value = 0;
      paidAmount.value = 0;

      toast.success(
        `Berhasil 🎉 (Antrian: #${data.order_antrian})`,
        { duration: 3000 }
      );
      setTimeout(() => router.visit("/penjualan"), 4000);
    } else {
      toast.error("Error checkout");
    }
  } catch (e) {
    console.error(e);
    toast.error("Gagal kirim checkout");
  }
}
</script>