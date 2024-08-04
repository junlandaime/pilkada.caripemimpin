@extends('layouts.app')

@section('title', 'Beranda - Pilkada Jawa Barat')

@section('content')
    <div class="bg-blue-600 text-white py-16">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl font-bold mb-4">Selamat Datang di Portal Pilkada Jawa Barat</h1>
            <p class="text-xl mb-8">Informasi lengkap tentang Pemilihan Kepala Daerah di Jawa Barat</p>
            <form action="{{ route('candidates.search') }}" method="GET" class="flex">
                <input type="text" name="query" placeholder="Cari kandidat atau wilayah..."
                    class="form-input flex-grow rounded-l-lg">
                <button type="submit"
                    class="bg-yellow-500 text-blue-900 px-6 py-2 rounded-r-lg hover:bg-yellow-400 transition duration-300">Cari</button>
            </form>
        </div>
    </div>

    <div class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-bold mb-4">Pemilihan Terdekat</h2>
                <ul class="space-y-4">
                    @foreach ($upcomingElections as $election)
                        <li>
                            <span class="font-semibold">{{ $election->region->name }}</span><br>
                            <span class="text-gray-600">{{ $election->position }}</span><br>
                            {{-- <span class="text-sm text-blue-600">{{ $election->date->format('d F Y') }}</span> --}}
                        </li>
                    @endforeach
                </ul>
                {{-- <a href="{{ route('elections.index') }}" class="mt-4 inline-block text-blue-600 hover:underline">Lihat semua
                    pemilihan</a> --}}
            </div>
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-bold mb-4">Kandidat Terpopuler</h2>
                {{-- <ul class="space-y-4">
                    @foreach ($popularCandidates as $candidate)
                        <li class="flex items-center">
                            <img src="{{ $candidate->photo_url }}" alt="{{ $candidate->name }}"
                                class="w-12 h-12 rounded-full mr-4">
                            <div>
                                <span class="font-semibold">{{ $candidate->name }}</span><br>
                                <span class="text-gray-600">{{ $candidate->position }} -
                                    {{ $candidate->region->name }}</span>
                            </div>
                        </li>
                    @endforeach
                </ul> --}}
                <a href="{{ route('candidates.index') }}" class="mt-4 inline-block text-blue-600 hover:underline">Lihat
                    semua kandidat</a>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-bold mb-4">Statistik Pilkada</h2>
                {{-- <ul class="space-y-2">
                    <li>Total Wilayah: <span class="font-semibold">{{ $statistics['total_regions'] }}</span></li>
                    <li>Total Kandidat: <span class="font-semibold">{{ $statistics['total_candidates'] }}</span></li>
                    <li>Pemilih Terdaftar: <span
                            class="font-semibold">{{ number_format($statistics['total_voters']) }}</span></li>
                    <li>Partisipasi Pemilih: <span
                            class="font-semibold">{{ number_format($statistics['avg_turnout'], 2) }}%</span></li>
                </ul>
                <a href="{{ route('regions.statistics') }}" class="mt-4 inline-block text-blue-600 hover:underline">Lihat
                    statistik lengkap</a> --}}
            </div>
        </div>

        <div class="mb-12">
            <h2 class="text-3xl font-bold mb-6">Peta Wilayah Pilkada</h2>
            <div id="map" class="h-96 rounded-lg shadow-md"></div>
        </div>

        <div class="mb-12">
            <h2 class="text-3xl font-bold mb-6">Berita dan Pengumuman Terbaru</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                {{-- @foreach ($latestNews as $news)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <img src="{{ $news->image_url }}" alt="{{ $news->title }}" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="font-bold text-xl mb-2">{{ $news->title }}</h3>
                            <p class="text-gray-600 mb-4">{{ Str::limit($news->content, 100) }}</p>
                            <a href="{{ route('news.show', $news) }}" class="text-blue-600 hover:underline">Baca
                                selengkapnya</a>
                        </div>
                    </div>
                @endforeach --}}
            </div>
            {{-- <a href="{{ route('news.index') }}" class="mt-4 inline-block text-blue-600 hover:underline">Lihat semua
                berita</a> --}}
        </div>

        <div>
            <h2 class="text-3xl font-bold mb-6">Panduan Pemilih</h2>
            <div class="bg-white rounded-lg shadow-md p-6">
                <p class="mb-4">Penting untuk memahami proses dan hak Anda sebagai pemilih. Berikut beberapa panduan
                    penting:</p>
                <ul class="list-disc list-inside space-y-2">
                    <li>Pastikan Anda terdaftar sebagai pemilih</li>
                    <li>Kenali kandidat dan program mereka</li>
                    <li>Periksa waktu dan lokasi TPS Anda</li>
                    <li>Bawa identitas yang diperlukan saat memilih</li>
                    <li>Jaga kerahasiaan suara Anda</li>
                </ul>
                {{-- <a href="{{ route('voter.guide') }}" class="mt-4 inline-block text-blue-600 hover:underline">Baca panduan
                    lengkap</a> --}}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var map = L.map('map').setView([-6.9175, 107.6191], 8);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            @foreach ($regions as $region)
                L.marker([{{ $region->latitude }}, {{ $region->longitude }}])
                    .addTo(map)
                    .bindPopup("<a href='{{ route('regions.show', $region) }}'>{{ $region->name }}</a>");
            @endforeach
        });
    </script>
@endpush
