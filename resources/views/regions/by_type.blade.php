@extends('layouts.app')

@section('title', 'Daftar ' . ucfirst($type))

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Daftar {{ ucfirst($type) }} di Jawa Barat</h1>

        <div class="mb-6 flex justify-between items-center">
            <div>
                <a href="{{ route('regions.byType', ['type' => 'kota']) }}"
                    class="btn {{ $type === 'kota' ? 'btn-primary' : 'btn-secondary' }} mr-2">Kota</a>
                <a href="{{ route('regions.byType', ['type' => 'kabupaten']) }}"
                    class="btn {{ $type === 'kabupaten' ? 'btn-primary' : 'btn-secondary' }}">Kabupaten</a>
            </div>
            <div>
                <form action="{{ route('regions.byType', ['type' => $type]) }}" method="GET" class="flex items-center">
                    <input type="text" name="search" placeholder="Cari {{ strtolower($type) }}..."
                        class="form-input mr-2" value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </form>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($regions as $region)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <h2 class="text-xl font-semibold mb-2">{{ $region->name }}</h2>
                        <div class="mb-4">
                            <span class="text-sm font-medium text-gray-500">Populasi:</span>
                            <span class="text-lg font-bold ml-2">{{ number_format($region->population) }}</span>
                        </div>
                        <div class="mb-4">
                            <span class="text-sm font-medium text-gray-500">Luas:</span>
                            <span class="text-lg font-bold ml-2">{{ number_format($region->area, 2) }} km²</span>
                        </div>
                        <div class="mb-4">
                            <span class="text-sm font-medium text-gray-500">Jumlah Kandidat:</span>
                            <span class="text-lg font-bold ml-2">{{ $region->candidates_count }}</span>
                        </div>
                        @if ($region->upcoming_elections_count > 0)
                            <div class="mb-4">
                                <span class="text-sm font-medium text-gray-500">Pemilihan akan datang:</span>
                                <span class="text-lg font-bold ml-2">{{ $region->upcoming_elections_count }}</span>
                            </div>
                        @endif
                        <a href="{{ route('regions.show', $region) }}" class="btn btn-secondary block text-center">Lihat
                            Detail</a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-8">
                    <p class="text-gray-500 text-lg">Tidak ada {{ strtolower($type) }} yang ditemukan.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $regions->links() }}
        </div>

        <div class="mt-8">
            <h2 class="text-2xl font-bold mb-4">Statistik {{ ucfirst($type) }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold mb-2">Total {{ ucfirst($type) }}</h3>
                    <p class="text-3xl font-bold text-blue-600">{{ $totalRegions }}</p>
                </div>
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold mb-2">Total Populasi</h3>
                    <p class="text-3xl font-bold text-green-600">{{ number_format($totalPopulation) }}</p>
                </div>
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold mb-2">Rata-rata Luas</h3>
                    <p class="text-3xl font-bold text-purple-600">{{ number_format($averageArea, 2) }} km²</p>
                </div>
            </div>
        </div>

        <div class="mt-8">
            <h2 class="text-2xl font-bold mb-4">Peta {{ ucfirst($type) }} Jawa Barat</h2>
            <div class="bg-white rounded-lg shadow-md p-6">
                <div id="map" class="h-96"></div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var map = L.map('map').setView([-6.9175, 107.6191], 8); // Centered on Bandung
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            @foreach ($regions as $region)
                L.marker([{{ $region->latitude }}, {{ $region->longitude }}])
                    .addTo(map)
                    .bindPopup("{{ $region->name }}");
            @endforeach
        });
    </script>
@endpush
