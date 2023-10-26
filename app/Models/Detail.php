<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;

    protected $table = 'activity_details';

    public $timestamps = false;

    protected $fillable = [
        'description',
        'amount',
    ];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}