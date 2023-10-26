<?php

namespace App\Models;

use App\Models\Account;
use App\Models\Traits\Filterable;
use App\Models\Traits\Searchable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    use HasFactory, SoftDeletes, Searchable, Filterable;

    protected $fillable = [
        'user_id',
        'account_id',
        'category_id',
        'activity_type',
        'activity_date',
        'description',
        'debit',
        'credit',
    ];

    protected $casts = [
        'activity_date' => 'date',
        'debit' => 'float',
        'credit' => 'float',
    ];

    protected $searchable = [
        'description',
    ];

    protected $filterable = [
        'period',
        'user_id',
        'activity_type',
        'account_id',
        'category_id',
        'month',
        'year',
    ];

    public function account()
    {
        return $this->belongsTo(Account::class)->withTrashed();
    }

    public function category()
    {
        return $this->belongsTo(Category::class)->withTrashed();
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function details()
    {
        return $this->hasMany(Detail::class);
    }

    public function medias()
    {
        return $this->hasMany(Media::class);
    }

    public function getMutationAttribute()
    {
        return $this->debit - $this->credit;
    }

    public function scopeWithBalance(Builder $query)
    {
        $balance_subquery = 'SELECT SUM(debit - credit)
                             FROM activities AS t
                             WHERE t.account_id = activities.account_id
                             AND (t.activity_date < activities.activity_date
                                OR (t.activity_date = activities.activity_date AND t.id < activities.id)
                             )';

        $query->selectRaw("activities.*, activities.debit - activities.credit + ({$balance_subquery}) AS balance");
    }

    public function scopeOrderByCustomDate(Builder $query, $orderBy)
    {
        if ($orderBy == 'asc') {
            $query->orderBy('activity_date', 'ASC');
            $query->orderBy('id', 'ASC');
        } elseif ($orderBy == 'desc') {
            $query->orderBy('activity_date', 'DESC');
            $query->orderBy('id', 'DESC');
        } else {
            $query->orderByRaw('YEAR(activity_date) DESC');
            $query->orderByRaw('MONTH(activity_date) DESC');
            $query->orderByRaw('DATE(activity_date) ASC');
            $query->orderBy('id', 'ASC');
        }
    }

    public function scopeThisMonth(Builder $query)
    {
        $query->whereRaw("MONTH(activity_date) = MONTH(NOW())")
            ->whereRaw("YEAR(activity_date) = YEAR(NOW())");
    }

    public function scopeLastMonth(Builder $query)
    {
        $query->whereRaw("MONTH(activity_date) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)")
            ->whereRaw("YEAR(activity_date) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)");
    }

    public function scopeIsExpense(Builder $query)
    {
        return $query->where('activity_type', 'expense');
    }

    public function scopeIsIncome(Builder $query)
    {
        return $query->where('activity_type', 'income');
    }

    public function scopeMonth(Builder $query, $month)
    {
        $query->whereRaw("MONTH(activity_date) = {$month}");
    }

    public function scopeYear(Builder $query, $year)
    {
        $query->whereRaw("YEAR(activity_date) = {$year}");
    }

    public function scopePeriod(Builder $query, $period)
    {
        if ($period == 'today') {
            $query->whereRaw('activity_date = DATE(NOW())');
        } else if ($period == 'this-week') {
            $query->whereRaw('activity_date between ? AND DATE(NOW())', [now()->startOfWeek()->toDateString()]);
        } else if ($period == 'this-month') {
            $query->whereRaw('activity_date between ? AND DATE(NOW())', [now()->startOfMonth()->toDateString()]);
        } else if ($period == 'last-3-month') {
            $query->whereRaw('activity_date between ? AND DATE(NOW())', [now()->subMonth(3)->startOfMonth()->toDateString()]);
        } else if ($period == 'last-6-month') {
            $query->whereRaw('activity_date between ? AND DATE(NOW())', [now()->subMonth(6)->startOfMonth()->toDateString()]);
        } else if ($period == 'this-year') {
            $query->whereRaw('activity_date between ? AND DATE(NOW())', [now()->startOfYear()->toDateString()]);
        }
    }
}
