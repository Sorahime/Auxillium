@extends('layouts.app-front')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">
    <h1 class="text-3xl font-bold mb-6">News</h1>

    {{-- Search + Filter Bar --}}
    <div class="flex flex-col md:flex-row gap-4 items-center mb-8">
        <form method="GET" action="{{ route('news') }}" class="flex-1 flex gap-2 w-full">
            <input
                name="search"
                value="{{ $filters['search'] ?? '' }}"
                placeholder="Search..."
                class="flex-1 border rounded-xl px-4 py-3"
            />

            {{-- keep filters --}}
            <input type="hidden" name="type" value="{{ $filters['type'] ?? '' }}">
            <input type="hidden" name="status" value="{{ $filters['status'] ?? '' }}">
            <input type="hidden" name="date" value="{{ $filters['date'] ?? '' }}">

            <button class="px-5 py-3 rounded-xl bg-blue-600 text-white font-semibold">
                Search
            </button>
        </form>

        <button id="btnFilterOpen"
            class="px-5 py-3 rounded-xl border flex items-center gap-2">
            ⚙️ Filter
        </button>
    </div>

    {{-- Gallery --}}
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($news as $item)
        <button
            class="bg-white border rounded-2xl overflow-hidden text-left hover:shadow-md transition"
            onclick="openNewsPopup(
                '{{ addslashes($item->title) }}',
                '{{ addslashes($item->content) }}',
                '{{ $item->image }}'
            )"
        >
            <div class="h-40 bg-slate-100 overflow-hidden">
                <img src="{{ $item->image }}" class="w-full h-full object-cover" alt="">
            </div>
            <div class="p-4">
                <h2 class="font-bold text-sm">{{ $item->title }}</h2>
                <p class="text-xs text-slate-500 mt-1">
                    {{ $item->disaster_type }} • {{ $item->status }} • {{ $item->published_at }}
                </p>
            </div>
        </button>
        @endforeach
    </div>

    <div class="mt-10">
        {{ $news->links() }}
    </div>
</div>

{{-- FILTER MODAL --}}
<div id="modalFilter" class="fixed inset-0 bg-black/40 hidden items-center justify-center px-4 z-50">
    <div class="bg-white w-full max-w-md rounded-2xl p-6 relative">
        <button id="btnFilterClose" class="absolute top-4 right-4 text-slate-400 hover:text-slate-900">✕</button>

        <h2 class="text-xl font-bold mb-4">Filter</h2>

        <form id="filterForm" method="GET" action="{{ route('news') }}" class="space-y-4">

            {{-- search keep --}}
            <input type="hidden" name="search" value="{{ $filters['search'] ?? '' }}">

            {{-- Disaster type --}}
            <div class="border rounded-xl p-4">
                <label class="font-semibold text-sm">Disaster Type</label>
                <select name="type" onchange="this.form.submit()"
                    class="w-full border rounded-lg px-3 py-2 mt-2">
                    <option value="">All</option>
                    @foreach(['Earthquake','Flood','Landslide','Tsunami','Volcano Eruption','Wildfire','Storm / Cyclone / Typhoon','Drought','Other Disasters'] as $type)
                        <option value="{{ $type }}" @selected(($filters['type'] ?? '') === $type)>
                            {{ $type }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Status --}}
            <div class="border rounded-xl p-4">
                <label class="font-semibold text-sm">Status</label>
                <select name="status" onchange="this.form.submit()"
                    class="w-full border rounded-lg px-3 py-2 mt-2">
                    <option value="">All</option>
                    @foreach(['Ongoing','Under Monitoring','Contained','Recovery Phase','Closed / Resolved'] as $st)
                        <option value="{{ $st }}" @selected(($filters['status'] ?? '') === $st)>
                            {{ $st }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Date --}}
            <div class="border rounded-xl p-4">
                <label class="font-semibold text-sm">Date</label>
                <select name="date" onchange="this.form.submit()"
                    class="w-full border rounded-lg px-3 py-2 mt-2">
                    <option value="">All</option>
                    <option value="today" @selected(($filters['date'] ?? '') === 'today')>Today</option>
                    <option value="24h" @selected(($filters['date'] ?? '') === '24h')>Last 24 hours</option>
                    <option value="7d" @selected(($filters['date'] ?? '') === '7d')>Last 7 days</option>
                    <option value="30d" @selected(($filters['date'] ?? '') === '30d')>Last 30 days</option>
                </select>
            </div>

            <div class="flex gap-3 justify-end pt-2">
                <a href="{{ route('news') }}"
                    class="px-4 py-2 rounded-xl border">
                    Clear all
                </a>
                <button type="submit"
                    class="px-4 py-2 rounded-xl bg-blue-600 text-white font-semibold">
                    Apply
                </button>
            </div>
        </form>
    </div>
</div>

{{-- NEWS POPUP --}}
<div id="modalNews" class="fixed inset-0 bg-black/40 hidden items-center justify-center px-4 z-50">
    <div class="bg-white w-full max-w-2xl rounded-2xl p-6 relative">
        <button id="btnNewsClose" class="absolute top-4 right-4 text-slate-400 hover:text-slate-900">✕</button>

        <h2 id="newsTitle" class="text-xl font-bold mb-4 text-center">News Title</h2>

        <div class="rounded-xl overflow-hidden bg-slate-100 h-56 mb-4">
            <img id="newsImage" src="" class="w-full h-full object-cover" alt="">
        </div>

        <p id="newsContent" class="text-sm text-slate-600 leading-relaxed">
            News content goes here...
        </p>
    </div>
</div>

<script>
    // filter modal
    const modalFilter = document.getElementById('modalFilter');
    const openFilter = () => { modalFilter.classList.remove('hidden'); modalFilter.classList.add('flex'); }
    const closeFilter = () => { modalFilter.classList.add('hidden'); modalFilter.classList.remove('flex'); }

    document.getElementById('btnFilterOpen')?.addEventListener('click', openFilter);
    document.getElementById('btnFilterClose')?.addEventListener('click', closeFilter);
    modalFilter?.addEventListener('click', (e) => { if(e.target === modalFilter) closeFilter(); });

    // news popup
    const modalNews = document.getElementById('modalNews');
    const openNews = () => { modalNews.classList.remove('hidden'); modalNews.classList.add('flex'); }
    const closeNews = () => { modalNews.classList.add('hidden'); modalNews.classList.remove('flex'); }

    document.getElementById('btnNewsClose')?.addEventListener('click', closeNews);
    modalNews?.addEventListener('click', (e) => { if(e.target === modalNews) closeNews(); });

    function openNewsPopup(title, content, image){
        document.getElementById('newsTitle').innerText = title;
        document.getElementById('newsContent').innerText = content;
        document.getElementById('newsImage').src = image;
        openNews();
    }
</script>
@endsection
