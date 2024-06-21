<x-layout>
    <div class="container rounded-3xl shadow-inner p-5 pl-8">
        <section class="flex items-center justify-between">
            <h2 class="font-normal text-xl">
                Viewing <span class="font-bold">Your</span> Game List
            </h2>
            <div class="flex space-x-4">
                <a href="{{ route('game-list.index') }}">
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-md @if(!request()->has('status') && !request()->has('favorite')) bg-blue-900 @else hover:bg-blue-600 focus:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-700 focus:ring-opacity-50 @endif">All games</button>
                </a>

                <a href="{{ route('game-list.index', ['status' => 1]) }}">
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-md @if(request('status') == 1) bg-blue-900 @else hover:bg-blue-600 focus:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-700 focus:ring-opacity-50 @endif">Playing</button>
                </a>

                <a href="{{ route('game-list.index', ['status' => 2]) }}">
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-md @if(request('status') == 2) bg-blue-900 @else hover:bg-blue-600 focus:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-700 focus:ring-opacity-50 @endif">Completed</button>
                </a>

                <a href="{{ route('game-list.index', ['status' => 3]) }}">
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-md @if(request('status') == 3) bg-blue-900 @else hover:bg-blue-600 focus:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-700 focus:ring-opacity-50 @endif">On-Hold</button>
                </a>

                <a href="{{ route('game-list.index', ['status' => 4]) }}">
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-md @if(request('status') == 4) bg-blue-900 @else hover:bg-blue-600 focus:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-700 focus:ring-opacity-50 @endif">Dropped</button>
                </a>

                <a href="{{ route('game-list.index', ['status' => 5]) }}">
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-md @if(request('status') == 5) bg-blue-900 @else hover:bg-blue-600 focus:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-700 focus:ring-opacity-50 @endif">Plan to Play</button>
                </a>

                <a href="{{ route('game-list.index', ['favorite' => 1]) }}">
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-md @if(request('favorite') == 1) bg-blue-900 @else hover:bg-blue-600 focus:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-700 focus:ring-opacity-50 @endif">Favorites</button>
                </a>
            </div>
        </section>

        <section class="all-games">
            @if ($message)
                <p class="text-red-500">{{ $message }}</p>
            @else
                <div class="game-gallery">
                    @foreach ($gameList as $game)
                        <div class="game-item">
                            <a href="{{ route('game.show', $game->game_id) }}">
                                <img src="{{ asset('images/gamelogos/' . $game->game->image) }}" alt="{{ $game->game->name }}" class="shadow-lg border border-gray-400">
                                <h3>{{ $game->game->name }}</h3>
                                <h3>Your score: {{ $game->score }}</h3>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>
    </div>
</x-layout>