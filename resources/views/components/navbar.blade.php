    <header class="fixed top-0 left-0 w-full bg-gradient-to-r from-blue-100 to-blue-900 shadow-lg flex items-center p-4 z-50">
        <div class="flex items-center space-x-2">
            <a href="{{ route('main') }}" class="text-lg">
                <button class="rounded-full text-lg text-white bg-blue-400 p-1 px-3 border-2 border-white transition-all duration-150 ease-in-out hover:scale-110 hover:bg-blue-600">
                    {{__('games')}}</button>
            </a>
            <a href="{{route('user.index')}}" class="text-lg">
                <button class="rounded-full text-lg text-white bg-blue-400 p-1 px-3 border-2 border-white transition-all duration-150 ease-in-out hover:scale-110 hover:bg-blue-600">
                    {{__('users')}}</button>
            </a>
            <a href="/locale/en">
                <button class="rounded-full text-lg text-white bg-blue-400 p-1 px-3 border-2 border-white transition-all duration-150 ease-in-out hover:scale-110 hover:bg-blue-600"><span class="fi fi-gb"></span></button>
            </a>
            <a href="/locale/lv">
                <button class="rounded-full text-lg text-white bg-blue-400 p-1 px-3 border-2 border-white transition-all duration-150 ease-in-out hover:scale-110 hover:bg-blue-600"><span class="fi fi-lv"></span></button>
            </a>
            <a href="/locale/ru">
                <button class="rounded-full text-lg text-white bg-blue-400 p-1 px-3 border-2 border-white transition-all duration-150 ease-in-out hover:scale-110 hover:bg-blue-600"><span class="fi fi-ru"></span></button>
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
                <input class="rounded-full p-1 px-2" type="text" name="search" placeholder="{{__('game_search')}}" required>
                <button class="rounded-full text-lg text-white bg-blue-400 p-1 px-3 border-2 border-white transition-all duration-150 ease-in-out hover:scale-110 hover:bg-blue-600" type="submit">
                    {{__('search')}}</button>
            </form>

            <nav>
                <ul class="flex items-center space-x-2">
                    @guest
                    <li>
                        <a href="{{ route('login') }}">
                            <button class="rounded-full text-lg text-white bg-blue-400 p-1 px-3 border-2 border-white transition-all duration-150 ease-in-out hover:scale-110 hover:bg-blue-600">
                                {{__('login')}}</button>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('register') }}">
                            <button class="rounded-full text-lg text-white bg-blue-400 p-1 px-3 border-2 border-white transition-all duration-150 ease-in-out hover:scale-110 hover:bg-blue-600">
                                {{__('register')}}</button>
                        </a>
                    </li>
                    @else
                    <li>
                    <a href="{{ route('game-list.index', ['id' => Auth::id()]) }}">
                            <button class="rounded-full text-lg text-white bg-blue-400 p-1 px-3 border-2 border-white transition-all duration-150 ease-in-out hover:scale-110 hover:bg-blue-600">
                                {{__('game_list')}}</button>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user.show', ['id' => Auth::id()]) }}">
                            <button class="rounded-full text-lg text-white bg-blue-400 p-1 px-3 border-2 border-white transition-all duration-150 ease-in-out hover:scale-110 hover:bg-blue-600">
                                {{__('profile')}}</button>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <button class="rounded-full text-lg text-white bg-blue-400 p-1 px-3 border-2 border-white transition-all duration-150 ease-in-out hover:scale-110 hover:bg-blue-600">
                                {{__('logout')}}</button>
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
