<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Petugas ' . $type) }}
        </h2>
    </x-slot>

    <div class="pt-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                       href="{{route('petugas.index')}}">Kembali
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
                        Data Petugas : {{ $type }}
                    </h1>
                </div>

                <form id="editPetugasForm" action="{{ route('petugas.update', [$data->id, $type]) }}" method="POST" class="space-y-6">
                    @csrf
                    <input type="hidden" name="id" value="{{$data->id}}">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- KHATIB --}}
                        @if ($type != 'tarawih')
                            <div>
                                <x-input-label for="khatib" :value="__('NAMA KHATIB')" />
                                <x-text-input id="khatib" value="{{$data->khatib}}" type="text" name="khatib" class="mt-1 block w-full" />
                                <x-input-error :messages="$errors->get('khatib')" class="mt-2" />
                            </div>
                        @endif
                        {{-- IMAM --}}
                        <div>
                            <x-input-label for="imam" :value="__('NAMA IMAM')" />
                            <x-text-input id="imam" value="{{$data->imam}}" type="text" name="imam" class="mt-1 block w-full" />
                            <x-input-error :messages="$errors->get('imam')" class="mt-2" />
                        </div>
                        {{-- MUADZIN --}}
                        @if ($type == 'jumat')
                            <div>
                                <x-input-label for="muadzin" :value="__('NAMA MUADZIN')" />
                                <x-text-input id="muadzin" value="{{$data->muadzin}}" type="text" name="muadzin" class="mt-1 block w-full" />
                                <x-input-error :messages="$errors->get('muadzin')" class="mt-2" />
                            </div>
                        @endif
                        {{-- BILAL --}}
                        @if ($type != 'tarawih')
                            <div>
                                <x-input-label for="bilal" :value="__('NAMA BILAL')" />
                                <x-text-input id="bilal" value="{{$data->bilal}}" type="text" name="bilal" class="mt-1 block w-full" />
                                <x-input-error :messages="$errors->get('bilal')" class="mt-2" />
                            </div>
                        @endif
                        {{-- KULTUM --}}
                        @if ($type == 'tarawih')
                            <div>
                                <x-input-label for="kultum" :value="__('NAMA KULTUM')" />
                                <x-text-input id="kultum" value="{{$data->kultum}}" type="text" name="kultum" class="mt-1 block w-full" />
                                <x-input-error :messages="$errors->get('kultum')" class="mt-2" />
                            </div>
                            {{-- SHOLAWAT --}}
                            <div>
                                <x-input-label for="sholawat" :value="__('NAMA SHOLAWAT')" />
                                <x-text-input id="sholawat" value="{{$data->sholawat}}" type="text" name="sholawat" class="mt-1 block w-full" />
                                <x-input-error :messages="$errors->get('sholawat')" class="mt-2" />
                            </div>
                        @endif
                        {{-- Moderator --}}
                        @if ($type == 'fitri' || $type == 'adha')
                            <div>
                                <x-input-label for="moderator" :value="__('NAMA PEMBAWA ACARA')" />
                                <x-text-input id="moderator" value="{{$data->moderator}}" type="text" name="moderator" class="mt-1 block w-full" />
                                <x-input-error :messages="$errors->get('moderator')" class="mt-2" />
                            </div>
                        @endif
                    </div>

                    <div class="flex justify-end">
                        <x-primary-button class="mt-4">
                            {{ __('Perbarui Data') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('editPetugasForm');

            form.addEventListener('submit', function (e) {
                e.preventDefault();

                // Only validate visible fields
                const requiredFields = form.querySelectorAll('input[type="text"]:not([hidden])');

                let isEmpty = false;
                let emptyFields = [];

                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        isEmpty = true;
                        emptyFields.push(field.id);
                    }
                });

                if (isEmpty) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Data tidak boleh kosong',
                        text: 'Semua kolom yang tampil wajib diisi.',
                        confirmButtonText: 'OK'
                    });
                    return;
                }

                Swal.fire({
                    title: 'Perbarui Data?',
                    text: 'Apakah Anda yakin ingin memperbarui data petugas?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Perbarui',
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
