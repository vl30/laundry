<template>
  <LayoutUtama
    judul-halaman="Edit Transaksi"
    :deskripsi-halaman="`Edit transaksi ${transaksi.kode_transaksi}`"
  >
    <div class="max-w-2xl">
      <div class="bg-white/10 backdrop-blur-sm rounded-xl border border-white/20 p-6">
        <form @submit.prevent="submitForm" class="space-y-6">
          <div>
            <label for="id_pelanggan" class="block text-sm font-medium text-white mb-2">Pelanggan</label>
            <select
              id="id_pelanggan"
              v-model="form.id_pelanggan"
              required
              class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
              <option value="">Pilih Pelanggan</option>
              <option v-for="pelanggan in daftarPelanggan" :key="pelanggan.id" :value="pelanggan.id">
                {{ pelanggan.nama }}
              </option>
            </select>
            <div v-if="errors.id_pelanggan" class="text-red-400 text-sm mt-1">{{ errors.id_pelanggan }}</div>
          </div>

          <div>
            <label for="id_kategori_layanan" class="block text-sm font-medium text-white mb-2">Jenis Layanan</label>
            <select
              id="id_kategori_layanan"
              v-model="form.id_kategori_layanan"
              required
              @change="hitungTotal"
              class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
              <option value="">Pilih Layanan</option>
              <option v-for="layanan in daftarKategoriLayanan" :key="layanan.id" :value="layanan.id">
                {{ layanan.nama_kategori }} - Rp{{ formatRupiah(layanan.harga_per_kg) }}/kg
              </option>
            </select>
            <div v-if="errors.id_kategori_layanan" class="text-red-400 text-sm mt-1">{{ errors.id_kategori_layanan }}</div>
          </div>

          <div>
            <label for="berat_kg" class="block text-sm font-medium text-white mb-2">Berat (kg)</label>
            <input
              id="berat_kg"
              v-model="form.berat_kg"
              type="number"
              step="0.1"
              min="0"
              required
              @input="hitungTotal"
              class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-blue-500"
              placeholder="Masukkan berat cucian"
            />
            <div v-if="errors.berat_kg" class="text-red-400 text-sm mt-1">{{ errors.berat_kg }}</div>
          </div>

          <div>
            <label for="status_transaksi" class="block text-sm font-medium text-white mb-2">Status Transaksi</label>
            <select
              id="status_transaksi"
              v-model="form.status_transaksi"
              required
              class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
              <option value="menunggu">Menunggu</option>
              <option value="dicuci">Dicuci</option>
              <option value="dijemur">Dijemur</option>
              <option value="disetrika">Disetrika</option>
              <option value="selesai">Selesai</option>
              <option value="diambil">Diambil</option>
            </select>
            <div v-if="errors.status_transaksi" class="text-red-400 text-sm mt-1">{{ errors.status_transaksi }}</div>
          </div>

          <div>
            <label for="catatan" class="block text-sm font-medium text-white mb-2">Catatan</label>
            <textarea
              id="catatan"
              v-model="form.catatan"
              rows="3"
              class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-blue-500"
              placeholder="Tambahkan catatan jika ada"
            ></textarea>
            <div v-if="errors.catatan" class="text-red-400 text-sm mt-1">{{ errors.catatan }}</div>
          </div>

          <div v-if="estimasiTotal > 0" class="bg-blue-500/20 rounded-lg p-4">
            <div class="text-white">
              <p class="text-lg font-semibold">Total Biaya: Rp{{ formatRupiah(estimasiTotal) }}</p>
              <p class="text-sm text-white/60">Estimasi selesai: {{ estimasiHari }} hari</p>
            </div>
          </div>

          <div class="flex items-center space-x-4">
            <button
              type="submit"
              :disabled="form.processing"
              class="bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 disabled:opacity-50 text-white font-semibold py-3 px-6 rounded-lg transition-all duration-200"
            >
              <span v-if="form.processing">Menyimpan...</span>
              <span v-else>Update Transaksi</span>
            </button>
            <Link
              :href="route('transaksi.index')"
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
import { computed } from 'vue'

const props = defineProps({
  transaksi: Object,
  daftarPelanggan: Array,
  daftarKategoriLayanan: Array,
  errors: Object
})

const form = useForm({
  id_pelanggan: props.transaksi.id_pelanggan,
  id_kategori_layanan: props.transaksi.id_kategori_layanan,
  berat_kg: props.transaksi.berat_kg,
  status_transaksi: props.transaksi.status_transaksi,
  catatan: props.transaksi.catatan
})

const layananTerpilih = computed(() => {
  return props.daftarKategoriLayanan.find(layanan => layanan.id == form.id_kategori_layanan)
})

const estimasiTotal = computed(() => {
  if (!layananTerpilih.value || !form.berat_kg) return 0
  return layananTerpilih.value.harga_per_kg * parseFloat(form.berat_kg)
})

const estimasiHari = computed(() => {
  return layananTerpilih.value?.estimasi_hari || 0
})

const formatRupiah = (angka) => {
  return new Intl.NumberFormat('id-ID').format(angka)
}

const hitungTotal = () => {
}

const submitForm = () => {
  form.put(route('transaksi.update', props.transaksi.id))
}
</script>
