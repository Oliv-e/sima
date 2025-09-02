<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Jadwal Sholat') }}
        </h2>
    </x-slot>

    <div class="pt-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                       href="{{route('jadwal_sholat.index')}}">Kembali
                    </a>
                </div>
                @if(session('success'))
                    <div class="bg-green-100 border mt-4 border-green-400 text-green-700 px-4 py-3 rounded">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="bg-green-100 border mt-4 px-4 py-3 rounded">
                    Data Jadwal Sholat bisa didapatkan di
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                       href="https://bimasislam.kemenag.go.id/jadwalshalat">
                       https://bimasislam.kemenag.go.id/jadwalshalat</a>
                    dengan cara memilih provinsi kalimantan barat, kabupaten sambas dan pilih bulan serta tahun, kemudian unduh file dan unggah di kotak dibawah ini untuk memasukkan jadwal sholat.
                    <img src="{{asset('def_gambar/petunjuk_jadwal_sholat.png')}}" alt="Petunjuk Jadwal Sholat" class="my-2 rounded-xl border border-black">
                </div>
            </div>
        </div>
    </div>
    <div class="pt-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form id="formId" action="{{route('jadwal_sholat.import')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <x-input-label for="file" :value="__('Unggah File')" class="mb-4" />

                        <div class="flex items-center justify-center w-full mb-4">
                            <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">.XLS</p>
                                </div>
                                <input id="dropzone-file" name="file" type="file" class="hidden" />
                                <p id="file-name-preview" class="mt-2 text-sm text-green-600 font-medium"></p>
                            </label>
                        </div>

                        <button id="tambahBtn" class="items-center px-4 py-2 bg-green-800 border rounded-md text-white">
                            Tambah Data
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tambahBtn = document.getElementById('tambahBtn');

            if (tambahBtn) {
                tambahBtn.addEventListener('click', function (e) {
                    e.preventDefault();
                    
                    const fileInput = document.getElementById('dropzone-file');

                    if (!fileInput.files || fileInput.files.length === 0) {
                        e.preventDefault();

                        Swal.fire({
                            icon: 'warning',
                            title: 'Data tidak boleh kosong',
                            text: 'Silakan pilih file terlebih dahulu.',
                            confirmButtonText: 'OK'
                        });

                        return false;
                    }

                    Swal.fire({
                        title: 'Tambah Data?',
                        text: 'Apakah Anda yakin ingin menambahkan data baru?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Tambah!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('formId').submit();
                        }
                    });
                });
            }
        });
    </script>

</x-app-layout>
