<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Content;

class ContentLive extends Model
{
    use HasFactory;

    protected $table = 'content_live';

    protected $fillable = [
        'content_id',
        'adult',
        'kids',
        'catchup',
    ];

    public function content()
    {
        return $this->belongsTo(Content::class, 'content_id');
    }
}
