@extends('layouts.app')

@section('title', 'Hasil Pencarian Wilayah')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Hasil Pencarian Wilayah</h1>

        <div class="mb-6">
            <form action="{{ route('regions.search') }}" method="GET" class="flex items-center">
                <input type="text" name="query" placeholder="Cari wilayah..." class="form-input flex-grow mr-2"
                    value="{{ $query }}">
                <button type="submit" class="btn btn-primary">Cari</button>
            </form>
        </div>

        @if ($regions->isEmpty())
            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6" role="alert">
                <p>Tidak ditemukan hasil untuk pencarian "{{ $query }}". Silakan coba kata kunci lain.</p>
            </div>
        @else
            <p class="mb-4">Ditemukan {{ $regions->total() }} hasil untuk pencarian "{{ $query }}"</p>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($regions as $region)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="p-6">
                            <h2 class="text-xl font-semibold mb-2">{{ $region->name }}</h2>
                            <p class="text-gray-600 mb-4">{{ $region->type }}</p>
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
                            <a href="{{ route('regions.show', $region) }}"
                                class="btn btn-secondary block text-center">Lihat Detail</a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $regions->appends(['query' => $query])->links() }}
            </div>
        @endif

        <div class="mt-8">
            <h2 class="text-2xl font-bold mb-4">Pencarian Terpopuler</h2>
            <div class="flex flex-wrap gap-2">
                @foreach ($popularSearches as $search)
                    <a href="{{ route('regions.search', ['query' => $search]) }}"
                        class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">{{ $search }}</a>
                @endforeach
            </div>
        </div>

        @if ($regions->isNotEmpty())
            <div class="mt-8">
                <h2 class="text-2xl font-bold mb-4">Peta Hasil Pencarian</h2>
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div id="map" class="h-96"></div>
                </div>
            </div>
        @endif
    </div>
@endsection

@push('scripts')
    @if ($regions->isNotEmpty())
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var map = L.map('map').setView([-6.9175, 107.6191], 7); // Centered on West Java
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);

                var bounds = [];
                @foreach ($regions as $region)
                    L.marker([{{ $region->latitude }}, {{ $region->longitude }}])
                        .addTo(map)
                        .bindPopup("<a href='{{ route('regions.show', $region) }}'>{{ $region->name }}</a>");
                    bounds.push([{{ $region->latitude }}, {{ $region->longitude }}]);
                @endforeach

                if (bounds.length > 0) {
                    map.fitBounds(bounds);
                }
            });
        </script>
    @endif
@endpush
