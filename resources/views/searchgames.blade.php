<x-layout>
    <div class="container rounded-3xl shadow-inner p-5 pl-8">
		<section class="all-games">
		<h2 class="font-bold pb-5 text-xl">Result</h2>
		@if ($message)
                <p class="text-red-500">{{ $message }}</p>
            @else
                <div class="game-gallery">
				@foreach ($games as $game)
                <div class="game-item">
                    <a href="{{ route('game.show', $game->id) }}">
                        <img src="{{ asset('images/gamelogos/' . $game->image) }}" alt="{{ $game->name }}" class="shadow-lg border border-gray-400">
                        <h3>{{ $game->name }}</h3>
                    </a>
                </div>
            @endforeach
                </div>
            @endif
        </div>
		</section>
    </div>
</x-layout>
