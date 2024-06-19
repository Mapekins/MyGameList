<x-layout>
<div class="container rounded-3xl shadow-inner p-5 pl-8">
        <p class="text-3xl text-black font-bold">Welcome to the MyGameList website!</p>
        <p class="italic mt-2 text-gray-400">Here you can add games to your list and manage them. For free.</p>
        <section class="top-games">
            <h2 class="font-bold text-xl">Top 5 Games</h2>
            <ul>
                <li>
                    <img src="https://via.placeholder.com/100" alt="Game 1">
                    <div>
                        <h3>Game 1</h3>
                        <p>Grade: 9.5</p>
                    </div>
                </li>
                <li>
                    <img src="https://via.placeholder.com/100" alt="Game 2">
                    <div>
                        <h3>Game 2</h3>
                        <p>Grade: 9.2</p>
                    </div>
                </li>
                <li>
                    <img src="https://via.placeholder.com/100" alt="Game 3">
                    <div>
                        <h3>Game 3</h3>
                        <p>Grade: 9.0</p>
                    </div>
                </li>
                <li>
                    <img src="https://via.placeholder.com/100" alt="Game 4">
                    <div>
                        <h3>Game 4</h3>
                        <p>Grade: 8.8</p>
                    </div>
                </li>
                <li>
                    <img src="https://via.placeholder.com/100" alt="Game 5">
                    <div>
                        <h3>Game 5</h3>
                        <p>Grade: 8.7</p>
                    </div>
                </li>
            </ul>
        </section>
</div>
    <div class="container rounded-3xl shadow-inner p-5 pl-8 mt-5 mb-5">
        <section class="best-of-the-best">
            <h2 class="font-bold text-xl">Best of the Best</h2>
            <div class="best-game">
                <img src="https://via.placeholder.com/250" alt="Best Game">
                <div>
                    <h3>Best Game</h3>
                    <p>This game is the best of the best because...</p>
                </div>
            </div>
        </section>
    </div>
    <div class="container rounded-3xl shadow-inner p-5 pl-8">
     <section class="all-games">
        <h2 class="font-bold pb-5 text-xl">All Games</h2>
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
    </section>
    </div>
</x-layout>
