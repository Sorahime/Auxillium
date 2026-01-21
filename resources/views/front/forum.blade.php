@extends('layouts.app-front')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold">Group Forum</h1>
            <p class="text-slate-600 mt-2">
                Province: <span class="font-semibold">{{ $province }}</span>
            </p>
        </div>

        <a href="{{ route('home') }}"
           class="px-5 py-3 rounded-xl border hover:bg-slate-50 text-sm">
            Back to Dashboard
        </a>
    </div>

    <div class="mt-8 grid lg:grid-cols-3 gap-6">

        {{-- LEFT: Info + Rules --}}
        <div class="bg-white border rounded-2xl p-6 h-fit">
            <h2 class="font-bold text-lg">Forum Information</h2>
            <p class="text-sm text-slate-600 mt-2">
                This group is dedicated to sharing safety updates, evacuation info, and emergency coordination.
            </p>

            <div class="mt-5 border-t pt-5">
                <h3 class="font-semibold text-sm text-slate-800">Guidelines</h3>
                <ul class="mt-3 space-y-2 text-sm text-slate-600 list-disc pl-5">
                    <li>No hoaxes or unverified information.</li>
                    <li>Share location details clearly.</li>
                    <li>Respect other members and avoid spam.</li>
                    <li>Use SOS responsibly.</li>
                </ul>
            </div>

            <div class="mt-6 border-t pt-5">
                <h3 class="font-semibold text-sm text-slate-800 mb-3">Quick Actions</h3>

                <div class="flex flex-col gap-3">
                    <a href="{{ route('service') }}"
                       class="px-4 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm text-center">
                        Open Service Map
                    </a>

                    <a href="{{ route('news') }}"
                       class="px-4 py-3 rounded-xl border hover:bg-slate-50 text-sm text-center">
                        View News Updates
                    </a>
                </div>
            </div>
        </div>

        {{-- RIGHT: Chat UI --}}
        <div class="lg:col-span-2 bg-white border rounded-2xl overflow-hidden flex flex-col h-[560px]">
            {{-- Chat header --}}
            <div class="px-6 py-4 border-b flex items-center justify-between">
                <div>
                    <p class="font-semibold">Chat Room</p>
                    <p class="text-xs text-slate-500">Auxillium • {{ $province }}</p>
                </div>
                <div class="text-xs text-green-600 font-semibold">
                    Online
                </div>
            </div>

            {{-- Messages --}}
            <div id="chatBox" class="flex-1 px-6 py-5 overflow-auto space-y-4 bg-slate-50">
                {{-- Example messages --}}
                <div class="max-w-[80%] bg-white border rounded-2xl p-4">
                    <p class="text-xs text-slate-500 mb-1">Volunteer • 10:12</p>
                    <p class="text-sm text-slate-700">
                        Halo semua, tetap waspada. Jika ada update lokasi bencana, share di sini ya.
                    </p>
                </div>

                <div class="max-w-[80%] ml-auto bg-blue-600 text-white rounded-2xl p-4">
                    <p class="text-xs text-white/70 mb-1">You • 10:14</p>
                    <p class="text-sm">
                        Siap! Ada info titik pengungsian terdekat?
                    </p>
                </div>
            </div>

            {{-- Input --}}
            <div class="p-4 border-t bg-white">
                <form onsubmit="sendFakeMessage(event)" class="flex gap-3">
                    <input id="msgInput"
                           class="flex-1 border rounded-xl px-4 py-3 text-sm outline-none"
                           placeholder="Type a message..." />

                    <button class="px-5 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm">
                        Send
                    </button>
                </form>

                <p class="text-xs text-slate-400 mt-2">
                    Tip: gunakan format “Lokasi: … | Kondisi: … | Butuh: …”
                </p>
            </div>
        </div>

    </div>
</div>

<script>
    function sendFakeMessage(e){
        e.preventDefault();

        const input = document.getElementById("msgInput");
        const chatBox = document.getElementById("chatBox");
        const text = input.value.trim();

        if(!text) return;

        const wrapper = document.createElement("div");
        wrapper.className = "max-w-[80%] ml-auto bg-blue-600 text-white rounded-2xl p-4";

        wrapper.innerHTML = `
            <p class="text-xs text-white/70 mb-1">You • just now</p>
            <p class="text-sm">${text}</p>
        `;

        chatBox.appendChild(wrapper);
        input.value = "";
        chatBox.scrollTop = chatBox.scrollHeight;
    }
</script>
@endsection
