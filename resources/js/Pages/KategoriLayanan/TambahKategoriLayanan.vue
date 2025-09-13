<template>
  <LayoutUtama
    judul-halaman="Tambah Kategori Layanan"
    deskripsi-halaman="Tambah kategori layanan baru"
  >
    <div class="max-w-2xl">
      <div class="bg-white/10 backdrop-blur-sm rounded-xl border border-white/20 p-6">
        <form @submit.prevent="submitForm" class="space-y-6">
          <div>
            <label for="nama_kategori" class="block text-sm font-medium text-white mb-2">Nama Kategori</label>
            <input
              id="nama_kategori"
              v-model="form.nama_kategori"
              type="text"
              required
              class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-blue-500"
              placeholder="Masukkan nama kategori"
            />
            <div v-if="errors.nama_kategori" class="text-red-400 text-sm mt-1">{{ errors.nama_kategori }}</div>
          </div>

          <div>
            <label for="deskripsi" class="block text-sm font-medium text-white mb-2">Deskripsi</label>
            <textarea
              id="deskripsi"
              v-model="form.deskripsi"
              rows="3"
              class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-blue-500"
              placeholder="Deskripsi layanan"
            ></textarea>
            <div v-if="errors.deskripsi" class="text-red-400 text-sm mt-1">{{ errors.deskripsi }}</div>
          </div>

          <div>
            <label for="harga_per_kg" class="block text-sm font-medium text-white mb-2">Harga per Kg</label>
            <input
              id="harga_per_kg"
              v-model="form.harga_per_kg"
              type="number"
              min="0"
              required
              class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-blue-500"
              placeholder="Masukkan harga per kg"
            />
            <div v-if="errors.harga_per_kg" class="text-red-400 text-sm mt-1">{{ errors.harga_per_kg }}</div>
          </div>

          <div>
            <label for="estimasi_hari" class="block text-sm font-medium text-white mb-2">Estimasi Hari</label>
            <input
              id="estimasi_hari"
              v-model="form.estimasi_hari"
              type="number"
              min="1"
              required
              class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-blue-500"
              placeholder="Masukkan estimasi waktu pengerjaan"
            />
            <div v-if="errors.estimasi_hari" class="text-red-400 text-sm mt-1">{{ errors.estimasi_hari }}</div>
          </div>

          <div class="flex items-center space-x-4">
            <button
              type="submit"
              :disabled="form.processing"
              class="bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 disabled:opacity-50 text-white font-semibold py-3 px-6 rounded-lg transition-all duration-200"
            >
              <span v-if="form.processing">Menyimpan...</span>
              <span v-else>Simpan Kategori</span>
            </button>
            <Link
              :href="route('kategori-layanan.index')"
              class="bg-white/10 hover:bg-white/20 text-white font-semibold py-3 px-6 rounded-lg transition-all duration-200"
            >
              Batal
            </Link>
          </div>
        </form>
      </div>
    </div>
  </LayoutUtama>
</template>

<script setup>
import LayoutUtama from '@/Layouts/LayoutUtama.vue'
import { Link, useForm } from '@inertiajs/vue3'

const props = defineProps({
  errors: Object
})

const form = useForm({
  nama_kategori: '',
  deskripsi: '',
  harga_per_kg: '',
  estimasi_hari: ''
})

const submitForm = () => {
  form.post(route('kategori-layanan.store'))
}
</script>
