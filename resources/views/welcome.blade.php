<x-page-layout>
    <style>
        #cont {
            background-image: url("data:image/svg+xml,<svg id='patternId' width='100%' height='100%' xmlns='http://www.w3.org/2000/svg'><defs><pattern id='a' patternUnits='userSpaceOnUse' width='80' height='80' patternTransform='scale(2) rotate(0)'><rect x='0' y='0' width='100%' height='100%' fill='%2300000000'/><path d='M69.84 0l-7.86 7.86L54.1 0l7.87-7.86zm18.02 18.02L80 25.88l-7.86-7.86L80 10.16zm-80 43.96L0 69.84l-7.86-7.86L0 54.1zM25.88 80l-7.86 7.86L10.16 80l7.86-7.86zm36.1-7.86L69.84 80l-7.86 7.86L54.1 80zM80 54.1l7.86 7.87L80 69.84l-7.86-7.86zM0 10.16l7.86 7.86L0 25.88l-7.86-7.86zM18.02-7.86L25.88 0l-7.86 7.86L10.16 0z'  stroke-linecap='square' stroke-width='1' stroke='%2300000010' fill='none'/><path d='M48.1 80c0 4.47-3.63 8.1-8.1 8.09A8.1 8.1 0 1148.1 80zm6.26-40H71.6M40 71.9V54.38m0-28.74V8.09m5.24 12.3a20.3 20.3 0 0114.37 14.37m0 10.48a20.3 20.3 0 01-14.38 14.37m-10.48 0A20.3 20.3 0 0120.4 45.24m0-10.48a20.3 20.3 0 0114.37-14.37M5.72 45.72A8.1 8.1 0 11-6.22 34.78 8.1 8.1 0 015.72 45.72zm80 0a8.1 8.1 0 11-11.94-10.94 8.1 8.1 0 0111.94 10.94zM48.09 0c0 4.47-3.62 8.1-8.09 8.09A8.07 8.07 0 0131.9 0 8.1 8.1 0 0148.1 0zM40 25.63L54.37 40 40 54.37 25.63 40zm5.72-19.91l28.1 29.02m.22 11.22L45.72 74.28m-11.44 0L5.72 45.72M5.24 34.3L34.28 5.72M8.08 40h17.55'  stroke-linecap='square' stroke-width='1' stroke='%230000000f' fill='none'/></pattern></defs><rect width='800%' height='800%' transform='translate(0,0)' fill='url(%23a)'/></svg>");
        }
        .text-besar {
            font-size: 1.875rem /* 30px */;
            line-height: 2.25rem /* 36px */;
        }
        .marquee {
        width: 100%;
        overflow: hidden;
        white-space: nowrap;
        box-sizing: border-box;
        }

        .marquee span {
        display: inline-block;
        padding-left: 100%;
        animation: marquee 10s linear infinite;
        }

        @keyframes marquee {
        0%   { transform: translateX(0%); }
        100% { transform: translateX(-100%); }
        }
    </style>

    <div id="cont" class="relative min-h-screen w-full flex flex-col">
        <!-- Header -->
        <div class="w-full flex flex-col lg:flex-row justify-between items-center p-4">
            <div class="flex flex-row items-center">
                <img src="{{ asset('def_gambar/logo_masjid.png') }}" class="w-24 h-24" alt="">
                <h1 class="uppercase text-xl lg:text-3xl font-bold p-4">
                    {{ config('app.name', 'Masjid') }}
                </h1>
            </div>
            <div class="flex items-center flex-row gap-1">
                <div class="hidden lg:flex items-center bg-white rounded-md shadow-md">
                    <h1 id="notif" class="text-3xl flex items-center justify-center bg-red-200 rounded-md p-4 cursor-pointer" onclick="toggleNotif()"><span class="ml-2 icon-[charm--sound-down]"></span></h1>
                </div>
                <div class="hidden lg:flex">
                    <p class="text-xl font-bold m-1 p-4 uppercase bg-white shadow-md rounded-md" id="countdown">Maghrib dalam xx jam xx menit xx detik</p>
                </div>
                <div class="flex flex-col items-center p-2 bg-white rounded-md shadow-md">
                    <h1 class="text-5xl" id="clock">{{ Carbon\Carbon::now()->translatedFormat('H:i:s') }}</h1>
                </div>
            </div>
        </div>

        {{-- PHONE SCHEDULE --}}
        <div class="w-full flex justify-center items-start gap-4 lg:hidden">
            @include('welcome_partials.jadwal', ['today' => $today])
            @guest
                <a class="bg-white border rounded-lg py-4 px-6" href="{{ route('login') }}">MASUK</a>
            @endguest

            @auth
                <a class="bg-green-500 text-white rounded-lg py-4 px-6" href="{{ route('dashboard') }}">Dashboard</a>
            @endauth

        </div>
        <!-- Carousels -->
        <div class="hidden lg:block absolute bottom-0 w-full">
            <!-- Carousel 1 -->
            <div id="carousel1" class="animate-fade-left animate-once">
                @if($today || $tomorrow || $hijriDate != null)
                <div class="w-full">
                    <div class="flex items-center px-4 w-full">
                        <div class="w-full flex justify-center font-bold m-1 p-4 bg-white rounded-md">
                            <table class="w-[80%]">
                                    <tr>
                                        @foreach ([$hijriDate, 'IMSAK', 'SUBUH', 'TERBIT', 'DHUHA', 'DZUHUR', 'ASHAR', 'MAGHRIB', 'ISYA'] as $waktu)
                                            <th class="text-md px-6 py-4">{{ $waktu }}</th>
                                        @endforeach
                                    </tr>
                                    <tr class="text-center bg-green-200 border-2 border-white">
                                        <td class="px-6 py-4 items-center flex gap-2"> <span class="icon-[material-symbols--play-arrow-rounded]"></span>
                                            {{ Carbon\Carbon::parse($today->tanggal)->translatedFormat('d/m/Y') }}</td>
                                        <td class="px-6 py-4">{{ Carbon\Carbon::parse($today->imsak)->translatedFormat('H:i') }}</td>
                                        <td class="px-6 py-4">{{ Carbon\Carbon::parse($today->subuh)->translatedFormat('H:i') }}</td>
                                        <td class="px-6 py-4">{{ Carbon\Carbon::parse($today->terbit)->translatedFormat('H:i') }}</td>
                                        <td class="px-6 py-4">{{ Carbon\Carbon::parse($today->dhuha)->translatedFormat('H:i') }}</td>
                                        <td class="px-6 py-4">{{ Carbon\Carbon::parse($today->dzuhur)->translatedFormat('H:i') }}</td>
                                        <td class="px-6 py-4">{{ Carbon\Carbon::parse($today->ashar)->translatedFormat('H:i') }}</td>
                                        <td class="px-6 py-4">{{ Carbon\Carbon::parse($today->maghrib)->translatedFormat('H:i') }}</td>
                                        <td class="px-6 py-4">{{ Carbon\Carbon::parse($today->isya)->translatedFormat('H:i') }}</td>
                                    </tr>
                                    <tr class="text-center bg-green-200 border-2 border-white">
                                        <td class="px-6 py-4 items-center flex gap-2"> <span class="w-4"></span>
                                            {{ Carbon\Carbon::parse($tomorrow->tanggal)->translatedFormat('d/m/Y') }}
                                        </td>
                                        <td class="px-6 py-4">{{ Carbon\Carbon::parse($tomorrow->imsak)->translatedFormat('H:i') }}</td>
                                        <td class="px-6 py-4">{{ Carbon\Carbon::parse($tomorrow->subuh)->translatedFormat('H:i') }}</td>
                                        <td class="px-6 py-4">{{ Carbon\Carbon::parse($tomorrow->terbit)->translatedFormat('H:i') }}</td>
                                        <td class="px-6 py-4">{{ Carbon\Carbon::parse($tomorrow->dhuha)->translatedFormat('H:i') }}</td>
                                        <td class="px-6 py-4">{{ Carbon\Carbon::parse($tomorrow->dzuhur)->translatedFormat('H:i') }}</td>
                                        <td class="px-6 py-4">{{ Carbon\Carbon::parse($tomorrow->ashar)->translatedFormat('H:i') }}</td>
                                        <td class="px-6 py-4">{{ Carbon\Carbon::parse($tomorrow->maghrib)->translatedFormat('H:i') }}</td>
                                        <td class="px-6 py-4">{{ Carbon\Carbon::parse($tomorrow->isya)->translatedFormat('H:i') }}</td>
                                    </tr>
                            </table>
                        </div>
                    </div>
                    @if ($quote != null)
                    <div class="flex px-4 w-full">
                        <div class="w-full text-3xl font-bold m-1 p-4 bg-white rounded-md">
                            <h1 class="text-center font-bold" id="quote1">{{$quote->quote1}}</h1>
                            <h1 class="text-center my-2" id="quote2">{{$quote->quote2}}</h1>
                            <h1 class="text-center italic" id="quote3">{{$quote->quote3}}</h1>
                        </div>
                    </div>
                    @endif
                </div>
                @endif
            </div>

            <!-- Carousel 2 -->
            <div id="carousel2" class="animate-fade-left animate-once hidden">
                <div class="w-full flex px-4">
                    <div class="w-full m-1 flex gap-2 justify-between">
                        <!-- Jadwal Sholat -->
                        @include('welcome_partials.jadwal', ['today' => $today])
                        <!-- Daftar Keuangan -->
                        <div class="flex-1 bg-white rounded-md shadow-md p-4 w-full md:w-1/2 overflow-auto">
                            <div class="flex text-2xl text-center justify-around font-bold">
                                <div class="bg-green-200 p-4 rounded-md">
                                    TOTAL UANG MASUK </br>
                                    {{'Rp. ' . number_format($total_masuk, '0', '.', '.') }}
                                </div>
                                <div class="bg-red-200 p-4 rounded-md">
                                    TOTAL UANG KELUAR </br>
                                    {{'Rp. ' . number_format($total_keluar, '0', '.', '.') }}
                                </div>
                                <div class="p-4 rounded-md">
                                    TOTAL UANG </br>
                                    {{'Rp. ' . number_format($total_akhir, '0', '.', '.') }}
                                </div>
                            </div>
                            <table class="w-full text-left text-3xl table-fixed">
                                <thead>
                                    <tr>
                                        <th class="py-2 px-4 text-center w-1/3">TANGGAL</th>
                                        <th class="py-2 px-4 text-center w-1/3">KET</th>
                                        <th class="py-2 px-4 text-center w-1/3">JUMLAH</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($keuangan as $item)
                                        <tr class="{{ $item->tipe == 'pemasukan' ? 'bg-green-200' : 'bg-red-200' }}">
                                            <td class="py-2 px-4 text-center">
                                                {{ Carbon\Carbon::parse($item->tanggal)->translatedFormat('d/m/Y') }}</td>
                                            <td class="py-2 px-4 text-center">{{ $item->keterangan }}</td>
                                            <td class="py-2 px-4 text-center">{{'Rp. ' . number_format($item->saldo, '0', '.', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{-- Petugas Sholat --}}
                        @include('welcome_partials.petugas', ['tipe_petugas' => $tipe_petugas, 'data_petugas' => $data_petugas])
                    </div>
                </div>
            </div>

            <!-- Carousel 3 -->
            @foreach ($gambar as $index => $item)
                <div id="carousel3-{{ $index + 1 }}" class="animate-fade-left animate-once hidden">
                    <div class="w-full flex gap-2 px-5 justify-between">
                        
                        <!-- Jadwal -->
                        @include('welcome_partials.jadwal', ['today' => $today])

                        <!-- Center -->
                        <div class="relative w-[900px] h-[550px] bg-white border rounded-lg shadow hover:shadow-md overflow-hidden">
                            <img src="{{ asset('storage/gambar/' . $item->path) }}"
                                alt="{{ $item->path }}"
                                class="absolute top-0 left-0 w-full h-full object-cover">
                            <div class="absolute bottom-0 left-0 w-full p-3 bg-white/80">
                                <h2 class="text-4xl font-semibold text-gray-800">{{ $item->caption }}</h2>
                            </div>
                        </div>

                        <!-- Petugas -->
                        @include('welcome_partials.petugas', ['tipe_petugas' => $tipe_petugas, 'data_petugas' => $data_petugas])
                    </div>
                </div>
            @endforeach

            <!-- Carousel Iqamah -->
            <div id="carouselIqamah" class="animate-fade-left animate-once hidden">
                <div class="w-full flex flex-col items-center gap-8 p-4 pb-4">
                    <div class="flex w-full gap-4">
                        <!-- Jadwal Sholat -->
                        @include('welcome_partials.jadwal', ['today' => $today])

                        <!-- Countdown Iqamah -->
                        <div class="w-full flex flex-col gap-4">
                            <div class="w-full flex flex-row gap-4">
                                {{-- gambar --}}
                                @isset($gambarPertama)
                                <div class="flex items-center justify-center bg-white rounded-xl shadow-xl p-4 w-full md:w-1/2 overflow-auto">
                                    <div id="Gambar1" class="h-[20rem] flex flex-col gap-2">
                                        <div class="w-full h-[90%]">
                                            <img src="{{ asset('storage/gambar/' . $gambarPertama->path) }}" alt="">
                                        </div>
                                        <div class="text-center text-5xl">
                                            {{ $gambarPertama->caption }}
                                        </div>
                                    </div>
                                </div>
                                @endisset
                                {{-- iqamah --}}
                                <div class="flex items-center justify-center bg-white rounded-xl shadow-xl p-4 w-full md:w-1/2 overflow-auto">
                                    <div id="Gambar1" class="flex flex-col gap-2">
                                        <h1 class="text-center text-5xl">IQAMAH</h1>
                                        <h1 class="text-center text-5xl" id="text_iqamah">Iqamah Dalam .. .. ..</h1>
                                    </div>
                                </div>
                            </div>
                            {{-- quotes --}}
                            @if ($quote != null)
                            <div class="bg-white rounded-xl justify-between shadow-xl gap-2 p-4">
                                <h1 class="text-2xl text-center font-bold" id="quote1">{{$quote->quote1}}</h1>
                                <h1 class="text-2xl text-center my-2" id="quote2">{{$quote->quote2}}</h1>
                                <h1 class="text-2xl text-center italic" id="quote3">{{$quote->quote3}}</h1>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pengumuman -->
            @if ($pengumuman != null)
                <div class="flex px-4 pb-2 w-full">
                    <div class="relative w-full overflow-hidden bg-white rounded-md p-2">
                        <div
                            class="flex whitespace-nowrap animate-marquee-x will-change-transform"
                            style="--marquee-duration: 15s;"
                            id="marquee-track"
                        >
                            <span class="text-5xl font-bold mx-4">
                                {{ $pengumuman->isi_pengumuman }}
                            </span>
                            <!-- Gandakan teks biar loop mulus -->
                            <span class="text-5xl font-bold mx-4">
                                {{ $pengumuman->isi_pengumuman }}
                            </span>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    {{-- notif --}}
    <audio id="iqamahAudio" src="{{ asset('notifs.mp4a') }}" preload="auto"></audio>

    <script>
        const t_iq = {{ $t_iq ?? 5 }}; // in minutes
        const t_rf = {{ $t_rf ?? 5 }}; // in minutes

        let isIqamahActive = false;

        window.addEventListener('load', () => {
            const audio = document.getElementById('silentClick');
            if (audio) {
                audio.play().then(() => {
                    // Now audio is "unlocked"
                });
            }
        });

        function toggleNotif() {
            const notif = document.getElementById('notif');
            notif.classList.toggle('bg-red-200');
            notif.classList.toggle('bg-green-200');
        }

        // "{{ Carbon\Carbon::now()->addMinute()->format('H:i') }}"

        const jadwalSholat = {
            imsak: "{{ Carbon\Carbon::parse($tomorrow->imsak)->format('H:i') }}",
            subuh: "{{ Carbon\Carbon::parse($tomorrow->subuh)->format('H:i') }}",
            terbit: "{{ Carbon\Carbon::parse($tomorrow->terbit)->format('H:i') }}",
            dhuha: "{{ Carbon\Carbon::parse($tomorrow->dhuha)->format('H:i') }}",
            dzuhur: "{{ Carbon\Carbon::parse($tomorrow->dzuhur)->format('H:i') }}",
            ashar: "{{ Carbon\Carbon::parse($tomorrow->ashar)->format('H:i') }}",
            maghrib: "{{ Carbon\Carbon::parse($tomorrow->maghrib)->format('H:i') }}",
            isya: "{{ Carbon\Carbon::parse($tomorrow->isya)->format('H:i') }}"
        };
        
        let currentSlide = 1;
        const gambarCount = {{ count($gambar) }};
        const totalSlides = 2 + gambarCount; // carousel1, carousel2, carousel3-n

        let carouselInterval = null;
        let iqamahInterval = null;

        function showSlide(index) {
            // Sembunyikan semua carousel default
            for (let i = 1; i <= 2; i++) {
                const slide = document.getElementById('carousel' + i);
                if (slide) slide.classList.add('hidden');
            }

            // Sembunyikan semua carousel3-n
            for (let i = 1; i <= gambarCount; i++) {
                const slide = document.getElementById('carousel3-' + i);
                if (slide) slide.classList.add('hidden');
            }

            // Tampilkan yang sesuai
            if (index === 1 || index === 2) {
                document.getElementById('carousel' + index)?.classList.remove('hidden');
            } else if (index >= 3 && index <= totalSlides) {
                const gambarIndex = index - 2; // Karena carousel3-n mulai dari index ke-3
                document.getElementById('carousel3-' + gambarIndex)?.classList.remove('hidden');
            }

            // Handle Iqamah tetap seperti sebelumnya
            const iqamahSlide = document.getElementById('carouselIqamah');
            const countdownEl = document.getElementById('countdown');

            if (iqamahSlide) {
                const isIqamah = index === 999;
                iqamahSlide.classList.toggle('hidden', !isIqamah);
                if (countdownEl) countdownEl.classList.toggle('hidden', isIqamah);
            }
        }


        function startCarousel() {
            if (carouselInterval) clearInterval(carouselInterval);
            carouselInterval = setInterval(() => {
                currentSlide = currentSlide % totalSlides + 1;
                showSlide(currentSlide);
            }, 5000);
        }


        function stopCarousel() {
            if (carouselInterval) {
                clearInterval(carouselInterval);
                carouselInterval = null;
            }
        }

        function startTime() {
            const today = new Date();
            let h = today.getHours();
            let m = today.getMinutes();
            let s = today.getSeconds();
            m = checkTime(m);
            s = checkTime(s);
            
            const clock = document.getElementById('clock');
            if (clock) {
                clock.innerHTML = h + ":" + m + ":" + s;
            }

            setTimeout(startTime, 1000);
        }

        function checkTime(i) {
            return i < 10 ? "0" + i : i;
        }

        document.addEventListener('DOMContentLoaded', function () {
            showSlide(currentSlide);
            startCarousel();
            startTime();
        });

        function getNextPrayerTime(jadwal) {
        const now = new Date();
        const today = new Date();
        const besok = new Date(today);
        besok.setDate(today.getDate() + 1);

        let nextPrayer = null;
        let nextLabel = "";

        for (const [label, time] of Object.entries(jadwal)) {
            const [hour, minute] = time.split(":").map(Number);

            // Buat objek waktu sholat
            const waktuSholat = new Date();
            waktuSholat.setHours(hour, minute, 0, 0);

            // Jika waktu sudah lewat, pakai jadwal besok
            if (waktuSholat < now) {
                waktuSholat.setDate(waktuSholat.getDate() + 1);
            }

            // Ambil yang paling dekat dari sekarang
            if (!nextPrayer || waktuSholat < nextPrayer) {
                nextPrayer = waktuSholat;
                nextLabel = label;
            }
        }

        return { time: nextPrayer, label: nextLabel };
    }

    function startPrayerCountdown(jadwal) {
        function update() {
            const now = new Date();
            const { time, label } = getNextPrayerTime(jadwal);

            const distance = time - now;

            if (distance <= 0) {
                document.getElementById("countdown").innerText = `Sudah masuk waktu ${label}`;
                return;
            }

            const hours = Math.floor((distance / (1000 * 60 * 60)) % 24);
            const minutes = Math.floor((distance / (1000 * 60)) % 60);
            const seconds = Math.floor((distance / 1000) % 60);

            // Buat bagian waktu hanya kalau nilainya > 0
            let parts = [];
            if (hours > 0) parts.push(hours + " jam");
            if (minutes > 0) parts.push(minutes + " menit");
            if (seconds > 0) parts.push(seconds + " detik");

            // Kalau semua 0 (jarang terjadi kecuali pas tepat waktu)
            if (parts.length === 0) {
                parts.push("0 detik");
            }

            document.getElementById("countdown").innerText =
                `${capitalize(label)} dalam ${parts.join(" ")}`;
        }

        function capitalize(text) {
            return text.charAt(0).toUpperCase() + text.slice(1);
        }

        update(); // Panggil sekali dulu
        setInterval(update, 1000); // Lalu setiap detik
    }

    startPrayerCountdown(jadwalSholat);

    function triggerIqamahCountdown(label) {
        isIqamahActive = true;
        stopCarousel(); // Stop normal carousel
        showSlide(999);   // Show iqamah carousel

        const iqamahDuration = t_iq * 60 * 1000;
        const iqamahEndTime = Date.now() + iqamahDuration;
        const iqamahAudio = document.getElementById('iqamahAudio');

        if (iqamahAudio) {
            iqamahAudio.play().catch(err => console.log("Iqamah audio failed to play:", err));
        }

        function updateIqamahCountdown() {
            const now = Date.now();
            const remaining = iqamahEndTime - now;

            if (remaining <= 0) {
                clearInterval(iqamahInterval);
                iqamahInterval = null;
                const iqamahAudio = document.getElementById('iqamahAudio');

                if (iqamahAudio) {
                    iqamahAudio.play().catch(err => console.log("Iqamah audio failed to play:", err));
                    
                    setTimeout(() => {
                        iqamahAudio.pause();
                        iqamahAudio.currentTime = 0; // Reset to start
                    }, 10000); // 20 seconds in milliseconds
                }
                document.getElementById("text_iqamah").innerText = "Iqamah dimulai";

                // After 3 seconds, return to normal carousel
                setTimeout(() => {
                    currentSlide = 1;
                    showSlide(currentSlide);
                    startCarousel();
                }, 20000);
                return;
            }

            const minutes = Math.floor((remaining / 1000 / 60));
            const seconds = Math.floor((remaining / 1000) % 60);

            document.getElementById("text_iqamah").innerText =
                `Iqamah dalam ${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
        }

        updateIqamahCountdown();
        if (iqamahInterval) clearInterval(iqamahInterval);
        iqamahInterval = setInterval(updateIqamahCountdown, 1000);
    }

    function checkIqamahTime(jadwal) {
        const now = new Date();

        for (const label of sholatUtama) {
            const [hour, minute] = jadwal[label].split(":").map(Number);
            const waktuSholat = new Date();
            waktuSholat.setHours(hour, minute, 0, 0);

            // Cek masuk waktu sholat dalam 10 detik pertama
            const diff = now - waktuSholat;
            if (diff >= 0 && diff <= 10000) {
                const iqamahAudio = document.getElementById('iqamahAudio');
                if (iqamahAudio) {
                    iqamahAudio.play().catch(err => console.log("Iqamah audio failed to play:", err));
                }
                triggerIqamahCountdown(label);
                break;
            }
        }
    }

    const sholatUtama = ["subuh", "dzuhur", "ashar", "maghrib", "isya"];

    function checkIqamahTime(jadwal) {
        const now = new Date();

        for (const label of sholatUtama) {
            const [hour, minute] = jadwal[label].split(":").map(Number);
            const waktuSholat = new Date();
            waktuSholat.setHours(hour, minute, 0, 0);

            // Time difference in milliseconds
            const diff = now - waktuSholat;

            // Start Iqamah if within 10 seconds after prayer time and iqamah not already running
            if (diff >= 0 && diff <= 10000 && !iqamahInterval) {
                triggerIqamahCountdown(label);
                break;
            }
        }
    }

    // On page load
    document.addEventListener('DOMContentLoaded', function () {
        showSlide(currentSlide);
        startCarousel();
        startTime(); // your existing clock updater
        startPrayerCountdown(jadwalSholat); // your countdown to next prayer
        setInterval(() => checkIqamahTime(jadwalSholat), 1000); // check every second
        setTimeout(function() {
            if (!isIqamahActive) {
                window.location.reload();
            }
        }, t_rf * 60 * 1000);
    });

    </script>
</x-page-layout>
