<x-layout>
@php
    $current_user = auth()->user();
    $userid = $current_user ? $current_user->id : null;

    // Calculate average rating
    $totalSum = 0;
    $totalCount = 0;

    foreach ($usersforgrade as $user) {
        $userRev = $reviews->where('user_id', $user->id)->first();
        if ($userRev) {
            $totalSum += $userRev->rating;
            $totalCount++;
        } else {
            $userGListEntry = $gameListEntries->where('user_id', $user->id)->first();
            if ($userGListEntry && $userGListEntry->score !== null) {
                $totalSum += $userGListEntry->score;
                $totalCount++;
            }
        }
    }

    if ($totalCount > 0) {
        $averageRating = number_format($totalSum / $totalCount, 2, ',', '');
    } else {
        $averageRating = 'Not yet rated! :(';
    }
@endphp
    <div class="container relative rounded-3xl shadow-inner p-5 pl-8 flex">
        <!-- Left Part -->
        <div class="w-1/4 pr-8 leftgame">
            <img src="{{ asset('images/gamelogos/' . $game->image) }}" alt="{{ $game->name }}" class="rounded-lg mb-5">
            <div class="mb-3">
                <label class="block text-lg font-semibold mb-2">Rating:</label>
                <div class="flex items-end">
                    <p class="text-4xl text-blue-400">{{$averageRating}}⭐</p>
                    <p class="text-xl"> ({{$totalCount}} users)</p>
                </div>


            </div>

            @guest
                <p class="text-blue-500">Log in to add the game to your list and more!</p>
            @endguest

    @auth
        @php($userid = auth()->id())
        @if($userGameListEntry)
            <!-- Update form -->
            <form action="{{ route('game-list.update') }}" method="POST" class="mb-3">
                @csrf
                <!-- Hidden input to store game_list_id -->
                <input type="hidden" name="game_list_id" value="{{ $userGameListEntry->id }}">
                <!-- Other fields -->
                <div class="mb-3">
                    <label for="status" class="block text-lg font-semibold mb-2">Status:</label>
                    <select id="status" name="status" class="border rounded-md px-3 py-1 w-32" required>
                        <option value="">Select</option>
                        <option value="1" {{ $userGameListEntry->status == 1 ? 'selected' : '' }}>Playing</option>
                        <option value="2" {{ $userGameListEntry->status == 2 ? 'selected' : '' }}>Completed</option>
                        <option value="3" {{ $userGameListEntry->status == 3 ? 'selected' : '' }}>On-Hold</option>
                        <option value="4" {{ $userGameListEntry->status == 4 ? 'selected' : '' }}>Dropped</option>
                        <option value="5" {{ $userGameListEntry->status == 5 ? 'selected' : '' }}>Plan to Play</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="score" class="block text-lg font-semibold mb-2">Your Score:</label>
                    <select id="score" name="score" class="border rounded-md px-3 py-1 w-32">
                        <option value="">Select</option>
                        @for ($i = 1; $i <= 10; $i++)
                            <option value="{{ $i }}" {{ $userGameListEntry->score == $i ? 'selected' : '' }}>{{ $i }} ⭐</option>
                        @endfor
                    </select>
                </div>

                <div class="mb-3">
                    <label for="favorite" class="block text-lg font-semibold mb-2 w-[164px]">Add to Favorites:</label>
                    <input type="checkbox" id="favorite" name="favorite" value="1" class="border rounded-md px-3 py-1 mb-2" {{ $userGameListEntry->favorite ? 'checked' : '' }}>
                </div>


                <div class="flex">
                <!-- Update button -->
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md mr-2 transition-all duration-150 ease-in-out hover:scale-110 hover:bg-blue-600">Update</button>

                <!-- Delete form -->

            </form>
            <form action="{{ route('game-list.destroy') }}" method="POST">
                    @csrf
                    <!-- Hidden input to store game_list_id -->
                    <input type="hidden" name="game_list_id" value="{{ $userGameListEntry->id }}">
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md transition-all duration-150 ease-in-out hover:scale-110 hover:bg-blue-600">Delete</button>
                </form>
            </div>
        @else
            <!-- Add form -->
            <form action="{{ route('game-list.store') }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ $userid }}"/>
                <input type="hidden" name="game_id" value="{{ $game->id }}">
                <!-- Other fields -->
                <div class="mb-3">
                    <label for="status" class="block text-lg font-semibold mb-2">Status:</label>
                    <select id="status" name="status" class="border rounded-md px-3 py-1 w-32" required>
                        <option value="">Select</option>
                        <option value="1">Playing</option>
                        <option value="2">Completed</option>
                        <option value="3">On-Hold</option>
                        <option value="4">Dropped</option>
                        <option value="5">Plan to Play</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="score" class="block text-lg font-semibold mb-2">Your Score:</label>
                    <select id="score" name="score" class="border rounded-md px-3 py-1 w-32">
                        <option value="">Select</option>
                        @for ($i = 1; $i <= 10; $i++)
                            <option value="{{ $i }}">{{ $i }} ⭐</option>
                        @endfor
                    </select>
                </div>

                <div class="mb-3">
                    <label for="favorite" class="block text-lg font-semibold mb-2 w-[164px]">Add to Favorites:</label>
                    <input type="checkbox" id="favorite" name="favorite" value="1" class="border rounded-md px-3 py-1 mb-2">
                </div>

                <!-- Add button -->
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md mb-3 transition-all duration-150 ease-in-out hover:scale-110 hover:bg-blue-600">Add</button>
            </form>
        @endif
    @endauth

@if(session('success'))
    <div class="alert alert-success text-green-500">
        {{ session('success') }}
    </div>
@endif

    </div>

    <!-- Right Part -->
    <div class="w-3/4">
        <h2 class="font-bold text-3xl mb-3">{{ $game->name }}</h2>
        <div class="mb-3">
            <label class="block text-lg font-semibold mb-2">Release Date:</label>
            <p>{{ $game->release_date }}</p>
        </div>
        <div class="mb-3">
            <label class="block text-lg font-semibold mb-2">Genre:</label>
            <p>{{ $game->genre }}</p>
        </div>
        <div class="mb-3">
            <label class="block text-lg font-semibold mb-2">Developer:</label>
            <p>{{ $game->developer }}</p>
        </div>
        <div>
            <label class="block text-lg font-semibold mb-2">Description:</label>
            <p>{{ $game->description }}</p>
        </div>
    </div>
{{--    Write review button and review menu--}}
@auth
    @php($userid = auth()->id())
    @if(!$reviews->contains('user_id', $userid))
        <div id="ex1" class="modal">
            <h2 class="text-lg font-bold">Review of {{$game->name}}</h2>
            <form action="{{ route('reviews.store') }}" method="POST" class="flex flex-col">
                @csrf
                <input type="hidden" name="game_id" value="{{ $game->id }}"/>
                <input type="hidden" name="user_id" value="{{ $userid }}"/>
                <input type="hidden" name="isCritic" value="{{ $current_user->hasRole('Critic') }}"/>
                <select id="reviewRating" name="rating" class="border rounded-md px-3 py-1 w-32 m-5" required>
                    <option>Select</option>
                    @for ($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}">{{ $i }} ⭐</option>
                    @endfor
                </select>
                <input type="text" id="reviewText" name="text" class="m-5" placeholder="Ohhh... What a great game!"></input>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md ml-5 mb-3 text-nowrap m-auto transition-all duration-150 ease-in-out hover:scale-110 hover:bg-blue-600">Post review</button>
            </form>
        </div>
        <div class="absolute bottom-4 right-6">
            <a href="#ex1" rel="modal:open"><button class="bg-blue-500 text-white px-4 py-2 rounded-md mb-3 text-nowrap transition-all duration-150 ease-in-out hover:scale-110 hover:bg-blue-600">Write Review</button></a>
        </div>
    @else
        <div id="ex2" class="modal">
            <h2 class="text-lg font-bold">Review of {{$game->name}}</h2>
            <form action="{{ route('reviews.update') }}" method="POST" class="flex flex-col">
                @csrf
                <input type="hidden" name="game_id" value="{{ $game->id }}"/>
                <input type="hidden" name="user_id" value="{{ $userid }}"/>
                <input type="hidden" name="isCritic" value="{{ $current_user->hasRole('Critic') }}"/>

                <select id="reviewRating" name="rating" class="border rounded-md px-3 py-1 w-32 m-5" required>
                    <option value="">Select</option>
                    @for ($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}" {{ $userReview->rating == $i ? 'selected' : '' }}>{{ $i }} ⭐</option>
                    @endfor
                </select>
                <input type="text" id="reviewText" name="text" class="m-5" placeholder="Ohhh... What a great game!" value="{{ $userReview->text }}"/>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md ml-5 mb-3 text-nowrap m-auto transition-all duration-150 ease-in-out hover:scale-110 hover:bg-blue-600">Edit review</button>
            </form>
        </div>
        <div class="absolute bottom-4 right-6">
            <a href="#ex2" rel="modal:open"><button class="bg-blue-500 text-white px-4 py-2 rounded-md mb-3 text-nowrap transition-all duration-150 ease-in-out hover:scale-110 hover:bg-blue-600">Edit Review</button></a>
        </div>
        <div class="absolute bottom-20 right-6">
            <form action="{{ route('reviews.destroy') }}" method="POST">
                @csrf
                <input type="hidden" name="game_id" value="{{ $game->id }}"/>
                <input type="hidden" name="user_id" value="{{ $userid }}"/>
                <input type="hidden" name="current_user_id" value="{{ $current_user->id }}"/>
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md mb-3 text-nowrap transition-all duration-150 ease-in-out hover:scale-110 hover:bg-red-900">Delete Review</button>
            </form>
        </div>
    @endif
@endauth
</div>
{{--Critic Reviews--}}
    @foreach ($reviews as $review)
    @php($user = $users->firstWhere('id', $review->user_id))
            @if($user->hasRole('Critic'))
    {{--BIG container--}}
    <div class="container rounded-3xl shadow-inner mt-4 p-5 pl-8 flex-fill flex flex-col justify-between border-4 border-amber-500">
        {{--Left Container--}}
        <div class="flex items-start items-center m-0 mr-4 mb-4">
            <a href="{{ route('user.show', ['id' => $user->id]) }}" class="flex items-center transition-all duration-150 ease-in-out hover:scale-95">
                @if($user->profile_picture)
                    <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="{{ $user->name }}" class="rounded-full w-20 h-20">
                @else
                    <img src="{{ asset('images/websitelogo/logo.png') }}" alt="Avatar" class="rounded-full w-20 h-20">
                @endif
                <h1 class="ml-2">{{ $user->name }}</h1>
            </a>
        </div>
        {{--        Right Container--}}
        <div class="">
            <p class="text-gray-600 text-lg">
                {{$review->text}}
            </p>
        </div>
        @if(Auth::check() && $current_user->hasRole(['Admin', 'Moderator']))
            <form action="{{ route('reviews.destroy') }}" method="POST" class="text-end">
                @csrf
                <input type="hidden" name="game_id" value="{{ $game->id }}"/>
                <input type="hidden" name="user_id" value="{{ $user->id }}"/>
                <input type="hidden" name="current_user_id" value="{{ $current_user->id }}"/>
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md mb-3 text-nowrap transition-all duration-150 ease-in-out hover:scale-110 hover:bg-red-900">Delete Review</button>
            </form>
        @endif
        <h1 class="text-end">Rating: {{$review->rating}} ⭐</h1>

    </div>
   @endif
   @endforeach
{{-- Reviews --}}
    @foreach ($reviews as $review)
           @php($user = $users->firstWhere('id', $review->user_id))
            @if(!$user->hasRole('Critic'))
{{--BIG container--}}
    <div class="container rounded-3xl shadow-inner mt-4 p-5 pl-8 flex-fill flex flex-col justify-between">
{{--Left Container--}}
        <div class="flex items-start items-center m-0 mr-4 mb-4">
        <a href="{{ route('user.show', ['id' => $user->id]) }}" class="flex items-center transition-all duration-150 ease-in-out hover:scale-95">
                @if($user->profile_picture)
                    <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="{{ $user->name }}" class="rounded-full mr-4 w-20 h-20">
                @else
                    <img src="{{ asset('images/websitelogo/logo.png') }}" alt="Avatar" class="rounded-full w-20 h-20">
                @endif
                    <h1 class="ml-2">{{ $user->name }}</h1>
                </a>
        </div>
{{--        Right Container--}}
        <div class="">
            <p class="text-gray-600 text-lg">
                {{$review->text}}
            </p>
        </div>
        @if(Auth::check() && $current_user->hasRole(['Admin', 'Moderator']))
            <form action="{{ route('reviews.destroy') }}" method="POST" class="text-end">
                @csrf
                <input type="hidden" name="game_id" value="{{ $game->id }}"/>
                <input type="hidden" name="user_id" value="{{ $user->id }}"/>
                <input type="hidden" name="current_user_id" value="{{ $current_user->id }}"/>
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md mb-3 text-nowrap transition-all duration-150 ease-in-out hover:scale-110 hover:bg-red-900">Delete Review</button>
            </form>
        @endif
        <h1 class="text-end">Rating: {{$review->rating}} ⭐</h1>
    </div>
    @endif
    @endforeach
</x-layout>
