<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Content;

class ContentType extends Model
{
    use HasFactory;

    protected $table = 'content_type';

    protected $fillable = [
        'name'
    ];

    public function contents()
    {
        return $this->hasMany(Content::class, 'content_type_id');
    }
}
