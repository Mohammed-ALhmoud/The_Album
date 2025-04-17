<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>The Album</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-[#2d3250] text-[#ffffff]">
    
    <div class="px-10">
        <nav class="flex justify-between items-center py-4 border-b border-[#ffffff]/10">
            <div>
                <a href="/">
                    <img src="{{ Vite::asset('resources/images/logo.svg') }}"
                         alt="Logo"
                         class="h-8 w-auto"
                         style="height: 36px; width: auto;">
                </a>
            </div>

            <div class="space-x-6 font-bold">
                <a href="#">Home</a>
                <a href="#">Albums</a>
                <a href="#">Upload</a>
                <a href="#">Explore</a>
            </div>

            @guest
                <div class="space-x-6 font-bold">
                    <a href='/login' class="bg-primary hover:bg-primary/80 text-white px-4 py-2 rounded-lg transition">Log In</a>
                    <a href='/register' class="bg-primary hover:bg-primary/80 text-white px-4 py-2 rounded-lg transition">Sign Up</a>
                </div>
            @endguest

            @auth
                <div class="flex items-center space-x-4">
                    <a href="{{ route('profile.edit') }}" class="bg-[#ffffff]/10 hover:bg-[#f9b17a] hover:text-[#2d3250] px-3 py-1 rounded-xl font-bold transition-colors duration-300">
                        My Profile
                    </a>

                    <a href="/photos/create" class="bg-primary hover:bg-primary/80 text-white px-4 py-2 rounded-lg transition">
                        Post a Photo
                    </a>

                    <form method="POST" action="/logout" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-primary hover:bg-primary/80 text-white px-4 py-2 rounded-lg transition">
                            Log Out
                        </button>
                    </form>
                </div>
            @endauth
        </nav>

        <main class="mt-10 max-w-[986px] mx-auto">
            {{ $slot }}
        </main>
    </div>
</body>
</html>
