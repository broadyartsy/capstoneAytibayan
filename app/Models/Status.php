<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'status_name',
        'created_at',
        'updated_at',
    ];
    
    public function user()
    {
        return $this->hasMany(User::class, 'status_id', 'id');
    }
}
