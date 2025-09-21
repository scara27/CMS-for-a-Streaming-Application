<?php

namespace App\Services;

use App\Models\ContentLive;

class LiveService
{
    public function getLives($perPage = 10)
    {
        return ContentLive::paginate($perPage);
    }

    public function createLive(array $data)
    {
        return ContentLive::create($data);
    }
    
    public function getLiveById($id)
    {
        return ContentLive::findOrFail($id);
    }

    public function updateLive($id, $data)
    {
        $live = ContentLive::findOrFail($id);
        $live->update($data);
        return $live;
    }

    public function deleteLive($id)
    {
        $live = ContentLive::findOrFail($id);
        $live->delete();
    }

}
