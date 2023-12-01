<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Program;
use App\Models\Role;
use App\Models\Status;
use App\Models\Financialassistance;
use App\Models\Assistancesteps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

// class User extends Authenticatable implements MustVerifyEmail
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "users";

    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $guarded = []; //protected $guarded = []; makes every field be fillable
    protected $fillable = [
        'id',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'email_verified_at',
        'password',
        'photo',
        'phone',
        'barangay',
        'city',
        'province',
        'zip',
        'blacklisted',
        'role_id',
        'program_id',
        'status_id',
        'remember_token',
        'created_at',
        'updated_at',
        'two_factor_code',
        'two_factor_expires_at',
    ];

    protected $dates = [
        'updated_at',
        'created_at',
        'email_verified_at',
        'two_factor_expires_at',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($user) {
    //         $user->generateWorkEmail();
    //     });

    //     static::updating(function ($user) {
    //         $user->generateWorkEmail();
    //     });

    //     static::creating(function ($user) {
    //         $user->generateDefaultPassword();
    //     });

    //     static::updating(function ($user) {
    //         $user->generateDefaultPassword();
    //     });
    // }

    // public function generateWorkEmail()
    // {
    //     // $workEmail = strtolower($this->first_name  . $this->middle_name . '.' . $this->last_name . '@apaoalbay.gov.ph');
    //     $workEmail = strtolower(str_replace(' ', '', $this->first_name . $this->middle_name . '.' . $this->last_name) . '@apaoalbay.gov.ph');
    //     $this->attributes['email'] = $workEmail;
    // }

    // public function generateDefaultPassword()
    // {
    //     $defaultPassword = Hash::make('ApaoAlbay2023');
    //     $this->attributes['password'] = $defaultPassword;
    // }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function assistance()
    {
        return $this->hasOne(Financialassistance::class, 'user_id');
    }

    public function financialAssistanceStatus() {
        return $this->assistance->belongsTo(Financialassistancestatus::class, 'financialassistancestatus_id');
    }

    public function loan()
    {
        return $this->hasOne(Loan::class, 'user_id');
    }

    public function loanstatus() {
        return $this->loan->belongsTo(Loanstatus::class, 'loanstatus_id');
    }

    public function currentloanstatus() {
        return $this->loan->belongsTo(CurrentLoanstatus::class, 'currentloanstatus_id');
    }

    public function assistanceSteps()
    {
        return $this->hasOne(Assistancesteps::class, 'user_id');
    }

    public function generateTwoFactorCode()
    {
        $this->timestamps = false; //Dont update the 'updated_at' field yet
        
        $this->two_factor_code = rand(100000, 999999);
        $this->two_factor_expires_at = now()->addMinutes(10);
        $this->save();
    }

    /**
     * Reset the MFA code generated earlier
     */
    public function resetTwoFactorCode()
    {
        $this->timestamps = false; //Dont update the 'updated_at' field yet
        
        $this->two_factor_code = null;
        $this->two_factor_expires_at = null;
        $this->save();
    }
}
