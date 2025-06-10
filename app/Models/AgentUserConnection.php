<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AgentUserConnection extends Model
{
    use HasFactory;

    protected $table = 'agents_users_conections';
    protected $primaryKey = 'connection_id';
    public $timestamps = true;

    protected $fillable = [
        'post_id',
        'to_id',
        'to_role',
        'from_id',
        'from_role',
        'closing_date',
        'post_done',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'timestamp',
        'closing_date' => 'datetime',
        // Appropriate cast for post_done if it's boolean:
        'post_done' => 'boolean',
    ];



    public function post(): BelongsTo
    {
        return $this->belongsTo(AgentPost::class, 'post_id', 'post_id');
    }

    public function userDetailsTo(): BelongsTo
    {
        return $this->belongsTo(Userdetails::class, 'to_id', 'details_id');
    }

    public function userDetailsFrom(): BelongsTo
    {
        return $this->belongsTo(Userdetails::class, 'from_id', 'details_id');
    }
}