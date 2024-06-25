<x-layout>
    <div class="container rounded-3xl shadow-inner p-5 pl-8">
        <section class="flex items-center justify-between">
        <h2 class="font-normal text-xl">
                @if (isset($user) && $user->id == Auth::id())
                    Viewing <span class="font-bold">Your</span> Game List
                @else
                    Viewing <span class="font-bold">{{ $user->name }}'s</span> Game List
                @endif
            </h2>
            <div class="flex space-x-4">
                <a href="{{ route('game-list.index', ['id' => $user->id]) }}">
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-md @if(!request()->has('status') && !request()->has('favorite')) bg-blue-900 @else hover:bg-blue-600 focus:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-700 focus:ring-opacity-50 @endif transition-all duration-150 ease-in-out hover:scale-110">All games</button>
                </a>

                <a href="{{ route('game-list.index', ['id' => $user->id, 'status' => 1]) }}">
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-md @if(request('status') == 1) bg-blue-900 @else hover:bg-blue-600 focus:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-700 focus:ring-opacity-50 @endif transition-all duration-150 ease-in-out hover:scale-110">Playing</button>
                </a>

                <a href="{{ route('game-list.index', ['id' => $user->id, 'status' => 2]) }}">
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-md @if(request('status') == 2) bg-blue-900 @else hover:bg-blue-600 focus:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-700 focus:ring-opacity-50 @endif transition-all duration-150 ease-in-out hover:scale-110">Completed</button>
                </a>

                <a href="{{ route('game-list.index', ['id' => $user->id, 'status' => 3]) }}">
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-md @if(request('status') == 3) bg-blue-900 @else hover:bg-blue-600 focus:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-700 focus:ring-opacity-50 @endif transition-all duration-150 ease-in-out hover:scale-110">On-Hold</button>
                </a>

                <a href="{{ route('game-list.index', ['id' => $user->id, 'status' => 4]) }}">
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-md @if(request('status') == 4) bg-blue-900 @else hover:bg-blue-600 focus:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-700 focus:ring-opacity-50 @endif transition-all duration-150 ease-in-out hover:scale-110">Dropped</button>
                </a>

                <a href="{{ route('game-list.index', ['id' => $user->id, 'status' => 5]) }}">
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-md @if(request('status') == 5) bg-blue-900 @else hover:bg-blue-600 focus:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-700 focus:ring-opacity-50 @endif transition-all duration-150 ease-in-out hover:scale-110">Plan to Play</button>
                </a>

                <a href="{{ route('game-list.index', ['id' => $user->id, 'favorite' => 1]) }}">
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-md @if(request('favorite') == 1) bg-blue-900 @else hover:bg-blue-600 focus:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-700 focus:ring-opacity-50 @endif transition-all duration-150 ease-in-out hover:scale-110">Favorites</button>
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
                            @php
                            $logoPath = public_path('images/gamelogos/' . $game->game->image);
                            $fallbackPath = asset('storage/' . $game->game->image);
                        @endphp

                        @if (file_exists($logoPath))
                            <img src="{{ asset('images/gamelogos/' . $game->game->image) }}" alt="{{ $game->game->name }}" class="shadow-lg border border-gray-400 transition-all duration-150 ease-in-out hover:scale-95">
                        @else
                            <img src="{{ $fallbackPath }}" alt="{{ $game->game->name }}" class="shadow-lg border border-gray-400 transition-all duration-150 ease-in-out hover:scale-95">
                        @endif
                                <h3>{{ $game->game->name }}</h3>
                                <h3>

                                    @if (isset($user) && $user->id == Auth::id())
                                        @if ($game->score !== null)
                                            Your score: {{ $game->score }}
                                        @endif
                                    @else
                                         @if ($game->score !== null)
                                           User's score: {{ $game->score }}
                                        @endif
                                    @endif
                                </h3>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>
    </div>
</x-layout>
