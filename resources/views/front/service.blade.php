@extends('layouts.app-front')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">

    {{-- TITLE --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold">Services</h1>
        <p class="text-slate-600 mt-2">
            Educational Library, real-time disaster map, and emergency contact access.
        </p>
    </div>

    {{-- EDUCATIONAL LIBRARY --}}
    <div class="bg-white border rounded-2xl p-6">
        <h2 class="text-xl font-bold mb-4">Educational Library</h2>

        <div class="grid lg:grid-cols-3 gap-6">
            {{-- LEFT SELECT --}}
            <div class="bg-slate-50 rounded-2xl p-4 border">
                <p class="text-sm font-semibold mb-2">Select Disaster</p>

                <select id="disasterSelect"
                        class="w-full border rounded-xl px-4 py-3">
                    <option value="Earthquake">Earthquake</option>
                    <option value="Flood">Flood</option>
                    <option value="Landslide">Landslide</option>
                    <option value="Tsunami">Tsunami</option>
                    <option value="Volcano Eruption">Volcano Eruption</option>
                    <option value="Wildfire">Wildfire</option>
                    <option value="Storm / Cyclone / Typhoon">Storm / Cyclone / Typhoon</option>
                    <option value="Drought">Drought</option>
                    <option value="Other Disasters">Other Disasters</option>
                </select>

                <div class="mt-4 text-xs text-slate-500">
                    Pilih tipe bencana untuk melihat langkah-langkah keselamatan.
                </div>
            </div>

            {{-- RIGHT CONTENT --}}
            <div class="lg:col-span-2">
                <div class="border rounded-2xl p-5 h-full">
                    <h3 id="eduTitle" class="text-lg font-bold mb-4">Earthquake</h3>

                    <div id="eduContent" class="space-y-3 text-sm text-slate-600 leading-relaxed">
                        <div>
                            <span class="font-semibold text-slate-800">1.</span>
                            Tetap tenang dan lakukan <span class="font-semibold">Drop, Cover, Hold On</span>.
                        </div>
                        <div>
                            <span class="font-semibold text-slate-800">2.</span>
                            Jauhi kaca, lemari, dan benda berat yang bisa jatuh.
                        </div>
                        <div>
                            <span class="font-semibold text-slate-800">3.</span>
                            Setelah guncangan berhenti, keluar dengan tertib melalui jalur aman.
                        </div>
                        <div>
                            <span class="font-semibold text-slate-800">4.</span>
                            Jika berada di luar, jauhi bangunan, tiang listrik, dan pohon besar.
                        </div>
                        <div>
                            <span class="font-semibold text-slate-800">5.</span>
                            Pantau informasi resmi (BMKG/BNPB).
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MAP --}}
    <div class="mt-10 bg-white border rounded-2xl p-6">
        <div class="flex flex-col md:flex-row justify-between md:items-center gap-3 mb-5">
            <div>
                <h2 class="text-xl font-bold">Disaster Map</h2>
                <p class="text-sm text-slate-600">
                    Interactive Indonesia map with disaster pin points.
                </p>
            </div>

            <div class="flex gap-2">
                <button id="btnFullScreen"
                        class="px-4 py-2 rounded-xl border hover:bg-slate-50 text-sm">
                    Full Screen
                </button>
                <button id="btnMyLocation"
                        class="px-4 py-2 rounded-xl bg-blue-600 text-white hover:bg-blue-700 text-sm">
                    My Location
                </button>
            </div>
        </div>

        <div id="map" class="mt-10 bg-white border rounded-2xl p-6">
            <div id="indoMap" class="w-full h-[450px]"></div>
            <a href="{{ route('service') }}#map"></a>
        </div>
    </div>

    {{-- LOGISTICS NEEDED --}}
<div class="mt-10 bg-white border rounded-2xl p-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <div>
            <h2 class="text-xl font-bold">Logistics Needed</h2>
            <p class="text-sm text-slate-600 mt-1">
                Overview of essential supplies required in affected areas, including fulfillment status and aid sources.
            </p>
        </div>

        <div class="flex gap-2">
            <button class="px-4 py-2 rounded-xl border hover:bg-slate-50 text-sm">
                Refresh
            </button>
            <button class="px-4 py-2 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold">
                Add Request
            </button>
        </div>
    </div>

    @php
        $logistics = [
            [
                'item' => 'Clean Water',
                'region' => 'Bandung, West Java',
                'source' => 'Jakarta Volunteer Center',
                'progress' => 65,
                'status' => 'Ongoing',
            ],
            [
                'item' => 'Medical Kit',
                'region' => 'Yogyakarta',
                'source' => 'Local Health Office',
                'progress' => 35,
                'status' => 'Urgent',
            ],
            [
                'item' => 'Blankets & Clothes',
                'region' => 'Central Java',
                'source' => 'Community Donations',
                'progress' => 90,
                'status' => 'Almost Done',
            ],
            [
                'item' => 'Food Supplies',
                'region' => 'Jakarta',
                'source' => 'National Disaster Agency',
                'progress' => 50,
                'status' => 'Ongoing',
            ],
            [
                'item' => 'Temporary Shelter',
                'region' => 'Aceh',
                'source' => 'NGO Partner Team',
                'progress' => 15,
                'status' => 'Urgent',
            ],
        ];

        function badgeClass($status){
            return match($status){
                'Urgent' => 'bg-red-50 text-red-700 border-red-200',
                'Almost Done' => 'bg-green-50 text-green-700 border-green-200',
                default => 'bg-blue-50 text-blue-700 border-blue-200',
            };
        }
    @endphp

    {{-- Desktop Table --}}
    <div class="hidden md:block overflow-hidden rounded-2xl border">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-slate-600">
                <tr>
                    <th class="text-left font-semibold px-5 py-4">Logistic Item</th>
                    <th class="text-left font-semibold px-5 py-4">Region</th>
                    <th class="text-left font-semibold px-5 py-4">Aid Source</th>
                    <th class="text-left font-semibold px-5 py-4">Progress</th>
                    <th class="text-left font-semibold px-5 py-4">Status</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach($logistics as $row)
                <tr class="border-t">
                    <td class="px-5 py-4 font-semibold text-slate-800">
                        {{ $row['item'] }}
                    </td>
                    <td class="px-5 py-4 text-slate-600">
                        {{ $row['region'] }}
                    </td>
                    <td class="px-5 py-4 text-slate-600">
                        {{ $row['source'] }}
                    </td>
                    <td class="px-5 py-4">
                        <div class="flex items-center gap-3">
                            <div class="flex-1 h-2 rounded-full bg-slate-100 overflow-hidden">
                                <div class="h-2 rounded-full bg-blue-600" style="width: {{ $row['progress'] }}%"></div>
                            </div>
                            <div class="text-xs font-semibold text-slate-600 w-10 text-right">
                                {{ $row['progress'] }}%
                            </div>
                        </div>
                    </td>
                    <td class="px-5 py-4">
                        <span class="px-3 py-1 rounded-full border text-xs font-semibold {{ badgeClass($row['status']) }}">
                            {{ $row['status'] }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Mobile Cards (Responsive) --}}
    <div class="md:hidden space-y-4">
        @foreach($logistics as $row)
        <div class="border rounded-2xl p-5 bg-white">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="font-semibold text-slate-800">{{ $row['item'] }}</p>
                    <p class="text-xs text-slate-500 mt-1">{{ $row['region'] }}</p>
                </div>
                <span class="px-3 py-1 rounded-full border text-xs font-semibold {{ badgeClass($row['status']) }}">
                    {{ $row['status'] }}
                </span>
            </div>

            <div class="mt-4 text-sm text-slate-600">
                <p><span class="font-semibold text-slate-800">Aid Source:</span> {{ $row['source'] }}</p>
            </div>

            <div class="mt-4">
                <div class="flex items-center justify-between text-xs text-slate-500 mb-2">
                    <span>Progress</span>
                    <span class="font-semibold text-slate-700">{{ $row['progress'] }}%</span>
                </div>
                <div class="h-2 rounded-full bg-slate-100 overflow-hidden">
                    <div class="h-2 rounded-full bg-blue-600" style="width: {{ $row['progress'] }}%"></div>
                </div>
            </div>
        </div>
        @endforeach
    </div>



    {{-- EMERGENCY CONTACT --}}
    <div class="mt-10">
        <h2 class="text-xl font-bold text-center">Emergency Contact</h2>
        <p class="text-center text-slate-600 text-sm mt-2 mb-6">
            Quick access to emergency hotlines.
        </p>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <a href="tel:119" class="bg-white border rounded-2xl p-6 text-center hover:shadow-md transition">
                <div class="text-4xl mb-3">🚑</div>
                <div class="text-red-500 font-bold text-lg">119</div>
                <div class="text-sm text-slate-600 mt-1">Medical Emergency</div>
            </a>

            <a href="tel:110" class="bg-white border rounded-2xl p-6 text-center hover:shadow-md transition">
                <div class="text-4xl mb-3">👮</div>
                <div class="text-blue-500 font-bold text-lg">110</div>
                <div class="text-sm text-slate-600 mt-1">Police Emergency</div>
            </a>

            <a href="tel:112" class="bg-white border rounded-2xl p-6 text-center hover:shadow-md transition">
                <div class="text-4xl mb-3">🔥</div>
                <div class="text-orange-500 font-bold text-lg">112/113</div>
                <div class="text-sm text-slate-600 mt-1">Fire & Rescue</div>
            </a>

            <a href="tel:117" class="bg-white border rounded-2xl p-6 text-center hover:shadow-md transition">
                <div class="text-4xl mb-3">🏢</div>
                <div class="text-green-600 font-bold text-lg">117</div>
                <div class="text-sm text-slate-600 mt-1">Disaster Management</div>
            </a>
        </div>
    </div>

</div>

{{-- Leaflet --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    // ===========================
    // EDUCATION CONTENT (INNER)
    // ===========================
    const eduData = {
        "Earthquake": [
            "Tetap tenang dan lakukan <b>Drop, Cover, Hold On</b>.",
            "Jauhi kaca, lemari, dan benda berat yang bisa jatuh.",
            "Setelah guncangan berhenti, keluar dengan tertib melalui jalur aman.",
            "Jika berada di luar, jauhi bangunan, tiang listrik, dan pohon besar.",
            "Pantau informasi resmi (BMKG/BNPB)."
        ],
        "Flood": [
            "Segera pindah ke tempat lebih tinggi jika air mulai naik.",
            "Matikan listrik jika memungkinkan dan jauhi kabel terbuka.",
            "Hindari berjalan/berkendara melewati arus deras.",
            "Siapkan tas darurat (dokumen, obat, makanan).",
            "Ikuti arahan petugas dan info resmi."
        ],
        "Landslide": [
            "Waspada jika hujan deras berkepanjangan di daerah lereng.",
            "Jauhi tebing/lereng retak dan area rawan longsor.",
            "Evakuasi segera jika ada tanda tanah bergerak.",
            "Laporkan retakan tanah kepada pihak berwenang.",
            "Hindari kembali sebelum dinyatakan aman."
        ],
        "Tsunami": [
            "Jika gempa kuat di daerah pantai, segera evakuasi ke tempat tinggi.",
            "Jangan menunggu peringatan jika tanda tsunami jelas.",
            "Ikuti jalur evakuasi resmi dan jangan panik.",
            "Jauhi pantai hingga dinyatakan aman.",
            "Pantau sirine dan info BMKG."
        ],
        "Volcano Eruption": [
            "Gunakan masker dan kacamata untuk melindungi dari abu vulkanik.",
            "Tutup ventilasi rumah jika abu tebal.",
            "Hindari lembah/sungai yang berpotensi lahar.",
            "Evakuasi sesuai radius aman yang ditetapkan.",
            "Simpan air bersih dan makanan."
        ],
        "Wildfire": [
            "Segera menjauh dari arah angin membawa asap/api.",
            "Gunakan kain basah untuk menutup hidung dan mulut.",
            "Hindari area hutan kering saat cuaca panas ekstrem.",
            "Ikuti instruksi evakuasi darurat.",
            "Laporkan titik api ke pihak berwenang."
        ],
        "Storm / Cyclone / Typhoon": [
            "Tetap berada di dalam bangunan yang aman.",
            "Jauhkan diri dari jendela dan benda yang bisa jatuh.",
            "Siapkan senter, baterai, dan powerbank.",
            "Matikan listrik jika ada potensi banjir.",
            "Hindari keluar rumah sampai cuaca stabil."
        ],
        "Drought": [
            "Hemat penggunaan air untuk kebutuhan utama.",
            "Simpan cadangan air bersih.",
            "Waspada potensi kebakaran akibat cuaca kering.",
            "Pantau info pemerintah terkait distribusi air.",
            "Jaga kesehatan: konsumsi cukup cairan."
        ],
        "Other Disasters": [
            "Pastikan mengetahui jalur evakuasi di area tempat tinggal.",
            "Siapkan tas darurat untuk kondisi darurat.",
            "Simpan nomor kontak penting.",
            "Pantau info resmi dari lembaga terkait.",
            "Tetap tenang dan bantu sesama."
        ]
    };

    const disasterSelect = document.getElementById("disasterSelect");
    const eduTitle = document.getElementById("eduTitle");
    const eduContent = document.getElementById("eduContent");

    function renderEducation(type){
        eduTitle.innerText = type;
        eduContent.innerHTML = "";

        eduData[type].forEach((line, idx) => {
            const div = document.createElement("div");
            div.innerHTML = `<span class="font-semibold text-slate-800">${idx+1}.</span> ${line}`;
            eduContent.appendChild(div);
        });
    }

    disasterSelect.addEventListener("change", function(){
        renderEducation(this.value);
    });

    // ===========================
    // MAP (Leaflet Indonesia)
    // ===========================
    const map = L.map('indoMap').setView([-2.5489, 118.0149], 5);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; OpenStreetMap'
    }).addTo(map);

    // sample disaster points (pin merah)
    const points = [
        { name: "Flood - Jakarta", lat: -6.2000, lng: 106.8166 },
        { name: "Earthquake - Yogyakarta", lat: -7.7956, lng: 110.3695 },
        { name: "Wildfire - Kalimantan", lat: -1.0000, lng: 114.0000 },
        { name: "Landslide - Bandung", lat: -6.9175, lng: 107.6191 },
    ];

    points.forEach(p => {
        L.marker([p.lat, p.lng]).addTo(map).bindPopup(p.name);
    });

    // Fullscreen map wrapper (simple)
    const mapWrapper = document.getElementById("mapWrapper");
    document.getElementById("btnFullScreen").addEventListener("click", function(){
        if (!document.fullscreenElement) {
            mapWrapper.requestFullscreen();
        } else {
            document.exitFullscreen();
        }
        setTimeout(() => map.invalidateSize(), 300);
    });

    // My location
    document.getElementById("btnMyLocation").addEventListener("click", function(){
        if(!navigator.geolocation){
            alert("Browser tidak mendukung lokasi.");
            return;
        }
        navigator.geolocation.getCurrentPosition((pos) => {
            const lat = pos.coords.latitude;
            const lng = pos.coords.longitude;

            map.setView([lat, lng], 12);
            L.marker([lat, lng]).addTo(map).bindPopup("Your Location").openPopup();
        }, () => {
            alert("Lokasi gagal diambil. Izinkan lokasi di browser.");
        });
    });
</script>
@endsection
