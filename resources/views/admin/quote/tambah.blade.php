<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Data Quote') }}
        </h2>
    </x-slot>

    <div class="pt-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                       href="{{route('quote.index')}}">Kembali
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
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form id="formId" action="{{route('quote.insert')}}" method="POST">
                        @csrf
                        <div class="my-2">
                            <x-input-label for="quote1" :value="__('Baris Pertama')" />
                            <x-text-input required id="quote1" type="text" name="quote1" value="{{old('quote1')}}" class="mt-1 bg-green-100 block w-full" />
                        </div>
                        <div class="my-2">
                            <x-input-label for="quote2" :value="__('Baris Kedua')" />
                            <x-text-input required id="quote2" type="text" name="quote2" value="{{old('quote2')}}" class="mt-1 bg-green-100 block w-full" />
                        </div>
                        <div class="my-2">
                            <x-input-label for="quote3" :value="__('Baris Ketiga')" />
                            <x-text-input required id="quote3" type="text" name="quote3" value="{{old('quote3')}}" class="mt-1 bg-green-100 block w-full" />
                        </div>
                        <div class="my-2 flex items-center gap-2">
                            <input type="checkbox" name="ditampilkan" id="ditampilkan" class="bg-green-100 rounded-xl focus:ring-green-200">
                            <x-input-label for="ditampilkan" :value="__('Langsung Ditampilkan?')" />
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
                    
                    const input1 = document.getElementById('quote1');
                    const input2 = document.getElementById('quote2');
                    const input3 = document.getElementById('quote3');
                    const form = tambahBtn.closest('form'); // this finds the enclosing form

                    // Trim and check if any field is empty
                    if (
                        input1.value.trim() === '' ||
                        input2.value.trim() === '' ||
                        input3.value.trim() === ''
                    ) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Data tidak boleh kosong',
                            text: 'Semua baris quote harus diisi.',
                            confirmButtonText: 'OK'
                        });
                        return;
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
