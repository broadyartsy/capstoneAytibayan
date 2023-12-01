<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'name',
        'extension',
        'contents',
    ];

    public function events()
    {
        return $this->belongsToMany(events::class);
    }
}
