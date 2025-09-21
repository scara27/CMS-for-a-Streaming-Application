<!DOCTYPE html>
<html>
<head>
    <title>TV Shows</title>
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

        <h1 class="text-2xl font-bold mb-4">TV Shows List</h1>
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
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Season</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Episode</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created At</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Updated At</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($shows as $show)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $show->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $show->content_id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $show->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $show->year }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $show->director }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                @if ($show->content && $show->content->icon)
                                    <img src="{{ $show->content->icon }}" alt="Icon" class="w-16 h-16 object-contain mx-auto">
                                @else
                                    <span class="text-gray-500">No Icon</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $show->season }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $show->episode }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $show->created_at->format('Y-m-d H:i') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $show->updated_at->format('Y-m-d H:i') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap flex space-x-2">
                                <!-- Edit Button -->
                                <a href="{{ route('content.edit.tvshow', $show->id) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                    Edit
                                </a>

                                <!-- Delete Form -->
                                <form action="{{ route('content.delete.tvshow', $show->id) }}" method="POST">
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
                    @if ($shows->onFirstPage())
                        <li>
                            <span class="px-3 py-2 text-gray-500 bg-gray-200 border border-gray-300 rounded-l-lg cursor-not-allowed">Previous</span>
                        </li>
                    @else
                        <li>
                            <a href="{{ $shows->previousPageUrl() }}" class="px-3 py-2 text-blue-600 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-blue-800">Previous</a>
                        </li>
                    @endif

                    <!-- Page Number Buttons -->
                    @for ($i = 1; $i <= $shows->lastPage(); $i++)
                        <li>
                            <a href="{{ $shows->url($i) }}" class="px-3 py-2 {{ $shows->currentPage() == $i ? 'bg-blue-600 text-white' : 'text-blue-600 bg-white' }} border border-gray-300 hover:bg-gray-100 hover:text-blue-800 rounded-lg">
                                {{ $i }}
                            </a>
                        </li>
                    @endfor

                    <!-- Next Button -->
                    @if ($shows->hasMorePages())
                        <li>
                            <a href="{{ $shows->nextPageUrl() }}" class="px-3 py-2 text-blue-600 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-blue-800">Next</a>
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

    <a href="{{ route('content.create.tvshow') }}" class="fixed bottom-4 right-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-full text-white bg-green-600 hover:bg-green-700">
        Add New TV Show
    </a>
</body>
</html>
