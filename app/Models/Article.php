<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'slug', 'content'];

    /**
     * The Article Resource URL key name
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
