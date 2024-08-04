@extends('layouts.app')

@section('title', 'Hubungi Kami - Pilkada Jawa Barat')

@section('content')
    <div class="bg-blue-600 text-white py-16">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl font-bold mb-4">Hubungi Kami</h1>
            <p class="text-xl">Kami siap mendengar pertanyaan, saran, atau masukan Anda</p>
        </div>
    </div>

    <div class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <div>
                <h2 class="text-2xl font-bold mb-6">Kirim Pesan</h2>
                <form action="{{ route('contact.submit') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-bold mb-2">Nama</label>
                        <input type="text" id="name" name="name" class="form-input w-full" required>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
                        <input type="email" id="email" name="email" class="form-input w-full" required>
                    </div>
                    <div class="mb-4">
                        <label for="subject" class="block text-gray-700 font-bold mb-2">Subjek</label>
                        <input type="text" id="subject" name="subject" class="form-input w-full" required>
                    </div>
                    <div class="mb-4">
                        <label for="message" class="block text-gray-700 font-bold mb-2">Pesan</label>
                        <textarea id="message" name="message" rows="5" class="form-textarea w-full" required></textarea>
                    </div>
                    <button type="submit"
                        class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition duration-300">Kirim
                        Pesan</button>
                </form>
            </div>
            <div>
                <h2 class="text-2xl font-bold mb-6">Informasi Kontak</h2>
                <div class="space-y-4">
                    <div class="flex items-start">
                        <svg class="w-6 h-6 text-blue-600 mr-3 mt-1" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <div>
                            <h3 class="font-semibold">Alamat</h3>
                            <p>Jl. Demokrasi No. 45, Bandung, Jawa Barat 40115</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <svg class="w-6 h-6 text-blue-600 mr-3 mt-1" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                            </path>
                        </svg>
                        <div>
                            <h3 class="font-semibold">Telepon</h3>
                            <p>(022) 123-4567</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <svg class="w-6 h-6 text-blue-600 mr-3 mt-1" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                        <div>
                            <h3 class="font-semibold">Email</h3>
                            <p>info@pilkada.caripemimpin.id</p>
                        </div>
                    </div>
                </div>

                <h2 class="text-2xl font-bold mt-12 mb-6">Jam Operasional</h2>
                <ul class="space-y-2">
                    <li><span class="font-semibold">Senin - Jumat:</span> 08:00 - 17:00</li>
                    <li><span class="font-semibold">Sabtu:</span> 09:00 - 14:00</li>
                    <li><span class="font-semibold">Minggu:</span> Tutup</li>
                </ul>

                <h2 class="text-2xl font-bold mt-12 mb-6">Lokasi Kami</h2>
                <div id="map" class="h-64 rounded-lg shadow-md"></div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var map = L.map('map').setView([-6.9175, 107.6191], 15);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            L.marker([-6.9175, 107.6191]).addTo(map)
                .bindPopup('Kantor Pilkada Jawa Barat')
                .openPopup();
        });
    </script>
@endpush
