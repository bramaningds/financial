<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $table = 'activity_medias';

    public $timestamps = false;

    protected $fillable = [
        'location',
    ];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}