<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Financialassistance;

class Financialassistancestatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'financial_assistance_status_name',
        'description',
        'created_at',
        'updated_at',
    ];

    public function financialAssistances()
    {
        return $this->hasMany(Financialassistance::class);
    }
}
