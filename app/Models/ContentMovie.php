<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Content;

class ContentMovie extends Model
{
    use HasFactory;

    protected $table = 'content_movie';

    protected $fillable = [
        'content_id',
        'name',
        'year',
        'director'
    ];

    public function content()
    {
        return $this->belongsTo(Content::class, 'content_id');
    }
}
