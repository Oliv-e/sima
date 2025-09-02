<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ ('Jadwal Sholat') }}
        </h2>
    </x-slot>

    <div class="pt-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                    href="{{route('jadwal_sholat.tambah')}}">
                    Tambah Data Jadwal Sholat</a>
                </div>
            </div>
        </div>
    </div>
    <div class="pt-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="w-full flex flex-col gap-2">
                    <h1>Hari ini : {{Carbon\Carbon::now()->translatedFormat('j F Y')}}</h1>
                    @if($bt)
                        <p>Menampilkan data untuk bulan: {{ \Carbon\Carbon::createFromFormat('Y-m', $bt)->translatedFormat('F Y') }}</p>
                    @else
                        <p>Menampilkan data untuk bulan ini: {{ \Carbon\Carbon::now()->translatedFormat('F Y') }}</p>
                    @endif
                    <form action="{{ route('jadwal_sholat.index') }}" method="GET">
                        <x-input-label>Filter Data Berdasarkan Bulan:</x-input-label>
                        <input type="month" name="filter" id="filter" value="{{ request('filter') }}" class="border border-green-200 bg-green-100 mb-4 rounded-md">
                        <button type="submit" class="border border-greeen-200 bg-green-200 rounded-md py-2 px-6">{{ __('Cari') }}</button>
                    </form>
                    <table>
                        <thead>
                            <tr class="bg-green-100">
                                <th class="py-2 px-8 border border-green-200">tanggal</th>
                                <th class="py-2 px-4 border hidden lg:table-cell border-green-200">imsak</th>
                                <th class="py-2 px-4 border hidden lg:table-cell border-green-200">subuh</th>
                                <th class="py-2 px-4 border hidden lg:table-cell border-green-200">terbit</th>
                                <th class="py-2 px-4 border hidden lg:table-cell border-green-200">dhuha</th>
                                <th class="py-2 px-4 border hidden lg:table-cell border-green-200">dzuhur</th>
                                <th class="py-2 px-4 border hidden lg:table-cell border-green-200">ashar</th>
                                <th class="py-2 px-4 border hidden lg:table-cell border-green-200">maghrib</th>
                                <th class="py-2 px-4 border hidden lg:table-cell border-green-200">isya</th>
                                <th class="py-2 px-4 border border-green-200">aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                            <tr class="{{Carbon\Carbon::parse($item->tanggal)->translatedFormat('j F Y') == Carbon\Carbon::now()->translatedFormat('j F Y') ? 'bg-green-100' : 'bg-white'}}">
                                <td class="py-2 px-4 border border-green-200">{{Carbon\Carbon::parse($item->tanggal)->translatedFormat('j F Y')}}</td>
                                <td class="py-2 px-4 border hidden lg:table-cell border-green-200">{{Carbon\Carbon::parse($item->imsak)->translatedFormat('H:i')}}</td>
                                <td class="py-2 px-4 border hidden lg:table-cell border-green-200">{{Carbon\Carbon::parse($item->subuh)->translatedFormat('H:i')}}</td>
                                <td class="py-2 px-4 border hidden lg:table-cell border-green-200">{{Carbon\Carbon::parse($item->terbit)->translatedFormat('H:i')}}</td>
                                <td class="py-2 px-4 border hidden lg:table-cell border-green-200">{{Carbon\Carbon::parse($item->dhuha)->translatedFormat('H:i')}}</td>
                                <td class="py-2 px-4 border hidden lg:table-cell border-green-200">{{Carbon\Carbon::parse($item->dzuhur)->translatedFormat('H:i')}}</td>
                                <td class="py-2 px-4 border hidden lg:table-cell border-green-200">{{Carbon\Carbon::parse($item->ashar)->translatedFormat('H:i')}}</td>
                                <td class="py-2 px-4 border hidden lg:table-cell border-green-200">{{Carbon\Carbon::parse($item->maghrib)->translatedFormat('H:i')}}</td>
                                <td class="py-2 px-4 border hidden lg:table-cell border-green-200">{{Carbon\Carbon::parse($item->isya)->translatedFormat('H:i')}}</td>
                                <td class="py-2 px-4 border border-green-200">
                                    <a href="{{route('jadwal_sholat.edit', $item->id)}}" class="items-center flex justify-center"> <span class="icon-[mdi--pencil] text-yellow-500"></span> </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
