<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\ContentType;
use App\Models\ContentStatus;
use App\Models\ContentLive;
use App\Models\ContentTvShow;
use App\Models\ContentMovie;

class Content extends Model
{
    use HasFactory;

    protected $table = 'content';

    protected $fillable = [
        'name',
        'content_type_id',
        'content_status_id',
        'icon',
        'imdb_id'
    ];

    public function contentType()
    {
        return $this->belongsTo(ContentType::class, 'content_type_id');
    }

    public function contentStatus()
    {
        return $this->belongsTo(ContentStatus::class, 'content_status_id');
    }

    public function lives()
    {
        return $this->hasMany(ContentLive::class, 'content_id');
    }

    public function tvShows()
    {
        return $this->hasMany(ContentTvShow::class, 'content_id');
    }

    public function movies()
    {
        return $this->hasMany(ContentMovie::class, 'content_id');
    }
}
