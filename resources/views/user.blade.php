<x-layout>
    <div class="container rounded-3xl shadow-inner p-5 pl-8 flex h-[500px] w-[1200px]">
        {{-- Left Column: Avatar and Upload Avatar Button --}}
        <div class="flex flex-col items-center mr-8">
            {{-- Avatar --}}
            <img src="{{ asset('images/websitelogo/logo.png') }}" alt="Avatar" class="rounded-full h-[225px] w-[225px] mb-4">

            {{-- Upload Avatar Button --}}
            @auth
                @php($userid = auth()->id())
                @if($user->id == $userid)
            <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                Upload Avatar
            </button>
                @endif
            @endauth
        </div>

        {{-- Middle Column: Username, UserID, Email, Role --}}
        <div class="flex-1">
            {{-- Username --}}
            <h1 class="text-3xl font-bold mb-3">{{ $user->name }}</h1>

            {{-- User ID --}}
            <p class="text-gray-600 mb-2 mt-2">User ID: {{ $user->id }}</p>

            {{-- Email --}}
            <p class="text-gray-600 mb-2">Email: {{ $user->email }}</p>

            {{-- Role (assuming it's a static text for now) --}}
            <p class="text-gray-600 mb-4">Role: {{$user->getRoleNames()[0]}}</p>
        </div>

        {{-- Right Column: Navigation Buttons --}}
        <div class="flex flex-col justify-between items-end">
            {{-- Top Right Buttons: Gamelist and Reviews --}}
            <div class="flex">
            <a href="{{ route('game-list.index') }}">
                <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mr-2">
                    Gamelist
                </button>
                </a>
                <div id="ex1" class="modal">
                    <h2 class="text-lg font-bold">{{$user->name}}'s reviews  </h2>
                    @foreach($reviews as $review)
                        <div class="size-fit m-2 p-2">
                            @php($game = $games->firstWhere('id', $review->game_id))
                            <h1>{{$game->name}} <span>| {{$review->rating}} ⭐</span></h1>
                            <p>{{$review->text}}</p>
                        </div>
                    @endforeach
                </div>
                <a href="#ex1" rel="modal:open"><button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Reviews</button></a>
            </div>
            {{-- Bottom Right Button: Edit Profile --}}
            @auth
                @if($user->id == $userid)
            <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold mt-4 py-2 px-4 rounded ">
                Edit Profile
            </button>
                @endif
            @endauth
        </div>
    </div>
</x-layout>
