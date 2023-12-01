<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Financialassistancehistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'transaction_type',
        'user_id',
        'financialassistance_id',
        'created_at',
        'updated_at',
    ];

    public function assistance()
    {
        return $this->belongsTo(Financialassistance::class, 'financialassistance_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function program()
    {
        return $this->user->belongsTo(Program::class, 'program_id');
    }

    public function assistancestatus() {
        return $this->assistance->belongsTo(Financialassistancestatus::class, 'financialassistancestatus_id');
    }
}
