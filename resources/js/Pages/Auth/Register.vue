<template>
  <div class="min-h-screen bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 flex items-center justify-center p-4">
    <div class="max-w-md w-full space-y-8">
      <div class="text-center">
        <div class="mx-auto w-16 h-16 bg-gradient-to-r from-blue-400 to-purple-500 rounded-xl flex items-center justify-center mb-4">
          <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
          </svg>
        </div>
        <h2 class="text-3xl font-bold text-white">Daftar ke Vultter</h2>
        <p class="text-white/60 mt-2">Bergabung dengan layanan laundry terbaik</p>
      </div>

      <div class="bg-white/10 backdrop-blur-sm rounded-xl border border-white/20 p-8">
        <form @submit.prevent="submitForm" class="space-y-6">
          <div>
            <label for="nama" class="block text-sm font-medium text-white mb-2">Nama Lengkap</label>
            <input
              id="nama"
              v-model="form.nama"
              type="text"
              required
              class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
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
              class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
              placeholder="Masukkan email"
            />
            <div v-if="errors.email" class="text-red-400 text-sm mt-1">{{ errors.email }}</div>
          </div>

          <div>
            <label for="no_telepon" class="block text-sm font-medium text-white mb-2">No. Telepon</label>
            <input
              id="no_telepon"
              v-model="form.no_telepon"
              type="tel"
              class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
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
              class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
              placeholder="Masukkan alamat lengkap"
            ></textarea>
            <div v-if="errors.alamat" class="text-red-400 text-sm mt-1">{{ errors.alamat }}</div>
          </div>

          <div>
            <label for="password" class="block text-sm font-medium text-white mb-2">Password</label>
            <input
              id="password"
              v-model="form.password"
              type="password"
              required
              class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
              placeholder="Masukkan password"
            />
            <div v-if="errors.password" class="text-red-400 text-sm mt-1">{{ errors.password }}</div>
          </div>

          <div>
            <label for="password_confirmation" class="block text-sm font-medium text-white mb-2">Konfirmasi Password</label>
            <input
              id="password_confirmation"
              v-model="form.password_confirmation"
              type="password"
              required
              class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
              placeholder="Konfirmasi password"
            />
          </div>

          <button
            type="submit"
            :disabled="form.processing"
            class="w-full bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 disabled:opacity-50 text-white font-semibold py-3 px-4 rounded-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500"
          >
            <span v-if="form.processing">Mendaftar...</span>
            <span v-else>Daftar</span>
          </button>

          <div class="text-center">
            <Link :href="route('login')" class="text-blue-400 hover:text-blue-300 text-sm transition-colors">
              Sudah punya akun? Masuk di sini
            </Link>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link, useForm } from '@inertiajs/vue3'

const props = defineProps({
  errors: Object
})

const form = useForm({
  nama: '',
  email: '',
  no_telepon: '',
  alamat: '',
  password: '',
  password_confirmation: ''
})

const submitForm = () => {
  form.post(route('register'), {
    onSuccess: () => {
      form.reset()
    }
  })
}
</script>
