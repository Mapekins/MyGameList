<x-layout>
<div class="container rounded-3xl shadow-inner p-5 pl-8 flex ">
    <!-- Left Part -->
    <div class="w-1/4 pr-8 leftgame">
        <img src="{{ asset('images/gamelogos/' . $game->image) }}" alt="{{ $game->name }}" class="rounded-lg mb-5">
        <div class="mb-3">
            <label class="block text-lg font-semibold mb-2">Rating:</label>
            <p>{{ $game->rating }}</p>
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
                    <option value="{{ $i }}">{{ $i }}</option>
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
</div>
{{-- Reviews --}}
    @foreach ($reviews as $review)
           @php($user = $users->firstWhere('id', $review->user_id))
{{--BIG container--}}
    <div class="container rounded-3xl shadow-inner mt-4 p-5 pl-8 flex-fill flex flex-col justify-between">
{{--Left Container--}}
        <div class="flex items-start items-center m-0 mr-4 mb-4">
        <a href="{{ route('user', ['id' => $user->id]) }}" class="flex items-center">
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
        <h1 class="text-end">Rating: {{$review->rating}}</h1>
    </div>
    @endforeach
</x-layout>
