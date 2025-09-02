<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Jadwal Sholat') }}
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

                <form id="editForm" action="{{ route('jadwal_sholat.update') }}" method="POST" class="space-y-6">
                    @csrf
                    <input type="hidden" name="id" value="{{$data->id}}">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="imsak" :value="__('Jam Imsak')" />
                            <x-text-input id="imsak" value="{{$data->imsak}}" type="time" name="imsak" class="mt-1 block w-full" />
                            <x-input-error :messages="$errors->get('imsak')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="subuh" :value="__('Jam Subuh')" />
                            <x-text-input id="subuh" value="{{$data->subuh}}" type="time" name="subuh" class="mt-1 block w-full" />
                            <x-input-error :messages="$errors->get('subuh')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="terbit" :value="__('Jam Terbit')" />
                            <x-text-input id="terbit" value="{{$data->terbit}}" type="time" name="terbit" class="mt-1 block w-full" />
                            <x-input-error :messages="$errors->get('terbit')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="dhuha" :value="__('Jam Dhuha')" />
                            <x-text-input id="dhuha" value="{{$data->dhuha}}" type="time" name="dhuha" class="mt-1 block w-full" />
                            <x-input-error :messages="$errors->get('dhuha')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="dzuhur" :value="__('Jam Dzuhur')" />
                            <x-text-input id="dzuhur" value="{{$data->dzuhur}}" type="time" name="dzuhur" class="mt-1 block w-full" />
                            <x-input-error :messages="$errors->get('dzuhur')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="ashar" :value="__('Jam Ashar')" />
                            <x-text-input id="ashar" value="{{$data->ashar}}" type="time" name="ashar" class="mt-1 block w-full" />
                            <x-input-error :messages="$errors->get('ashar')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="maghrib" :value="__('Jam Maghrib')" />
                            <x-text-input id="maghrib" value="{{$data->maghrib}}" type="time" name="maghrib" class="mt-1 block w-full" />
                            <x-input-error :messages="$errors->get('maghrib')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="isya" :value="__('Jam Isya')" />
                            <x-text-input id="isya" value="{{$data->isya}}" type="time" name="isya" class="mt-1 block w-full" />
                            <x-input-error :messages="$errors->get('isya')" class="mt-2" />
                        </div>
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
            const form = document.getElementById('editForm');

            form.addEventListener('submit', function (e) {
                e.preventDefault(); // prevent immediate submission

                // Collect all time input fields
                const fields = [
                    'imsak', 'subuh', 'terbit', 'dhuha',
                    'dzuhur', 'ashar', 'maghrib', 'isya'
                ];

                // Check for empty fields
                let isEmpty = false;
                fields.forEach(id => {
                    const input = document.getElementById(id);
                    if (!input.value.trim()) {
                        isEmpty = true;
                    }
                });

                if (isEmpty) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Data tidak boleh kosong',
                        text: 'Semua jam sholat wajib diisi.',
                        confirmButtonText: 'OK'
                    });
                    return;
                }

                // If all valid, confirm submission
                Swal.fire({
                    title: 'Perbarui Data?',
                    text: 'Apakah Anda yakin ingin memperbarui jadwal sholat?',
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
