<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentRating extends Model
{
    use HasFactory;
    protected $table = 'ratings';
    protected $guarded = [];

    public function agent()
    {
        return $this->belongsTo(User::class, 'rating_for', 'id');
    }
}
