<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gambar') }}
        </h2>
    </x-slot>

    <div class="pt-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Add Button + Success Message -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg space-y-4">
                <div class="max-w-xl">
                    <a href="{{ route('gambar.tambah') }}"
                       class="inline-block text-sm text-green-600 underline hover:text-green-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Tambah Data Gambar
                    </a>
                </div>
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                        {{ session('success') }}
                    </div>
                @endif
            </div>

            <!-- Gambar Aktif -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Gambar Ditampilkan</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    @foreach ($data->where('ditampilkan', true) as $item)
                        <div class="bg-gray-50 border rounded-lg shadow hover:shadow-md transition overflow-hidden">
                            <img src="{{ asset('storage/gambar/' . $item->path) }}"
                                 class="w-full h-48 object-cover"
                                 alt="{{ $item->caption }}">
                            <div class="p-4 flex justify-between items-center">
                                <p class="text-sm font-medium text-gray-700">{{ $item->caption }}</p>
                                <div class="space-x-2 flex items-center">
                                    <a href="{{ route('gambar.edit', $item->id) }}" class="text-blue-600 hover:underline text-sm">Edit</a>
                                    <form action="{{ route('gambar.hapus', $item->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-red-600 hover:underline text-sm">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Gambar Tidak Aktif -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Gambar Tidak Ditampilkan</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    @foreach ($data->where('ditampilkan', false) as $item)
                        <div class="bg-gray-50 border rounded-lg shadow hover:shadow-md transition overflow-hidden">
                            <img src="{{ asset('storage/gambar/' . $item->path) }}"
                                 class="w-full h-48 object-cover"
                                 alt="{{ $item->caption }}">
                            <div class="p-4 flex justify-between items-center">
                                <p class="text-sm font-medium text-gray-700">{{ $item->caption }}</p>
                                <div class="space-x-2 flex items-center">
                                    <a href="{{ route('gambar.edit', $item->id) }}" class="text-blue-600 hover:underline text-sm">Edit</a>
                                    <form action="{{ route('gambar.hapus', $item->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-red-600 hover:underline text-sm">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
