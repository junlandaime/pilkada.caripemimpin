@extends('layouts.admin')

@section('title', 'Tambah Kandidat Baru')

@section('content')
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold mb-6">Tambah Kandidat Baru</h1>

        <form action="{{ route('admin.candidates.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                        Nama
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror"
                        id="name" type="text" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="position">
                        Posisi
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('position') border-red-500 @enderror"
                        id="position" type="text" name="position" value="{{ old('position') }}" required>
                    @error('position')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="party">
                        Partai
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('party') border-red-500 @enderror"
                        id="party" type="text" name="party" value="{{ old('party') }}" required>
                    @error('party')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="region_id">
                        Wilayah
                    </label>
                    <select
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('region_id') border-red-500 @enderror"
                        id="region_id" name="region_id" required>
                        <option value="">Pilih Wilayah</option>
                        @foreach ($regions as $region)
                            <option value="{{ $region->id }}" {{ old('region_id') == $region->id ? 'selected' : '' }}>
                                {{ $region->type }} -
                                {{ $region->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('region_id')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="photo">
                        Foto
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('photo') border-red-500 @enderror"
                        id="photo" type="file" name="photo" accept="image/*">
                    @error('photo')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="short_bio">
                        Biografi Singkat
                    </label>
                    <textarea
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('short_bio') border-red-500 @enderror"
                        id="short_bio" name="short_bio" rows="3">{{ old('short_bio') }}</textarea>
                    @error('short_bio')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="full_bio">
                        Biografi Lengkap
                    </label>
                    <textarea
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('full_bio') border-red-500 @enderror"
                        id="full_bio" name="full_bio" rows="6">{{ old('full_bio') }}</textarea>
                    @error('full_bio')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="election_date">
                        Tanggal Pemilihan
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('election_date') border-red-500 @enderror"
                        id="election_date" type="date" name="election_date" value="{{ old('election_date') }}" required>
                    @error('election_date')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex items-center justify-between">
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="submit">
                        Simpan Kandidat
                    </button>
                    <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800"
                        href="{{ route('admin.candidates.index') }}">
                        Batal
                    </a>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        // Tambahkan script JavaScript untuk validasi form client-side jika diperlukan
    </script>
@endpush
