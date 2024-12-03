<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'prize_pool',
        'allocation_percentage',
        'start_date',
        'end_date',
    ];

    public function scores()
    {
        return $this->hasMany(Score::class);
    }
}
