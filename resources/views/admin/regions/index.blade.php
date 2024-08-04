@extends('layouts.admin')

@section('title', 'Daftar Wilayah')

@section('content')
    <div x-data="regionsFilter()" x-init="init()" class="container mx-auto px-4">
        <h1 class="text-3xl font-bold mb-6">Daftar Wilayah</h1>
        <a href="{{ route('admin.regions.create') }}"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Tambah Wilayah
        </a>

        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nama Wilayah</label>
                    <input type="text" x-model="filters.name" @input="applyFilters()" id="name"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div>
                    <label for="type" class="block text-gray-700 text-sm font-bold mb-2">Tipe Wilayah</label>
                    <select x-model="filters.type" @change="applyFilters()" id="type"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="">Semua Tipe</option>
                        <option value="Kota">Kota</option>
                        <option value="Kabupaten">Kabupaten</option>
                    </select>
                </div>
                <div>
                    <label for="population" class="block text-gray-700 text-sm font-bold mb-2">Populasi Minimum</label>
                    <input type="number" x-model="filters.population" @input="applyFilters()" id="population"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
            </div>
            <div class="mt-4">
                <button @click="resetFilters()"
                    class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Reset Filter
                </button>
            </div>
        </div>

        <div class="bg-white shadow-md rounded my-6" x-show="!loading">
            <table class="min-w-full table-auto">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Nama</th>
                        <th class="py-3 px-6 text-left">Tipe</th>
                        <th class="py-3 px-6 text-center">Populasi</th>
                        <th class="py-3 px-6 text-center">Jumlah Kandidat</th>
                        <th class="py-3 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    <template x-for="region in filteredRegions" :key="region.id">
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap" x-text="region.name"></td>
                            <td class="py-3 px-6 text-left" x-text="region.type"></td>
                            <td class="py-3 px-6 text-center" x-text="formatNumber(region.population)"></td>
                            <td class="py-3 px-6 text-center" x-text="region.candidates_count"></td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center">
                                    <a :href="'/admin/regions/' + region.id"
                                        class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>
                                    <a :href="'/admin/regions/' + region.id + '/edit'"
                                        class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </a>
                                    <button @click="deleteRegion(region)"
                                        class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
        <div x-show="loading" class="text-center py-4">
            <svg class="animate-spin h-5 w-5 mr-3 inline-block" viewBox="0 0 24 24">
                <!-- SVG spinner code here -->
            </svg>
            Loading...
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function regionsFilter() {
            return {
                regions: @json($regions),
                filteredRegions: [],
                filters: {
                    name: '',
                    type: '',
                    population: ''
                },
                loading: false,

                init() {
                    this.filteredRegions = this.regions;
                },

                applyFilters() {
                    this.loading = true;
                    // Simulate API call delay
                    setTimeout(() => {
                        this.filteredRegions = this.regions.filter(region => {
                            return (
                                (this.filters.name === '' || region.name.toLowerCase().includes(this
                                    .filters.name.toLowerCase())) &&
                                (this.filters.type === '' || region.type === this.filters.type) &&
                                (this.filters.population === '' || region.population >= parseInt(this
                                    .filters.population))
                            );
                        });
                        this.loading = false;
                    }, 300);
                },

                resetFilters() {
                    this.filters = {
                        name: '',
                        type: '',
                        population: ''
                    };
                    this.applyFilters();
                },

                formatNumber(number) {
                    return new Intl.NumberFormat('id-ID').format(number);
                },

                deleteRegion(region) {
                    if (confirm(`Apakah Anda yakin ingin menghapus wilayah ${region.name}?`)) {
                        fetch(`/admin/regions/${region.id}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                        'content'),
                                    'Accept': 'application/json',
                                    'Content-Type': 'application/json'
                                },
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    this.regions = this.regions.filter(r => r.id !== region.id);
                                    alert('Wilayah berhasil dihapus.');
                                } else {
                                    alert('Gagal menghapus wilayah: ' + data.message);
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert('Terjadi kesalahan saat menghapus wilayah.');
                            });
                    }
                }
            }
        }
    </script>
@endpush
