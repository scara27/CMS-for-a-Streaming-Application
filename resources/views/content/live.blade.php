<!DOCTYPE html>
<html>
<head>
    <title>Live Content</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mx-auto px-4">
        <!-- Back to Home Link -->
        <div class="my-4">
            <a href="{{ route('content.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-md">
                &larr; Back
            </a>
        </div>

        <h1 class="my-4 text-2xl font-bold">Live Content List</h1>
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Content ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Adult</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kids</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Catchup</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Icon</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created At</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Updated At</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lives as $live)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $live->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $live->content_id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $live->adult ? 'yes' : 'no' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $live->kids ? 'yes' : 'no' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $live->catchup ? 'yes' : 'no' }}
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            @if ($live->content && $live->content->icon)
                                <img src="{{ $live->content->icon }}" alt="Icon" class="w-16 h-16 object-contain mx-auto">
                            @else
                                <span class="text-gray-500">No Icon</span>
                            @endif
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">{{ $live->created_at }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $live->updated_at }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <!-- Edit Button -->
                            <a href="{{ route('content.edit.live', $live->id) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                Edit
                            </a>

                            <!-- Delete Form -->
                            <form action="{{ route('content.delete.live', $live->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="ml-2 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700" onclick="return confirm('Are you sure you want to delete this item?');">
                                    Delete
                                </button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <!-- Pagination Links -->
        <div class="flex justify-center mt-6">
            <nav aria-label="Pagination">
                <ul class="inline-flex items-center space-x-2">
                    <!-- Previous Button -->
                    @if ($lives->onFirstPage())
                        <li>
                            <span class="px-3 py-2 text-gray-500 bg-gray-200 border border-gray-300 rounded-l-lg cursor-not-allowed">Previous</span>
                        </li>
                    @else
                        <li>
                            <a href="{{ $lives->previousPageUrl() }}" class="px-3 py-2 text-blue-600 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-blue-800">Previous</a>
                        </li>
                    @endif

                    <!-- Page Number Buttons -->
                    @for ($i = 1; $i <= $lives->lastPage(); $i++)
                        <li>
                            <a href="{{ $lives->url($i) }}" class="px-3 py-2 {{ $lives->currentPage() == $i ? 'bg-blue-600 text-white' : 'text-blue-600 bg-white' }} border border-gray-300 hover:bg-gray-100 hover:text-blue-800 rounded-lg">
                                {{ $i }}
                            </a>
                        </li>
                    @endfor

                    <!-- Next Button -->
                    @if ($lives->hasMorePages())
                        <li>
                            <a href="{{ $lives->nextPageUrl() }}" class="px-3 py-2 text-blue-600 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-blue-800">Next</a>
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

    <a href="{{ route('content.create.live') }}" class="fixed bottom-4 right-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-full text-white bg-green-600 hover:bg-green-700">
        Add New Live Content
    </a>
</body>
</html>
