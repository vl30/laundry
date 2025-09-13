<template>
  <LayoutUtama
    judul-halaman="Detail Transaksi"
    :deskripsi-halaman="`Detail transaksi ${transaksi.kode_transaksi}`"
  >
    <div class="max-w-3xl">
      <div class="bg-white/10 backdrop-blur-sm rounded-xl border border-white/20 p-6">
        <div class="space-y-6">
          <!-- Header -->
          <div class="flex justify-between items-start">
            <div>
              <h3 class="text-2xl font-bold text-white">{{ transaksi.kode_transaksi }}</h3>
              <p class="text-white/60">{{ formatTanggal(transaksi.created_at) }}</p>
            </div>
            <span :class="getBadgeStatus(transaksi.status_transaksi)"
                  class="px-3 py-1 text-sm font-semibold rounded-full">
              {{ transaksi.status_transaksi }}
            </span>
          </div>

          <!-- Info Pelanggan -->
          <div class="border-t border-white/10 pt-6">
            <h4 class="text-lg font-semibold text-white mb-4">Informasi Pelanggan</h4>
            <div class="grid grid-cols-2 gap-4 text-white/80">
              <div>
                <p class="text-sm text-white/60">Nama</p>
                <p>{{ transaksi.pelanggan.nama }}</p>
              </div>
              <div>
                <p class="text-sm text-white/60">No. Telepon</p>
                <p>{{ transaksi.pelanggan.no_telepon }}</p>
              </div>
              <div class="col-span-2">
                <p class="text-sm text-white/60">Alamat</p>
                <p>{{ transaksi.pelanggan.alamat }}</p>
              </div>
            </div>
          </div>

          <!-- Detail Layanan -->
          <div class="border-t border-white/10 pt-6">
            <h4 class="text-lg font-semibold text-white mb-4">Detail Layanan</h4>
            <div class="grid grid-cols-2 gap-4 text-white/80">
              <div>
                <p class="text-sm text-white/60">Jenis Layanan</p>
                <p>{{ transaksi.kategori_layanan.nama_kategori }}</p>
              </div>
              <div>
                <p class="text-sm text-white/60">Berat</p>
                <p>{{ transaksi.berat_kg }} kg</p>
              </div>
              <div>
                <p class="text-sm text-white/60">Harga per Kg</p>
                <p>Rp {{ formatRupiah(transaksi.kategori_layanan.harga_per_kg) }}</p>
              </div>
              <div>
                <p class="text-sm text-white/60">Total Harga</p>
                <p class="text-lg font-semibold text-white">Rp {{ formatRupiah(transaksi.total_harga) }}</p>
              </div>
            </div>
          </div>

          <!-- Catatan -->
          <div class="border-t border-white/10 pt-6" v-if="transaksi.catatan">
            <h4 class="text-lg font-semibold text-white mb-4">Catatan</h4>
            <p class="text-white/80">{{ transaksi.catatan }}</p>
          </div>

          <!-- Timeline -->
          <div class="border-t border-white/10 pt-6">
            <h4 class="text-lg font-semibold text-white mb-4">Status Pengerjaan</h4>
            <div class="space-y-4">
              <div v-for="(status, index) in statusTimeline" :key="index"
                   class="flex items-center space-x-4">
                <div :class="status.active ? 'bg-blue-500' : 'bg-white/20'"
                     class="w-4 h-4 rounded-full"></div>
                <div class="flex-1">
                  <p :class="status.active ? 'text-white' : 'text-white/60'"
                     class="font-medium">{{ status.label }}</p>
                  <p v-if="status.timestamp" class="text-sm text-white/60">
                    {{ formatTanggal(status.timestamp) }}
                  </p>
                </div>
              </div>
            </div>
          </div>

          <!-- Actions -->
          <div class="border-t border-white/10 pt-6 flex justify-end space-x-4">
            <Link
              :href="route('transaksi.edit', transaksi.id)"
              class="bg-blue-500/20 hover:bg-blue-500/30 text-blue-300 px-6 py-2 rounded-lg font-medium transition-colors"
            >
              Edit Transaksi
            </Link>
            <Link
              :href="route('transaksi.index')"
              class="bg-white/10 hover:bg-white/20 text-white px-6 py-2 rounded-lg font-medium transition-colors"
            >
              Kembali
            </Link>
          </div>
        </div>
      </div>
    </div>
  </LayoutUtama>
</template>

<script setup>
import LayoutUtama from '@/Layouts/LayoutUtama.vue'
import { Link } from '@inertiajs/vue3'
import { computed } from 'vue'

const props = defineProps({
  transaksi: Object
})

const formatRupiah = (angka) => {
  return new Intl.NumberFormat('id-ID').format(angka)
}

const formatTanggal = (tanggal) => {
  return new Date(tanggal).toLocaleDateString('id-ID', {
    weekday: 'long',
    year: 'numeric',
    month: 'long',
    day: 'numeric',
    hour: '2-digit',
    minute: '2-digit'
  })
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

const statusTimeline = computed(() => {
  const statuses = [
    { label: 'Diterima', status: 'menunggu' },
    { label: 'Dicuci', status: 'dicuci' },
    { label: 'Dijemur', status: 'dijemur' },
    { label: 'Disetrika', status: 'disetrika' },
    { label: 'Selesai', status: 'selesai' },
    { label: 'Diambil', status: 'diambil' }
  ]

  let found = false
  return statuses.map(s => ({
    ...s,
    active: !found && (found = s.status === props.transaksi.status_transaksi)
  }))
})
</script>
