    <header class="fixed top-0 left-0 w-full bg-gradient-to-r from-blue-100 to-blue-900 shadow-lg flex items-center p-4 z-50">
        <div class="flex items-center space-x-2">
            <a href="{{ route('main') }}" class="text-lg">
                <button class="rounded-full text-lg text-white bg-blue-400 p-1 px-3 border-2 border-white">Games</button>
            </a>
            <a href="{{route('user.index')}}" class="text-lg">
                <button class="rounded-full text-lg text-white bg-blue-400 p-1 px-3 border-2 border-white">Users</button>
            </a>
        </div>
        <div class="absolute left-1/2 transform -translate-x-1/2">
            <a href="{{ route('main') }}" class="flex items-center logo-link">
               <img src="{{ asset('images/websitelogo/logo.png') }}" alt="MyGameList Logo" class="logo-image">
                <h1 class="text-4xl font-bold text-white">MyGameList</h1>
            </a>
        </div>
        <div class="flex items-center space-x-4 ml-auto">
            <form action="{{ route('game.search') }}" method="GET" class="flex items-center space-x-2">
                <input class="rounded-full p-1 px-2" type="text" name="search" placeholder="Search for a game..." required>
                <button class="rounded-full text-lg text-white bg-blue-400 p-1 px-3 border-2 border-white" type="submit">Search</button>
            </form>
            <div>
                <select class="text-lg text-black rounded-full pl-3 p-1 pr-9">
                    <option value="en" class="text-lg text-black">English</option>
                    <option value="lv" class="text-lg text-black">Latvian</option>
                    <option value="ru" class="text-lg text-black">Russian</option>
                </select>
            </div>
            <nav>
                <ul class="flex items-center space-x-2">
                    @guest
                    <li>
                        <a href="{{ route('login') }}">
                            <button class="rounded-full text-lg text-white bg-blue-400 p-1 px-3 border-2 border-white">Login</button>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('register') }}">
                            <button class="rounded-full text-lg text-white bg-blue-400 p-1 px-3 border-2 border-white">Register</button>
                        </a>
                    </li>
                    @else
                    <li>
                    <a href="{{ route('game-list.index', ['id' => Auth::id()]) }}">
                            <button class="rounded-full text-lg text-white bg-blue-400 p-1 px-3 border-2 border-white">Game List</button>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user.show', ['id' => Auth::id()]) }}">
                            <button class="rounded-full text-lg text-white bg-blue-400 p-1 px-3 border-2 border-white">Profile</button>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <button class="rounded-full text-lg text-white bg-blue-400 p-1 px-3 border-2 border-white">Logout</button>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                    </li>
                    @endguest
                </ul>
            </nav>
        </div>
    </header>
