<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'project',
        'loan_amount',
        'loan_term_in_months',
        'repayment_schedule',
        'date_of_maturity',
        'remaining_loan_balance',
        'user_id',
        'loanstatus_id',
        'currentloanstatus_id',
        'created_at',
        'updated_at',
    ];

    protected $dates = [
        'date_of_payment',
        'repayment_schedule',
        'date_of_maturity',
        'updated_at',
        'created_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function loan_status()
    {
        return $this->belongsTo(Loanstatus::class);
    }
}
