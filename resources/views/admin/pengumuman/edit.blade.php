<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data Pengumuman') }}
        </h2>
    </x-slot>

    <div class="pt-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                       href="{{route('pengumuman.index')}}">Kembali
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
                    <form id="formId" action="{{route('pengumuman.update', $data->id)}}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="my-2">
                            <x-input-label for="isi_pengumuman" :value="__('Pengumuman')" />
                            <x-text-input required id="isi_pengumuman" type="text" name="isi_pengumuman" value="{{old('isi_pengumuman',$data->isi_pengumuman)}}" class="mt-1 bg-green-100 block w-full" />
                        </div>
                        <div class="my-2 flex items-center gap-2">
                            <input type="checkbox" name="ditampilkan" {{ old('ditampilkan', $data->ditampilkan) ? 'checked' : '' }} id="ditampilkan" class="bg-green-100 rounded-xl focus:ring-green-200">
                            <x-input-label for="ditampilkan" :value="__('Langsung Ditampilkan?')" />
                        </div>
                        <button id="tambahBtn" class="items-center px-4 py-2 bg-green-800 border rounded-md text-white">
                            Edit Data
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
                    
                    const input1 = document.getElementById('isi_pengumuman');
                    const form = tambahBtn.closest('form'); // this finds the enclosing form

                    // Trim and check if any field is empty
                    if (
                        input1.value.trim() === ''
                    ) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Data tidak boleh kosong',
                            text: 'Baris pengumuman harus diisi.',
                            confirmButtonText: 'OK'
                        });
                        return;
                    }

                    Swal.fire({
                        title: 'Edit Data?',
                        text: 'Apakah Anda yakin ingin mengedit data?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Edit!',
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
