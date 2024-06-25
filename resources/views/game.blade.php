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
    <<<<<<< HEAD
            $averageRating = __('not_rated');
    =======
            $averageRating = null;
    >>>>>>> e1042771b5f928992fd2428298abb97d6951e4fe
        }
    @endphp
    <div class="container relative rounded-3xl shadow-inner p-5 pl-8 flex">
        <!-- Left Part -->
        <div class="w-1/4 pr-8 leftgame">
            @php
                $logoPath = public_path('images/gamelogos/' . $game->image);
                $fallbackPath = asset('storage/' . $game->image);
            @endphp

            @if (file_exists($logoPath))
                <img src="{{ asset('images/gamelogos/' . $game->image) }}" alt="{{ $game->name }}" class="rounded-lg mb-5">
            @else
                <img src="{{ $fallbackPath }}" alt="{{ $game->name }}" class="rounded-lg mb-5">
            @endif
            <div class="mb-3">
                <label class="block text-lg font-semibold mb-2">{{__('rating')}}:</label>
                <div class="flex items-end">
                    <<<<<<< HEAD
                    @if ($averageRating !== __('not_rated'))
                        =======
                        @if ($averageRating !== null)
                            >>>>>>> e1042771b5f928992fd2428298abb97d6951e4fe
                            <p class="text-4xl text-blue-400">{{$averageRating}}⭐</p>
                            <p class="text-xl"> ({{$totalCount}} {{__('users')}})</p>
                        @else
                            <<<<<<< HEAD
                            <p>{{$averageRating}}</p>

                            =======
                            <p>__('not_rated')</p>

                            >>>>>>> e1042771b5f928992fd2428298abb97d6951e4fe
                        @endif

                </div>


            </div>

            @guest
                <p class="text-blue-500">{{__('login_to_add_game')}}</p>
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
                                <option value="1" {{ $userGameListEntry->status == 1 ? 'selected' : '' }}>{{__('status_playing')}}</option>
                                <option value="2" {{ $userGameListEntry->status == 2 ? 'selected' : '' }}>
                                    {{__('status_completed')}}</option>
                                <option value="3" {{ $userGameListEntry->status == 3 ? 'selected' : '' }}>{{__('status_on-hold')}}</option>
                                <option value="4" {{ $userGameListEntry->status == 4 ? 'selected' : '' }}>{{__('status_dropped')}}</option>
                                <option value="5" {{ $userGameListEntry->status == 5 ? 'selected' : '' }}>{{__('status_planned')}}</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="score" class="block text-lg font-semibold mb-2">Your Score:</label>
                            <select id="score" name="score" class="border rounded-md px-3 py-1 w-32">
                                <option value="">{{__('select')}}</option>
                                @for ($i = 1; $i <= 10; $i++)
                                    <option value="{{ $i }}" {{ $userGameListEntry->score == $i ? 'selected' : '' }}>{{ $i }} ⭐</option>
                                @endfor
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="favorite" class="block text-lg font-semibold mb-2 w-[164px]">{{__('add_favorite')}} :</label>
                            <input type="checkbox" id="favorite" name="favorite" value="1" class="border rounded-md px-3 py-1 mb-2" {{ $userGameListEntry->favorite ? 'checked' : '' }}>
                        </div>


                        <div class="flex">
                            <!-- Update button -->
                            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md mr-2 transition-all duration-150 ease-in-out hover:scale-110 hover:bg-green-600">
                                {{__('update')}}</button>

                            <!-- Delete form -->

                    </form>
                    <form action="{{ route('game-list.destroy') }}" method="POST">
                        @csrf
                        <!-- Hidden input to store game_list_id -->
                        <input type="hidden" name="game_list_id" value="{{ $userGameListEntry->id }}">
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md transition-all duration-150 ease-in-out hover:scale-110 hover:bg-red-600">
                            {{__('delete')}}</button>
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
                        <option value="">{{__('select')}}</option>
                        <option value="1">{{__('status_playing')}}</option>
                        <option value="2">{{__('status_completed')}}</option>
                        <option value="3">{{__('status_on-hold')}}</option>
                        <option value="4">{{__('status_dropped')}}</option>
                        <option value="5">{{__('status_planned')}}</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="score" class="block text-lg font-semibold mb-2">{{__('your_score')}} :</label>
                    <select id="score" name="score" class="border rounded-md px-3 py-1 w-32">
                        <option value="">{{__('select')}}</option>
                        @for ($i = 1; $i <= 10; $i++)
                            <option value="{{ $i }}">{{ $i }} ⭐</option>
                        @endfor
                    </select>
                </div>

                <div class="mb-3">
                    <label for="favorite" class="block text-lg font-semibold mb-2 w-[164px]">{{_('add_favorite')}} :</label>
                    <input type="checkbox" id="favorite" name="favorite" value="1" class="border rounded-md px-3 py-1 mb-2">
                </div>

                <!-- Add button -->
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md mb-3 transition-all duration-150 ease-in-out hover:scale-110 hover:bg-blue-600">
                    {{__('add')}}</button>
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
    <div class="w-3/4 relative">

        @if(Auth::check() && $current_user->hasRole(['Admin', 'Editor']))
            <div class="absolute top-0 right-0 flex space-x-2 mt-2 mr-2">




                <div id="ex4" class="modal">
                    <h2 class="text-lg font-bold">{{__('edit_game')}}</h2>
                    <form action="{{ route('game.edit') }}" method="POST" enctype="multipart/form-data" class="flex flex-col">
                        @csrf
                        <input type="hidden" name="game_id" value="{{ $game->id }}">
                        <label for="game_logo" class="text-gray-700 text-sm font-bold mb-2">{{__('game_logo')}} : </label>
                        <input type="file" name="game_logo" id="game_logo" class="border rounded w-full py-2 px-3">
                        <label for="title" class="text-gray-700 text-sm font-bold mt-2">{{__('title')}} : </label>
                        <input type="text" id="title" name="title"  placeholder="{{__('title')}}" value="{{ $game->name }}" required/>
                        <label for="descr" class="text-gray-700 text-sm font-bold mt-2">{{__('description')}} : </label>
                        <input type="text" id="descr" name="descr"  placeholder="{{__('description')}}" value="{{ $game->description }}" required/>
                        <label for="genre" class="text-gray-700 text-sm font-bold mt-2">{{__('genre')}} : </label>
                        <input type="text" id="genre" name="genre" placeholder="{{__('genre')}}" value="{{ $game->genre }}" required/>
                        <label for="reldate" class="text-gray-700 text-sm font-bold mt-2">{{__('game_release')}} : </label>
                        <input type="text" id="reldate" name="reldate" placeholder="{{__('yyyy-mm-dd')}}" value="{{ $game->release_date }}" required/>
                        <label for="dev" class="text-gray-700 text-sm font-bold mt-2">{{__('developer')}} : </label>
                        <input type="text" id="dev" name="dev" placeholder="{{__('developer')}}" value="{{ $game->developer }}" required/>
                        <button type="submit" class="bg-blue-500 text-white rounded-md text-nowrap flex size-fit m-2 ml-0 px-2 py-2 transition-all duration-150 ease-in-out hover:scale-110 hover:bg-blue-600">
                            {{__('edit_game')}}</button>
                    </form>
                </div>
                <a href="#ex4" rel="modal:open"><button class="bg-green-500 text-white px-4 py-2 rounded-md mr-2 transition-all duration-150 ease-in-out hover:scale-110 hover:bg-green-600">
                        {{__('edit_game')}}
                    </button></a>


                <form action="{{ route('game.delete') }}" method="POST">
                    @csrf
                    <input type="hidden" name="game_id" value="{{ $game->id }}">
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md transition-all duration-150 ease-in-out hover:scale-110 hover:bg-red-900">
                        {{__('game_delete')}}</button>
                </form>
            </div>
        @endif

        <h2 class="font-bold text-3xl mb-3">{{ $game->name }}</h2>
        <div class="mb-3">
            <label class="block text-lg font-semibold mb-2">{{__('game_release')}} :</label>
            <p>{{ $game->release_date }}</p>
        </div>
        <div class="mb-3">
            <label class="block text-lg font-semibold mb-2">{{__('genre')}} :</label>
            <p>{{ $game->genre }}</p>
        </div>
        <div class="mb-3">
            <label class="block text-lg font-semibold mb-2">{{__('developer')}} :</label>
            <p>{{ $game->developer }}</p>
        </div>
        <div>
            <label class="block text-lg font-semibold mb-2">{{__('description')}} :</label>
            <p>{{ $game->description }}</p>
        </div>
    </div>
    {{--    Write review button and review menu--}}
    @auth
        @php($userid = auth()->id())
        @if(!$reviews->contains('user_id', $userid))
            <div id="ex1" class="modal">
                <h2 class="text-lg font-bold">{{__('review_of')}} {{$game->name}}</h2>
                <form action="{{ route('reviews.store') }}" method="POST" class="flex flex-col">
                    @csrf
                    <input type="hidden" name="game_id" value="{{ $game->id }}"/>
                    <input type="hidden" name="user_id" value="{{ $userid }}"/>
                    <input type="hidden" name="isCritic" value="{{ $current_user->hasRole('Critic') }}"/>
                    <select id="reviewRating" name="rating" class="border rounded-md px-3 py-1 w-32 m-5" required>
                        <option>{{__('select')}}</option>
                        @for ($i = 1; $i <= 10; $i++)
                            <option value="{{ $i }}">{{ $i }} ⭐</option>
                        @endfor
                    </select>
                    <input type="text" id="reviewText" name="text" class="m-5" placeholder="{{__('placeholder_for_review')}}"></input>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md ml-5 mb-3 text-nowrap m-auto transition-all duration-150 ease-in-out hover:scale-110 hover:bg-blue-600">
                        {{__('post_review')}}</button>
                </form>
            </div>
            <div class="absolute bottom-4 right-6">
                <a href="#ex1" rel="modal:open"><button class="bg-blue-500 text-white px-4 py-2 rounded-md mb-3 text-nowrap transition-all duration-150 ease-in-out hover:scale-110 hover:bg-blue-600">
                        {{__('write_review')}}</button></a>
            </div>
        @else
            <div id="ex2" class="modal">
                <h2 class="text-lg font-bold">{{__('review_of')}} {{$game->name}}</h2>
                <form action="{{ route('reviews.update') }}" method="POST" class="flex flex-col">
                    @csrf
                    <input type="hidden" name="game_id" value="{{ $game->id }}"/>
                    <input type="hidden" name="user_id" value="{{ $userid }}"/>
                    <input type="hidden" name="isCritic" value="{{ $current_user->hasRole('Critic') }}"/>

                    <select id="reviewRating" name="rating" class="border rounded-md px-3 py-1 w-32 m-5" required>
                        <option value="">{{__('select')}}</option>
                        @for ($i = 1; $i <= 10; $i++)
                            <option value="{{ $i }}" {{ $userReview->rating == $i ? 'selected' : '' }}>{{ $i }} ⭐</option>
                        @endfor
                    </select>
                    <input type="text" id="reviewText" name="text" class="m-5" placeholder="{{__('placeholder_for_review')}}" value="{{ $userReview->text }}"/>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md ml-5 mb-3 text-nowrap m-auto transition-all duration-150 ease-in-out hover:scale-110 hover:bg-blue-600">
                        {{__('edit_review')}}</button>
                </form>
            </div>
            <div class="absolute bottom-4 right-6">
                <a href="#ex2" rel="modal:open"><button class="bg-blue-500 text-white px-4 py-2 rounded-md mb-3 text-nowrap transition-all duration-150 ease-in-out hover:scale-110 hover:bg-blue-600">{{__('edit_review')}}</button></a>
            </div>
            <div class="absolute bottom-20 right-6">
                <form action="{{ route('reviews.destroy') }}" method="POST">
                    @csrf
                    <input type="hidden" name="game_id" value="{{ $game->id }}"/>
                    <input type="hidden" name="user_id" value="{{ $userid }}"/>
                    <input type="hidden" name="current_user_id" value="{{ $current_user->id }}"/>
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md mb-3 text-nowrap transition-all duration-150 ease-in-out hover:scale-110 hover:bg-red-900">
                        {{__('delete_review')}}</button>
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
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md mb-3 text-nowrap transition-all duration-150 ease-in-out hover:scale-110 hover:bg-red-900">{{__('delete_review')}}</button>
                            </form>
                        @endif
                        <h1 class="text-end">{{__('review')}}: {{$review->rating}} ⭐</h1>

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
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md mb-3 text-nowrap transition-all duration-150 ease-in-out hover:scale-110 hover:bg-red-900">{{__('delete_review')}}</button>
                            </form>
                        @endif
                        <h1 class="text-end">{{__('rating')}}: {{$review->rating}} ⭐</h1>
                    </div>
                @endif
            @endforeach
</x-layout>
