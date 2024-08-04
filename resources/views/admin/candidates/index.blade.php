@extends('layouts.admin')

@section('title', 'Daftar Kandidat')

@section('content')
    <div x-data="candidatesFilter()" x-init="init()" class="container mx-auto px-4">
        <h1 class="text-3xl font-bold mb-6">Daftar Kandidat</h1>
        <a href="{{ route('admin.candidates.create') }}"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Tambah Kandidat
        </a>

        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nama</label>
                    <input type="text" x-model="filters.name" @input="applyFilters()" id="name"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div>
                    <label for="position" class="block text-gray-700 text-sm font-bold mb-2">Posisi</label>
                    <select x-model="filters.position" @change="applyFilters()" id="position"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="">Semua Posisi</option>
                        @foreach ($positions as $position)
                            <option value="{{ $position }}">{{ $position }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="party" class="block text-gray-700 text-sm font-bold mb-2">Partai</label>
                    <select x-model="filters.party" @change="applyFilters()" id="party"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="">Semua Partai</option>
                        @foreach ($parties as $party)
                            <option value="{{ $party }}">{{ $party }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="region_id" class="block text-gray-700 text-sm font-bold mb-2">Wilayah</label>
                    <select x-model="filters.region_id" @change="applyFilters()" id="region_id"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="">Semua Wilayah</option>
                        @foreach ($regions as $region)
                            <option value="{{ $region->id }}">{{ $region->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="date_from" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Pemilihan Dari</label>
                    <input type="date" x-model="filters.date_from" @change="applyFilters()" id="date_from"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div>
                    <label for="date_to" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Pemilihan
                        Sampai</label>
                    <input type="date" x-model="filters.date_to" @change="applyFilters()" id="date_to"
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
                        <th class="py-3 px-6 text-left">Posisi</th>
                        <th class="py-3 px-6 text-left">Partai</th>
                        <th class="py-3 px-6 text-left">Wilayah</th>
                        <th class="py-3 px-6 text-center">Tanggal Pemilihan</th>
                        <th class="py-3 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    <template x-for="candidate in filteredCandidates" :key="candidate.id">
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap" x-text="candidate.name"></td>
                            <td class="py-3 px-6 text-left" x-text="candidate.position"></td>
                            <td class="py-3 px-6 text-left" x-text="candidate.party"></td>
                            <td class="py-3 px-6 text-left" x-text="candidate.region.name"></td>
                            <td class="py-3 px-6 text-center" x-text="formatDate(candidate.election_date)"></td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center">
                                    <a :href="'/admin/candidates/' + candidate.id"
                                        class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>
                                    <a :href="'/admin/candidates/' + candidate.id + '/edit'"
                                        class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </a>
                                    <button @click="deleteCandidate(candidate)"
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
        function candidatesFilter() {
            return {
                candidates: @json($candidates),
                filteredCandidates: [],
                filters: {
                    name: '',
                    position: '',
                    party: '',
                    region_id: '',
                    date_from: '',
                    date_to: ''
                },
                loading: false,

                init() {
                    this.filteredCandidates = this.candidates;
                },

                applyFilters() {
                    this.loading = true;
                    // In a real application, you would make an AJAX call here
                    // For this example, we'll simulate an API call with setTimeout
                    setTimeout(() => {
                        this.filteredCandidates = this.candidates.filter(candidate => {
                            return (
                                (this.filters.name === '' || candidate.name.toLowerCase().includes(this
                                    .filters.name.toLowerCase())) &&
                                (this.filters.position === '' || candidate.position === this.filters
                                    .position) &&
                                (this.filters.party === '' || candidate.party === this.filters.party) &&
                                (this.filters.region_id === '' || candidate.region.id == this.filters
                                    .region_id) &&
                                (this.filters.date_from === '' || new Date(candidate.election_date) >=
                                    new Date(this.filters.date_from)) &&
                                (this.filters.date_to === '' || new Date(candidate.election_date) <=
                                    new Date(this.filters.date_to))
                            );
                        });
                        this.loading = false;
                    }, 300);
                },

                resetFilters() {
                    this.filters = {
                        name: '',
                        position: '',
                        party: '',
                        region_id: '',
                        date_from: '',
                        date_to: ''
                    };
                    this.applyFilters();
                },

                formatDate(dateString) {
                    const options = {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    };
                    return new Date(dateString).toLocaleDateString('id-ID', options);
                },

                deleteCandidate(candidate) {
                    if (confirm(`Apakah Anda yakin ingin menghapus kandidat ${candidate.name}?`)) {
                        fetch(`/admin/candidates/${candidate.id}`, {
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
                                    this.candidates = this.candidates.filter(c => c.id !== candidate.id);
                                    alert('Kandidat berhasil dihapus.');
                                } else {
                                    alert('Gagal menghapus kandidat: ' + data.message);
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert('Terjadi kesalahan saat menghapus kandidat.');
                            });
                    }
                }
            }
        }
    </script>
@endpush
