<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        "recipient_email",
        "description",
        "time",
        "date",
        "from"
    ];

    use HasFactory;
}
