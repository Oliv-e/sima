<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-100 overflow-hidden shadow-sm sm:rounded-lg">
                @if($today || $hijriDate != null)
                    <h1 class="px-6 py-8 text-center text-xl">{{ $hijriDate }}</h1>
                    <div class="flex lg:hidden flex-col gap-4 items-center justify-center">
                        @include('welcome_partials.jadwal', ['today' => $today])
                        <div>
                            <a href="{{ route('jadwal_sholat.index') }}" class="underline">JADWAL SHOLAT</a>
                        </div>
                    </div>
                    <div class="border bg-white shadow-md rounded-md hidden lg:flex flex-col p-4 m-4 gap-4 justify-center">
                        <table>
                            <thead>
                                <tr>
                                    <th class="px-6 py-4"></th>
                                    @foreach (['IMSAK', 'SUBUH', 'TERBIT', 'DHUHA', 'DZUHUR', 'ASHAR', 'MAGHRIB', 'ISYA'] as $waktu)
                                        <th class="px-6 py-4">{{ $waktu }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center bg-green-200 border-2 border-white">
                                    <td class="px-6 py-4 items-center flex gap-2"> <span
                                            class="icon-[material-symbols--play-arrow-rounded]"></span>
                                        {{ Carbon\Carbon::parse($today->tanggal)->translatedFormat('d F Y') }}</td>
                                    <td class="px-6 py-4">{{ Carbon\Carbon::parse($today->imsak)->translatedFormat('H:i') }}</td>
                                    <td class="px-6 py-4">{{ Carbon\Carbon::parse($today->subuh)->translatedFormat('H:i') }}</td>
                                    <td class="px-6 py-4">{{ Carbon\Carbon::parse($today->terbit)->translatedFormat('H:i') }}</td>
                                    <td class="px-6 py-4">{{ Carbon\Carbon::parse($today->dhuha)->translatedFormat('H:i') }}</td>
                                    <td class="px-6 py-4">{{ Carbon\Carbon::parse($today->dzuhur)->translatedFormat('H:i') }}</td>
                                    <td class="px-6 py-4">{{ Carbon\Carbon::parse($today->ashar)->translatedFormat('H:i') }}</td>
                                    <td class="px-6 py-4">{{ Carbon\Carbon::parse($today->maghrib)->translatedFormat('H:i') }}</td>
                                    <td class="px-6 py-4">{{ Carbon\Carbon::parse($today->isya)->translatedFormat('H:i') }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div>
                            <a href="{{ route('jadwal_sholat.index') }}" class="underline">JADWAL SHOLAT</a>
                        </div>
                    </div>
                @endif
                @if ($quote != null)
                    <div class="bg-white rounded-xl justify-between shadow-xl gap-2 m-4 p-4">
                        <h1 class="text-xl text-center font-bold" id="quote1">{{$quote->quote1}}</h1>
                        <h1 class="text-xl text-center my-2" id="quote2">{{$quote->quote2}}</h1>
                        <h1 class="text-xl text-center italic" id="quote3">{{$quote->quote3}}</h1>
                    </div>
                    <div class="m-4 p-4 bg-white rounded-md shadow-md">
                        <a href="{{ route('quote.index') }}" class="underline">QUOTE</a>
                    </div>
                @endif
                @if ($pengumuman != null)
                    <div class="w-full">
                        <marquee class="text-3xl font-bold m-4 p-4 bg-white rounded-xl">{{$pengumuman->isi_pengumuman}}</marquee>
                    </div>
                    <div class="m-4 p-4 bg-white rounded-md shadow-md">
                        <a href="{{ route('pengumuman.index') }}" class="underline">PENGUMUMAN</a>
                    </div>
                @endif
                <div class="p-6 text-gray-900">
                    <h1>Navigasi Cepat : </h1>
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mt-4">
                        <a href="{{ route('jadwal_sholat.index') }}" class="underline">JADWAL SHOLAT</a>
                        <a href="{{ route('quote.index') }}" class="underline">QUOTE</a>
                        <a href="{{ route('pengumuman.index') }}" class="underline">PENGUMUMAN</a>
                        <a href="{{ route('petugas.index') }}" class="underline">PETUGAS</a>
                        <a href="{{ route('keuangan.index') }}" class="underline">KEUANGAN</a>
                        <a href="{{ route('gambar.index') }}" class="underline">GAMBAR</a>
                        <a href="{{ route('konfig.index') }}" class="underline">JEDA WAKTU</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
