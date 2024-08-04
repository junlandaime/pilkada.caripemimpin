@extends('layouts.app')

@section('title', 'Statistik Wilayah')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Statistik Wilayah Pilkada Jawa Barat</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-2">Total Wilayah</h2>
                <p class="text-3xl font-bold text-blue-600">{{ $statistics['total_regions'] }}</p>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-2">Total Kota</h2>
                <p class="text-3xl font-bold text-green-600">{{ $statistics['total_kota'] }}</p>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-2">Total Kabupaten</h2>
                <p class="text-3xl font-bold text-purple-600">{{ $statistics['total_kabupaten'] }}</p>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-2">Total Kandidat</h2>
                <p class="text-3xl font-bold text-red-600">{{ $statistics['total_candidates'] }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-semibold mb-4">Distribusi Wilayah</h2>
                <canvas id="regionDistributionChart"></canvas>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-semibold mb-4">Wilayah dengan Kandidat Terbanyak</h2>
                <canvas id="topRegionsCandidatesChart"></canvas>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <h2 class="text-2xl font-semibold mb-4">Perbandingan Populasi Wilayah</h2>
            <canvas id="populationComparisonChart"></canvas>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-semibold mb-4">Statistik Pemilih</h2>
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th class="text-left">Metrik</th>
                            <th class="text-right">Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Total Pemilih Terdaftar</td>
                            <td class="text-right">{{ number_format($statistics['total_registered_voters']) }}</td>
                        </tr>
                        <tr>
                            <td>Rata-rata Partisipasi Pemilih</td>
                            <td class="text-right">{{ number_format($statistics['average_voter_turnout'], 2) }}%</td>
                        </tr>
                        <tr>
                            <td>Wilayah dengan Partisipasi Tertinggi</td>
                            <td class="text-right">{{ $statistics['highest_turnout_region']->name }}
                                ({{ number_format($statistics['highest_turnout_region']->voter_turnout, 2) }}%)</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-semibold mb-4">Pemilihan Mendatang</h2>
                <canvas id="upcomingElectionsChart"></canvas>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-semibold mb-4">Peta Sebaran Wilayah</h2>
            <div id="map" class="h-96"></div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Distribusi Wilayah Chart
            new Chart(document.getElementById('regionDistributionChart'), {
                type: 'pie',
                data: {
                    labels: ['Kota', 'Kabupaten'],
                    datasets: [{
                        data: [{{ $statistics['total_kota'] }},
                            {{ $statistics['total_kabupaten'] }}],
                        backgroundColor: ['#4CAF50', '#2196F3']
                    }]
                }
            });

            // Top Regions by Candidates Chart
            new Chart(document.getElementById('topRegionsCandidatesChart'), {
                type: 'bar',
                data: {
                    labels: {!! json_encode($statistics['top_regions_candidates']->pluck('name')) !!},
                    datasets: [{
                        label: 'Jumlah Kandidat',
                        data: {!! json_encode($statistics['top_regions_candidates']->pluck('candidates_count')) !!},
                        backgroundColor: '#FFA000'
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Population Comparison Chart
            new Chart(document.getElementById('populationComparisonChart'), {
                type: 'horizontalBar',
                data: {
                    labels: {!! json_encode($statistics['population_comparison']->pluck('name')) !!},
                    datasets: [{
                        label: 'Populasi',
                        data: {!! json_encode($statistics['population_comparison']->pluck('population')) !!},
                        backgroundColor: '#4CAF50'
                    }]
                },
                options: {
                    scales: {
                        x: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Upcoming Elections Chart
            new Chart(document.getElementById('upcomingElectionsChart'), {
                type: 'line',
                data: {
                    labels: {!! json_encode($statistics['upcoming_elections']->pluck('month')) !!},
                    datasets: [{
                        label: 'Jumlah Pemilihan',
                        data: {!! json_encode($statistics['upcoming_elections']->pluck('count')) !!},
                        borderColor: '#3F51B5',
                        fill: false
                    }]
                }
            });

            // Map
            var map = L.map('map').setView([-6.9175, 107.6191], 8);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            @foreach ($statistics['regions'] as $region)
                L.marker([{{ $region->latitude }}, {{ $region->longitude }}])
                    .addTo(map)
                    .bindPopup("{{ $region->name }}");
            @endforeach
        });
    </script>
@endpush
