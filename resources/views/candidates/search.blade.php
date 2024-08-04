@extends('layouts.app')

@section('title', 'Hasil Pencarian - CariPemimpin')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Hasil Pencarian</h1>

        <!-- Breadcrumb -->
        <nav class="text-gray-500 text-sm mb-6" aria-label="Breadcrumb">
            <ol class="list-none p-0 inline-flex">
                <li class="flex items-center">
                    <a href="{{ route('home') }}" class="hover:text-[#90EE90]">Beranda</a>
                    <svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                        <path
                            d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z" />
                    </svg>
                </li>
                <li>
                    <span class="text-gray-700" aria-current="page">Hasil Pencarian</span>
                </li>
            </ol>
        </nav>

        <!-- Search Form -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <form action="{{ route('search-calon') }}" method="GET" class="flex flex-wrap items-center">
                <input type="text" name="query" value="{{ $query }}" placeholder="Nama calon atau daerah..."
                    class="flex-grow mr-4 mb-4 sm:mb-0 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#90EE90]">
                <button type="submit"
                    class="bg-[#90EE90] text-hitam font-bold py-2 px-6 rounded-lg hover:bg-green-400 transition duration-300">
                    Cari
                </button>
            </form>
        </div>

        <!-- Search Results -->
        @if ($candidates->isEmpty())
            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-8" role="alert">
                <p class="font-bold">Tidak ada hasil</p>
                <p>Maaf, tidak ada calon yang cocok dengan kata kunci "{{ $query }}". Silakan coba dengan kata kunci
                    lain.</p>
            </div>
        @else
            <p class="mb-4">Ditemukan {{ $candidates->total() }} hasil untuk pencarian "{{ $query }}"</p>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                @foreach ($candidates as $calon)
                    <x-calon-card :calon="$calon" />
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $candidates->appends(['query' => $query])->links() }}
            </div>
        @endif

        <!-- Related Searches or Suggestions -->
        @if ($candidates->isNotEmpty())
            <div class="mt-12">
                <h2 class="text-2xl font-bold mb-4">Pencarian Terkait</h2>
                <ul class="list-disc list-inside">
                    <li><a href="{{ route('search-calon', ['query' => $query . ' visi misi']) }}"
                            class="text-blue-600 hover:underline">{{ $query }} visi misi</a></li>
                    <li><a href="{{ route('search-calon', ['query' => $query . ' program unggulan']) }}"
                            class="text-blue-600 hover:underline">{{ $query }} program unggulan</a></li>
                    <li><a href="{{ route('search-calon', ['query' => $query . ' pengalaman']) }}"
                            class="text-blue-600 hover:underline">{{ $query }} pengalaman</a></li>
                </ul>
            </div>
        @endif

        <!-- Call to Action -->
        <div class="bg-gray-100 rounded-lg p-6 mt-12">
            <h2 class="text-2xl font-bold mb-4">Tidak menemukan yang Anda cari?</h2>
            <p class="mb-4">Jelajahi daftar lengkap calon pemimpin atau lihat berdasarkan daerah.</p>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('daftar-calon') }}"
                    class="bg-[#90EE90] text-hitam font-bold py-2 px-6 rounded-lg hover:bg-green-400 transition duration-300">
                    Lihat Semua Calon
                </a>
                <a href="{{ route('daftar-daerah') }}"
                    class="bg-hitam text-white font-bold py-2 px-6 rounded-lg hover:bg-gray-800 transition duration-300">
                    Lihat Berdasarkan Daerah
                </a>
            </div>
        </div>
    </div>
@endsection
