<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Updates extends Model
{
    protected $fillable = [
        'email',
        'title',
        'benef_of',
        'image',
    ];

    use HasFactory;
}
