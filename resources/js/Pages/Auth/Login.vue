<template>
  <div class="min-h-screen bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 flex items-center justify-center p-4">
    <div v-if="isChecking" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center">
      <div class="bg-white rounded-2xl p-8 flex flex-col items-center max-w-sm mx-4 transform scale-95 animate-scale">
        <div class="w-16 h-16 mb-4">
          <svg v-if="!loginSuccess" class="animate-spin" viewBox="0 0 24 24" fill="none">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
          </svg>
          <svg v-else class="text-green-500 animate-check" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
          </svg>
        </div>
        <p class="text-gray-800 text-lg font-medium">{{ loadingMessage }}</p>
        <p class="text-gray-500 text-sm text-center mt-2">{{ loadingDescription }}</p>
      </div>
    </div>

    <div v-if="showError" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center">
      <div class="bg-white rounded-2xl p-8 flex flex-col items-center max-w-sm mx-4 transform scale-95 animate-scale">
        <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mb-4">
          <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-2">Akses Ditolak</h3>
        <p class="text-gray-500 text-center mb-6">Maaf, Anda tidak memiliki izin untuk mengakses sistem ini.</p>
        <button
          @click="closeError"
          class="bg-gray-100 hover:bg-gray-200 text-gray-800 font-medium py-2 px-4 rounded-lg transition-colors"
        >
          Tutup
        </button>
      </div>
    </div>

    <div class="max-w-md w-full space-y-8">
      <div class="text-center">
        <div class="mx-auto w-16 h-16 bg-gradient-to-r from-blue-400 to-purple-500 rounded-xl flex items-center justify-center mb-4">
          <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
          </svg>
        </div>
        <h2 class="text-3xl font-bold text-white">Masuk ke Vultter</h2>
        <p class="text-white/60 mt-2">Area khusus staff Vultter Laundry</p>
      </div>

      <div class="bg-white/10 backdrop-blur-sm rounded-xl border border-white/20 p-8">
        <form @submit.prevent="submitForm" class="space-y-6">
          <div>
            <label for="email" class="block text-sm font-medium text-white mb-2">Email</label>
            <input
              id="email"
              v-model="form.email"
              type="email"
              required
              class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
              placeholder="Masukkan email Anda"
              :disabled="form.processing"
            />
            <div v-if="errors.email" class="text-red-400 text-sm mt-1">{{ errors.email }}</div>
          </div>

          <div>
            <label for="password" class="block text-sm font-medium text-white mb-2">Password</label>
            <input
              id="password"
              v-model="form.password"
              type="password"
              required
              class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
              placeholder="Masukkan password Anda"
              :disabled="form.processing"
            />
            <div v-if="errors.password" class="text-red-400 text-sm mt-1">{{ errors.password }}</div>
          </div>

          <button
            type="submit"
            :disabled="form.processing || isChecking"
            class="relative w-full bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 disabled:opacity-50 text-white font-semibold py-3 px-4 rounded-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 overflow-hidden group"
          >
            <span v-if="!form.processing && !isChecking" class="group-hover:translate-x-1 transition-transform inline-block">
              Masuk
            </span>
            <svg v-else class="animate-spin h-5 w-5 mx-auto text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
          </button>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link, useForm } from '@inertiajs/vue3'
import { useToast } from '@/Composables/useToast'
import { ref, computed } from 'vue'

const props = defineProps({
  errors: Object
})

const toast = useToast()
const isChecking = ref(false)
const loginSuccess = ref(false)
const showError = ref(false)
const form = useForm({
  email: '',
  password: '',
})

const loadingMessage = computed(() => {
  if (loginSuccess.value) return 'Login Berhasil!'
  return 'Memeriksa Akses...'
})

const loadingDescription = computed(() => {
  if (loginSuccess.value) return 'Mengalihkan ke dashboard...'
  return 'Mohon tunggu sebentar'
})

const closeError = () => {
  showError.value = false
  form.reset()
}

const submitForm = () => {
  isChecking.value = true
  loginSuccess.value = false

  form.post(route('login'), {
    onSuccess: (response) => {
      if (response?.props?.auth?.user?.tipe_pengguna === 'pelanggan') {
        setTimeout(() => {
          isChecking.value = false
          showError.value = true
        }, 1500)
        return
      }

      loginSuccess.value = true
      setTimeout(() => {
        window.location.href = route('dashboard')
      }, 1000)
    },
    onError: (errors) => {
      setTimeout(() => {
        isChecking.value = false
        if (errors.error === 'unauthorized_role') {
          showError.value = true
        } else {
          toast.error('Email atau password salah')
        }
      }, 1500)
    }
  })
}
</script>

<style>
.animate-scale {
  animation: scale 0.3s ease-out;
}

.animate-check {
  animation: check 0.5s ease-out forwards;
}

@keyframes scale {
  0% {
    transform: scale(0.95);
    opacity: 0;
  }
  100% {
    transform: scale(1);
    opacity: 1;
  }
}

@keyframes check {
  0% {
    transform: scale(0);
    opacity: 0;
  }
  50% {
    transform: scale(1.2);
  }
  100% {
    transform: scale(1);
    opacity: 1;
  }
}
</style>
