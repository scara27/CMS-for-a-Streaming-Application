<!DOCTYPE html>
<html>
<head>
    <title>Movies</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mx-auto px-4 py-6">

        <!-- Back to Home Link -->
        <div class="mb-4">
            <a href="{{ route('content.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-md">
                &larr; Back
            </a>
        </div>

        <h1 class="text-2xl font-bold mb-4">Movies List</h1>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Content ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Year</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Director</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Icon</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created At</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Updated At</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($movies as $movie)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $movie->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $movie->content_id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $movie->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $movie->year }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $movie->director }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                @if ($movie->content && $movie->content->icon)
                                    <img src="{{ $movie->content->icon }}" alt="Icon" class="w-16 h-16 object-contain mx-auto">
                                @else
                                    <span class="text-gray-500">No Icon</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $movie->created_at->format('Y-m-d H:i') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $movie->updated_at->format('Y-m-d H:i') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap flex space-x-2">
                                <!-- Edit Button -->
                                <a href="{{ route('content.edit.movie', $movie->id) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                    Edit
                                </a>

                                <!-- Delete Form -->
                                <form action="{{ route('content.delete.movie', $movie->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700" onclick="return confirm('Are you sure you want to delete this item?');">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination Links -->
        <div class="flex justify-center mt-6">
            <nav aria-label="Pagination">
                <ul class="inline-flex items-center space-x-2">
                    <!-- Previous Button -->
                    @if ($movies->onFirstPage())
                        <li>
                            <span class="px-3 py-2 text-gray-500 bg-gray-200 border border-gray-300 rounded-l-lg cursor-not-allowed">Previous</span>
                        </li>
                    @else
                        <li>
                            <a href="{{ $movies->previousPageUrl() }}" class="px-3 py-2 text-blue-600 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-blue-800">Previous</a>
                        </li>
                    @endif

                    <!-- Page Number Buttons -->
                    @for ($i = 1; $i <= $movies->lastPage(); $i++)
                        <li>
                            <a href="{{ $movies->url($i) }}" class="px-3 py-2 {{ $movies->currentPage() == $i ? 'bg-blue-600 text-white' : 'text-blue-600 bg-white' }} border border-gray-300 hover:bg-gray-100 hover:text-blue-800 rounded-lg">
                                {{ $i }}
                            </a>
                        </li>
                    @endfor

                    <!-- Next Button -->
                    @if ($movies->hasMorePages())
                        <li>
                            <a href="{{ $movies->nextPageUrl() }}" class="px-3 py-2 text-blue-600 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-blue-800">Next</a>
                        </li>
                    @else
                        <li>
                            <span class="px-3 py-2 text-gray-500 bg-gray-200 border border-gray-300 rounded-r-lg cursor-not-allowed">Next</span>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>

    </div>

    <a href="{{ route('content.create.movie') }}" class="fixed bottom-4 right-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-full text-white bg-green-600 hover:bg-green-700">
        Add New Movie
    </a>
</body>
</html>
