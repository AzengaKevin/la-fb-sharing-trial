<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function file()
    {
        return $this->morphOne(File::class, 'fileable');
    }

    public function image() : string
    {
        return Storage::disk('public')->url($this->file->path);
    }
}
