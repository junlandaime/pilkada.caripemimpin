@extends('layouts.app')

@section('title', 'Tentang Kami - Pilkada Jawa Barat')

@section('content')
    <div class="bg-blue-600 text-white py-16">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl font-bold mb-4">Tentang Kami</h1>
            <p class="text-xl">Mengenal lebih dekat platform informasi Pilkada Jawa Barat</p>
        </div>
    </div>

    <div class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 mb-12">
            <div>
                <h2 class="text-3xl font-bold mb-6">Visi Kami</h2>
                <p class="text-lg mb-4">
                    Menjadi sumber informasi terpercaya dan komprehensif tentang Pemilihan Kepala Daerah di Jawa Barat,
                    mendorong partisipasi aktif masyarakat dalam proses demokrasi, dan memfasilitasi pengambilan keputusan
                    yang terinformasi bagi para pemilih.
                </p>
            </div>
            <div>
                <h2 class="text-3xl font-bold mb-6">Misi Kami</h2>
                <ul class="list-disc list-inside text-lg space-y-2">
                    <li>Menyediakan informasi akurat dan terkini tentang kandidat dan proses Pilkada</li>
                    <li>Meningkatkan kesadaran dan pemahaman masyarakat tentang pentingnya partisipasi dalam Pilkada</li>
                    <li>Menjembatani komunikasi antara kandidat, pemerintah, dan masyarakat</li>
                    <li>Mendorong transparansi dan akuntabilitas dalam proses pemilihan</li>
                    <li>Memfasilitasi diskusi dan dialog konstruktif tentang isu-isu penting di Jawa Barat</li>
                </ul>
            </div>
        </div>

        <div class="mb-12">
            <h2 class="text-3xl font-bold mb-6">Sejarah Kami</h2>
            <p class="text-lg mb-4">
                Platform pilkada.caripemimpin diluncurkan pada tahun 2024 sebagai respons terhadap kebutuhan masyarakat
                Jawa Barat akan sumber informasi yang terpercaya dan mudah diakses tentang Pemilihan Kepala Daerah.
                Berawal dari inisiatif sekelompok aktivis demokrasi dan teknologi, kami berkomitmen untuk meningkatkan
                kualitas partisipasi masyarakat dalam proses demokrasi lokal.
            </p>
            <p class="text-lg">
                Sejak peluncurannya, platform ini telah berkembang menjadi rujukan utama bagi masyarakat, media,
                dan pemangku kepentingan lainnya dalam mencari informasi tentang Pilkada di Jawa Barat.
            </p>
        </div>

        <div class="mb-12">
            <h2 class="text-3xl font-bold mb-6">Tim Kami</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                {{-- @foreach ($teamMembers as $member)
                    <div class="bg-white rounded-lg shadow-md p-6 text-center">
                        <img src="{{ $member['photo'] }}" alt="{{ $member['name'] }}"
                            class="w-32 h-32 rounded-full mx-auto mb-4">
                        <h3 class="text-xl font-semibold mb-2">{{ $member['name'] }}</h3>
                        <p class="text-gray-600 mb-2">{{ $member['position'] }}</p>
                        <p class="text-sm">{{ $member['bio'] }}</p>
                    </div>
                @endforeach --}}
            </div>
        </div>

        <div class="mb-12">
            <h2 class="text-3xl font-bold mb-6">Mitra dan Kolaborator</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                {{-- @foreach ($partners as $partner)
                    <div class="bg-white rounded-lg shadow-md p-4 flex items-center justify-center">
                        <img src="{{ $partner['logo'] }}" alt="{{ $partner['name'] }}" class="max-h-16">
                    </div>
                @endforeach --}}
            </div>
        </div>

        <div>
            <h2 class="text-3xl font-bold mb-6">Hubungi Kami</h2>
            <p class="text-lg mb-4">
                Kami selalu terbuka untuk saran, kritik, dan kolaborasi. Jangan ragu untuk menghubungi kami melalui:
            </p>
            <ul class="list-disc list-inside text-lg">
                <li>Email: info@pilkada.caripemimpin.id</li>
                <li>Telepon: (022) 123-4567</li>
                <li>Alamat: Jl. Demokrasi No. 45, Bandung, Jawa Barat</li>
            </ul>
        </div>
    </div>
@endsection
