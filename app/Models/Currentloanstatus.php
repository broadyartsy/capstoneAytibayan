<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currentloanstatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'current_loan_status_name',
        'description',
        'created_at',
        'updated_at',
    ];

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}
