<template>
  <LayoutUtama
    judul-halaman="Edit Pengguna"
    deskripsi-halaman="Ubah informasi pengguna"
  >
    <div class="max-w-2xl">
      <div class="bg-white/10 backdrop-blur-sm rounded-xl border border-white/20 p-6">
        <form @submit.prevent="submitForm" class="space-y-6">
          <div>
            <label for="nama" class="block text-sm font-medium text-white mb-2">Nama Lengkap</label>
            <input
              id="nama"
              v-model="form.nama"
              type="text"
              required
              class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-blue-500"
              placeholder="Masukkan nama lengkap"
            />
            <div v-if="errors.nama" class="text-red-400 text-sm mt-1">{{ errors.nama }}</div>
          </div>

          <div>
            <label for="email" class="block text-sm font-medium text-white mb-2">Email</label>
            <input
              id="email"
              v-model="form.email"
              type="email"
              required
              class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-blue-500"
              placeholder="Masukkan email"
            />
            <div v-if="errors.email" class="text-red-400 text-sm mt-1">{{ errors.email }}</div>
          </div>

          <div>
            <label for="password" class="block text-sm font-medium text-white mb-2">Password (Kosongkan jika tidak ingin mengubah)</label>
            <input
              id="password"
              v-model="form.password"
              type="password"
              class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-blue-500"
              placeholder="Masukkan password baru"
            />
            <div v-if="errors.password" class="text-red-400 text-sm mt-1">{{ errors.password }}</div>
          </div>

          <div>
            <label for="tipe_pengguna" class="block text-sm font-medium text-white mb-2">Tipe Pengguna</label>
            <select
              id="tipe_pengguna"
              v-model="form.tipe_pengguna"
              required
              class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
              <option value="">Pilih Tipe Pengguna</option>
              <option value="admin">Admin</option>
              <option value="kasir">Kasir</option>
              <option value="pelanggan">Pelanggan</option>
            </select>
            <div v-if="errors.tipe_pengguna" class="text-red-400 text-sm mt-1">{{ errors.tipe_pengguna }}</div>
          </div>

          <div>
            <label for="no_telepon" class="block text-sm font-medium text-white mb-2">No. Telepon</label>
            <input
              id="no_telepon"
              v-model="form.no_telepon"
              type="tel"
              required
              class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-blue-500"
              placeholder="Masukkan nomor telepon"
            />
            <div v-if="errors.no_telepon" class="text-red-400 text-sm mt-1">{{ errors.no_telepon }}</div>
          </div>

          <div>
            <label for="alamat" class="block text-sm font-medium text-white mb-2">Alamat</label>
            <textarea
              id="alamat"
              v-model="form.alamat"
              rows="3"
              required
              class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-blue-500"
              placeholder="Masukkan alamat lengkap"
            ></textarea>
            <div v-if="errors.alamat" class="text-red-400 text-sm mt-1">{{ errors.alamat }}</div>
          </div>

          <div class="flex items-center space-x-4">
            <button
              type="submit"
              :disabled="form.processing"
              class="bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 disabled:opacity-50 text-white font-semibold py-3 px-6 rounded-lg transition-all duration-200"
            >
              <span v-if="form.processing">Menyimpan...</span>
              <span v-else>Update Pengguna</span>
            </button>
            <Link
              :href="route('pengguna.index')"
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
  pengguna: Object,
  errors: Object
})

const form = useForm({
  nama: props.pengguna.nama,
  email: props.pengguna.email,
  password: '',
  tipe_pengguna: props.pengguna.tipe_pengguna,
  no_telepon: props.pengguna.no_telepon,
  alamat: props.pengguna.alamat
})

const submitForm = () => {
  form.put(route('pengguna.update', props.pengguna.id))
}
</script>
