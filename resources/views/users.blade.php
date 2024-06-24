<x-layout class="flex-end">
    <form action="{{ route('user.search') }}" method="GET" class="absolute top-24 right-4 items-center space-x-2">
        <input class="rounded-full p-1 px-2" type="text" name="search" placeholder="Search for a user..." required>
        <button class="rounded-full text-lg text-white bg-blue-400 p-1 px-3 border-2 border-white transition-all duration-150 ease-in-out hover:scale-110 hover:bg-blue-600" type="submit">Search</button>
    </form>
    <div class="flex justify-center">
    <div class="container p-4 border rounded-lg shadow-inner m-5">
        <div class="game-gallery grid grid-cols-9 gap-4">
            @foreach ($users as $user)
                <div class="text-center border rounded-lg shadow p-1">
                    <a href="{{ route('user.show', ['id' => $user->id]) }}" class="flex flex-col items-center transition-all duration-150 ease-in-out hover:scale-110">
                        @if($user->profile_picture)
                            <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="{{ $user->name }}" class="rounded-full w-20 h-20">
                        @else
                            <img src="{{ asset('images/websitelogo/logo.png') }}" alt="Avatar" class="rounded-full w-20 h-20">
                        @endif
                        <p class="text-lg">{{ $user->name }}</p>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
</x-layout>
