<header class="fixed top-0 left-0 w-full bg-white shadow-lg flex justify-between items-center p-4 rounded sticky-top bg-gradient-to-r from-blue-100 via-fuchsia-800 to-blue-900">
        <div class="flex-start space-x-2">
            <a href="{{ route('main') }}" class="text-lg"><button class="rounded-full text-lg text-white bg-blue-400 p-0 px-3 border-2 border-white">Games</button></a>
            <a href="#" class="text-lg"><button class="rounded-full text-lg text-white bg-blue-400 p-0 px-3 mb-1 border-2 border-white">Users</button></a>
        </div>
        <div class="flex-grow text-center">
            <a href="{{ route('main') }}" class="logo-link">
                <h1 class="text-4xl font-bold">MyGameList</h1>
            </a>
        </div>
        <div class="flex items-center space-x-2 m-0">
            <div>
                <form method="GET">
                    <input class="rounded-full m-0 p-1 px-2" type="text" name="search" placeholder="Search for a game...">
                    <button class="rounded-full text-lg text-white bg-blue-400 p-0 px-3 border-2 border-white" type="submit">Search</button>
                </form>
            </div>
            <div class="">
                <select class="text-lg text-black rounded-full m-0 pr-8 pt-0.5 pb-0.5">
                    <option value="en" class="text-lg text-black">English</option>
                    <option value="lv" class="text-lg text-black">Latvian</option>
                    <option value="ru" class="text-lg text-black">Russian</option>
                </select>
            </div>
            <nav>
                <ul>
                    @guest
                    <li>
                        <a href="{{ route('login') }}"><button class="rounded-full text-lg text-white bg-blue-400 p-0 px-3 mb-1 border-2 border-white">Login</button></a>
                    </li>
                        <li>
                            <a href="{{ route('register') }}"><button class="rounded-full text-lg text-white bg-blue-400 p-0 px-3 mt-1 border-2 border-white">Register</button></a>
                        </li>
                    @else
                    <li><a href="#" ><button class="rounded-full text-lg text-white bg-blue-400 mb-1 p-0 px-3 border-2 border-white" type="submit">Game List</button></a></li>
                    <li><a href="#" ><button class="rounded-full text-lg text-white bg-blue-400 mt-1 mb-1 p-0 px-3 border-2 border-white" type="submit">Profile</button></a></li>
                    <li>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            <button class="rounded-full text-lg text-white bg-blue-400 mt-1 p-0 px-3 border-2 border-white" type="submit">Logout</button>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                        </form>
                    </li>
                    @endguest
                </ul>
            </nav>
        </div>
</header>
