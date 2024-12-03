<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'score',
        'wallet_address',
        'season_id',
        'is_paid',
        'payment_amount',
    ];

    public function season()
    {
        return $this->belongsTo(Season::class);
    }
}
