@extends('layouts.app-front')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">
    <h1 class="text-3xl font-bold">Peta Offline</h1>

    <div class="mt-8 grid md:grid-cols-3 gap-6">
        <div class="bg-white border rounded-2xl p-4">
            <h2 class="font-semibold mb-3">Downloaded Maps</h2>

            <div class="space-y-3 text-sm text-slate-600">
                <div class="flex justify-between border-b pb-2">
                    <span>DKI Jakarta</span>
                    <span>17/05/2025</span>
                </div>
                <div class="flex justify-between border-b pb-2">
                    <span>Jawa Barat</span>
                    <span>08/02/2024</span>
                </div>
                <div class="flex justify-between border-b pb-2">
                    <span>DIY Yogyakarta</span>
                    <span>12/12/2022</span>
                </div>
            </div>

            <button class="mt-5 px-4 py-2 rounded-xl bg-slate-100 w-full">
                Back
            </button>
        </div>

        <div class="md:col-span-2 bg-white border rounded-2xl overflow-hidden">
            <div class="w-full h-[450px] bg-slate-100 flex items-center justify-center text-slate-500">
                [Offline Map Preview Placeholder]
            </div>
        </div>
    </div>
</div>
@endsection
