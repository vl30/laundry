<template>
  <LayoutUtama
    judul-halaman="Dashboard"
    deskripsi-halaman="Ringkasan aktivitas laundry Vultter hari ini"
  >

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
      <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 border border-white/20 hover:bg-white/15 transition-all duration-300">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-white/60 text-sm font-medium">Total Transaksi</p>
            <p class="text-2xl font-bold text-white">{{ statistik.totalTransaksi }}</p>
          </div>
          <div class="w-12 h-12 bg-blue-500/20 rounded-lg flex items-center justify-center">
            <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
          </div>
        </div>
      </div>

      <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 border border-white/20 hover:bg-white/15 transition-all duration-300">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-white/60 text-sm font-medium">Total Pelanggan</p>
            <p class="text-2xl font-bold text-white">{{ statistik.totalPelanggan }}</p>
          </div>
          <div class="w-12 h-12 bg-green-500/20 rounded-lg flex items-center justify-center">
            <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
            </svg>
          </div>
        </div>
      </div>

      <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 border border-white/20 hover:bg-white/15 transition-all duration-300">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-white/60 text-sm font-medium">Transaksi Hari Ini</p>
            <p class="text-2xl font-bold text-white">{{ statistik.transaksiHariIni }}</p>
          </div>
          <div class="w-12 h-12 bg-yellow-500/20 rounded-lg flex items-center justify-center">
            <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
          </div>
        </div>
      </div>

      <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 border border-white/20 hover:bg-white/15 transition-all duration-300">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-white/60 text-sm font-medium">Pendapatan Bulan Ini</p>
            <p class="text-2xl font-bold text-white">Rp {{ formatRupiah(statistik.pendapatanBulanIni) }}</p>
          </div>
          <div class="w-12 h-12 bg-purple-500/20 rounded-lg flex items-center justify-center">
            <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
            </svg>
          </div>
        </div>
      </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
      <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 border border-white/20">
        <h3 class="text-lg font-semibold text-white mb-4">Pendapatan Per Bulan</h3>
        <div class="h-64">
          <Bar
            :data="chartData"
            :options="chartOptions"
          />
        </div>
      </div>

      <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 border border-white/20">
        <h3 class="text-lg font-semibold text-white mb-4">Status Transaksi</h3>
        <div class="space-y-4">
          <div class="flex items-center justify-between">
            <span class="text-white/80">Transaksi Selesai</span>
            <span class="text-white font-semibold">{{ statistik.transaksiSelesai }}</span>
          </div>
          <div class="w-full bg-white/10 rounded-full h-2">
            <div
              class="bg-green-500 h-2 rounded-full"
              :style="`width: ${(statistik.transaksiSelesai / statistik.totalTransaksi) * 100}%`"
            ></div>
          </div>
        </div>
      </div>
    </div>

    <div class="bg-white/10 backdrop-blur-sm rounded-xl border border-white/20 overflow-hidden">
      <div class="p-6 border-b border-white/20">
        <div class="flex items-center justify-between">
          <h3 class="text-lg font-semibold text-white">Transaksi Terbaru</h3>
          <Link :href="route('transaksi.index')"
                class="text-blue-400 hover:text-blue-300 text-sm font-medium transition-colors">
            Lihat Semua
          </Link>
        </div>
      </div>
      <div class="overflow-x-auto">
        <table class="w-full">
          <thead class="bg-white/5">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-white/60 uppercase tracking-wider">Kode</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-white/60 uppercase tracking-wider">Pelanggan</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-white/60 uppercase tracking-wider">Layanan</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-white/60 uppercase tracking-wider">Total</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-white/60 uppercase tracking-wider">Status</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-white/10">
            <tr v-for="transaksi in transaksiTerbaru" :key="transaksi.id"
                class="hover:bg-white/5 transition-colors">
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-white">
                {{ transaksi.kode_transaksi }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-white/80">
                {{ transaksi.pelanggan.nama }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-white/80">
                {{ transaksi.kategori_layanan.nama_kategori }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-white/80">
                Rp {{ formatRupiah(transaksi.total_harga) }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span :class="getBadgeStatus(transaksi.status_transaksi)"
                      class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full">
                  {{ transaksi.status_transaksi }}
                </span>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </LayoutUtama>
</template>

<script setup>
import LayoutUtama from '@/Layouts/LayoutUtama.vue'
import { Link } from '@inertiajs/vue3'
import { Bar } from 'vue-chartjs'
import { Chart as ChartJS, CategoryScale, LinearScale, BarElement, Title, Tooltip, Legend } from 'chart.js'

ChartJS.register(CategoryScale, LinearScale, BarElement, Title, Tooltip, Legend)

const props = defineProps({
  statistik: Object,
  transaksiTerbaru: Array
})

const formatRupiah = (angka) => {
  return new Intl.NumberFormat('id-ID').format(angka)
}

const chartData = {
  labels: props.statistik.pendapatanPerBulan.map(item => item.bulan),
  datasets: [
    {
      label: 'Pendapatan',
      data: props.statistik.pendapatanPerBulan.map(item => item.total),
      backgroundColor: 'rgba(59, 130, 246, 0.5)',
      borderColor: 'rgb(59, 130, 246)',
      borderWidth: 1
    }
  ]
}

const chartOptions = {
  responsive: true,
  maintainAspectRatio: false,
  plugins: {
    legend: {
      labels: {
        color: 'rgba(255, 255, 255, 0.8)'
      }
    }
  },
  scales: {
    y: {
      beginAtZero: true,
      grid: {
        color: 'rgba(255, 255, 255, 0.1)'
      },
      ticks: {
        color: 'rgba(255, 255, 255, 0.8)',
        callback: function(value) {
          return 'Rp ' + new Intl.NumberFormat('id-ID').format(value)
        }
      }
    },
    x: {
      grid: {
        color: 'rgba(255, 255, 255, 0.1)'
      },
      ticks: {
        color: 'rgba(255, 255, 255, 0.8)'
      }
    }
  }
}

const getBadgeStatus = (status) => {
  const statusMap = {
    'menunggu': 'bg-yellow-100 text-yellow-800',
    'dicuci': 'bg-blue-100 text-blue-800',
    'dijemur': 'bg-orange-100 text-orange-800',
    'disetrika': 'bg-purple-100 text-purple-800',
    'selesai': 'bg-green-100 text-green-800',
    'diambil': 'bg-gray-100 text-gray-800'
  }
  return statusMap[status] || 'bg-gray-100 text-gray-800'
}
</script>
