<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import { toast } from 'vue-sonner';
import { Card, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Textarea } from '@/components/ui/textarea';
import { Button } from '@/components/ui/button';
import SearchableSelect from '@/components/SearchableSelect.vue';
import { type BreadcrumbItem } from '@/types';

const props = defineProps<{
  branch: any;
  partners: Array<{ id: number; name: string }>;
}>();

const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Edit Cabang', href: `/admin/cabang/${props.branch.id}/edit` },
];

const form = ref({
  partner_id: props.branch.partner_id,
  name: props.branch.name ?? '',
  slug: props.branch.slug ?? '',
  phone: props.branch.phone ?? '',
  type: props.branch.type ?? '',
  street_address: props.branch.street_address ?? '',
  is_open: !!props.branch.is_open,
  is_active: !!props.branch.is_active,
  logo: null as File | null,
  image: null as File | null,
});

function generateSlugSelf() {
  form.value.slug = form.value.slug
    .toLowerCase()
    .trim()
    .replace(/\s+/g, '-')
    .replace(/[^a-z0-9\-]/g, '')
    .replace(/\-+/g, '-')
}


function submit() {
  const fd = new FormData();

  Object.entries(form.value).forEach(([key, val]) => {
    if (typeof val === 'boolean') {
      fd.append(key, val ? '1' : '0');
    } else if (Array.isArray(val)) {
      val.forEach((v, i) => fd.append(`type[${i}]`, v));
    } else if (val !== null) {
      fd.append(key, val as any);
    }
  });

  fd.append('_method', 'PUT');

  router.post(`/admin/cabang/${props.branch.id}`, fd, {
    preserveState: true,
    onSuccess: () => toast.success('Cabang berhasil diperbarui'),
  });
}

// ================= TAG INPUT =================
const typeInput = ref('') // input sementara
const typeTags = ref<string[]>([])

// inisialisasi dari backend
if (form.value.type) {
  typeTags.value = form.value.type.split(',').map(s => s.trim())
}

// ketika user tekan enter
function addTypeTag() {
  const value = typeInput.value.trim()
  if (!value) return
  if (!typeTags.value.includes(value)) {
    typeTags.value.push(value)
  }
  typeInput.value = ''
  // update form string
  form.value.type = typeTags.value.join(', ')
}

// hapus tag
function removeTypeTag(tag: string) {
  typeTags.value = typeTags.value.filter(t => t !== tag)
  form.value.type = typeTags.value.join(', ')
}
</script>

<template>
  <Head title="Edit Cabang" />
<AppLayout :breadcrumbs="breadcrumbs">
  <div class="py-4 px-3 space-y-4 ">

    <div class="flex flex-wrap lg:flex-nowrap gap-4">

      <!-- ================= LEFT (INFO UTAMA) ================= -->
      <div class="w-full lg:w-2/3 space-y-4">

        <!-- INFO CABANG -->
        <Card class="px-5">
          <CardHeader>
            <CardTitle>Info Cabang</CardTitle>
          </CardHeader>

          <div class="grid md:grid-cols-2 gap-4">
            <div class="space-y-2">
              <Label>Partner</Label>
              <SearchableSelect
                v-model="form.partner_id"
                :items="partners"
                label="Partner"
              />
            </div>

            <div class="space-y-2">
              <Label>Nama Cabang</Label>
              <Input v-model="form.name" />
            </div>

            <div class="space-y-2">
              <Label>Slug</Label>
              <Input v-model="form.slug" @input="generateSlugSelf" />
            </div>

            <div class="space-y-2">
              <Label>No. Telepon</Label>
              <Input v-model="form.phone" />
            </div>
          </div>

          <div><label class="mb-2">Tipe Usaha</Label>
            <div class="flex flex-wrap gap-2 mb-2">
              <span
                v-for="tag in typeTags"
                :key="tag"
                class="bg-blue-100 text-blue-800 px-2 py-1 rounded flex items-center gap-1 text-sm"
              >
                {{ tag }}
                <button type="button" @click="removeTypeTag(tag)" class="text-red-500 hover:text-red-700">✕</button>
              </span>
            </div>
            <Input
              v-model="typeInput"
              placeholder="Ketik dan tekan Enter..."
              @keyup.enter="addTypeTag"
            />
          </div>          

          <div class="space-y-2 mt-4">
            <Label>Alamat</Label>
            <Textarea v-model="form.street_address" rows="3" />
          </div>
        </Card>

      </div>

      <!-- ================= RIGHT (STATUS & MEDIA) ================= -->
      <div class="w-full lg:w-1/3 space-y-4">

        <!-- STATUS -->
        <Card class="px-5">
          <CardHeader>
            <CardTitle>Status</CardTitle>
          </CardHeader>

          <!-- ACTIVE -->
          <div class="bg-gray-100 dark:bg-gray-950 p-2 rounded-lg flex gap-1">
            <button
              type="button"
              class="flex-1 py-1 rounded transition"
              :class="!form.is_active
                ? 'bg-white shadow'
                : 'text-gray-500'"
              @click="form.is_active = false"
            >
              Tidak Aktif
            </button>

            <button
              type="button"
              class="flex-1 py-1 rounded transition"
              :class="form.is_active
                ? 'bg-green-500 text-white shadow'
                : 'text-gray-500'"
              @click="form.is_active = true"
            >
              Aktif
            </button>
          </div>

          <!-- OPEN -->
          <div class="bg-gray-100 dark:bg-gray-950 p-2 rounded-lg flex gap-1 mt-3">
            <button
              type="button"
              class="flex-1 py-1 rounded transition"
              :class="!form.is_open
                ? 'bg-white shadow'
                : 'text-gray-500'"
              @click="form.is_open = false"
            >
              Tutup
            </button>

            <button
              type="button"
              class="flex-1 py-1 rounded transition"
              :class="form.is_open
                ? 'bg-green-500 text-white shadow'
                : 'text-gray-500'"
              @click="form.is_open = true"
            >
              Buka
            </button>
          </div>
        </Card>

        <!-- MEDIA -->
        <Card class="px-5">
          <CardHeader>
            <CardTitle>Media</CardTitle>
          </CardHeader>

          <div class="space-y-3">
            <div>
              <Label>Logo</Label>
              <Input
                type="file"
                @change="e => form.logo = e.target.files?.[0] ?? null"
              />
              <img
                v-if="branch.logo"
                :src="branch.logo"
                class="h-16 mt-2 rounded"
              />
            </div>

            <div>
              <Label>Background Image</Label>
              <Input
                type="file"
                @change="e => form.image = e.target.files?.[0] ?? null"
              />
              <img
                v-if="branch.image"
                :src="branch.image"
                class="h-28 mt-2 rounded"
              />
            </div>
          </div>
        </Card>

      </div>
    </div>

    <!-- ACTION -->
    <div class="flex justify-end">
      <Button @click="submit">Simpan Perubahan</Button>
    </div>

  </div>
</AppLayout>

</template>
