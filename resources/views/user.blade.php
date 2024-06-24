<x-layout>
    @php($current_user = auth()->user())
    @php($userid = $current_user->id)

    <div class="container rounded-3xl shadow-inner p-5 pl-8 flex h-[500px] w-[1200px]">
        {{-- Left Column: Avatar and Upload Avatar Button --}}
        <div class="flex flex-col items-center mr-8">
            {{-- Avatar --}}
            <img src="{{ asset('images/websitelogo/logo.png') }}" alt="Avatar" class="rounded-full h-[225px] w-[225px] mb-4">

            {{-- Upload Avatar Button --}}
            @auth
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

            {{-- Role --}}
            <p class="text-gray-600 mb-4">Role: {{$user->getRoleNames()[0]}}</p>
        </div>

        {{-- Right Column: Navigation Buttons --}}
        <div class="flex flex-col justify-between items-end relative">
            {{-- Top Right Buttons: Gamelist and Reviews --}}
            <div class="flex">
            <a href="{{ route('game-list.index', ['id' => $user->id]) }}">
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
                    <div class="flex flex-wrap gap-2">
                    <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                        Edit Profile
                    </button>
                @endif
                    @if(Auth::check() && $current_user->hasRole(['Admin']))
                        <form action="{{ route('role.change') }}" method="POST" class="">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}"/>
                            <input type="hidden" name="current_user_id" value="{{ $userid }}"/>
                            <select name="role_name" class="rounded">
                                <option value="Verified user">
                                    Verified User
                                </option>
                                <option value="Critic">
                                    Critic
                                </option>
                                <option value="Editor">
                                    Editor
                                </option>
                                <option value="Moderator">
                                    Moderator
                                </option>
                                <option value="Admin">
                                    Admin
                                </option>
                            </select>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded text-nowrap font-bold">Change Role</button>
                        </form>
                    @endif
            @endauth
                    </div>
        </div>
    </div>
</x-layout>
