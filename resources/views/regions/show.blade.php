@extends('layouts.app')

@section('title', $region->name)

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">{{ $region->name }}</h1>

        <div class="bg-white shadow-xl rounded-lg overflow-hidden mb-8">
            <div class="p-6 md:p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h2 class="text-2xl font-semibold mb-4">Informasi Umum</h2>
                        <p><strong>Tipe:</strong> {{ $region->type }}</p>
                        <p><strong>Populasi:</strong> {{ number_format($region->population) }} jiwa</p>
                        <p><strong>Luas Wilayah:</strong> {{ number_format($region->area, 2) }} km²</p>
                        {{-- <p><strong>Kepadatan Penduduk:</strong> {{ number_format($region->population / $region->area, 2) }}
                            jiwa/km²</p> --}}
                    </div>
                    <div>
                        <h2 class="text-2xl font-semibold mb-4">Statistik Pemilihan</h2>
                        <p><strong>Jumlah Kandidat:</strong> {{ $region->candidates->count() }}</p>
                        <p><strong>Pemilihan Akan Datang:</strong> {{ $upcomingElections->count() }}</p>
                        <p><strong>Total Pemilih Terdaftar:</strong> {{ number_format($region->registered_voters) }}</p>
                        <p><strong>Partisipasi Pemilih Terakhir:</strong>
                            {{ number_format($region->last_election_turnout, 2) }}%</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-8">
            <h2 class="text-2xl font-bold mb-4">Deskripsi Wilayah</h2>
            <div class="bg-white shadow-md rounded-lg p-6">
                <p class="text-gray-700">{{ $region->description }}</p>
            </div>
        </div>

        <div class="mb-8">
            <h2 class="text-2xl font-bold mb-4">Peta Wilayah</h2>
            <div class="bg-white shadow-md rounded-lg p-6">
                <div id="map" class="h-96"></div>
            </div>
        </div>

        <div class="mb-8">
            <h2 class="text-2xl font-bold mb-4">Kandidat</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($region->candidates as $candidate)
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2">{{ $candidate->name }}</h3>
                            <p class="text-gray-600 mb-4">{{ $candidate->party }}</p>
                            <p class="text-sm text-gray-500 mb-4">{{ Str::limit($candidate->short_bio, 100) }}</p>
                            <a href="{{ route('candidates.show', $candidate) }}"
                                class="btn btn-primary block text-center">Lihat Profil</a>
                        </div>
                    </div>
                @empty
                    <p class="col-span-full text-center text-gray-500">Belum ada kandidat terdaftar untuk wilayah ini.</p>
                @endforelse
            </div>
        </div>

        <div class="mb-8">
            <h2 class="text-2xl font-bold mb-4">Pemilihan Akan Datang</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-3 px-4 text-left">Tanggal</th>
                            <th class="py-3 px-4 text-left">Posisi</th>
                            <th class="py-3 px-4 text-left">Jumlah Kandidat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($upcomingElections as $election)
                            <tr>
                                {{-- <td class="py-3 px-4">{{ $election->date->format('d F Y') }}</td> --}}
                                <td class="py-3 px-4">{{ $election->position }}</td>
                                <td class="py-3 px-4">{{ $election->candidates_count }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="py-3 px-4 text-center text-gray-500">Tidak ada pemilihan yang akan
                                    datang.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="text-center mt-8">
            <a href="{{ route('regions.index') }}" class="btn btn-secondary">Kembali ke Daftar Wilayah</a>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var map = L.map('map').setView([{{ $region->latitude }}, {{ $region->longitude }}], 10);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
            L.marker([{{ $region->latitude }}, {{ $region->longitude }}]).addTo(map)
                .bindPopup('{{ $region->name }}')
                .openPopup();
        });
    </script>
@endpush
