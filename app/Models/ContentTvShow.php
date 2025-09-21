<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Content;

class ContentTvShow extends Model
{
    use HasFactory;

    protected $table = 'content_tv_show';

    protected $fillable = [
        'content_id',
        'name',
        'year',
        'director',
        'season',
        'episode'
    ];

    public function content()
    {
        return $this->belongsTo(Content::class, 'content_id');
    }
}
