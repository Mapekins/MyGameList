<x-layout>
<div class="container rounded-3xl shadow-inner p-5 pl-8">
        <p class="text-3xl text-black font-bold">{{__('welcome')}}</p>
        <p class="italic mt-2 text-gray-400">{{__('main_description')}}</p>
        <section class="top-games">
            <h2 class="font-bold text-xl">{{__('top_2-6')}}</h2>
            <ul>
                @for($i = 1;$i < 6; $i++)
                    @php
                        $gameId = $averageRatings[$i]['game_id'];
                        $averageRating = $averageRatings[$i]['average_rating'];
                        $gameName = $games->firstWhere('id', $gameId)->name;
                    @endphp
                    <li class="w-[230px] h-[400px]">
                        <a href="{{ route('game.show', $gameId) }}" class="h-[350px]">

            @php
                $logoPath = public_path('images/gamelogos/' . $games->firstWhere('id', $gameId)->image);
                $fallbackPath = asset('storage/' . $games->firstWhere('id', $gameId)->image);
            @endphp

            @if (file_exists($logoPath))
                <img src="{{ asset('images/gamelogos/' . $games->firstWhere('id', $gameId)->image) }}" alt="{{ $games->firstWhere('id', $gameId)->image }}" class="shadow-lg border border-gray-400 mb-2 w-[200px] h-[275px] transition-all duration-150 ease-in-out hover:scale-95">
            @else
                <img src="{{ $fallbackPath }}" alt="{{ $games->firstWhere('id', $gameId)->image }}" class="shadow-lg border border-gray-400 mb-2 w-[200px] h-[275px] transition-all duration-150 ease-in-out hover:scale-95">
            @endif
                        <div class="text-wrap size-fit">
                            <h3>{{$gameName}}</h3>
                            <p>{{__('rating')}} : {{$averageRating}}⭐</p>
                        </div>
                        </a>
                    </li>
                @endfor
            </ul>
        </section>
</div>
    <div class="container rounded-3xl shadow-inner p-5 pl-8 mt-5 mb-5">
        <section class="best-of-the-best">
            <h2 class="font-bold text-xl">{{__('top_1')}}</h2>
            <div class="best-game">
                <a href="{{ route('game.show', $averageRatings[0]['game_id']) }}">

            @php
                $logoPath = public_path('images/gamelogos/' . $games->firstWhere('id',$averageRatings[0]['game_id'])->image);
                $fallbackPath = asset('storage/' . $games->firstWhere('id',$averageRatings[0]['game_id'])->image);
            @endphp

            @if (file_exists($logoPath))
                <img src="{{ asset('images/gamelogos/' . $games->firstWhere('id',$averageRatings[0]['game_id'])->image) }}" alt="{{ $games->firstWhere('id',$averageRatings[0]['game_id'])->image }}" class="shadow-lg border border-gray-400 w-[300px] h-[375px] transition-all duration-150 ease-in-out hover:scale-95">
            @else
                <img src="{{ $fallbackPath }}" alt="{{ $games->firstWhere('id',$averageRatings[0]['game_id'])->image }}" class="shadow-lg border border-gray-400 w-[300px] h-[375px] transition-all duration-150 ease-in-out hover:scale-95">
            @endif

                <div class="relative">
                    <h1 class="text-4xl font-bold">{{$games->firstWhere('id',$averageRatings[0]['game_id'])->name}}</h1>
                    <p>{{__('rating')}}: {{$averageRatings[0]['average_rating']}}⭐</p>
                    @php
                        $hasCriticReview = false;
                    @endphp

                    @foreach ($reviews->where('game_id', $averageRatings[0]['game_id']) as $review)
                        @php
                            $user = $users->firstWhere('id', $review->user_id);
                        @endphp
                        @if ($user && $user->hasRole('Critic'))
                            @php
                                $hasCriticReview = true;
                            @endphp
                            @break
                        @endif
                    @endforeach

                    @if ($hasCriticReview)
                        <p>{{__('main_critics_reviews')}} :</p>
                        @foreach ($reviews->where('game_id', $averageRatings[0]['game_id']) as $review)
                            @php
                                $user = $users->firstWhere('id', $review->user_id);
                            @endphp
                            @if ($user && $user->hasRole('Critic'))
                                <div class="container rounded-3xl shadow-inner m-1 p-1 flex-fill flex flex-col justify-between border-4 border-amber-500">
                                    <div class="flex m-1 p-1">
                                        <a href="{{ route('user.show', ['id' => $user->id]) }}" class="flex items-center">
                                            @if($user->profile_picture)
                                                <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="{{ $user->name }}" class="rounded-full mr-4 w-20 h-20">
                                            @else
                                                <img src="{{ asset('images/websitelogo/logo.png') }}" alt="Avatar" class="rounded-full w-20 h-20">
                                            @endif
                                            <h1 class="ml-2">{{ $user->name }}</h1>
                                        </a>
                                    </div>
                                    <div class="flex m-1 p-1">
                                        <p class="text-gray-600 text-lg">
                                            {{ $review->text }}
                                        </p>
                                    </div>
                                    <h1 class="text-end">Rating: {{ $review->rating }} ⭐</h1>
                                </div>
                            @endif
                        @endforeach
                    @else
                        <p>{{__('main_if_no_critics_reviews')}}</p>
                    @endif
                </div>
                </a>
            </div>
        </section>
    </div>
    <div class="container rounded-3xl shadow-inner p-5 pl-8">
     <section class="all-games">
        <h2 class="font-bold pb-5 text-xl">{{__('all_games')}}</h2>
        <div class="game-gallery">
            @foreach ($games as $game)
                <div class="game-item">
                    <a href="{{ route('game.show', $game->id) }}">
                    @php
                $logoPath = public_path('images/gamelogos/' . $game->image);
                $fallbackPath = asset('storage/' . $game->image);
            @endphp

            @if (file_exists($logoPath))
                <img src="{{ asset('images/gamelogos/' . $game->image) }}" alt="{{ $game->name }}" class="shadow-lg border border-gray-400 transition-all duration-150 ease-in-out hover:scale-95">
            @else
                <img src="{{ $fallbackPath }}" alt="{{ $game->name }}" class="shadow-lg border border-gray-400 transition-all duration-150 ease-in-out hover:scale-95">
            @endif
                        <h3>{{ $game->name }}</h3>
                    </a>
                </div>
            @endforeach
        </div>
    </section>
    </div>
</x-layout>
