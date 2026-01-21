@extends('layouts.app-front')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">

    @if(session('success'))
        <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid lg:grid-cols-3 gap-8">
        {{-- LEFT MENU --}}
        <div class="bg-white border rounded-2xl p-6 h-fit">
            <h2 class="font-bold text-lg mb-6">Settings</h2>

            <div class="space-y-2 text-sm">
                <button class="w-full text-left px-4 py-3 rounded-xl bg-blue-50 text-blue-700 font-semibold">
                    Account
                </button>
                <button class="w-full text-left px-4 py-3 rounded-xl hover:bg-slate-50">
                    Password
                </button>
                <button class="w-full text-left px-4 py-3 rounded-xl hover:bg-slate-50">
                    Privacy & Security
                </button>
                <button class="w-full text-left px-4 py-3 rounded-xl hover:bg-slate-50">
                    Notification
                </button>
                <button class="w-full text-left px-4 py-3 rounded-xl hover:bg-slate-50">
                    Help
                </button>
            </div>
        </div>

        {{-- RIGHT FORM --}}
        <div class="lg:col-span-2 bg-white border rounded-2xl p-6">
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6 mb-6">
                <div>
                    <h1 class="text-2xl font-bold">Profile</h1>
                    <p class="text-sm text-slate-500">Lengkapi data agar akunmu siap digunakan.</p>
                </div>

                <button form="profileForm"
                    class="px-5 py-3 rounded-xl bg-blue-600 text-white font-semibold w-full md:w-auto">
                    Save Changes
                </button>
            </div>

            <form id="profileForm" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data"
                class="grid md:grid-cols-3 gap-6">
                @csrf

                {{-- AVATAR --}}
                <div class="md:col-span-1">
                    <div class="border rounded-2xl p-5 text-center">
                        <div class="w-28 h-28 mx-auto rounded-full bg-slate-100 overflow-hidden flex items-center justify-center border">
                            @if($profile->avatar)
                                <img src="{{ asset('storage/'.$profile->avatar) }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-3xl">👤</span>
                            @endif
                        </div>

                        <p class="text-xs text-slate-500 mt-3">Upload your photo</p>

                        <input type="file" name="avatar"
                            class="mt-4 w-full text-sm border rounded-lg px-3 py-2">
                    </div>
                </div>

                {{-- INPUTS --}}
                <div class="md:col-span-2 space-y-4">

                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm font-semibold">Full Name</label>
                            <input name="full_name" value="{{ $profile->full_name }}"
                                class="w-full border rounded-xl px-4 py-3 mt-1" placeholder="Your name">
                        </div>

                        <div>
                            <label class="text-sm font-semibold">Username</label>
                            <input name="username" value="{{ $profile->username }}"
                                class="w-full border rounded-xl px-4 py-3 mt-1" placeholder="username">
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm font-semibold">Email</label>
                            <input name="email" value="{{ $profile->email }}"
                                class="w-full border rounded-xl px-4 py-3 mt-1" placeholder="email">
                        </div>

                        <div>
                            <label class="text-sm font-semibold">Gender</label>
                            <select name="gender" class="w-full border rounded-xl px-4 py-3 mt-1">
                                <option value="">Select</option>
                                <option value="Male" @selected($profile->gender === 'Male')>Male</option>
                                <option value="Female" @selected($profile->gender === 'Female')>Female</option>
                                <option value="Other" @selected($profile->gender === 'Other')>Other</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm font-semibold">Phone Number</label>
                            <input name="phone" value="{{ $profile->phone }}"
                                class="w-full border rounded-xl px-4 py-3 mt-1" placeholder="+62...">
                        </div>

                        <div>
                            <label class="text-sm font-semibold">Address</label>
                            <input name="address" value="{{ $profile->address }}"
                                class="w-full border rounded-xl px-4 py-3 mt-1" placeholder="Your address">
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
@endsection
