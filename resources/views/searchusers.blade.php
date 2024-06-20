<x-layout>
    <form action="{{ route('user.search') }}" method="GET" class="absolute top-24 right-4 items-center space-x-2">
        <input class="rounded-full p-1 px-2" type="text" name="search" placeholder="Search for a user..." required>
        <button class="rounded-full text-lg text-white bg-blue-400 p-1 px-3 border-2 border-white" type="submit">Search</button>
    </form>
    <div class="space-x-2 space-y-2 m-5">
        @foreach ($users as $user)
            <div class="container inline-flex p-4 border size-fit rounded-lg shadow-inner">
                <a href="{{ route('user.show', ['id' => $user->id]) }}" class="flex items-center">
                    <img src="{{ asset('images/websitelogo/logo.png') }}" class="w-20 h-20 rounded-full">
                    <h1 class="text-lg">{{ $user->name }}</h1>
                </a>
            </div>
        @endforeach
    </div>
</x-layout>
