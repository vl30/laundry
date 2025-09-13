<template>
  <LayoutUtama
    judul-halaman="Daftar Transaksi"
    deskripsi-halaman="Kelola semua transaksi laundry"
  >
    <div class="flex justify-between items-center mb-6">
      <div class="flex items-center space-x-4">
        <input
          type="text"
          placeholder="Cari transaksi..."
          class="bg-white/10 border border-white/20 text-white placeholder-white/50 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
      </div>
      <Link
        :href="route('transaksi.create')"
        class="bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white px-6 py-2 rounded-lg font-medium transition-all duration-200 flex items-center space-x-2"
      >
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
        </svg>
        <span>Tambah Transaksi</span>
      </Link>
    </div>

    <div class="bg-white/10 backdrop-blur-sm rounded-xl border border-white/20 overflow-hidden">
      <div class="overflow-x-auto">
        <table class="w-full">
          <thead class="bg-white/5">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-white/60 uppercase tracking-wider">Kode</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-white/60 uppercase tracking-wider">Pelanggan</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-white/60 uppercase tracking-wider">Layanan</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-white/60 uppercase tracking-wider">Berat</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-white/60 uppercase tracking-wider">Total</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-white/60 uppercase tracking-wider">Status</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-white/60 uppercase tracking-wider">Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-white/10">
            <tr v-for="transaksi in daftarTransaksi.data" :key="transaksi.id"
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
                {{ transaksi.berat_kg }} kg
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
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                <Link
                  :href="route('transaksi.show', transaksi.id)"
                  class="text-blue-400 hover:text-blue-300 transition-colors"
                >
                  Detail
                </Link>
                <Link
                  :href="route('transaksi.edit', transaksi.id)"
                  class="text-yellow-400 hover:text-yellow-300 transition-colors"
                >
                  Edit
                </Link>
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

defineProps({
  daftarTransaksi: Object
})

const formatRupiah = (angka) => {
  return new Intl.NumberFormat('id-ID').format(angka)
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
