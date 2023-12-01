<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inquiries extends Model
{
    protected $fillable = [
        'fullname',
        'from',
        'to',
        'programEmail',
        'email',
        'contacts',
        'message',
        'attachment',
        'is_unread'
    ];
    use HasFactory;
}
