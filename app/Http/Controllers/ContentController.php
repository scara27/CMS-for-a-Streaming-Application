<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Services\MovieService;
use App\Services\TVShowService;
use App\Services\LiveService;
use App\Services\OmdbService;
use App\Services\ContentService;

use App\Models\Content;
use App\Models\ContentMovie;
use App\Models\ContentTvShow;
use App\Models\ContentLive;

class ContentController extends Controller
{
    public function __construct(MovieService $movieService, TVShowService $tvService, LiveService $liveService, ContentService $contentService)
    {
        $this->movieService = $movieService;
        $this->tvService = $tvService;
        $this->liveService = $liveService;
        $this->contentService = $contentService;
    }

    public function index(Request $request){
        $route_name = $request->route()->getName();

        if ($route_name == 'content.index.movie'){
            $movies = $this->movieService->getMovies();
            return view('content.movies', ['movies' => $movies]);
        } else if ($route_name == 'content.index.tvshow') {
            $tvShows = $this->tvService->getTvShows();
            return view('content.tvshows', ['shows' => $tvShows]);
        } else if ($route_name == 'content.index.live') {
            $lives = $this->liveService->getLives();
            return view('content.live', ['lives' => $lives]);
        } else {
            $contents = $this->contentService->getContents();
            return view('content.content_list', ['contents' => $contents]);
        }
    }

    public function createMovie()
    {
        return view('content.create.create_movie');
    }

    public function createTVShow()
    {
        return view('content.create.create_tvshow');
    }

    public function createLive()
    {
        return view('content.create.create_live');
    }

    public function createContent()
    {
        return view('content.create.create_content');
    }

    public function editMovie($id)
    {
        $movie = $this->movieService->getMovieById($id);
        return view('content.edit.edit_movie', ['movie' => $movie]);
    }

    public function updateMovie(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'year' => 'required|integer',
            'director' => 'required|string|max:255',
        ]);

        $this->movieService->updateMovie($id, $validated);

        return redirect()->route('content.index.movie')->with('success', 'Movie updated successfully!');
    }

    public function deleteMovie($id)
    {
        $this->movieService->deleteMovie($id);

        return redirect()->route('content.index.movie')->with('success', 'Movie deleted successfully!');
    }

    public function editTVShow($id)
    {
        $tvShow = $this->tvService->getTVShowById($id);
        return view('content.edit.edit_tvshow', ['tvShow' => $tvShow]);
    }

    public function updateTVShow(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'year' => 'required|string',
            'director' => 'required|string|max:255',
            'season' => 'integer',
            'episode' => 'integer',
        ]);

        $this->tvService->updateTVShow($id, $validated);

        return redirect()->route('content.index.tvshow')->with('success', 'TV Show updated successfully!');
    }

    public function deleteTVShow($id)
    {
        $this->tvService->deleteTVShow($id);

        return redirect()->route('content.index.tvshow')->with('success', 'TV Show deleted successfully!');
    }

    public function editLive($id)
    {
        $live = $this->liveService->getLiveById($id);
        return view('content.edit.edit_live', ['live' => $live]);
    }

    public function updateLive(Request $request, $id)
    {
        // Validate input
        $request->validate([
            'content_id' => 'required|integer',
            'adult' => 'nullable|string',
            'kids' => 'nullable|string',
            'cathcup' => 'nullable|string',
        ]);

        // Convert checkbox values to boolean (or integers)
        $data = $request->all();
        $data['adult'] = $request->has('adult') ? 1 : 0;
        $data['kids'] = $request->has('kids') ? 1 : 0;
        $data['cathcup'] = $request->has('cathcup') ? 1 : 0;

        $this->liveService->updateLive($id, $data);

        return redirect()->route('content.index.live')->with('success', 'Live content updated successfully!');
    }

    public function deleteLive($id)
    {
        $this->liveService->deleteLive($id);

        return redirect()->route('content.index.live')->with('success', 'Live content deleted successfully!');
    }

    // app/Http/Controllers/OmdbController.php
    public function getDetailsOmdb($imdbId)
    {
        $apiKey = env('OMDB_API_KEY');
        $response = Http::get("http://www.omdbapi.com/?i={$imdbId}&apikey={$apiKey}");

        return $response->json();
    }


    public function storeMovie(Request $request)
    {
        // Validate the request
        $request->validate([
            'content_id' => 'required|exists:content,id',
        ]);

        // Fetch the content record
        $content = Content::find($request->content_id);
        
        if (!$content) {
            return redirect()->back()->with('error', 'Content not found.');
        }

        // Fetch data from OMDB API
        $response = Http::get('http://www.omdbapi.com/', [
            'apikey' => env('OMDB_API_KEY'),
            'i' => $content->imdb_id,
        ]);

        if ($response->failed()) {
            return redirect()->back()->with('error', 'Failed to fetch data from OMDB API.');
        }

        $movieData = $response->json();

        // Check if movie data is valid
        if ($movieData['Response'] == 'False') {
            return redirect()->back()->with('error', 'Movie not found in OMDB.');
        }

        // Save movie data to content_movies table
        ContentMovie::create([
            'content_id' => $request->content_id,
            'name' => $movieData['Title'],
            'year' => $movieData['Year'],
            'director' => $movieData['Director'],
        ]);

        return redirect()->route('content.index')->with('success', 'Movie added successfully.');
    }

    public function storeTvShow(Request $request)
    {
        // Validate the request
        $request->validate([
            'content_id' => 'required|exists:content,id',
        ]);

        // Fetch the content record
        $content = Content::find($request->content_id);

        if (!$content) {
            return redirect()->back()->with('error', 'Content not found.');
        }

        // Fetch data from OMDB API
        $response = Http::get('http://www.omdbapi.com/', [
            'apikey' => env('OMDB_API_KEY'),
            'i' => $content->imdb_id,
        ]);

        if ($response->failed()) {
            return redirect()->back()->with('error', 'Failed to fetch data from API.');
        }

        $data = $response->json();

        // Determine the correct format for season and episode
        $season = $data['Season'] ?? null;
        $episode = $data['Episode'] ?? null;

        // Save TV show data to content_tv_shows table
        ContentTvShow::create([
            'content_id' => $request->content_id,
            'name' => $data['Title'],
            'year' => $data['Year'] ?? 'Unknown',
            'director' => $data['Director'],
            'season' => $season,
            'episode' => $episode,
        ]);

        return redirect()->route('content.index')->with('success', 'TV Show added successfully.');
    }

    public function storeLive(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'content_id' => 'required|exists:content,id',
            'catchup' => 'nullable|boolean', // Handle the checkbox
        ]);

        // Fetch the content record
        $content = Content::find($validated['content_id']);

        if (!$content) {
            return redirect()->back()->with('error', 'Content not found.');
        }

        // Fetch data from OMDB API
        $response = Http::get('http://www.omdbapi.com/', [
            'apikey' => env('OMDB_API_KEY'),
            'i' => $content->imdb_id,
        ]);

        if ($response->failed()) {
            return redirect()->back()->with('error', 'Failed to fetch data from API.');
        }

        $data = $response->json();

        // Determine if content is for adults or kids
        $adult = (isset($data['Rated']) && strpos($data['Rated'], 'R') !== false) ? 1 : 0;
        $kids = (isset($data['Rated']) && strpos($data['Rated'], 'G') !== false) ? 1 : 0;

        // Handle catchup value from checkbox
        $catchup = $request->has('catchup1') ? 1 : 0;

        // Save live content data to the live table
        ContentLive::create([
            'content_id' => $validated['content_id'],
            'adult' => $adult,
            'kids' => $kids,
            'catchup' => $catchup,
        ]);

        return redirect()->route('content.index')->with('success', 'Live content added successfully.');
    }

    public function storeContent(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'content_type_id' => 'required|integer',
            'content_status_id' => 'required|integer',
            'icon' => 'nullable|string|url', // Assuming 'icon' is a URL
            'imdb_id' => 'required|string|max:255',
        ]);

        // Fetch data from OMDB API
        $response = Http::get('http://www.omdbapi.com/', [
            'apikey' => env('OMDB_API_KEY'),
            'i' => $request->imdb_id,
        ]);

        if ($response->failed()) {
            return redirect()->back()->with('error', 'Failed to fetch data from API.');
        }

        $data = $response->json();

        Content::create([
            'name' => $request->name,
            'content_type_id' => $request->content_type_id,
            'content_status_id' => $request->content_status_id,
            'icon' => $data['Poster'],
            'imdb_id' => $request->imdb_id,
        ]);

        return redirect()->route('content.index')->with('success', 'TV Show added successfully.');
    }

}
