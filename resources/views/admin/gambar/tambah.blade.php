<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Data Gambar') }}
        </h2>
    </x-slot>

    <div class="pt-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                       href="{{route('gambar.index')}}">Kembali
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
                <div class="w-full">
                    <form id="uploadForm" action="{{route('gambar.create')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <x-input-label for="file" :value="__('Unggah File')" class="mb-4" />

                        <div class="flex items-center justify-center w-full mb-4">
                            <label for="dropzone-file" class="relative flex flex-col items-center justify-center w-full h-72 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 overflow-hidden">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">.png .jpg. jpeg</p>
                                </div>
                                <input id="dropzone-file" name="file" type="file" class="hidden" />
                                <p id="file-name-preview" class="mt-2 text-sm text-green-600 font-medium"></p>
                            </label>
                        </div>

                        <x-input-label for="caption" :value="__('Caption Gambar')" class="mb-4"/>
                        <x-text-input class="w-full mb-4" required name="caption" type="text" placeholder="Cth. Zakat Tanggal Sekian"/>

                        <div class="flex items-center gap-2 mb-4">
                            <input name="ditampilkan" type="checkbox" id="ditampilkan" value="1" class="rounded border-gray-300 text-green-600 shadow-sm focus:ring-green-500">
                            <x-input-label for="ditampilkan" :value="__('Ditampilkan ?')" />
                        </div>

                        <x-primary-button>
                            {{ __('Tambah Data') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const fileInput = document.getElementById('dropzone-file');
        const captionInput = document.querySelector('input[name="caption"]');
        const form = document.getElementById('uploadForm');

        const previewText = document.querySelector('#file-name-preview');
        const dropzoneLabel = fileInput.closest('label');
        const dropzoneContent = dropzoneLabel.querySelector('div');

        fileInput.addEventListener('change', function () {
            if (fileInput.files && fileInput.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    dropzoneContent.innerHTML = '';
                    const card = document.createElement('div');
                    card.className = "w-full h-60 bg-white border border-gray-300 rounded-lg shadow overflow-hidden flex items-center justify-center";

                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = "max-h-full max-w-full object-contain";

                    card.appendChild(img);
                    dropzoneContent.appendChild(card);

                    previewText.textContent = fileInput.files[0].name;
                };
                reader.readAsDataURL(fileInput.files[0]);
            }
        });

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            if (!fileInput.files.length) {
                return Swal.fire({
                    icon: 'warning',
                    title: 'File kosong!',
                    text: 'Silakan pilih file gambar terlebih dahulu.'
                });
            }

            if (!captionInput.value.trim()) {
                return Swal.fire({
                    icon: 'warning',
                    title: 'Caption kosong!',
                    text: 'Silakan isi caption terlebih dahulu.'
                });
            }

            Swal.fire({
                title: 'Tambah Gambar?',
                text: "Apakah Anda yakin ingin mengunggah gambar ini?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#16a34a',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Unggah',
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
