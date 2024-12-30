<x-layout_main>
    <div class="w-full max-w-md">
        <!-- Logo -->
        <div class="flex justify-center mb-2">
            <img src="{{ asset('img/logo_kiquals.png') }}" alt="KiQualls Logo" class="w-32">
        </div>

        <!-- Title -->
        <h1 class="text-4xl font-bold text-center mb-2">Masuk</h1>
        <p class="text-center text-gray-600 mb-8">Selamat datang di KiQualls</p>

        <!-- Login Form -->
        <div class="bg-white/80 backdrop-blur-sm rounded-xl p-8 shadow-lg">
            <form method="POST" action="{{ route('signin.post') }}" class="space-y-6">
                @csrf
                
                <!-- Username Field -->
                <div>
                    <label class="block text-gray-700 text-sm font-medium mb-2">Nama Pengguna</label>
                    <input type="text" name="name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Silakan masukkan username Anda" required>
                </div>

                <!-- Password Field -->
                <div>
                    <label class="block text-gray-700 text-sm font-medium mb-2">Kata Sandi</label>
                    <input type="password" name="password" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Silakan masukkan kata sandi Anda" required>
                </div>

                <!-- Login Button -->
                <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 transition-colors">
                    Login
                </button>

                <!-- Register Link -->
                <div class="text-center text-sm">
                    <span class="text-gray-600">Belum punya akun? </span>
                    <a href="{{ route('signup') }}" class="text-blue-500 hover:text-blue-600">Daftar disini</a>
                </div>
            </form>
        </div>
    </div>
</x-layout_main>