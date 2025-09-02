<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Quote') }}
        </h2>
    </x-slot>

    <div class="pt-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                    href="{{route('quote.tambah')}}">
                    Tambah Data Quote</a>
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
                    <?php $no = 1;?>
                    @foreach ($quote as $item)
                        <div class="my-2 bg-green-100 border border-green-200 p-4 rounded-xl">
                            <h1 class="text-xl font-bold">Quote no : {{$no++}}</h1>
                            <h1 class="text-xl font-bold {{$item->ditampilkan ? 'text-green-500' : 'text-red-500'}}">Status : {{$item->ditampilkan == 1 ? 'Sedang Ditampilkan' : 'Tidak Ditampilkan'}}</h1>
                            <h1>Isi Baris Pertama :</h1>
                            <h1 class="p-2 bg-green-200 rounded-xl">{{$item->quote1}}</h1>
                            <h1>Isi Baris Kedua :</h1>
                            <h1 class="p-2 bg-green-200 rounded-xl">{{$item->quote2}}</h1>
                            <h1>Isi Baris Ketiga :</h1>
                            <h1 class="p-2 bg-green-200 rounded-xl">{{$item->quote3}}</h1>
                            <div class="flex justify-between class">
                                <form action="{{route('quote.edit', $item->id)}}" method="GET">
                                    <button type="submit" class="border border-green-500 bg-green-500 text-white hover:text-black py-2 px-4 mt-2 rounded-xl hover:bg-yellow-200">Edit</button>
                                </form>
                                <form class="formHapus" action="{{ route('quote.delete', $item->id) }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="hapusBtn border border-green-500 bg-red-500 text-white hover:text-black py-2 px-4 mt-2 rounded-xl hover:bg-yellow-200">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const hapusButtons = document.querySelectorAll('.hapusBtn');

            hapusButtons.forEach(button => {
                button.addEventListener('click', function (e) {
                    e.preventDefault();

                    Swal.fire({
                        title: 'Hapus Data?',
                        text: 'Apakah Anda yakin ingin menghapus data?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const form = button.closest('form');
                            if (form) form.submit();
                        }
                    });
                });
            });
        });
    </script>
</x-app-layout>
