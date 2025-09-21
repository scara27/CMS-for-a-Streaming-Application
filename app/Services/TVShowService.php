<?php

namespace App\Services;

use App\Models\ContentTvShow;

class TVShowService
{
    public function getTvShows($perPage = 10)
    {
        return ContentTvShow::paginate($perPage);
    }

    public function createTVShow(array $data)
    {
        return ContentTvShow::create($data);
    }

    public function getTVShowById($id)
    {
        return ContentTvShow::findOrFail($id);
    }

    public function updateTVShow($id, $data)
    {
        $tvShow = ContentTvShow::findOrFail($id);
        $tvShow->update($data);
        return $tvShow;
    }

    public function deleteTVShow($id)
    {
        $tvShow = ContentTvShow::findOrFail($id);
        $tvShow->delete();
    }

}
