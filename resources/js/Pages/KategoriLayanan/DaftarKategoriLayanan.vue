<template>
  <LayoutUtama
    judul-halaman="Daftar Layanan"
    deskripsi-halaman="Kelola kategori layanan laundry"
  >
    <div class="flex justify-between items-center mb-6">
      <div class="flex items-center space-x-4">
        <input
          type="text"
          placeholder="Cari layanan..."
          class="bg-white/10 border border-white/20 text-white placeholder-white/50 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
      </div>
      <Link
        :href="route('kategori-layanan.create')"
        class="bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white px-6 py-2 rounded-lg font-medium transition-all duration-200 flex items-center space-x-2"
      >
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
        </svg>
        <span>Tambah Layanan</span>
      </Link>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <div v-for="layanan in daftarKategoriLayanan.data" :key="layanan.id"
           class="bg-white/10 backdrop-blur-sm rounded-xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 group">
        <div class="flex items-start justify-between mb-4">
          <div class="w-12 h-12 bg-gradient-to-r from-blue-400 to-purple-500 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
            </svg>
          </div>
          <span :class="layanan.aktif ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'"
                class="px-2 py-1 text-xs font-semibold rounded-full">
            {{ layanan.aktif ? 'Aktif' : 'Nonaktif' }}
          </span>
        </div>

        <h3 class="text-xl font-semibold text-white mb-2">{{ layanan.nama_kategori }}</h3>
        <p class="text-white/60 mb-4 text-sm">{{ layanan.deskripsi }}</p>

        <div class="space-y-2 mb-4">
          <div class="flex justify-between items-center">
            <span class="text-white/60 text-sm">Harga per kg:</span>
            <span class="text-white font-semibold">Rp {{ formatRupiah(layanan.harga_per_kg) }}</span>
          </div>
          <div class="flex justify-between items-center">
            <span class="text-white/60 text-sm">Estimasi:</span>
            <span class="text-white font-semibold">{{ layanan.estimasi_hari }} hari</span>
          </div>
        </div>

        <div class="flex space-x-2">
          <Link
            :href="route('kategori-layanan.edit', layanan.id)"
            class="flex-1 bg-blue-500/20 hover:bg-blue-500/30 text-blue-300 text-center py-2 px-4 rounded-lg text-sm font-medium transition-colors"
          >
            Edit
          </Link>
          <button
            @click="hapusLayanan(layanan.id)"
            class="flex-1 bg-red-500/20 hover:bg-red-500/30 text-red-300 py-2 px-4 rounded-lg text-sm font-medium transition-colors"
          >
            Hapus
          </button>
        </div>
      </div>
    </div>
  </LayoutUtama>
</template>

<script setup>
import LayoutUtama from '@/Layouts/LayoutUtama.vue'
import { Link, router } from '@inertiajs/vue3'

defineProps({
  daftarKategoriLayanan: Object
})

const formatRupiah = (angka) => {
  return new Intl.NumberFormat('id-ID').format(angka)
}

const hapusLayanan = (id) => {
  if (confirm('Apakah Anda yakin ingin menghapus layanan ini?')) {
    router.delete(route('kategori-layanan.destroy', id))
  }
}
</script>
