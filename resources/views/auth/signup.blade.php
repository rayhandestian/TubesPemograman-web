<x-layout_main>
    <!-- Register Container -->
    <div class="w-full max-w-md">
        <!-- Logo -->
        <div class="flex justify-center mb-2">
            <img src="{{ asset('img/logo_kiquals.png') }}" alt="KiQualls Logo" class="w-32">
        </div>

        <!-- Title -->
        <h1 class="text-4xl font-bold text-center mb-2">Daftar</h1>
        <p class="text-center text-gray-600 mb-8">Buat akun KiQualls baru</p>

        <!-- Register Form -->
        <div class="bg-white/80 backdrop-blur-sm rounded-xl p-8 shadow-lg">
            <form method="POST" action="{{ route('signup.post') }}" class="space-y-6">
                @csrf
                <!-- Name Field -->
                <div>
                    <label class="block text-gray-700 text-sm font-medium mb-2">Nama Lengkap</label>
                    <input type="text" name="name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-medium mb-2">Nama Ibu Kandung</label>
                    <input type="text" name="mother_name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-medium mb-2">Usia</label>
                    <input type="number" name="age" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <!-- Password Field -->
                <div>
                    <label class="block text-gray-700 text-sm font-medium mb-2">Kata Sandi</label>
                    <input type="password" name="password" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <!-- Confirm Password Field -->
                <div>
                    <label class="block text-gray-700 text-sm font-medium mb-2">Konfirmasi Kata Sandi</label>
                    <input type="password" name="password_confirmation" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <!-- Register Button -->
                <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 transition-colors">
                    Daftar
                </button>

                <!-- Login Link -->
                <div class="text-center text-sm">
                    <span class="text-gray-600">Sudah punya akun? </span>
                    <a href="{{ route('signin') }}" class="text-blue-500 hover:text-blue-600">Masuk disini</a>
                </div>
            </form>
        </div>
    </div>
</x-layout_main>