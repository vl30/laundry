<template>
  <LayoutUtama
    judul-halaman="Detail Pengguna"
    :deskripsi-halaman="`Informasi lengkap ${pengguna.nama}`"
  >
    <div class="max-w-3xl">
      <div class="bg-white/10 backdrop-blur-sm rounded-xl border border-white/20 p-6">
        <div class="space-y-6">
          <!-- header -->
          <div class="flex justify-between items-start">
            <div>
              <h3 class="text-2xl font-bold text-white">{{ pengguna.nama }}</h3>
              <p class="text-white/60">{{ pengguna.email }}</p>
            </div>
            <span :class="getBadgeTipe(pengguna.tipe_pengguna)"
                  class="px-3 py-1 text-sm font-semibold rounded-full">
              {{ pengguna.tipe_pengguna }}
            </span>
          </div>

          <!-- info kontak -->
          <div class="border-t border-white/10 pt-6">
            <h4 class="text-lg font-semibold text-white mb-4">Informasi Kontak</h4>
            <div class="grid grid-cols-2 gap-4 text-white/80">
              <div>
                <p class="text-sm text-white/60">No. Telepon</p>
                <p>{{ pengguna.no_telepon }}</p>
              </div>
              <div class="col-span-2">
                <p class="text-sm text-white/60">Alamat</p>
                <p>{{ pengguna.alamat }}</p>
              </div>
            </div>
          </div>

          <div class="border-t border-white/10 pt-6 flex justify-end space-x-4">
            <Link
              :href="route('pengguna.edit', pengguna.id)"
              class="bg-blue-500/20 hover:bg-blue-500/30 text-blue-300 px-6 py-2 rounded-lg font-medium transition-colors"
            >
              Edit Pengguna
            </Link>
            <Link
              :href="route('pengguna.index')"
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

const props = defineProps({
  pengguna: Object
})

const getBadgeTipe = (tipe) => {
  const tipeMap = {
    'admin': 'bg-purple-100 text-purple-800',
    'kasir': 'bg-blue-100 text-blue-800',
    'pelanggan': 'bg-green-100 text-green-800'
  }
  return tipeMap[tipe] || 'bg-gray-100 text-gray-800'
}
</script>
