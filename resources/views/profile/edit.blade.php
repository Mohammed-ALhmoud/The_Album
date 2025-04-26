<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-[#2d3250] text-white min-h-screen flex flex-col items-center justify-center">

    <div class="w-full max-w-md p-8 bg-[#424769] rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold text-center mb-6">Edit Your Profile</h1>

        @if (session('status') === 'profile-updated')
            <div class="bg-green-600 p-3 rounded mb-4 text-center">
                Profile updated successfully!
            </div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}" class="space-y-4">
            @csrf
            @method('PATCH')

            <div>
                <label for="name" class="block mb-1">Name:</label>
                <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}"
                       class="w-full p-2 rounded bg-gray-800 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="email" class="block mb-1">Email:</label>
                <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email) }}"
                       class="w-full p-2 rounded bg-gray-800 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg w-full transition">
                Save Changes
            </button>
        </form>

        <form method="POST" action="{{ route('profile.destroy') }}" class="mt-6 text-center">
            @csrf
            @method('DELETE')

            <label for="password" class="block mb-2">Confirm Password to Delete:</label>
            <input type="password" name="password" id="password"
                   class="w-full p-2 rounded bg-gray-800 text-white border border-gray-600 mb-4">

            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg w-full transition">
                Delete Account
            </button>
        </form>

    </div>

</body>
</html>
