@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="container mx-auto px-4 py-8 lg:px-32">
        <h1 class="text-3xl font-bold mb-6">Dashboard Admin</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-2">Total Kandidat</h2>
                <p class="text-3xl font-bold text-blue-600">{{ $totalCandidates }}</p>
                <a href="{{ route('admin.candidates.index') }}" class="text-blue-500 hover:underline mt-2 inline-block">Kelola
                    Kandidat</a>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-2">Total Wilayah</h2>
                <p class="text-3xl font-bold text-green-600">{{ $totalRegions }}</p>
                <a href="{{ route('admin.regions.index') }}" class="text-green-500 hover:underline mt-2 inline-block">Kelola
                    Wilayah</a>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-2">Pemilihan Akan Datang</h2>
                {{-- <p class="text-3xl font-bold text-purple-600">{{ $upcomingElections }}</p> --}}
                <a href="{{ route('admin.elections.index') }}"
                    class="text-purple-500 hover:underline mt-2 inline-block">Kelola Pemilihan</a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-semibold mb-4">Aktivitas Terbaru</h2>
                <ul class="space-y-2">
                    {{-- @forelse($recentActivities as $activity)
                        <li class="flex items-center justify-between">
                            <span>{{ $activity->description }}</span>
                            <span class="text-sm text-gray-500">{{ $activity->created_at->diffForHumans() }}</span>
                        </li>
                    @empty
                        <li>Tidak ada aktivitas terbaru.</li>
                    @endforelse --}}
                </ul>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-semibold mb-4">Pemilihan Terdekat</h2>
                <ul class="space-y-2">
                    {{-- @forelse($nearestElections as $election)
                        <li class="flex items-center justify-between">
                            <span>{{ $election->name }} - {{ $election->region->name }}</span>
                            <span class="text-sm text-gray-500">{{ $election->date->format('d M Y') }}</span>
                        </li>
                    @empty
                        <li>Tidak ada pemilihan yang akan datang.</li>
                    @endforelse --}}
                </ul>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <h2 class="text-2xl font-semibold mb-4">Statistik Website</h2>
            {{-- <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div>
                    <h3 class="text-lg font-semibold">Pengunjung Hari Ini</h3>
                    <p class="text-2xl font-bold text-blue-600">{{ $visitorToday }}</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold">Total Pengunjung</h3>
                    <p class="text-2xl font-bold text-green-600">{{ $totalVisitors }}</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold">Halaman Terpopuler</h3>
                    <p class="text-lg">{{ $popularPage }}</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold">Waktu Respon Rata-rata</h3>
                    <p class="text-2xl font-bold text-purple-600">{{ $avgResponseTime }} ms</p>
                </div>
            </div> --}}
        </div>

        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold">Tugas-tugas</h2>
            <a href="#"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-300">Tambah Tugas</a>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6">
            <ul class="space-y-2">
                {{-- @forelse($tasks as $task)
                    <li class="flex items-center justify-between">
                        <span>{{ $task->description }}</span>
                        <div>
                            <span class="text-sm text-gray-500 mr-2">Tenggat: {{ $task->due_date->format('d M Y') }}</span>
                            <button class="text-green-500 hover:text-green-700">Selesai</button>
                        </div>
                    </li>
                @empty
                    <li>Tidak ada tugas saat ini.</li>
                @endforelse --}}
            </ul>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Anda bisa menambahkan script untuk chart atau interaktivitas lainnya di sini
    </script>
@endpush
