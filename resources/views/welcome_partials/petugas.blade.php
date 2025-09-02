<!-- Petugas Sholat -->
<div class="bg-white rounded-md shadow-md text-3xl flex gap-8 p-4">
    <table>
        <tr>
            <th colspan="2" class="py-2 px-6 text-center uppercase">PETUGAS
                {{ $tipe_petugas == 'fitri' || $tipe_petugas == 'adha' ? 'IDUL ' . $tipe_petugas : $tipe_petugas }}</th>
        </tr>
        @if ($tipe_petugas != 'tarawih')
            <tr>
                <td class="py-2 px-6 text-center">KHATIB</td>
            </tr>
            <tr>
                <td class="bg-green-200 py-2 px-6 text-center">{{ $data_petugas->khatib }}</td>
            </tr>
        @endif
        <tr>
            <td class="py-2 px-6 text-center">IMAM</td>
        </tr>
        <tr>
            <td class="bg-green-200 py-2 px-6 text-center">{{ $data_petugas->imam }}</td>
        </tr>
        @if ($tipe_petugas == 'jumat')
            <tr>
                <td class="py-2 px-6 text-center">MUADZIN</td>
            </tr>
            <tr>
                <td class="bg-green-200 py-2 px-6 text-center">{{ $data_petugas->muadzin }}</td>
            </tr>
        @endif
        @if ($tipe_petugas != 'tarawih')
            <tr>
                <td class="py-2 px-6 text-center">BILAL</td>
            </tr>
            <tr>
                <td class="bg-green-200 py-2 px-6 text-center">{{ $data_petugas->bilal }}</td>
            </tr>
        @endif
        @if ($tipe_petugas == 'tarawih')
            <tr>
                <td class="py-2 px-6 text-center">KULTUM</td>
            </tr>
            <tr>
                <td class="bg-green-200 py-2 px-6 text-center">{{ $data_petugas->kultum }}</td>
            </tr>
            <tr>
                <td class="py-2 px-6 text-center">SHOLAWAT</td>
            </tr>
            <tr>
                <td class="bg-green-200 py-2 px-6 text-center">{{ $data_petugas->sholawat }}</td>
            </tr>
        @endif
        @if ($tipe_petugas == 'fitri' || $tipe_petugas == 'adha')
            <tr>
                <td class="py-2 px-6 text-center">MODERATOR</td>
            </tr>
            <tr>
                <td class="bg-green-200 py-2 px-6 text-center">{{ $data_petugas->moderator }}</td>
            </tr>
        @endif
    </table>
</div>