<x-layout>
<div class="container relative rounded-3xl shadow-inner p-5 pl-8 flex">
    <!-- Left Part -->
    <div class="w-1/4 pr-8 leftgame">
        <img src="{{ asset('images/gamelogos/' . $game->image) }}" alt="{{ $game->name }}" class="rounded-lg mb-5">
        <div class="mb-3">
            <label class="block text-lg font-semibold mb-2">Rating:</label>
            @php($count = 0)
            @php($sum = 0)
            @foreach($reviews as $review)
                @php($count++)
                @php($sum += $review->rating)
            @endforeach
            @if($count == 0)
                <p>Not yet rated! :(</p>
            @else
            @php($rating = number_format($sum / $count, 2, ','))
                <p class="text-4xl text-blue-400">{{$rating}}⭐</p>
            @endif
        </div>
        <div class="mb-3">
            <label for="status" class="block text-lg font-semibold mb-2">Status:</label>
            <select id="status" class="border rounded-md px-3 py-1 w-32">
                <option value="">Select</option>
                <option value="playing">Playing</option>
                <option value="completed">Completed</option>
                <option value="on-hold">On Hold</option>
                <option value="dropped">Dropped</option>
                <option value="plan-to-play">Plan to Play</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="score" class="block text-lg font-semibold mb-2">Your Score:</label>
            <select id="score" class="border rounded-md px-3 py-1 w-32">
                <option value="">Select</option>
                @for ($i = 1; $i <= 10; $i++)
                    <option value="{{ $i }}">{{ $i }} ⭐</option>
                @endfor
            </select>
        </div>
        <button class="bg-blue-500 text-white px-4 py-2 rounded-md mb-3">Add</button>
        <button class="bg-green-500 text-white px-4 py-2 rounded-md">Add to Favorites</button>
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
        @if(!$reviews->contains('user_id',$userid))
        <x-modal name="ReviewModal" :show="true">
            <h2 class="text-lg font-bold">Review of {{$game->name}}</h2>
            <form action="{{ route('reviews.store') }}" method="POST" class="flex flex-col">
                @csrf
                <input type="hidden" name="game_id" value="{{ $game->id }}"/>
                <input type="hidden" name="user_id" value="{{ $userid }}"/>
                <select id="reviewRating" name="rating" class="border rounded-md px-3 py-1 w-32 m-5 required">
                    <option>Select</option>
                    @for ($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}">{{ $i }} ⭐</option>
                    @endfor
                </select>
                <input type="text" id="reviewText" name="text" class="m-5" placeholder="Ohhh... What a great game!"></input>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md ml-5 mb-3 text-nowrap m-auto">Post review</button>
            </form>
            <button @click="$dispatch('close-modal', 'ReviewModal')" class="bg-blue-500 text-white px-4 py-2 rounded-md ml-5 mb-3 text-nowrap absolute right-2 bottom-2">Close</button>
        </x-modal>
        <div class="absolute bottom-4 right-6">
            <button @click="$dispatch('open-modal', 'ReviewModal')" class="bg-blue-500 text-white px-4 py-2 rounded-md mb-3 text-nowrap">Write Review</button>
        </div>
        @else
            <x-modal name="EditReviewModal" :show="false">
                <h2 class="text-lg font-bold">Review of {{$game->name}}</h2>
                <form action="{{ route('reviews.update') }}" method="POST" class="flex flex-col">
                    @csrf
                    <input type="hidden" name="game_id" value="{{ $game->id }}"/>
                    <input type="hidden" name="user_id" value="{{ $userid }}"/>
                    <select id="reviewRating" name="rating" class="border rounded-md px-3 py-1 w-32 m-5">
                        <option value="">Select</option>
                        @for ($i = 1; $i <= 10; $i++)
                            <option value="{{ $i }}">{{ $i }} ⭐</option>
                        @endfor
                    </select>
                    <input type="text" id="reviewText" name="text" class="m-5" placeholder="Ohhh... What a great game!"></input>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md ml-5 mb-3 text-nowrap m-auto">Post review</button>
                </form>
                <button @click="$dispatch('close-modal', 'EditReviewModal')" class="bg-blue-500 text-white px-4 py-2 rounded-md ml-5 mb-3 text-nowrap absolute right-2 bottom-2">Close</button>
            </x-modal>
            <div class="absolute bottom-4 right-6">
                <button @click="$dispatch('open-modal', 'EditReviewModal')" class="bg-blue-500 text-white px-4 py-2 rounded-md mb-3 text-nowrap">Edit Review</button>
            </div>
            <div class="absolute bottom-20 right-6">
                <form action="{{ route('reviews.destroy') }}" method="POST">
                    @csrf
                    <input type="hidden" name="game_id" value="{{ $game->id }}"/>
                    <input type="hidden" name="user_id" value="{{ $userid }}"/>
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md mb-3 text-nowrap">Delete Review</button>
                </form>
            </div>
        @endif
    @endauth
</div>

{{-- Reviews --}}
    @foreach ($reviews as $review)
           @php($user = $users->firstWhere('id', $review->user_id))
{{--BIG container--}}
    <div class="container rounded-3xl shadow-inner mt-4 p-5 pl-8 flex-fill flex flex-col justify-between">
{{--Left Container--}}
        <div class="flex items-start items-center m-0 mr-4 mb-4">
        <a href="{{ route('user.show', ['id' => $user->id]) }}" class="flex items-center">
                    <img src="{{ asset('images/websitelogo/logo.png') }}" class="size-20 rounded-full">
                    <h1 class="ml-2">{{ $user->name }}</h1>
                </a>
        </div>
{{--        Right Container--}}
        <div class="">
            <p class="text-gray-600 text-lg">
                {{$review->text}}
            </p>
        </div>
        <h1 class="text-end">Rating: {{$review->rating}} ⭐</h1>
    </div>
    @endforeach
</x-layout>
