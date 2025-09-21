<?php

namespace App\Services;

use App\Models\Content;

class ContentService
{

    public function getContents($perPage = 10)
    {
        // Fetch a paginated set of movies, with 10 movies per page
        return Content::paginate($perPage);
    }

    public function createContent(array $data)
    {
        return Content::create($data);
    }

    public function getContentById($id)
    {
        return Content::findOrFail($id);
    }

    public function updateContent($id, $data)
    {
        $content = Content::findOrFail($id);
        $content->update($data);
        return $content;
    }

    public function deleteContent($id)
    {
        $content = Content::findOrFail($id);
        $content->delete();
    }

}