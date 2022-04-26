<?php

namespace App\Models;

use App\Constants\UserTypes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasRoles, Notifiable, SoftDeletes, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'active',
        'phone',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'otp_expiration' => 'datetime',
    ];

    public function setPasswordAttribute($pass)
    {
        if($pass){
            $this->attributes['password'] = Hash::make($pass);
        }
    }

    public function resetOTP()
    {
        $this->timestamps = false;
        $this->otp = null;
        $this->otp_expiration = null;
        $this->save();
    }

    //scopes
    public function scopeAdmin($query)
    {
        return $query->where('type', UserTypes::ADMIN);
    }

    public function scopeClient($query)
    {
        return $query->where('type', UserTypes::CLIENT);
    }

    public function scopeVerified($query, $verified)
    {
        return $verified == true ?
            $query->where('email_verified_at', '!=', null):
            $query->where('email_verified_at', '=', null);
    }

    //booleans
    public function isSuperAdmin()
    {
        return $this->type == UserTypes::SUPER_ADMIN;
    }

    public function isAdmin()
    {
        return $this->type == UserTypes::ADMIN;
    }

    public function isClient()
    {
        return $this->type == UserTypes::CLIENT;
    }

    public function isVerified()
    {
        return $this->email_verified_at ? true : false;
    }

    //relations
}
