<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assistancesteps extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'step_one',
        'step_two',
        'step_three',
        'step_four',
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
