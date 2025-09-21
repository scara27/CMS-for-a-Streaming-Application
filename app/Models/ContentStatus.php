<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Content;

class ContentStatus extends Model
{
    use HasFactory;

    protected $table = 'content_status';

    protected $fillable = [
        'name'
    ];

    public function contents()
    {
        return $this->hasMany(Content::class, 'content_status_id');
    }
}
