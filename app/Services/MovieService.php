<?php

namespace App\Services;

use App\Models\ContentMovie;

class MovieService
{
    public function getMovies($perPage = 10)
    {
        return ContentMovie::paginate($perPage);
    }


    public function createMovie(array $data)
    {
        return ContentMovie::create($data);
    }

    public function getMovieById($id)
    {
        return ContentMovie::findOrFail($id);
    }

    public function updateMovie($id, $data)
    {
        $movie = ContentMovie::findOrFail($id);
        $movie->update($data);
        return $movie;
    }

    public function deleteMovie($id)
    {
        $movie = ContentMovie::findOrFail($id);
        $movie->delete();
    }

}
