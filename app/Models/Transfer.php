<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use App\Models\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transfer extends Model
{
    use HasFactory, Searchable, Filterable;

    protected $fillable = [
        'user_id',
        'from_id',
        'to_id',
        'transfer_date',
        'description',
        'amount',
    ];

    protected $casts = [
        'transfer_date' => 'date:Y-m-d',
        'amount' => 'float',
    ];

    protected $attributes = [
        'amount' => 0,
    ];

    protected $searchable = [
        'description',
    ];

    protected $filterable = [
        'period',
        'user_id',
        'from_id',
        'to_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function from_account()
    {
        return $this->belongsTo(Account::class, 'from_id')->withTrashed();
    }

    public function to_account()
    {
        return $this->belongsTo(Account::class, 'to_id')->withTrashed();
    }

    public function scopePeriod(Builder $query, $period)
    {
        if ($period == 'today') {
            $query->whereRaw('transfer_date = DATE(NOW())');
        } else if ($period == 'this-week') {
            $query->whereRaw('transfer_date between ? AND DATE(NOW())', [now()->startOfWeek()->toDateString()]);
        } else if ($period == 'this-month') {
            $query->whereRaw('transfer_date between ? AND DATE(NOW())', [now()->startOfMonth()->toDateString()]);
        } else if ($period == 'last-3-month') {
            $query->whereRaw('transfer_date between ? AND DATE(NOW())', [now()->subMonth(3)->startOfMonth()->toDateString()]);
        } else if ($period == 'last-6-month') {
            $query->whereRaw('transfer_date between ? AND DATE(NOW())', [now()->subMonth(6)->startOfMonth()->toDateString()]);
        } else if ($period == 'this-year') {
            $query->whereRaw('transfer_date between ? AND DATE(NOW())', [now()->startOfYear()->toDateString()]);
        }
    }
}
