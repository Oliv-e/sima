<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Keuangan') }}
        </h2>
    </x-slot>

    <div class="pt-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                       href="{{route('keuangan.index')}}">Kembali
                    </a>
                </div>
                @if(session('success'))
                    <div class="bg-green-100 border mt-4 border-green-400 text-green-700 px-4 py-3 rounded">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="pt-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-6 bg-white shadow sm:rounded-lg">
                <div class="mb-6">
                    <h1 class="text-2xl font-semibold text-gray-800">
                        Data Tanggal: {{ \Carbon\Carbon::parse($data->tanggal)->translatedFormat('j F Y') }}
                    </h1>
                </div>
                <form action="{{route('keuangan.update', $data->id)}}" method="POST" id="addDataForm" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                        <div>
                            <x-input-label for="tanggal" :value="__('Tanggal')" />
                            <x-text-input id="tanggal" type="date" name="tanggal" value="{{ \Carbon\Carbon::parse($data->tanggal)->toDateString() }}" class="mt-1 block w-full" />
                            <x-input-error :messages="$errors->get('tanggal')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="tipe" :value="__('Jenis Keuangan')" />
                            <select name="tipe" id="tipe" class="mt-1 block w-full rounded-md border-gray-300">
                                <option value="pemasukan" {{ $data->tipe == 'pemasukan' ? 'selected' : '' }}>Pemasukan</option>
                                <option value="pengeluaran" {{ $data->tipe == 'pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
                            </select>
                            <x-input-error :messages="$errors->get('tipe')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="keterangan" :value="__('Keterangan')" />
                            <x-text-input id="keterangan" type="text" name="keterangan" value="{{ $data->keterangan }}" class="mt-1 block w-full" />
                            <x-input-error :messages="$errors->get('keterangan')" class="mt-2" />
                        </div>

                        <div class="">
                            <label for="saldo" class="block text-sm font-medium text-gray-700">Saldo</label>
                            <input placeholder="cth Rp. 100.000" type="text" value="{{ 'Rp. ' . number_format($data->saldo, 0, ',' , '.')}}" id="saldo" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-gray-700 focus:ring-gray-500" oninput="formatRupiahJurnal(this)">
                            <input type="hidden" name="saldo" id="saldo_numeric">
                        </div>
                    </div>
                    <div class="mt-4">
                        <x-primary-button>
                            {{ __('Edit Data') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function formatRupiahJurnal(input) {
            let value = input.value.replace(/[^,\d]/g, '').toString();
            let split = value.split(',');
            let integerPart = split[0];
            let decimalPart = split.length > 1 ? ',' + split[1] : '';
            integerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            input.value = 'Rp. ' + integerPart + decimalPart;
        }

        document.getElementById('addDataForm').addEventListener('submit', function(e) {
            e.preventDefault(); // Cegah submit default

            const tanggal = document.getElementById('tanggal').value;
            const tipe = document.getElementById('tipe').value;
            const keterangan = document.getElementById('keterangan').value.trim();
            const saldoDisplay = document.getElementById('saldo').value;
            const saldoNumeric = saldoDisplay.replace(/[^,\d]/g, '').toString().replace(/\./g, '');

            if (!tanggal || !tipe || !keterangan || saldoNumeric === '') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Data tidak lengkap',
                    text: 'Mohon isi semua field!',
                });
                return;
            }

            Swal.fire({
                title: 'Simpan Perubahan?',
                text: "Data akan diperbarui.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#2563eb',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Simpan',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('saldo_numeric').value = saldoNumeric;
                    e.target.submit();
                }
            });
        });
    </script>
</x-app-layout>
