<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, Searchable, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $searchable = [
        'name',
    ];

    public function latest_activity()
    {
        return $this->hasOne(Activity::class)->latestOfMany();
    }

    public function this_month_activities()
    {
        return $this->hasMany(Activity::class)->whereRaw('MONTH(activity_date) = ' . date('m'));
    }

    public function latest_transfer()
    {
        return $this->hasOne(Transfer::class)->latestOfMany();
    }

    public function this_month_transfers()
    {
        return $this->hasMany(Transfer::class)->whereRaw('MONTH(transfer_date) = ' . date('m'));
    }

    public function isAdmin(): bool
    {
        return $this->is_admin == 'Y';
    }
}
