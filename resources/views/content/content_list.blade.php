<!DOCTYPE html>
<html>
<head>
    <title>Content List</title>
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

        <h1 class="text-2xl font-bold mb-4">Content List</h1>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Content Type ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Content Status ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Icon</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">IMDB ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created At</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Updated At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contents as $content)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $content->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $content->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $content->content_type_id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $content->content_status_id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                @if ($content->icon)
                                    <img src="{{ $content->icon }}" alt="Icon" class="w-16 h-16 object-contain mx-auto">
                                @else
                                    <span class="text-gray-500">No Icon</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $content->imdb_id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $content->created_at->format('Y-m-d H:i') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $content->updated_at->format('Y-m-d H:i') }}</td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination Links -->
        <div class="flex justify-center mt-6">
            <nav aria-label="Pagination">
                <ul class="inline-flex items-center space-x-2">
                    @if ($contents->onFirstPage())
                        <li>
                            <span class="px-3 py-2 text-gray-500 bg-gray-200 border border-gray-300 rounded-l-lg cursor-not-allowed">Previous</span>
                        </li>
                    @else
                        <li>
                            <a href="{{ $contents->previousPageUrl() }}" class="px-3 py-2 text-blue-600 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100">Previous</a>
                        </li>
                    @endif

                    @for ($i = 1; $i <= $contents->lastPage(); $i++)
                        <li>
                            <a href="{{ $contents->url($i) }}" class="px-3 py-2 {{ $contents->currentPage() == $i ? 'bg-blue-600 text-white' : 'text-blue-600 bg-white' }} border border-gray-300 hover:bg-gray-100 rounded-lg">{{ $i }}</a>
                        </li>
                    @endfor

                    @if ($contents->hasMorePages())
                        <li>
                            <a href="{{ $contents->nextPageUrl() }}" class="px-3 py-2 text-blue-600 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100">Next</a>
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
</body>
</html>
