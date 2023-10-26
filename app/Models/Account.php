<?php

namespace App\Models;

use App\Models\Activity;
use App\Models\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use HasFactory, SoftDeletes, Searchable;

    protected $fillable = [
        'name',
        'description',
    ];

    protected $casts = [
        'balance' => 'float',
    ];

    protected $attributes = [
        'balance' => 0,
    ];

    protected $searchable = [
        'name',
        'description',
    ];

    public function transfer_in()
    {
        return $this->hasMany(Transfer::class, 'to_id');
    }

    public function transfer_out()
    {
        return $this->hasMany(Transfer::class, 'from_id');
    }

    public function latest_activity()
    {
        return $this->hasOne(Activity::class)->latestOfMany();
    }

    public function this_month_activities()
    {
        return $this->hasMany(Activity::class)->whereRaw('MONTH(activity_date) = ' . date('m'));
    }

    public function latest_transfer_in()
    {
        return $this->hasOne(Transfer::class, 'to_id')->latestOfMany();
    }

    public function latest_transfer_out()
    {
        return $this->hasOne(Transfer::class, 'from_id')->latestOfMany();
    }

    public function this_month_transfers_in()
    {
        return $this->hasMany(Transfer::class, 'to_id')->whereRaw('MONTH(transfer_date) = ' . date('m'));
    }

    public function this_month_transfers_out()
    {
        return $this->hasMany(Transfer::class, 'from_id')->whereRaw('MONTH(transfer_date) = ' . date('m'));
    }

}