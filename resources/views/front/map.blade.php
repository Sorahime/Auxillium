@extends('layouts.app-front')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">
    <h1 class="text-3xl font-bold">Map</h1>
    <p class="text-slate-600 mt-2">Provinsi: <span class="font-semibold">{{ $province }}</span></p>

    <div class="mt-8 bg-white border rounded-2xl overflow-hidden">
        <div id="map" class="w-full h-[520px]"></div>
    </div>
</div>

{{-- leaflet cdn --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    // default ke indonesia dulu (nanti bisa kita mapping berdasarkan provinsi)
    const map = L.map('map').setView([-2.5489, 118.0149], 5);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; OpenStreetMap'
    }).addTo(map);

    // contoh marker bencana
    L.marker([-6.200000, 106.816666]).addTo(map)
        .bindPopup("Bencana: Flood (contoh titik)")
        .openPopup();
</script>
@endsection
