<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="absolute top-4 right-4 p-4">
        @auth
            <div class="flex items-center space-x-4">
                <span class="text-gray-700">Welcome, {{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-blue-500 hover:text-blue-700">Logout</button>
                </form>
            </div>
        @endauth
    </div>

    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h1 class="text-2xl font-bold mb-6 text-center">Content Home</h1>
        <ul class="space-y-4">
            <li>
                <a href="{{ route('content.index.movie') }}" class="block bg-blue-500 text-white text-center py-3 px-6 rounded-lg shadow hover:bg-blue-600 transition duration-300 ease-in-out">Movies</a>
            </li>
            <li>
                <a href="{{ route('content.index.tvshow') }}" class="block bg-green-500 text-white text-center py-3 px-6 rounded-lg shadow hover:bg-green-600 transition duration-300 ease-in-out">TV Shows</a>
            </li>
            <li>
                <a href="{{ route('content.index.live') }}" class="block bg-red-500 text-white text-center py-3 px-6 rounded-lg shadow hover:bg-red-600 transition duration-300 ease-in-out">Live Content</a>
            </li>
        </ul>

        <div class="mt-8">
            <h2 class="text-xl font-semibold mb-4 text-center">Add New Content</h2>
            <ul class="space-y-4">
                <li>
                    <a href="{{ route('content.create.movie') }}" class="block bg-blue-500 text-white text-center py-3 px-6 rounded-lg shadow hover:bg-blue-600 transition duration-300 ease-in-out">Add Movie</a>
                </li>
                <li>
                    <a href="{{ route('content.create.tvshow') }}" class="block bg-green-500 text-white text-center py-3 px-6 rounded-lg shadow hover:bg-green-600 transition duration-300 ease-in-out">Add TV Show</a>
                </li>
                <li>
                    <a href="{{ route('content.create.live') }}" class="block bg-red-500 text-white text-center py-3 px-6 rounded-lg shadow hover:bg-red-600 transition duration-300 ease-in-out">Add Live Content</a>
                </li>
            </ul>
        </div><div class="mt-8">
            <h2 class="text-xl font-semibold mb-4 text-center">Content Management</h2>
            <ul class="space-y-4">
                <li>
                    <a href="{{ route('content.create.content') }}" class="block bg-yellow-500 text-white text-center py-3 px-6 rounded-lg shadow hover:bg-yellow-600 transition duration-300 ease-in-out">Add Content</a>
                </li>
                {{-- <li>
                    <a href="{{ route('content.index.content_list') }}" class="block bg-green-500 text-white text-center py-3 px-6 rounded-lg shadow hover:bg-green-600 transition duration-300 ease-in-out">Content List</a>
                </li> --}}
            </ul>
        </div>
    </div>
</body>
</html>
