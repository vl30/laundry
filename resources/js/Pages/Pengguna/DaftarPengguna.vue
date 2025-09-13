<template>
  <LayoutUtama
    judul-halaman="Daftar Pengguna"
    deskripsi-halaman="Kelola pengguna sistem laundry"
  >
    <div class="flex justify-between items-center mb-6">
      <div class="flex items-center space-x-4">
        <input
          type="text"
          placeholder="Cari pengguna..."
          class="bg-white/10 border border-white/20 text-white placeholder-white/50 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
      </div>
      <Link
        :href="route('pengguna.create')"
        class="bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white px-6 py-2 rounded-lg font-medium transition-all duration-200 flex items-center space-x-2"
      >
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
        </svg>
        <span>Tambah Pengguna</span>
      </Link>
    </div>

    <div class="bg-white/10 backdrop-blur-sm rounded-xl border border-white/20 overflow-hidden">
      <div class="overflow-x-auto">
        <table class="w-full">
          <thead class="bg-white/5">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-white/60 uppercase tracking-wider">Nama</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-white/60 uppercase tracking-wider">Email</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-white/60 uppercase tracking-wider">Tipe</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-white/60 uppercase tracking-wider">No. Telepon</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-white/60 uppercase tracking-wider">Status</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-white/60 uppercase tracking-wider">Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-white/10">
            <tr v-for="pengguna in daftarPengguna.data" :key="pengguna.id"
                class="hover:bg-white/5 transition-colors">
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div class="w-8 h-8 bg-gradient-to-r from-blue-400 to-purple-500 rounded-full flex items-center justify-center mr-3">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                  </div>
                  <div>
                    <div class="text-sm font-medium text-white">{{ pengguna.nama }}</div>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-white/80">
                {{ pengguna.email }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span :class="getBadgeTipePengguna(pengguna.tipe_pengguna)"
                      class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full">
                  {{ pengguna.tipe_pengguna }}
                </span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-white/80">
                {{ pengguna.no_telepon || '-' }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span :class="pengguna.aktif ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'"
                      class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full">
                  {{ pengguna.aktif ? 'Aktif' : 'Nonaktif' }}
                </span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                <Link
                  :href="route('pengguna.show', pengguna.id)"
                  class="text-blue-400 hover:text-blue-300 transition-colors"
                >
                  Detail
                </Link>
                <Link
                  :href="route('pengguna.edit', pengguna.id)"
                  class="text-yellow-400 hover:text-yellow-300 transition-colors"
                >
                  Edit
                </Link>
                <button
                  @click="hapusPengguna(pengguna.id)"
                  class="text-red-400 hover:text-red-300 transition-colors"
                >
                  Hapus
                </button>
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
import { Link, router } from '@inertiajs/vue3'

defineProps({
  daftarPengguna: Object
})

const getBadgeTipePengguna = (tipe) => {
  const tipeMap = {
    'admin': 'bg-purple-100 text-purple-800',
    'kasir': 'bg-blue-100 text-blue-800',
    'pelanggan': 'bg-green-100 text-green-800'
  }
  return tipeMap[tipe] || 'bg-gray-100 text-gray-800'
}

const hapusPengguna = (id) => {
  if (confirm('Apakah Anda yakin ingin menghapus pengguna ini?')) {
    router.delete(route('pengguna.destroy', id))
  }
}
</script>
