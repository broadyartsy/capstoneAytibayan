<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class events extends Model
{
    protected $fillable = [
        'title',
        'date',
        'from',
        'to',
        'message',
    ];

    public function files()
    {
        return $this->belongsToMany(File::class);
    }
}
