<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = ['path', 'thumb_path', 'type', 'description'];

    /**
     * M : 1 Relationship with X
     */
    public function fileable()
    {
        return $this->morphTo();
    }
}
