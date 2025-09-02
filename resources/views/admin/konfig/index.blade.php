<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ ('Jeda Waktu') }}
        </h2>
    </x-slot>

    <div class="pt-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
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
                <div class="w-full flex flex-col gap-4">
                    <form class="config-form" data-name="Iqamah" action="{{ route('konfig.update', $data[0]->id) }}" method="POST">
                        @csrf
                        <label for="iqamah_delay">Jeda Waktu Antara Sholat dan Iqamah: 
                            <input oninput="showButton(0)" type="number" name="val" id="iqamah_delay"
                                   class="rounded-md bg-green-100" value="{{ $data[0]->val }}">
                            Menit.
                        </label>
                        <button id="button0" type="button"
                                onclick="confirmSubmit(this)" 
                                class="hidden rounded-md bg-yellow-200 py-2 px-4 border">Ganti Data</button>
                    </form>

                    <form class="config-form" data-name="Refresh" action="{{ route('konfig.update', $data[1]->id) }}" method="POST">
                        @csrf
                        <label for="refresh_delay">Jeda Waktu Muat Ulang Halaman: 
                            <input oninput="showButton(1)" type="number" name="val" id="refresh_delay"
                                   class="rounded-md bg-green-100" value="{{ $data[1]->val }}">
                            Menit.
                        </label>
                        <button id="button1" type="button"
                                onclick="confirmSubmit(this)" 
                                class="hidden rounded-md bg-yellow-200 py-2 px-4 border">Ganti Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showButton(val) {
            document.getElementById('button' + val).classList.remove('hidden');
        }

        function confirmSubmit(button) {
            const form = button.closest('form');
            const typeName = form.dataset.name || 'data ini';

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: `Anda akan mengubah nilai ${typeName}.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#38a169',
                cancelButtonColor: '#e53e3e',
                confirmButtonText: 'Ya, ubah!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    </script>
</x-app-layout>
