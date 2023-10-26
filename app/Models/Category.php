<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use App\Models\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, Filterable, Searchable, SoftDeletes;

    protected $fillable = [
        'activity_type',
        'name',
    ];

    protected $searchable = [
        'name',
    ];


    protected $filterable = [
        'activity_type',
    ];

    public function latest_activity()
    {
        return $this->hasOne(Activity::class)->latestOfMany();
    }

    public function this_month_activities()
    {
        return $this->hasMany(Activity::class)->whereRaw('MONTH(activity_date) = ' . date('m'));
    }

    public function scopeOfActivityType(Builder $query, $activity_type)
    {
        if (!$activity_type) return;

        $query->where('activity_type', $activity_type);
    }

    public function scopeOfIncome(Builder $query)
    {
        $query->where('activity_type', 'income');
    }

    public function scopeOfExpense(Builder $query)
    {
        $query->where('activity_type', 'expense');
    }
}
