<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ ('Petugas') }}
        </h2>
    </x-slot>

    <div class="pt-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                @if(session('success'))
                    <div class="bg-green-100 border mt-4 border-green-400 text-green-700 px-4 py-3 rounded">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="w-full flex flex-col gap-4">
                    <h1 class="uppercase">Data petugas yang ditampilkan : {{ $data[5]->petugas ?? 'Tidak Ada Data Yang Ditampilkan' }}</h1>
                    <form id="formTampilkanPetugas" action="{{ route('config.update') }}" method="POST">
                        @csrf
                        <x-input-label>Tampilkan Petugas : </x-input-label>
                        <select name="tampilkan" id="tampilkan" class="border border-green-200 rounded-md bg-green-100">
                            <option value="jumat">Petugas Jumat</option>
                            <option value="tarawih">Petugas Tarawih</option>
                            <option value="fitri">Petugas Idul Fitri</option>
                            <option value="adha">Petugas Idul Adha</option>
                        </select>
                        <button type="submit" class="border border-green-200 rounded-md bg-green-100 py-2 px-4">Tampilkan</button>
                    </form>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 justify-between">
                        {{--  --}}
                        <table>
                            <thead>
                                <tr class="bg-green-100">
                                    <th colspan="2" class="py-2 px-8 border border-green-200">Petugas Jumat</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="py-2 px-8 border border-green-200">Khatib</td>
                                    <td class="py-2 px-8 border border-green-200">{{ $data[1]->khatib ?? 'Tidak Ada Data' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-8 border border-green-200">Imam</td>
                                    <td class="py-2 px-8 border border-green-200">{{ $data[1]->imam ?? 'Tidak Ada Data' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-8 border border-green-200">Muadzin</td>
                                    <td class="py-2 px-8 border border-green-200">{{ $data[1]->muadzin ?? 'Tidak Ada Data' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-8 border border-green-200">Bilal</td>
                                    <td class="py-2 px-8 border border-green-200">{{ $data[1]->bilal ?? 'Tidak Ada Data' }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="py-2 px-8 border border-green-200 text-center">
                                        <form action="{{ route('petugas.view', [$data[1]->id, $type = 'jumat']) }}" method="GET">
                                            <button type="submit" class="border border-green-200 rounded-md bg-yellow-100 py-2 px-4">Edit Data</button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        {{--  --}}
                        <table>
                            <thead>
                                <tr class="bg-green-100">
                                    <th colspan="2" class="py-2 px-8 border border-green-200">Petugas Tarawih</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="py-2 px-8 border border-green-200">Imam</td>
                                    <td class="py-2 px-8 border border-green-200">{{ $data[2]->imam ?? 'Tidak Ada Data' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-8 border border-green-200">Kultum</td>
                                    <td class="py-2 px-8 border border-green-200">{{ $data[2]->kultum ?? 'Tidak Ada Data' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-8 border border-green-200">Sholawat</td>
                                    <td class="py-2 px-8 border border-green-200">{{ $data[2]->sholawat ?? 'Tidak Ada Data' }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="py-2 px-8 border border-green-200 text-center">
                                        <form action="{{ route('petugas.view', [$data[2]->id, $type = 'tarawih']) }}" method="GET">
                                            <button type="submit" class="border border-green-200 rounded-md bg-yellow-100 py-2 px-4">Edit Data</button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        {{--  --}}
                        <table>
                            <thead>
                                <tr class="bg-green-100">
                                    <th colspan="2" class="py-2 px-8 border border-green-200">Petugas Idul Fitri</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="py-2 px-8 border border-green-200">Khatib</td>
                                    <td class="py-2 px-8 border border-green-200">{{ $data[3]->khatib ?? 'Tidak Ada Data' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-8 border border-green-200">Imam</td>
                                    <td class="py-2 px-8 border border-green-200">{{ $data[3]->imam ?? 'Tidak Ada Data' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-8 border border-green-200">Bilal</td>
                                    <td class="py-2 px-8 border border-green-200">{{ $data[3]->bilal ?? 'Tidak Ada Data' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-8 border border-green-200">Pembawa Acara</td>
                                    <td class="py-2 px-8 border border-green-200">{{ $data[3]->moderator ?? 'Tidak Ada Data' }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="py-2 px-8 border border-green-200 text-center">
                                        <form action="{{ route('petugas.view', [$data[3]->id, $type = 'fitri']) }}" method="GET">
                                            <button type="submit" class="border border-green-200 rounded-md bg-yellow-100 py-2 px-4">Edit Data</button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        {{--  --}}
                        <table>
                            <thead>
                                <tr class="bg-green-100">
                                    <th colspan="2" class="py-2 px-8 border border-green-200">Petugas Idul Adha</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="py-2 px-8 border border-green-200">Khatib</td>
                                    <td class="py-2 px-8 border border-green-200">{{ $data[4]->khatib ?? 'Tidak Ada Data' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-8 border border-green-200">Imam</td>
                                    <td class="py-2 px-8 border border-green-200">{{ $data[4]->imam ?? 'Tidak Ada Data' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-8 border border-green-200">Bilal</td>
                                    <td class="py-2 px-8 border border-green-200">{{ $data[4]->bilal ?? 'Tidak Ada Data' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-8 border border-green-200">Pembawa Acara</td>
                                    <td class="py-2 px-8 border border-green-200">{{ $data[4]->moderator ?? 'Tidak Ada Data' }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="py-2 px-8 border border-green-200 text-center">
                                        <form action="{{ route('petugas.view', [$data[4]->id, $type = 'adha']) }}" method="GET">
                                            <button type="submit" class="border border-green-200 rounded-md bg-yellow-100 py-2 px-4">Edit Data</button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('formTampilkanPetugas');
            const select = document.getElementById('tampilkan');

            form.addEventListener('submit', function (e) {
                e.preventDefault();

                const selected = select.value;

                if (!selected) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Pilihan tidak boleh kosong',
                        text: 'Silakan pilih jenis petugas terlebih dahulu.',
                        confirmButtonText: 'OK'
                    });
                    return;
                }

                Swal.fire({
                    title: 'Tampilkan Petugas?',
                    text: 'Anda akan menampilkan data untuk: ' + selected.toUpperCase(),
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Tampilkan',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>

</x-app-layout>
