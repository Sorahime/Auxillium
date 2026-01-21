<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Auxillium</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white text-slate-800">

{{-- NAVBAR --}}
<header class="w-full border-b bg-white">
    <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
        <a href="{{ route('home') }}" class="flex items-center gap-2 font-bold text-xl">
            <span class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center">🌐</span>
            AUXILIUM
        </a>

        <nav class="flex items-center gap-6 text-sm">
            <a href="{{ route('home') }}" class="hover:text-blue-600">Home</a>
            <a href="{{ route('service') }}" class="hover:text-blue-600">Service</a>
            <a href="{{ route('news') }}" class="hover:text-blue-600">News</a>

            {{-- Before login --}}
            @guest
                <button id="btnLoginOpen"
                        class="px-4 py-2 rounded-xl border hover:bg-slate-50">
                    Sign In
                </button>
            @endguest

            {{-- After login --}}
            @auth
                <a href="{{ route('profile') }}"
                   class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center overflow-hidden border">
                    👤
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="px-4 py-2 rounded-xl border hover:bg-red-50 hover:text-red-600">
                        Logout
                    </button>
                </form>
            @endauth
        </nav>
    </div>
</header>

{{-- CONTENT --}}
<main>
    @yield('content')
</main>

{{-- FOOTER --}}
<footer class="border-t mt-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 py-10">
        <div class="flex flex-col md:flex-row gap-8 md:items-center md:justify-between">
            <div>
                <p class="font-bold text-slate-800">Auxillium</p>
                <p class="text-sm text-slate-500 mt-2 max-w-md">
                    A disaster response and safety platform designed to keep communities informed,
                    connected, and protected in critical situations.
                </p>
            </div>

            <div class="flex flex-col sm:flex-row gap-8 text-sm">
                <div class="space-y-2">
                    <p class="font-semibold text-slate-700">Company</p>
                    <p class="text-slate-500 hover:text-slate-800 cursor-pointer">About</p>
                    <p class="text-slate-500 hover:text-slate-800 cursor-pointer">Services</p>
                    <p class="text-slate-500 hover:text-slate-800 cursor-pointer">News</p>
                </div>

                <div class="space-y-2">
                    <p class="font-semibold text-slate-700">Support</p>
                    <p class="text-slate-500 hover:text-slate-800 cursor-pointer">Help Center</p>
                    <p class="text-slate-500 hover:text-slate-800 cursor-pointer">Privacy Policy</p>
                    <p class="text-slate-500 hover:text-slate-800 cursor-pointer">Terms of Service</p>
                </div>
            </div>
        </div>

        <div class="border-t mt-10 pt-6 flex flex-col md:flex-row items-center justify-between gap-4 text-sm text-slate-500">
            <p>© 2026 Auxillium. All rights reserved.</p>

            <div class="flex gap-4">
                <a href="#" class="hover:text-slate-800">Twitter</a>
                <a href="#" class="hover:text-slate-800">Facebook</a>
                <a href="#" class="hover:text-slate-800">LinkedIn</a>
                <a href="#" class="hover:text-slate-800">YouTube</a>
            </div>
        </div>
    </div>
</footer>



{{-- =========================
    MODAL LOGIN + REGISTER
    ONLY FOR GUEST
========================= --}}
@guest

    {{-- MODAL LOGIN --}}
    <div id="modalLogin"
         class="fixed inset-0 bg-black/40 hidden items-center justify-center px-4 z-50">
        <div class="bg-white w-full max-w-md rounded-2xl p-8 relative">
            <button id="btnLoginClose"
                    class="absolute top-4 right-4 text-slate-400 hover:text-slate-900">✕</button>

            <div class="text-center mb-6">
                <div class="w-16 h-16 mx-auto rounded-full bg-blue-50 flex items-center justify-center text-2xl">🌊</div>
                <h2 class="font-bold text-xl mt-3">Log In</h2>
                <p class="text-sm text-slate-500">AUXILIUM</p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <input
                    name="email"
                    placeholder="Username/email"
                    class="w-full border rounded-lg px-3 py-2"
                    required
                />

                <input
                    name="password"
                    type="password"
                    placeholder="Password"
                    class="w-full border rounded-lg px-3 py-2"
                    required
                />

                {{-- error jika login salah --}}
                @if ($errors->any())
                    <div class="text-sm text-red-600">
                        Login gagal. Cek username/email atau password.
                    </div>
                @endif

                <div class="flex justify-between text-sm">
                    <a href="{{ route('password.request') }}" class="text-blue-600 hover:underline">
                        Forgot Password?
                    </a>
                </div>

                <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg font-semibold">
                    Log In
                </button>
            </form>

            <button id="btnRegisterOpen"
                    class="w-full mt-4 border py-2 rounded-lg text-sm hover:bg-slate-50">
                Don’t have an account yet?
                <span class="text-blue-600 font-semibold">Sign up</span>
            </button>
        </div>
    </div>


    {{-- MODAL REGISTER --}}
    <div id="modalRegister"
         class="fixed inset-0 bg-black/40 hidden items-center justify-center px-4 z-50">
        <div class="bg-white w-full max-w-md rounded-2xl p-8 relative">
            <button id="btnRegisterClose"
                    class="absolute top-4 right-4 text-slate-400 hover:text-slate-900">✕</button>

            <div class="text-center mb-6">
                <div class="w-16 h-16 mx-auto rounded-full bg-blue-50 flex items-center justify-center text-2xl">🌊</div>
                <h2 class="font-bold text-xl mt-3">Sign Up</h2>
                <p class="text-sm text-slate-500">AUXILIUM</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                {{-- Breeze default pakai "name" jadi kita pakai itu sebagai username --}}
                <input
                    name="name"
                    placeholder="Username"
                    class="w-full border rounded-lg px-3 py-2"
                    required
                />

                <input
                    name="email"
                    type="email"
                    placeholder="Enter Email"
                    class="w-full border rounded-lg px-3 py-2"
                    required
                />

                <input
                    name="password"
                    type="password"
                    placeholder="Password"
                    class="w-full border rounded-lg px-3 py-2"
                    required
                />

                <input
                    name="password_confirmation"
                    type="password"
                    placeholder="Confirm Password"
                    class="w-full border rounded-lg px-3 py-2"
                    required
                />

                <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg font-semibold">
                    Sign Up
                </button>
            </form>

            <button id="btnBackToLogin"
                    class="w-full mt-4 border py-2 rounded-lg text-sm hover:bg-slate-50">
                Already have an account?
                <span class="text-blue-600 font-semibold">Login</span>
            </button>
        </div>
    </div>


    {{-- SCRIPT MODAL --}}
    <script>
        const modalLogin = document.getElementById('modalLogin');
        const modalRegister = document.getElementById('modalRegister');

        function openLogin(){
            modalLogin.classList.remove('hidden');
            modalLogin.classList.add('flex');
        }
        function closeLogin(){
            modalLogin.classList.add('hidden');
            modalLogin.classList.remove('flex');
        }

        function openRegister(){
            modalRegister.classList.remove('hidden');
            modalRegister.classList.add('flex');
        }
        function closeRegister(){
            modalRegister.classList.add('hidden');
            modalRegister.classList.remove('flex');
        }

        document.getElementById('btnLoginOpen')?.addEventListener('click', openLogin);
        document.getElementById('btnLoginClose')?.addEventListener('click', closeLogin);

        document.getElementById('btnRegisterOpen')?.addEventListener('click', () => {
            closeLogin();
            openRegister();
        });

        document.getElementById('btnRegisterClose')?.addEventListener('click', closeRegister);

        document.getElementById('btnBackToLogin')?.addEventListener('click', () => {
            closeRegister();
            openLogin();
        });

        modalLogin?.addEventListener('click', (e) => {
            if (e.target === modalLogin) closeLogin();
        });

        modalRegister?.addEventListener('click', (e) => {
            if (e.target === modalRegister) closeRegister();
        });

        // ✅ Kalau login gagal, otomatis buka modal login lagi
        @if ($errors->any())
        document.addEventListener("DOMContentLoaded", function(){
            openLogin();
        });
        @endif
    </script>

@endguest

</body>
</html>
