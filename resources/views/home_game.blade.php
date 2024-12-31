<x-layout_landingPage>
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold mb-8">Permainan</h1>
        
        <div class="grid grid-cols-2 gap-6">
            @foreach($games as $game)
            <a href="{{ route('games.show', $game['id']) }}" class="block p-6 bg-white rounded-lg shadow">
                <div class="flex items-center">
                    <img src="{{ asset('asset/' . $game['icon']) }}" class="w-16 h-16">
                    <div class="ml-4">
                        <h2 class="text-xl font-bold">{{ $game['title'] }}</h2>
                        <p class="text-gray-600">{{ $game['subtitle'] }}</p>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</x-layout_landingPage>