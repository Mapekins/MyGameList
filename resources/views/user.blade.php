<x-layout>
    @php($current_user = auth()->user())
    @php($userid = auth()->id())
    @if (session('success'))
        <div class="container size-fit bg-green-600 text-white p-4 rounded-md mb-4 font-bold transition-all duration-150 ease-in-out hover:scale-110 hover:bg-green-700">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="container size-fit bg-red-500 text-white p-4 rounded-md mb-4 font-bold transition-all duration-150 ease-in-out hover:scale-110 hover:bg-red-900">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container rounded-3xl shadow-inner p-5 pl-8 flex h-[500px] w-[1200px]">
{{-- Massege to user about password--}}
        {{-- Left Column: Avatar and Upload Avatar Button --}}
        <div class="flex flex-col items-center mr-8 relative">
            {{-- Avatar --}}
            @if($user->profile_picture)
                <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="{{ $user->name }}" class="h-[225px] w-[225px]">
            @else
                <img src="{{ asset('images/websitelogo/logo.png') }}" alt="Avatar" class="h-[225px] w-[225px]">
            @endif

            @if(Auth::check() && $current_user->hasRole(['Admin', 'Editor']))
            <div id="ex3" class="modal">
                        <h2 class="text-lg font-bold">{{__('create_game')}}</h2>
                            <form action="{{ route('game.create') }}" method="POST" enctype="multipart/form-data" class="flex flex-col">
                                @csrf
                                <label for="game_logo" class="text-gray-700 text-sm font-bold mb-2">{{__('game_logo')}} : </label>
                                <input type="file" name="game_logo" id="game_logo" class="border rounded w-full py-2 px-3">
                                <label for="title" class="text-gray-700 text-sm font-bold mt-2">{{__('title')}} : </label>
                                <input type="text" id="title" name="title"  placeholder="{{__('title')}}" required/>
                                <label for="descr" class="text-gray-700 text-sm font-bold mt-2">{{__('description')}} : </label>
                                <input type="text" id="descr" name="descr"  placeholder="{{__('description')}}" required/>
                                <label for="genre" class="text-gray-700 text-sm font-bold mt-2">{{__('genre')}}: </label>
                                <input type="text" id="genre" name="genre" placeholder="{{__('genre')}}" required/>
                                <label for="reldate" class="text-gray-700 text-sm font-bold mt-2">{{__('game_release')}} : </label>
                                <input type="text" id="reldate" name="reldate" placeholder="{{__('yyyy-mm-dd')}}" required/>
                                <label for="dev" class="text-gray-700 text-sm font-bold mt-2">{{__('developer')}} : </label>
                                <input type="text" id="dev" name="dev" placeholder="{{__('developer')}}" required/>
                                <button type="submit" class="bg-blue-500 text-white rounded-md text-nowrap flex size-fit m-2 ml-0 px-2 py-2 transition-all duration-150 ease-in-out hover:scale-110 hover:bg-blue-600">{{__('create_game')}}</button>
                            </form>
                    </div>
                        <a href="#ex3" rel="modal:open"><button class="absolute bottom-0 left-0 bg-blue-500 text-white font-bold py-2 px-4 rounded transition-all duration-150 ease-in-out hover:scale-110 hover:bg-blue-600">
                            {{__('add_game')}}
                    </button></a>

            @endif

        </div>
        {{-- Middle Column: Username, UserID, Email, Role --}}
        <div class="flex-1">
            {{-- Username --}}
            <h1 class="text-3xl font-bold mb-3">{{ $user->name }}</h1>

            {{-- User ID --}}
            <p class="text-gray-600 mb-2 mt-2">{{__('user_id')}} : {{ $user->id }}</p>

            {{-- Email --}}
            <p class="text-gray-600 mb-2">{{__('email')}} : {{ $user->email }}</p>

            {{-- Role --}}
            <p class="text-gray-600 mb-4">{{__('role')}} : {{$user->getRoleNames()[0]}}</p>
        </div>

        {{-- Right Column: Navigation Buttons --}}
        <div class="flex flex-col justify-between items-end relative">
            {{-- Top Right Buttons: Gamelist and Reviews --}}
            <div class="flex">
            <a href="{{ route('game-list.index', ['id' => $user->id]) }}">
                <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mr-2 transition-all duration-150 ease-in-out hover:scale-110 hover:bg-blue-600">
                    {{__('game_list')}}
                </button>
                </a>
                <div id="ex1" class="modal">
                    <h2 class="text-lg font-bold">{{$user->name}}  {{__('s_reviews')}}  </h2>
                    @foreach($reviews as $review)
                        <div class="size-fit m-2 p-2">
                            @php($game = $games->firstWhere('id', $review->game_id))
                            <h1>{{$game->name}} <span>| {{$review->rating}} ⭐</span></h1>
                            <p>{{$review->text}}</p>
                        </div>
                    @endforeach
                </div>
                <a href="#ex1" rel="modal:open"><button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded transition-all duration-150 ease-in-out hover:scale-110 hover:bg-blue-600">
                    {{__('reviews')}}</button></a>
            </div>
            {{-- Bottom Right Button: Edit Profile --}}
            @auth
                @if($user->id == $userid)
                    <div id="ex2" class="modal">
                        <h2 class="text-lg font-bold">{{__('editing_profile')}}</h2>
                            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="flex flex-col">
                                @csrf
                                <label for="profile_picture" class="text-gray-700 text-sm font-bold mb-2">{{__('profile_picture')}} : </label>
                                <input type="file" name="profile_picture" id="profile_picture" class="border rounded w-full py-2 px-3">
                                <label for="name" class="text-gray-700 text-sm font-bold mt-2">{{__('new_username')}} : </label>
                                <input type="text" id="name" name="name"  placeholder="{{__('leave_same')}}" value=""/>
                                <label for="email" class="text-gray-700 text-sm font-bold mt-2">{{__('new_email')}} : </label>
                                <input type="text" id="email" name="email"  placeholder="{{__('leave_same')}}" value=""/>
                                <label for="current_password" class="text-gray-700 text-sm font-bold mt-2">{{__('cur_password')}}: </label>
                                <input type="password" id="current_password" name="current_password" placeholder="{{__('required_pass')}}" value="" required/>
                                <label for="new_password" class="text-gray-700 text-sm font-bold mt-2">{{__('new_password')}} : </label>
                                <input type="password" id="new_password" name="new_password" placeholder="{{__('leave_same')}}" value=""/>
                                <label for="new_password_confirmation" class="text-gray-700 text-sm font-bold mt-2">{{__('rep_password')}}: </label>
                                <input type="password" id="new_password_confirmation" name="new_password_confirmation"  placeholder="{{__('leave_same')}}" value=""/>
                                <button type="submit" class="bg-blue-500 text-white rounded-md text-nowrap flex size-fit m-2 ml-0 px-2 py-2 transition-all duration-150 ease-in-out hover:scale-110 hover:bg-blue-600">
                                    {{__('save_changes')}}</button>
                            </form>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <a href="#ex2" rel="modal:open"><button class="bg-blue-500 text-white font-bold py-2 px-4 rounded transition-all duration-150 ease-in-out hover:scale-110 hover:bg-blue-600">
                            {{__('edit_profile')}}
                    </button></a>
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
                        <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded text-nowrap transition-all duration-150 ease-in-out hover:scale-110 hover:bg-blue-600">
                            {{__('change_role')}}</button>
                    </form>
                @endif
                </div>
            @endauth
        </div>
    </div>
</x-layout>
