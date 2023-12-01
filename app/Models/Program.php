<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'id',
        'program_name',
        'location',
        'email',
        'contact',
        'description',
        'quiry',
        'requirements',
        'image',
        'background_image',
        'password',
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->hasMany(User::class, 'program_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function coordinators()
{
    return $this->hasMany(User::class)->where('role_id', Role::where('role_name', ['binhiprojectcoordinator', 'abakaprojectcoordinator', 'agripinayprojectcoordinator', 'akbayprojectcoordinator', 'leadprojectcoordinator'])->first()->id);
}
}
