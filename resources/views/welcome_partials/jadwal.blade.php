<!-- Jadwal Sholat -->
<div class="bg-white rounded-md shadow-md flex gap-2 p-1">
    <table>
        <tr>
            <th colspan="2" class="py-2 text-3xl px-6 text-center">
                {{ Carbon\Carbon::parse($today->tanggal)->translatedFormat('d F Y') }}</th>
        </tr>
        <tr class="border-2 border-green-200">
            <td class="py-2 px-3 text-3xl">IMSAK</td>
            <th class="py-2 px-3 text-3xl bg-green-200">{{ Carbon\Carbon::parse($today->imsak)->translatedFormat('H:i') }}</th>
        </tr>
        <tr class="border-2 border-green-200">
            <td class="py-2 px-3 text-3xl">SUBUH</td>
            <th class="py-2 px-3 text-3xl bg-green-200">{{ Carbon\Carbon::parse($today->subuh)->translatedFormat('H:i') }}</th>
        </tr>
        <tr class="border-2 border-green-200">
            <td class="py-2 px-3 text-3xl">DHUHA</td>
            <th class="py-2 px-3 text-3xl bg-green-200">{{ Carbon\Carbon::parse($today->dhuha)->translatedFormat('H:i') }}</th>
        </tr>
        <tr class="border-2 border-green-200">
            <td class="py-2 px-3 text-3xl">DZUHUR</td>
            <th class="py-2 px-3 text-3xl bg-green-200">{{ Carbon\Carbon::parse($today->dzuhur)->translatedFormat('H:i') }}</th>
        </tr>
        <tr class="border-2 border-green-200">
            <td class="py-2 px-3 text-3xl">ASHAR</td>
            <th class="py-2 px-3 text-3xl bg-green-200">{{ Carbon\Carbon::parse($today->ashar)->translatedFormat('H:i') }}</th>
        </tr>
        <tr class="border-2 border-green-200">
            <td class="py-2 px-3 text-3xl">MAGHRIB</td>
            <th class="py-2 px-3 text-3xl bg-green-200">{{ Carbon\Carbon::parse($today->maghrib)->translatedFormat('H:i') }}</th>
        </tr>
        <tr class="border-2 border-green-200">
            <td class="py-2 px-3 text-3xl">ISYA</td>
            <th class="py-2 px-3 text-3xl bg-green-200">{{ Carbon\Carbon::parse($today->isya)->translatedFormat('H:i') }}</th>
        </tr>
    </table>
</div>
