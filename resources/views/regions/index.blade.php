@extends('layouts.app')

@section('title', 'Daftar Wilayah')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Wilayah Pilkada Jawa Barat</h1>

        <div class="mb-6">
            <form action="{{ route('regions.index') }}" method="GET" class="flex items-center">
                <input type="text" name="search" placeholder="Cari wilayah..." class="form-input flex-grow mr-2"
                    value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">Cari</button>
            </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($regions as $region)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <h2 class="text-xl font-semibold mb-2">{{ $region->name }}</h2>
                        <p class="text-gray-600 mb-4">{{ $region->type }}</p>
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
                    <p class="text-gray-500 text-lg">Tidak ada wilayah yang ditemukan.</p>
                </div>
            @endforelse
        </div>

        {{-- <div class="mt-8">
            {{ $regions->links() }}
        </div> --}}

        <div class="mt-8">
            <h2 class="text-2xl font-bold mb-4">Statistik Wilayah</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold mb-2">Total Wilayah</h3>
                    <p class="text-3xl font-bold text-blue-600">{{ $totalRegions }}</p>
                </div>
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold mb-2">Total Kota</h3>
                    <p class="text-3xl font-bold text-green-600">{{ $totalCities }}</p>
                </div>
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold mb-2">Total Kabupaten</h3>
                    <p class="text-3xl font-bold text-purple-600">{{ $totalRegencies }}</p>
                </div>
            </div>
        </div>

        <div class="mt-8">
            <h2 class="text-2xl font-bold mb-4">Peta Wilayah</h2>
            <div class="bg-white rounded-lg shadow-md p-6">
                <!-- Placeholder untuk peta -->
                <div class="bg-gray-200 h-96 flex items-center justify-center">
                    <p class="text-gray-500">Peta Wilayah Jawa Barat akan ditampilkan di sini</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Script untuk implementasi peta bisa ditambahkan di sini
        // Misalnya menggunakan Leaflet.js atau Google Maps API
    </script>
@endpush
