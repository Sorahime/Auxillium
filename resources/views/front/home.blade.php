@extends('layouts.app-front')

@section('content')

{{-- HERO TOP --}}
<section class="max-w-7xl mx-auto px-4 pt-12 pb-10">
    <div class="text-center max-w-3xl mx-auto">
        <h1 class="text-4xl md:text-5xl font-bold leading-tight">
            Together, We Protect Each Other
        </h1>

        <p class="mt-5 text-slate-600 text-lg">
            Kami hadir untuk membantu masyarakat tetap waspada, saling terhubung,
            dan saling mendukung saat bencana terjadi. Mari bergerak bersama untuk keselamatan semua.
        </p>
    </div>

    {{-- ACTION BAR (Clean Minimal) --}}
<div class="mt-10">
    <div class="bg-white border rounded-3xl shadow-sm overflow-hidden">
        <div class="p-4 md:p-5">

            {{-- Desktop layout --}}
            <div class="hidden lg:flex items-center gap-4">

                {{-- GROUP FORUM (Card like Report) --}}
                <div class="flex-1">
                    <button id="btnForumOpen"
                        class="w-full bg-white border rounded-2xl px-5 py-4 flex items-center gap-3 hover:bg-slate-50 transition">
                        <div class="w-11 h-11 rounded-2xl bg-slate-50 border flex items-center justify-center">
                            <class="w-5 h-5 text-slate-700" viewBox="0 0 24 24" fill="none">
                                <path d="M7 20v-2a4 4 0 0 1 4-4h2a4 4 0 0 1 4 4v2" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
                                <path d="M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z" stroke="currentColor" stroke-width="1.6"/>
                            </svg>
                        </div>
                        <div class="text-left">
                            <p class="text-sm font-semibold text-slate-800">Group Forum</p>
                            <p class="text-xs text-slate-500">Select province to join chat</p>
                        </div>
                        <div class="ml-auto text-slate-400">▾</div>
                    </button>
                </div>

                {{-- SOS --}}
                <div class="w-[220px]">
                    <form method="POST" action="{{ route('sos.store') }}">
                        @csrf
                        <input type="hidden" name="lat" id="sosLat">
                        <input type="hidden" name="lng" id="sosLng">

                        <button type="submit"
                            class="w-full h-[64px] rounded-2xl font-bold text-white
                                   bg-gradient-to-r from-red-500 to-rose-500 hover:opacity-95 shadow-sm">
                            SEND SOS
                        </button>
                    </form>
                </div>

                {{-- REPORT --}}
                <div class="w-[240px]">
                    <button id="btnReportOpen"
                        class="w-full bg-white border rounded-2xl px-5 py-4 flex items-center gap-3 hover:bg-slate-50 transition">
                        <div class="w-11 h-11 rounded-2xl bg-slate-50 border flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-slate-700" viewBox="0 0 24 24" fill="none">
                                <path d="M8 4h8v4H8V4Z" stroke="currentColor" stroke-width="1.6"/>
                                <path d="M6 8h12v12H6V8Z" stroke="currentColor" stroke-width="1.6"/>
                                <path d="M9 12h6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
                                <path d="M9 16h6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <div class="text-left">
                            <p class="text-sm font-semibold text-slate-800">Report</p>
                            <p class="text-xs text-slate-500">Send disaster report</p>
                        </div>
                    </button>
                </div>

                {{-- OFFLINE MAP --}}
                <div class="w-[240px]">
                    <a href="{{ route('offline.index') }}"
                        class="w-full bg-white border rounded-2xl px-5 py-4 flex items-center gap-3 hover:bg-slate-50 transition">
                        <div class="w-11 h-11 rounded-2xl bg-slate-50 border flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-slate-700" viewBox="0 0 24 24" fill="none">
                                <path d="M3 6l6-2 6 2 6-2v14l-6 2-6-2-6 2V6Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/>
                                <path d="M9 4v14" stroke="currentColor" stroke-width="1.6"/>
                                <path d="M15 6v14" stroke="currentColor" stroke-width="1.6"/>
                            </svg>
                        </div>
                        <div class="text-left">
                            <p class="text-sm font-semibold text-slate-800">Offline Map</p>
                            <p class="text-xs text-slate-500">Downloaded map access</p>
                        </div>
                    </a>
                </div>

            </div>


            {{-- Mobile layout --}}
            <div class="lg:hidden space-y-4">

                {{-- SOS --}}
                <form method="POST" action="{{ route('sos.store') }}">
                    @csrf
                    <input type="hidden" name="lat" id="sosLatMobile">
                    <input type="hidden" name="lng" id="sosLngMobile">

                    <button type="submit"
                        class="w-full py-4 rounded-2xl font-bold text-white
                               bg-gradient-to-r from-red-500 to-rose-500 hover:opacity-95 shadow-sm">
                        SEND SOS
                    </button>

                    <p class="text-xs text-slate-500 mt-2">
                        Use SOS only for emergency situations.
                    </p>
                </form>

                {{-- Forum --}}
                <button id="btnForumOpenMobile"
                    class="w-full bg-white border rounded-2xl px-5 py-4 flex items-center gap-3 hover:bg-slate-50 transition">
                    <div class="w-11 h-11 rounded-2xl bg-slate-50 border flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-slate-700" viewBox="0 0 24 24" fill="none">
                            <path d="M7 20v-2a4 4 0 0 1 4-4h2a4 4 0 0 1 4 4v2" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
                            <path d="M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z" stroke="currentColor" stroke-width="1.6"/>
                        </svg>
                    </div>
                    <div class="text-left">
                        <p class="text-sm font-semibold text-slate-800">Group Forum</p>
                        <p class="text-xs text-slate-500">Select province to join chat</p>
                    </div>
                    <div class="ml-auto text-slate-400">▾</div>
                </button>

                {{-- Report + Offline --}}
                <div class="grid grid-cols-2 gap-3">
                    <button id="btnReportOpenMobile"
                        class="py-3 rounded-2xl border bg-white hover:bg-slate-50 text-sm font-semibold text-slate-700">
                        Report
                    </button>

                    <a href="{{ route('offline.index') }}"
                        class="py-3 rounded-2xl border bg-white hover:bg-slate-50 text-sm font-semibold text-slate-700 text-center">
                        Offline Map
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>


{{-- FORUM DROPDOWN MODAL --}}
<div id="modalForum" class="fixed inset-0 bg-black/40 hidden items-center justify-center px-4 z-50">
    <div class="bg-white w-full max-w-md rounded-2xl p-6 relative">
        <button id="btnForumClose" class="absolute top-4 right-4 text-slate-400 hover:text-slate-900">✕</button>

        <h2 class="text-xl font-bold text-center">Join Group Forum</h2>
        <p class="text-sm text-slate-500 text-center mt-2">
            Select a province to enter the group chat.
        </p>

        <div class="mt-6">
            <label class="text-sm font-semibold">Province</label>
            <select id="forumProvinceSelect"
                class="w-full border rounded-xl px-4 py-3 mt-2">
                <option value="">Select Region</option>
                @foreach(config('provinces') as $prov)
                    <option value="{{ $prov }}">{{ $prov }}</option>
                @endforeach
            </select>

            <button id="btnForumGo"
                class="w-full mt-4 px-5 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold">
                Enter Forum
            </button>
        </div>
    </div>
</div>


</section>

{{-- BIG BANNER --}}
<section class="max-w-7xl mx-auto px-4 pb-14">
    <div class="relative rounded-3xl overflow-hidden border bg-slate-200">
        <img
            src="https://images.unsplash.com/photo-1600628422019-2b06e2e7e45d?auto=format&fit=crop&w=1600&q=80"
            alt="Relief Team"
            class="w-full h-[280px] md:h-[380px] object-cover"
        />

        <div class="absolute inset-0 bg-black/40"></div>

        <div class="absolute inset-0 p-8 md:p-10 flex items-end justify-between">
            <div class="text-white">
                <h2 class="text-2xl md:text-4xl font-bold leading-tight">
                    We are Here<br/>For You.
                </h2>
                <p class="mt-3 text-white/80 text-sm md:text-base max-w-md">
                    Supporting communities with fast response, accurate updates, and safe coordination.
                </p>
            </div>

            <div class="hidden md:flex flex-col gap-6 text-white text-right">
                <div>
                    <div class="text-4xl font-bold">12.550+</div>
                    <div class="text-sm text-white/80">Helped people</div>
                </div>
                <div>
                    <div class="text-4xl font-bold">500+</div>
                    <div class="text-sm text-white/80">Total Volunteers</div>
                </div>
            </div>
        </div>
    </div>
</section>


{{-- NEWS PREVIEW --}}
<section class="max-w-7xl mx-auto px-4 pb-14">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
        <h2 class="text-3xl font-bold leading-tight">
            Discover the Latest Disaster<br/>Information and Safety Updates
        </h2>

        <a href="{{ route('news') }}"
            class="px-6 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold inline-flex items-center gap-2">
            More News
            <span>›</span>
        </a>
    </div>

    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @php
            $newsDummy = [
                ['Tornado','https://images.unsplash.com/photo-1504893524553-b855bce32c67?auto=format&fit=crop&w=1000&q=80'],
                ['Flood','https://images.unsplash.com/photo-1524324463413-57d12ee6f4c6?auto=format&fit=crop&w=1000&q=80'],
                ['Landslide','https://images.unsplash.com/photo-1583337130417-3346a1be7dee?auto=format&fit=crop&w=1000&q=80'],
                ['Earthquake','https://images.unsplash.com/photo-1544986581-efac024faf62?auto=format&fit=crop&w=1000&q=80'],
                ['Erupting Volcano','https://images.unsplash.com/photo-1609710228159-0fa9bd7c0827?auto=format&fit=crop&w=1000&q=80'],
                ['Wildfire','https://images.unsplash.com/photo-1475776408506-9a5371e7a068?auto=format&fit=crop&w=1000&q=80'],
                ['Flood','https://images.unsplash.com/photo-1547683905-f686c993aae5?auto=format&fit=crop&w=1000&q=80'],
                ['Tsunami','https://images.unsplash.com/photo-1485230405346-71acb9518d9c?auto=format&fit=crop&w=1000&q=80'],
            ];
        @endphp

        @foreach($newsDummy as $n)
            <div class="bg-white border rounded-2xl overflow-hidden hover:shadow-md transition">
                <div class="h-40 bg-slate-100 overflow-hidden">
                    <img src="{{ $n[1] }}" class="w-full h-full object-cover" alt="">
                </div>

                <div class="p-4">
                    <h3 class="font-bold text-sm">Breaking News : {{ $n[0] }}</h3>
                    <p class="text-xs text-slate-500 mt-2 line-clamp-2">
                        Safety update and latest information regarding the incident. Stay alert and follow official announcements.
                    </p>
                    <a href="{{ route('news') }}" class="text-xs text-blue-600 hover:underline mt-3 inline-block">
                        See more
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</section>


{{-- HOME MAP (INTERACTIVE) --}}
<section class="max-w-7xl mx-auto px-4 pb-14">
    <div class="text-center mb-6">
        <h2 class="text-3xl font-bold">
            Experience Clearer Awareness with<br/>
            <span class="text-blue-600">Our Real-Time Disaster Map</span>
        </h2>
        <p class="text-slate-600 mt-3">
            Explore affected areas and view disaster points in real-time overview.
        </p>
    </div>

    <div class="bg-white border rounded-3xl p-6">

        {{-- MAP --}}
        <div class="rounded-2xl overflow-hidden border">
            <div id="homeMap" class="w-full h-[280px] md:h-[380px]"></div>
        </div>

        {{-- Legend + Buttons --}}
        <div class="mt-5 flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="flex flex-wrap items-center gap-4 text-sm text-slate-600">
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-red-500 inline-block"></span>
                    Disaster Site
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-blue-600 inline-block"></span>
                    SOS Point
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-green-600 inline-block"></span>
                    Evacuation Area
                </div>
            </div>

            <div class="flex gap-3">
                <button id="homeMapMyLoc"
                    class="px-5 py-3 rounded-xl border hover:bg-slate-50 text-sm">
                    My Location
                </button>

                <a href="{{ route('service') }}#map"
                    class="px-8 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm">
                    See Maps
                </a>
            </div>
        </div>
    </div>
</section>

{{-- Leaflet Home Map --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    // HOME MAP (Leaflet)
    const homeMap = L.map('homeMap', {
        zoomControl: true,
        scrollWheelZoom: false,
    }).setView([-2.5489, 118.0149], 5);

    // Base map
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; OpenStreetMap'
    }).addTo(homeMap);

    function addPoint(lat, lng, color, title){
        return L.circleMarker([lat, lng], {
            radius: 9,
            color: "#ffffff",
            weight: 2,
            fillColor: color,
            fillOpacity: 0.95,
        }).addTo(homeMap).bindPopup(title);
    }

    // Demo points (nanti bisa dari database)
    const disasterSites = [
        { title: "Flood • Jakarta", lat: -6.2000, lng: 106.8166 },
        { title: "Earthquake • Yogyakarta", lat: -7.7956, lng: 110.3695 },
        { title: "Landslide • Bandung", lat: -6.9175, lng: 107.6191 },
    ];

    const sosPoints = [
        { title: "SOS • User Signal", lat: -6.9147, lng: 107.6098 },
    ];

    const evacAreas = [
        { title: "Evacuation Area • Safe Zone", lat: -6.9500, lng: 107.7000 },
    ];

    // Add markers
    disasterSites.forEach(p => addPoint(p.lat, p.lng, "#ef4444", p.title)); // red
    sosPoints.forEach(p => addPoint(p.lat, p.lng, "#2563eb", p.title));     // blue
    evacAreas.forEach(p => addPoint(p.lat, p.lng, "#16a34a", p.title));     // green

    homeMap.on('focus', () => homeMap.scrollWheelZoom.enable());
    homeMap.on('blur', () => homeMap.scrollWheelZoom.disable());

    // My Location
    document.getElementById("homeMapMyLoc")?.addEventListener("click", function(){
        if(!navigator.geolocation){
            alert("Browser tidak mendukung lokasi.");
            return;
        }
        navigator.geolocation.getCurrentPosition((pos) => {
            const lat = pos.coords.latitude;
            const lng = pos.coords.longitude;

            homeMap.setView([lat, lng], 12);
            addPoint(lat, lng, "#0ea5e9", "Your Location").openPopup();
        }, () => {
            alert("Lokasi gagal diambil. Izinkan lokasi di browser.");
        });
    });

    setTimeout(() => {
        homeMap.invalidateSize();
    }, 300);
</script>



{{-- TEAM MEMBERS --}}
<section class="max-w-7xl mx-auto px-4 pb-16">
    <div class="text-center mb-8">
        <h2 class="text-3xl font-bold">
            Connect with Our Team <span class="text-blue-600">Who Cares</span> for Your Safety
        </h2>
        <p class="text-slate-600 mt-3">
            Our volunteers and coordinators are here to support you in crisis situations.
        </p>
    </div>

    @php
        $members = [
            ['Sofia Melati Bareut Runa', 'College Student', 'https://images.unsplash.com/photo-1524504388940-b1c1722653e1?auto=format&fit=crop&w=300&q=80'],
            ['Gema Fitri Ramadhani', 'College Student', 'https://images.unsplash.com/photo-1524502397800-2eeaad7c3fe5?auto=format&fit=crop&w=300&q=80'],
            ['Mohamad Dandung Sadat', 'College Student', 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format&fit=crop&w=300&q=80'],
            ['Wistaranatha Conary Hermarita', 'College Student', 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=300&q=80'],
            ['Rizki Fadhilah', 'College Student', 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=300&q=80'],
        ];
    @endphp

    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($members as $m)
            <div class="bg-white border rounded-2xl p-6 hover:shadow-md transition">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-14 h-14 rounded-full overflow-hidden bg-slate-100 border">
                        <img src="{{ $m[2] }}" class="w-full h-full object-cover" alt="">
                    </div>
                    <div>
                        <p class="font-semibold">{{ $m[0] }}</p>
                        <p class="text-xs text-slate-500">{{ $m[1] }}</p>
                    </div>
                </div>

                <p class="text-sm text-slate-600 leading-relaxed">
                    “Our mission is to provide accurate updates and emergency coordination
                    for affected communities. Stay connected and stay safe.”
                </p>
            </div>
        @endforeach
    </div>
</section>


{{-- REPORT MODAL (POPUP) --}}
<div id="modalReport" class="fixed inset-0 bg-black/40 hidden items-center justify-center px-4 z-50">
    <div class="bg-white w-full max-w-3xl rounded-2xl p-6 relative">
        <button id="btnReportClose" class="absolute top-4 right-4 text-slate-400 hover:text-slate-900">✕</button>

        <h2 class="text-xl font-bold mb-6 text-center">Send Your Report</h2>

        <form method="POST" action="{{ route('report.store') }}" enctype="multipart/form-data"
            class="grid md:grid-cols-2 gap-6">
            @csrf

            <div class="space-y-4">
                <div>
                    <label class="text-sm font-semibold">Kategori</label>
                    <select name="category" class="w-full border rounded-xl px-4 py-3 mt-1" required>
                        <option value="">Pilih kategori</option>
                        <option>Earthquake</option>
                        <option>Flood</option>
                        <option>Landslide</option>
                        <option>Tsunami</option>
                        <option>Wildfire</option>
                    </select>
                </div>

                <div>
                    <label class="text-sm font-semibold">Deskripsi <span class="text-slate-400">(optional)</span></label>
                    <textarea name="description" class="w-full border rounded-xl px-4 py-3 mt-1" rows="4"
                        placeholder="Tulis laporan singkat..."></textarea>
                </div>

                <div>
                    <label class="text-sm font-semibold">Lokasi</label>
                    <input name="location" class="w-full border rounded-xl px-4 py-3 mt-1"
                           placeholder="Contoh: Bandung, dekat alun-alun">
                </div>

                <div>
                    <label class="text-sm font-semibold">Provinsi</label>
                    <select name="province" class="w-full border rounded-xl px-4 py-3 mt-1">
                        <option value="">(optional)</option>
                        @foreach(config('provinces') as $prov)
                            <option value="{{ $prov }}">{{ $prov }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="space-y-4">
                <label class="text-sm font-semibold">Foto/Video <span class="text-slate-400">(optional)</span></label>

                <div class="border-2 border-dashed rounded-2xl p-6 text-center">
                    <p class="text-slate-500 text-sm">Drop files here</p>
                    <p class="text-slate-400 text-xs mt-1">Supported: JPG, PNG, MP4 (max 15MB)</p>
                    <input type="file" name="media" class="mt-4 w-full text-sm">
                </div>

                <div class="flex justify-end gap-3">
                    <button type="button" id="btnReportCancel"
                        class="px-5 py-3 rounded-xl border text-slate-600 hover:bg-slate-50">
                        Cancel
                    </button>
                    <button type="submit"
                        class="px-5 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold">
                        Send Report
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>


<script>
    // =========================
    // FORUM MODAL OPEN/CLOSE
    // =========================
    const modalForum = document.getElementById("modalForum");

    const openForum = () => {
        modalForum.classList.remove("hidden");
        modalForum.classList.add("flex");
    };

    const closeForum = () => {
        modalForum.classList.add("hidden");
        modalForum.classList.remove("flex");
    };

    document.getElementById("btnForumOpen")?.addEventListener("click", openForum);
    document.getElementById("btnForumOpenMobile")?.addEventListener("click", openForum);
    document.getElementById("btnForumClose")?.addEventListener("click", closeForum);

    modalForum?.addEventListener("click", (e) => {
        if (e.target === modalForum) closeForum();
    });

    // enter forum button
    document.getElementById("btnForumGo")?.addEventListener("click", () => {
        const prov = document.getElementById("forumProvinceSelect")?.value;
        if(!prov) return alert("Please select a province first.");
        window.location.href = `/forum/${encodeURIComponent(prov)}`;
    });

    // =========================
    // SOS Location (Desktop + Mobile)
    // =========================
    function setSOSLocation(latId, lngId) {
        if (!navigator.geolocation) return;
        navigator.geolocation.getCurrentPosition((pos) => {
            const latEl = document.getElementById(latId);
            const lngEl = document.getElementById(lngId);
            if (latEl) latEl.value = pos.coords.latitude;
            if (lngEl) lngEl.value = pos.coords.longitude;
        });
    }
    setSOSLocation("sosLat", "sosLng");
    setSOSLocation("sosLatMobile", "sosLngMobile");

    // =========================
    // REPORT MODAL (Desktop + Mobile)
    // =========================
    const modalReport = document.getElementById('modalReport');

    const openReport = () => {
        if (!modalReport) return;
        modalReport.classList.remove('hidden');
        modalReport.classList.add('flex');
    };

    const closeReport = () => {
        if (!modalReport) return;
        modalReport.classList.add('hidden');
        modalReport.classList.remove('flex');
    };

    document.getElementById('btnReportOpen')?.addEventListener('click', openReport);
    document.getElementById('btnReportOpenMobile')?.addEventListener('click', openReport);
    document.getElementById('btnReportClose')?.addEventListener('click', closeReport);
    document.getElementById('btnReportCancel')?.addEventListener('click', closeReport);

    modalReport?.addEventListener('click', (e) => {
        if(e.target === modalReport) closeReport();
    });
</script>


@endsection
