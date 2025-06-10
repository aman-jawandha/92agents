<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AgentPost extends Model
{
    use HasFactory;

    protected $table = 'agents_posts';
    protected $primaryKey = 'post_id';
    public $timestamps = true; // Assuming you want to use created_at and updated_at

    protected $fillable = [
        'agents_user_id',
        'agents_users_role_id',
        'posttitle',
        'details',
        'address1',
        'address2',
        'city',
        'state',
        'status',
        'area',
        'zip',
        'when_do_you_want_to_sell',
        'need_Cash_back',
        'interested_short_sale',
        'got_lender_approval_for_short_sale',
        'home_type',
        'best_features',
        'price_range',
        'firsttime_home_buyer',
        'do_u_have_a_home_to_sell',
        'if_so_do_you_need_help_selling',
        'interested_in_buying',
        'bids_emailed',
        'do_you_need_financing',
        'is_deleted',
        'applied_post',
        'applied_user_id',
        'post_type',
        'agent_select_date',
        'agent_send_review',
        'buyer_seller_send_review',
        'mark_complete',
        'closing_date',
        'agent_payment',
        'final_status',
        'cron_time',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'agent_select_date' => 'datetime',
        'closing_date' => 'datetime',
        // Add other casts as needed (e.g., for enums or booleans)
    ];

    // Relationships (Assuming you have AgentUser, AgentCity, and AgentState models)

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'agents_user_id', 'id');
    }

    public function userDetails()
    {
        return $this->hasOneThrough(
            UserDetails::class,
            User::class,
            'id', // Foreign key on the users table...
            'details_id', // Foreign key on the user_details table...
            'agents_user_id', // Local key on the agents_posts table...
            'id' // Local key on the users table...
        );
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city', 'city_id');
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class, 'state', 'state_id');
    }

    public function connections(): HasMany
    {
        return $this->hasMany(AgentUserConnection::class, 'post_id', 'post_id');
    }

}