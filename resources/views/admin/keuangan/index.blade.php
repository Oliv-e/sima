<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ ('Keuangan') }}
        </h2>
    </x-slot>

    <div class="pt-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                    href="{{route('keuangan.tambah')}}">
                    Tambah Data Keuangan</a>
                </div>
            </div>
            @if(session('success'))
                <div class="bg-green-100 border mt-4 border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif
        </div>
    </div>
    <div class="pt-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="w-full flex flex-col gap-2">
                    <h1>Hari ini : {{Carbon\Carbon::now()->translatedFormat('j F Y')}}</h1>
                    
                    <form action="{{ route('keuangan.index') }}" method="GET">
                        <x-input-label>Filter Data Berdasarkan Bulan:</x-input-label>
                        <input type="month" name="filter" id="filter" value="{{ request('filter') }}" class="border border-green-200 bg-green-100 mb-4 rounded-md">
                        <button type="submit" class="border border-greeen-200 bg-green-200 rounded-md py-2 px-6">{{ __('Cari') }}</button>
                    </form>
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                        @foreach ($data as $item)
                            <div class="mb-4">
                                <div class="bg-white shadow-md rounded-xl p-4 space-y-3 border">
                                    <div class="text-sm text-gray-600">
                                        <p><span class="font-semibold text-gray-700">Tanggal:</span> {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</p>
                                        <p><span class="font-semibold text-gray-700">Saldo:</span> <span class="text-green-600 font-semibold">Rp {{ number_format($item->saldo, 0, ',', '.') }}</span></p>
                                        <p><span class="font-semibold text-gray-700">Total Saldo:</span> <span class="text-green-600 font-semibold">Rp {{ number_format($item->total_saldo, 0, ',', '.') }}</span></p>
                                        <p><span class="font-semibold text-gray-700">Tipe:</span> 
                                            <span class="{{ $item->tipe == 'pemasukan' ? 'text-blue-600' : 'text-red-600' }} font-semibold uppercase">
                                                {{ $item->tipe }}
                                            </span>
                                        </p>
                                    </div>

                                    <div class="bg-gray-50 border border-gray-200 p-3 rounded-md text-sm text-gray-700">
                                        {{ $item->keterangan }}
                                    </div>

                                    <div class="flex justify-between items-center">
                                        <a href="{{ route('keuangan.edit', $item->id) }}"
                                        class="bg-yellow-500 hover:bg-yellow-600 text-white font-medium px-4 py-2 rounded-md text-sm flex items-center gap-1">
                                            ✏️ Edit
                                        </a>

                                        <form action="{{ route('keuangan.hapus', $item->id) }}" method="POST" class="form-hapus">
                                            @csrf
                                            <button type="submit"
                                                class="bg-red-500 hover:bg-red-600 text-white font-medium px-4 py-2 rounded-md text-sm flex items-center gap-1 btn-hapus">
                                                🗑️ Hapus
                                            </button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const hapusButtons = document.querySelectorAll('.form-hapus');

            hapusButtons.forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();

                    Swal.fire({
                        title: 'Hapus Data?',
                        text: 'Data yang dihapus tidak dapat dikembalikan!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#e3342f',
                        cancelButtonColor: '#6b7280',
                        confirmButtonText: 'Ya, Hapus',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
</x-app-layout>
