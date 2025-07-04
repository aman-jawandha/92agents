<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Popin extends Model
{
    use HasFactory;
    protected $table="popins";
    protected $guarded = [];

    public function get_user(){
        return $this->belongsTo(Userdetails::class,'agent_id','details_id');
    }
}
