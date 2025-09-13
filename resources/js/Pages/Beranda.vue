<template>
  <div class="min-h-screen bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900">
    <section class="relative overflow-hidden">
      <div class="absolute inset-0 bg-gradient-to-r from-blue-600/20 to-purple-600/20"></div>
      <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
        <div class="text-center">
          <div class="flex justify-center mb-8">
            <div class="w-20 h-20 bg-gradient-to-r from-blue-400 to-purple-500 rounded-2xl flex items-center justify-center animate-pulse">
              <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
              </svg>
            </div>
          </div>
          <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 animate-fade-in">
            Vultter
            <span class="bg-gradient-to-r from-blue-400 to-purple-500 bg-clip-text text-transparent">Laundry</span>
          </h1>
          <p class="text-xl text-white/80 mb-8 max-w-2xl mx-auto animate-fade-in">
            Layanan laundry premium untuk pakaian Anda. Bersih, wangi, dan profesional.
          </p>
          <div class="flex flex-col space-y-4 sm:flex-row sm:space-y-0 sm:space-x-4 justify-center animate-fade-in">
            <Link
              :href="route('login')"
              class="group bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white font-semibold py-4 px-8 rounded-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center"
            >
              <span>Masuk ke Dashboard</span>
              <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
              </svg>
            </Link>
          </div>
        </div>
      </div>
    </section>

    <!-- info device -->
    <section class="py-12">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white/10 backdrop-blur-sm rounded-xl border border-white/20 p-6 mb-8">
          <h2 class="text-2xl font-semibold text-white mb-6 text-center flex items-center justify-center">
            <svg class="w-6 h-6mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
            Informasi Device
          </h2>

          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <!-- nama device -->
            <div class="bg-white/5 rounded-lg p-4 flex items-center space-x-3">
              <div class="w-10 h-10 bg-blue-500/20 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
              </div>
              <div>
                <p class="text-white/60 text-sm">Device</p>
                <p class="text-white font-medium">{{ deviceInfo.name }}</p>
              </div>
            </div>

            <!-- ip -->
            <div class="bg-white/5 rounded-lg p-4 flex items-center space-x-3">
              <div class="w-10 h-10 bg-green-500/20 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9" />
                </svg>
              </div>
              <div>
                <p class="text-white/60 text-sm">IP Address</p>
                <p class="text-white font-medium">{{ deviceInfo.ip }}</p>
              </div>
            </div>

            <!-- lokasi -->
            <div class="bg-white/5 rounded-lg p-4 flex items-center space-x-3">
              <div class="w-10 h-10 bg-purple-500/20 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
              </div>
              <div>
                <p class="text-white/60 text-sm">Location</p>
                <p class="text-white font-medium">{{ deviceInfo.location }}</p>
              </div>
            </div>

            <!-- batre-->
            <div class="bg-white/5 rounded-lg p-4 flex items-center space-x-3">
              <div class="w-10 h-10 bg-yellow-500/20 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
              </div>
              <div class="flex-1">
                <div class="flex items-center justify-between mb-1">
                  <p class="text-white/60 text-sm">Battery</p>
                  <p class="text-white font-medium">{{ deviceInfo.battery.percentage }}%</p>
                </div>
                <div class="w-full bg-gray-700 rounded-full h-2">
                  <div
                    class="h-2 rounded-full transition-all duration-500"
                    :class="getBatteryColor(deviceInfo.battery.percentage)"
                    :style="{ width: deviceInfo.battery.percentage + '%' }"
                  ></div>
                </div>
                <p class="text-xs text-white/50 mt-1">
                  {{ deviceInfo.battery.charging ? 'Charging' : 'Not Charging' }}
                </p>
              </div>
            </div>

            <!-- os -->
            <div class="bg-white/5 rounded-lg p-4 flex items-center space-x-3">
              <div class="w-10 h-10 bg-indigo-500/20 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />
                </svg>
              </div>
              <div>
                <p class="text-white/60 text-sm">Platform</p>
                <p class="text-white font-medium">{{ deviceInfo.platform }}</p>
              </div>
            </div>

            <!-- koneksi -->
            <div class="bg-white/5 rounded-lg p-4 flex items-center space-x-3">
              <div class="w-10 h-10 bg-red-500/20 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0" />
                </svg>
              </div>
              <div>
                <p class="text-white/60 text-sm">Connection</p>
                <p class="text-white font-medium">{{ deviceInfo.connection }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- lacak order -->
    <section class="py-12">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white/10 backdrop-blur-sm rounded-xl border border-white/20 p-6">
          <h2 class="text-2xl font-semibold text-white mb-4 text-center">Lacak Pesanan Anda</h2>
          <div class="max-w-md mx-auto">
            <form @submit.prevent="cariPesanan" class="flex space-x-4">
              <input
                v-model="kodePesanan"
                type="text"
                placeholder="Masukkan kode pesanan (contoh: VLT-XXXXXXXX)"
                class="flex-1 px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-blue-500"
                :disabled="isLoading"
              >
              <button
                type="submit"
                :disabled="isLoading"
                class="bg-blue-500 hover:bg-blue-600 disabled:bg-blue-500/50 text-white px-6 py-3 rounded-lg font-medium transition-all duration-300 flex items-center min-w-[100px] justify-center"
              >
                <div v-if="isLoading" class="flex items-center">
                  <div class="animate-spin rounded-full h-4 w-4 border-2 border-white border-t-transparent mr-2"></div>
                  <span>Mencari...</span>
                </div>
                <div v-else class="flex items-center">
                  <span>Lacak</span>
                  <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                  </svg>
                </div>
              </button>
            </form>

            <!-- hasil lacak -->
            <div v-if="trackingResult.show" class="mt-8 bg-white/5 rounded-lg p-6 space-y-6 animate-slide-up">
              <!-- info -->
              <div class="border-b border-white/10 pb-4">
                <h3 class="text-lg font-semibold text-white mb-2">Informasi Pesanan</h3>
                <div class="grid grid-cols-2 gap-4 text-white/80">
                  <div>
                    <p class="text-sm text-white/60">Kode Pesanan</p>
                    <p class="font-medium">{{ trackingResult.data.transaksi.kode_transaksi }}</p>
                  </div>
                  <div>
                    <p class="text-sm text-white/60">Tanggal Masuk</p>
                    <p>{{ formatTanggal(trackingResult.data.transaksi.tanggal_masuk) }}</p>
                  </div>
                  <div>
                    <p class="text-sm text-white/60">Jenis Layanan</p>
                    <p>{{ trackingResult.data.transaksi.kategori_layanan.nama_kategori }}</p>
                  </div>
                  <div>
                    <p class="text-sm text-white/60">Total Biaya</p>
                    <p>Rp {{ formatRupiah(trackingResult.data.transaksi.total_harga) }}</p>
                  </div>
                </div>
              </div>

              <!-- status -->
              <div>
                <h3 class="text-lg font-semibold text-white mb-4">Status Pesanan</h3>
                <div class="space-y-4">
                  <div v-for="(status, index) in trackingResult.data.timeline"
                       :key="status.status"
                       class="flex items-center space-x-4"
                  >
                    <div
                      :class="[
                          'w-4 h-4 rounded-full transition-all duration-500',
                          status.active ? 'bg-blue-500 animate-pulse' : 'bg-white/20'
                      ]"
                    ></div>
                    <div class="flex-1">
                      <p :class="[
                          'font-medium transition-colors duration-300',
                          status.active ? 'text-white' : 'text-white/60'
                      ]">{{ status.label }}</p>
                      <p v-if="status.time" class="text-sm text-white/60">
                        {{ formatTanggal(status.time) }}
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ftur -->
    <section class="py-24">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
          <h2 class="text-3xl font-bold text-white mb-4">Layanan Unggulan Kami</h2>
          <p class="text-white/60 max-w-2xl mx-auto">
            Berbagai layanan premium untuk merawat pakaian kesayangan Anda
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <div class="bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 p-8 hover:bg-white/10 transition-all duration-300 group">
            <div class="w-16 h-16 bg-blue-500/20 rounded-lg flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
              <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
            <h3 class="text-xl font-semibold text-white mb-4">Premium Washing</h3>
            <p class="text-white/60">Mencuci dengan deterjen berkualitas tinggi dan treatment khusus untuk setiap jenis kain.</p>
          </div>

          <div class="bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 p-8 hover:bg-white/10 transition-all duration-300 group">
            <div class="w-16 h-16 bg-green-500/20 rounded-lg flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
              <svg class="w-8 h-8 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
              </svg>
            </div>
            <h3 class="text-xl font-semibold text-white mb-4">Setrika Profesional</h3>
            <p class="text-white/60">Hasil setrika rapi dengan teknologi modern dan tenaga profesional berpengalaman.</p>
          </div>

          <div class="bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 p-8 hover:bg-white/10 transition-all duration-300 group">
            <div class="w-16 h-16 bg-purple-500/20 rounded-lg flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
              <svg class="w-8 h-8 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
              </svg>
            </div>
            <h3 class="text-xl font-semibold text-white mb-4">Express Service</h3>
            <p class="text-white/60">Layanan kilat untuk kebutuhan mendesak dengan kualitas tetap terjaga.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- footer -->
    <footer class="border-t border-white/10 py-12">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
          <div class="flex items-center justify-center space-x-2 mb-4">
            <div class="w-8 h-8 bg-gradient-to-r from-blue-400 to-purple-500 rounded-lg flex items-center justify-center">
              <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
              </svg>
            </div>
            <span class="text-xl font-bold text-white">Vultter</span>
          </div>
          <p class="text-white/60 mb-2">Dibuat dengan ❤️ oleh Naufal Dzakwan (VL)</p>
          <p class="text-white/40 text-sm">© 2025 Vultter Laundry. Semua hak dilindungi.</p>
        </div>
      </div>
    </footer>

    <!-- notip -->
    <Transition
      enter-active-class="transition duration-300 ease-out"
      enter-from-class="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
      enter-to-class="translate-y-0 opacity-100 sm:translate-x-0"
      leave-active-class="transition duration-100 ease-in"
      leave-from-class="opacity-100"
      leave-to-class="opacity-0"
    >
      <div
        v-if="toast.show"
        class="fixed top-5 right-5 z-50 max-w-sm w-full"
      >
        <div
          :class="[
            'rounded-lg shadow-lg border p-4 backdrop-blur-sm',
            toast.type === 'success'
              ? 'bg-green-500/20 border-green-400/30 text-green-100'
              : 'bg-red-500/20 border-red-400/30 text-red-100'
          ]"
        >
          <div class="flex items-center space-x-3">
            <div class="flex-shrink-0">
              <svg v-if="toast.type === 'success'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              <svg v-else class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
            <p class="font-medium">{{ toast.message }}</p>
            <button @click="toast.hide()" class="ml-auto flex-shrink-0">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>
        </div>
      </div>
    </Transition>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import { ref, reactive, onMounted } from 'vue'

const kodePesanan = ref('')
const isLoading = ref(false)
const trackingResult = reactive({
    show: false,
    data: null
})

const deviceInfo = reactive({
    name: 'Unknown Device',
    ip: 'Detecting...',
    location: 'Detecting...',
    battery: {
        percentage: 0,
        charging: false
    },
    platform: 'Unknown',
    connection: 'Unknown'
})

const toast = reactive({
    show: false,
    message: '',
    type: 'success',
    hide() {
        this.show = false
    },
    success(message) {
        this.message = message
        this.type = 'success'
        this.show = true
        setTimeout(() => this.hide(), 5000)
    },
    error(message) {
        this.message = message
        this.type = 'error'
        this.show = true
        setTimeout(() => this.hide(), 5000)
    }
})

const getDeviceInfo = async () => {
    try {
        const userAgent = navigator.userAgent
        deviceInfo.platform = getPlatform(userAgent)
        deviceInfo.name = getDeviceName(userAgent)
        deviceInfo.connection = getConnectionType()

        try {
            const ipResponse = await fetch('https://api.ipify.org?format=json')
            const ipData = await ipResponse.json()
            deviceInfo.ip = ipData.ip

            const locationResponse = await fetch(`https://ipapi.co/${ipData.ip}/json/`)
            const locationData = await locationResponse.json()
            deviceInfo.location = `${locationData.city}, ${locationData.country_name}`
        } catch (error) {
            deviceInfo.ip = 'Unable to detect'
            deviceInfo.location = 'Unable to detect'
        }

        if ('getBattery' in navigator) {
            try {
                const battery = await navigator.getBattery()
                deviceInfo.battery.percentage = Math.round(battery.level * 100)
                deviceInfo.battery.charging = battery.charging

                battery.addEventListener('chargingchange', () => {
                    deviceInfo.battery.charging = battery.charging
                })
                battery.addEventListener('levelchange', () => {
                    deviceInfo.battery.percentage = Math.round(battery.level * 100)
                })
            } catch (error) {
                deviceInfo.battery.percentage = 'N/A'
                deviceInfo.battery.charging = false
            }
        } else {
            deviceInfo.battery.percentage = 'N/A'
            deviceInfo.battery.charging = false
        }
    } catch (error) {
        console.error('Error getting device info:', error)
    }
}

const getPlatform = (userAgent) => {
    if (userAgent.includes('Windows')) return 'Windows'
    if (userAgent.includes('Mac')) return 'macOS'
    if (userAgent.includes('Linux')) return 'Linux'
    if (userAgent.includes('Android')) return 'Android'
    if (userAgent.includes('iOS') || userAgent.includes('iPhone') || userAgent.includes('iPad')) return 'iOS'
    return 'Unknown'
}

const getDeviceName = (userAgent) => {
    if (userAgent.includes('iPhone')) return 'iPhone'
    if (userAgent.includes('iPad')) return 'iPad'
    if (userAgent.includes('Android')) return 'Android Device'
    if (userAgent.includes('Mac')) return 'Mac'
    if (userAgent.includes('Windows')) return 'Windows PC'
    if (userAgent.includes('Linux')) return 'Linux PC'
    return 'Unknown Device'
}

const getConnectionType = () => {
    if ('connection' in navigator) {
        const connection = navigator.connection
        return connection.effectiveType || 'Unknown'
    }
    return 'Unknown'
}

const getBatteryColor = (percentage) => {
    if (percentage === 'N/A') return 'bg-gray-500'
    if (percentage > 50) return 'bg-green-500'
    if (percentage > 20) return 'bg-yellow-500'
    return 'bg-red-500'
}

const cariPesanan = async () => {
    if (!kodePesanan.value.trim()) {
        toast.error('Masukkan kode pesanan terlebih dahulu')
        return
    }

    isLoading.value = true
    trackingResult.show = false

    try {
        await new Promise(resolve => setTimeout(resolve, 1500))

        const response = await axios.get(`/tracking/${kodePesanan.value}`)

        trackingResult.data = response.data
        trackingResult.show = true
        toast.success('Pesanan berhasil ditemukan!')

    } catch (error) {
        console.error('Tracking error:', error)
        toast.error('Pesanan tidak ditemukan atau terjadi kesalahan')
        trackingResult.show = false
        trackingResult.data = null
    } finally {
        isLoading.value = false
    }
}

const formatTanggal = (tanggal) => {
    if (!tanggal) return '-'
    return new Date(tanggal).toLocaleDateString('id-ID', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    })
}

const formatRupiah = (angka) => {
    if (!angka) return '0'
    return new Intl.NumberFormat('id-ID').format(angka)
}

onMounted(() => {
    getDeviceInfo()
})
</script>

<style scoped>
@keyframes fade-in {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes slide-up {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.animate-fade-in {
  animation: fade-in 0.8s ease-out;
}

.animate-slide-up {
  animation: slide-up 0.6s ease-out;
}

::-webkit-scrollbar {
  width: 8px;
}

::-webkit-scrollbar-track {
  background: rgba(255, 255, 255, 0.1);
  border-radius: 10px;
}

::-webkit-scrollbar-thumb {
  background: rgba(255, 255, 255, 0.3);
  border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
  background: rgba(255, 255, 255, 0.5);
}

@keyframes spin {
  to {
    transform: rotate(360deg);
  }
}

.animate-spin {
  animation: spin 1s linear infinite;
}

@keyframes pulse {
  0%, 100% {
    opacity: 1;
  }
  50% {
    opacity: .5;
  }
}

.animate-pulse {
  animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}
</style>
