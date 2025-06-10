<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\QuestionAnswers;
use App\Models\Bookmark;
use App\Models\Rating;
use Illuminate\Http\Request;

class Post extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'agents_posts';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'post_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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
        'created_at',
        'post_type',
        'updated_at',
        'agent_select_date',
        'agent_send_review',
        'buyer_seller_send_review',
        'mark_complete',
        'closing_date',
        'agent_payment',
        'final_status',
        'cron_time',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'city' => 'integer',
        'state' => 'integer',
        'status' => 'integer',
        'need_Cash_back' => 'boolean',
        'interested_short_sale' => 'boolean',
        'got_lender_approval_for_short_sale' => 'boolean',
        'firsttime_home_buyer' => 'integer',
        'do_u_have_a_home_to_sell' => 'integer',
        'if_so_do_you_need_help_selling' => 'integer',
        'interested_in_buying' => 'integer',
        'is_deleted' => 'boolean',
        'applied_post' => 'integer',
        'applied_user_id' => 'integer',
        'agent_send_review' => 'boolean',
        'buyer_seller_send_review' => 'boolean',
        'mark_complete' => 'boolean',
        'final_status' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'agent_select_date' => 'datetime',
        'closing_date' => 'datetime',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Get the user that owns the post.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'agents_user_id');
    }
    
    /**
     * Get the user role that owns the post.
     */
    public function userRole()
    {
        return $this->belongsTo(UserRoler::class, 'agents_users_role_id');
    }

    /**
     * Get the city that the post belongs to
     */

     public function cityData()
     {
         return $this->belongsTo(City::class, 'city');
     }

    /**
     * Get the state that the post belongs to
     */
    public function stateData()
    {
        return $this->belongsTo(State::class, 'state');
    }

    // ====================================

    public function getAppliedPostsDataBySelectedAgent($user = null)
    {
        $query = DB::table('agents_posts')->select('*');
        if ($user != null) {
            $query->where(['agents_posts.agents_user_id' => $user]);
        }
        $query->where('agents_posts.is_deleted', '0');
        $query->orderBy('agents_posts.created_at', 'DESC');
        $result = $query->first();
        return $result;
    }

    public function getDetailsByUserroleandId($user = null, $role = null)
    {
        $query = DB::table('agents_posts')->select('*');
        if ($user != null) {
            $query->where(['agents_posts.agents_user_id' => $user]);
        }
        if ($role != null) {
            $query->where(['agents_posts.agents_users_role_id' => $role]);
        }
        $query->where('agents_posts.is_deleted', '0');
        $query->orderBy('agents_posts.created_at', 'DESC');
        $result = $query->first();
        return $result;
    }

    /* get all data any filed using*/

    public function getDetailsByAny($limit = 20, $where = null, $page = 1)
    {
        $query = AgentPost::with([
            'user',
            'userDetails', // Ensure this relationship is correctly set up
            'state',
            'city',
            'connections' => function ($q) use ($where) {
                $q->with('userDetailsFrom', 'userDetailsTo') // Assuming these are defined and working
                    ->orderBy('updated_at', 'DESC');

                if ($where) {
                    $q->where(function ($q) use ($where) {
                        if (isset($where['agents_posts.agents_user_id']) && isset($where['agents_posts.agents_users_role_id'])) {
                            $userId = $where['agents_posts.agents_user_id'];
                            $roleId = $where['agents_posts.agents_users_role_id'];

                            // JOIN agents_users_details here
                            $q->join('agents_users_details', function ($join) use ($userId, $roleId) {
                                $join->on(function ($j) use ($userId, $roleId) {
                                    $j->where('agents_users_conections.from_id', $userId)
                                        ->where('agents_users_conections.from_role', $roleId)
                                        ->whereColumn('agents_users_conections.to_id', 'agents_users_details.details_id');
                                })->orOn(function ($j) use ($userId, $roleId) {
                                    $j->where('agents_users_conections.to_id', $userId)
                                        ->where('agents_users_conections.to_role', $roleId)
                                        ->whereColumn('agents_users_conections.from_id', 'agents_users_details.details_id');
                                });
                            });
                        }
                    });
                }
            },
        ])
            ->where('is_deleted', 0) // No need for string '0' with integer column
            ->orderBy('created_at', 'DESC');



        if ($where) {
            // Refactor the $where clause here as well to use parameterized queries if needed.
            // Example (adapt based on your actual where conditions):
            foreach ($where as $key => $value) {
                if (is_array($value)) { // For conditions like whereIn
                    $query->whereIn($key, $value);
                } else {
                    $query->where($key, $value);
                }
            }
        }

        $paginatedResults = $query->paginate(perPage: $limit);

        $paginatedResults->getCollection()->transform(function ($item) {
            $item->post_view_count = $item->connections->count();
            return $item;
        });

        return $paginatedResults;
    }

    public function getDetailsByAny1($limit = 20, $where = null, $page = 1)
    {
        $query = DB::table('agents_posts')
            ->select(
                'agents_posts.*',
                'agents_users.login_status',
                'agents_posts.closing_date as post_close_date',
                'agents_users.api_token',
                'agents_users_details.name',
                'agents_users_details.description',
                'agents_state.state_name',
                'agents_city.city_name'
            )
            ->join('agents_users', 'agents_users.id', '=', 'agents_posts.agents_user_id')
            ->join('agents_users_details', 'agents_users_details.details_id', '=', 'agents_users.id')
            ->leftJoin('agents_state', 'agents_state.state_id', '=', 'agents_posts.state')
            ->leftJoin('agents_city', 'agents_city.city_id', '=', 'agents_posts.city')
            ->where('agents_posts.is_deleted', '0')
            ->orderBy('agents_posts.created_at', 'DESC');

        // Apply additional where conditions if provided
        if ($where) {
            $query->where($where);
        }

        return $query->paginate(perPage: $limit);

        // Process results and add view count
        foreach ($results as &$value) {
            $value->post_view_count = $this->postviewcountandagentlist($value, $where);
        }
    }

    /* Post view count and agent list */
    public function postviewcountandagentlist($value, $where = null)
    {
        $query1 = DB::table('agents_users_conections as c')
            ->join('agents_users_details as u', function ($join) {
                $join->on('u.details_id', '=', 'c.from_id')
                    ->orOn('u.details_id', '=', 'c.to_id');
            });
        if ($where != null) {
            $query1->where(function ($query) use ($where) {
                $query->whereRaw(DB::raw(
                    'CASE WHEN c.from_id = ' . $where['agents_posts.agents_user_id'] . ' AND c.from_role = ' . $where['agents_posts.agents_users_role_id'] . '
				            THEN c.to_id = u.details_id
				            WHEN c.to_id = ' . $where['agents_posts.agents_user_id'] . ' AND c.to_role = ' . $where['agents_posts.agents_users_role_id'] . '
				            THEN c.from_id = u.details_id END'
                ));
            });
        }
        $query1->where('c.post_id', $value->post_id)
            ->select('c.*', 'u.details_id', 'u.photo', 'u.name', 'u.description', 'u.years_of_expreience')
            ->orderBy('c.updated_at', 'DESC');
        $count = $query1->count();
        $result = $query1->get();
        return ['post_view_count' => $count, 'connected_agent_list' => $result];
    }

    /* get all data any filed using*/
    public function getSelectedDetailsByAny($limit, $where = null, $record = null)
    {
        $query = DB::table('agents_posts')->select(
            'agents_posts.*',
            'agents_users.id',
            'agents_users.agents_users_role_id',
            'agents_users.login_status',
            'agents_users.api_token',
            'agents_users_details.name',
            'agents_users_details.photo',
            'agents_users_details.description',
            'agents_users_details.address',
            'agents_users_details.address2',
            'agents_users_details.city_id',
            'agents_users_details.zip_code',
            'agents_users_details.years_of_expreience',
            'agents_users_details.brokers_name',
            'agents_users_details.total_sales',
            'agents_state.state_name'
        );
        $query->Join('agents_users', 'agents_users.id', '=', 'agents_posts.applied_user_id');
        $query->Join('agents_users_details', 'agents_users_details.details_id', '=', 'agents_posts.applied_user_id');
        $query->leftjoin('agents_state', 'agents_state.state_id', '=', 'agents_posts.state');
        if ($where != null) {
            $query->where($where);
        }
        $query->where('agents_posts.is_deleted', '0');
        $query->where('agents_posts.applied_post', '1');
        $query->orderBy('agents_posts.updated_at', 'DESC');
        if ($record == null) {
            $count = $query->count();
            $result = $query->skip($limit * 10)->take(10)->get();
            $coun = floor($count / 10);
            $prview = $limit == 0 ? 0 : $limit - 1;
            $next = $coun == $limit ? 0 : ($count <= 10 ? 0 : $limit + 1);
            $rlimit = $limit * 10 == 0 ? 1 : $limit * 10;
            $llimit = $next * 10 == 0 ? $count : $next * 10;
            $data = ['result' => $result, 'count' => $count, 'llimit' => $llimit, 'rlimit' => $rlimit, 'prview' => $prview, 'next' => $next];
        } else {
            $data = $query->first();
        }
        return $data;
    }

    /* get all data any filed using*/
    public function getDetailsBypostid($where = null)
    {
        $query = DB::table('agents_posts')
            ->select(
                'agents_city.city_name',
                'agents_state.state_name',
                'agents_posts.*',
                'agents_users.id',
                'agents_users.agents_users_role_id',
                'agents_users.login_status',
                'agents_users.api_token',
                'agents_users_details.name',
                'agents_users_details.photo',
                'agents_users_details.description',
                'agents_users_details.address',
                'agents_users_details.address2',
                'agents_users_details.city_id',
                'agents_users_details.zip_code',
                'agents_users_details.years_of_expreience',
                'agents_users_details.brokers_name',
                'agents_users_details.total_sales',
                'agents_users_roles.role_name'
            )
                ->leftJoin('agents_state', 'agents_state.state_id', '=', 'agents_posts.state')
                ->leftJoin('agents_city', 'agents_city.city_id', '=', 'agents_posts.city')
                ->leftJoin('agents_users', 'agents_users.id', '=', 'agents_posts.agents_user_id')
                ->leftJoin('agents_users_details', 'agents_users_details.details_id', '=', 'agents_users.id')
                ->leftJoin('agents_users_roles', 'agents_users_roles.role_id', '=', 'agents_posts.agents_users_role_id')
                ->when($where != null, function ($query) use ($where) {
                    $query->where($where);
                })
                ->where('agents_posts.is_deleted', '0')
                ->orderBy('agents_posts.created_at', 'DESC')
                ->first();

        return $query;
    }

    /* For post insert and update */
    public function inserupdate($data = null, $id = null)
    {
        if (empty($id)) {
            $result = DB::table('agents_posts')->insertGetId($data);
        } else {
            $result = DB::table('agents_posts')->where($id)->update($data);
        }
        return $result;
    }

    /* get all data any filed using Answers table*/
    public function getpostmultipalByAny($where = null)
    {
        $query = DB::table('agents_posts')->select('*');
        if ($where != null) {
            $query->where($where);
        }
        $query->where('agents_posts.is_deleted', '0');
        $query->orderBy('created_at', 'DESC');
        return $result = $query->get();
    }

    /* get all data any filed using Answers table*/
    public function getpostsingalByAny($where = null)
    {
        $query = DB::table('agents_posts')->select('*');
        if ($where != null) {
            $query->where($where);
        }
        $query->where('agents_posts.is_deleted', '0');
        $query->where('agents_posts.status', '1');

        // Apply pagination
        return $query->paginate();
        // return $result = $query->first();
    }

    /* Applied post listing get for agents */
    public function AppliedPostListGetForAgents($limit = null, $where = null, $orwhere = null, $selected = null)
    {
        $query = DB::table('agents_users_conections')
            ->join('agents_posts', 'agents_posts.post_id', '=', 'agents_users_conections.post_id')
            ->leftJoin('agents_users', 'agents_users.id', '=', 'agents_posts.agents_user_id')
            ->leftJoin('agents_state', 'agents_state.state_id', '=', 'agents_posts.state')
            ->leftJoin('agents_users_details', 'agents_users_details.details_id', '=', 'agents_posts.agents_user_id')
            ->where(function ($query) use ($where, $orwhere) {
                $query->whereRaw(DB::raw(
                    'CASE 
                    WHEN agents_users_conections.to_id = ' . $where['agents_users_conections.to_id'] . ' AND agents_users_conections.to_role = ' . $where['agents_users_conections.to_role'] . '
                    THEN agents_users_conections.from_id 	= 	agents_posts.agents_user_id
                    WHEN agents_users_conections.from_id 	= ' . $orwhere['agents_users_conections.from_id'] . '  AND agents_users_conections.from_role = ' . $orwhere['agents_users_conections.from_role'] . '
                    THEN agents_users_conections.to_id 		= 	agents_posts.agents_user_id 
                 END'
                ));
            });

        // Apply filters based on selected value
        if ($selected == 1) {
            $query->where(['agents_posts.applied_post' => $selected, 'agents_posts.applied_user_id' => $where['agents_users_conections.to_id']]);
        } elseif ($selected == 2) {
            $query->where(['agents_posts.applied_post' => $selected]);
        }

        // Select necessary columns
        $query->select(
            'agents_state.state_name',
            'agents_posts.*',
            'agents_posts.closing_date as post_close_date',
            'agents_posts.updated_at as pupdated_at',
            'agents_users.login_status',
            'agents_users_details.name',
            'agents_users_details.details_id',
            'agents_users_conections.*',
            DB::raw('(CASE WHEN agents_users_conections.to_id = ' . $where['agents_users_conections.to_id'] . ' AND agents_users_conections.to_role = ' . $where['agents_users_conections.to_role'] . ' THEN "to"  WHEN agents_users_conections.from_id = ' . $where['agents_users_conections.to_id'] . '  AND agents_users_conections.from_role = ' . $where['agents_users_conections.to_role'] . ' THEN "from" END) AS is_user')
        )
            ->orderBy('agents_users_conections.updated_at', 'DESC');

        // Get total count before pagination
        $count = $query->count();

        // Apply pagination
        $results = $query->skip($limit * 10)->take(10)->get();

        // Process results and add additional data
        foreach ($results as &$value) {
            $post_view_count = $this->postviewcount($value->post_id);

            $bd = $value->is_user == 'to'
                ? (object) ['details_id' => $value->from_id, 'details_id_role_id' => $value->from_role]
                : (object) ['details_id' => $value->to_id, 'details_id_role_id' => $value->to_role];

            $post_share_count = $this->getspecificnotificationbypost_id($bd, $value->post_id, $where['agents_users_conections.to_id'], $where['agents_users_conections.to_role']);

            $post_messages_count = $this->getspecificmessagenotificationbypost_id($bd, $value->post_id, $where['agents_users_conections.to_id'], $where['agents_users_conections.to_role']);

            $value = (object) array_merge((array) $value, (array) $post_view_count, (array) $post_messages_count, (array) $post_share_count);
        }

        // Calculate pagination values
        $coun = floor($count / 10);
        $prview = $limit == 0 ? 0 : $limit - 1;
        $next = $coun == $limit ? 0 : ($count <= 10 ? 0 : $limit + 1);
        $rlimit = $limit * 10 == 0 ? 1 : $limit * 10;
        $llimit = $next * 10 == 0 ? $count : $next * 10;

        return [
            'result' => $results,
            'count' => $count,
            'llimit' => $llimit,
            'rlimit' => $rlimit,
            'prview' => $prview,
            'next' => $next
        ];
    }

    /* Post view count process */
    public function postviewcount($post_id)
    {
        return DB::table('agents_users_conections')
            ->select(DB::raw('count(*) as post_view_count'))
            ->where('post_id', $post_id)
            ->groupBy('post_id')
            ->first();
    }

    /* Appled agents detail get for buyer */
    public function AppliedAgentsListGetForBuyer($limit, $post_id, $userid, $roleid)
    {
        $query1 = DB::table('agents_users_conections as m')
            ->join('agents_users_details as u', function ($join) {
                $join->on('u.details_id', '=', 'm.to_id')
                    ->orOn('u.details_id', '=', 'm.from_id');
            })
            ->join('agents_conversation as mc', function ($join) {
                $join->on('u.details_id', '=', 'mc.sender_id')
                    ->orOn('u.details_id', '=', 'mc.receiver_id');
            })
            ->leftJoin('agents_state', 'agents_state.state_id', '=', 'u.state_id')
            ->leftJoin('agents_city', 'agents_city.city_id', '=', 'u.city_id')
            ->join('agents_users', 'agents_users.id', '=', 'u.details_id')
            ->where(function ($query) use ($post_id, $userid, $roleid) {
                $query->whereRaw(DB::raw(
                    'CASE WHEN m.to_id = ' . $userid . ' AND m.to_role = ' . $roleid . '
					            THEN m.from_id = u.details_id
					            WHEN m.from_id = ' . $userid . '  AND m.from_role = ' . $roleid . '
					            THEN m.to_id = u.details_id END'
                ));
            })
            ->Join('agents_users_roles', 'agents_users_roles.role_id', '=', 'agents_users.agents_users_role_id')
            ->where(['m.post_id' => $post_id])
            ->select(
                'mc.conversation_id',
                'agents_users.id',
                'agents_users.agents_users_role_id',
                'u.brokers_name',
                'agents_state.state_name',
                'agents_city.city_name',
                'm.*',
                'u.name',
                'u.description',
                'u.photo',
                'u.years_of_expreience',
                'u.details_id',
                DB::raw('(CASE WHEN m.to_id = ' . $userid . ' AND m.to_role = ' . $roleid . ' THEN m.from_role  WHEN m.from_id = ' . $userid . '  AND m.from_role = ' . $roleid . ' THEN m.to_role END) AS details_id_role_id'),
                DB::raw('(CASE WHEN m.to_id = ' . $userid . ' AND m.to_role = ' . $roleid . ' THEN "to"  WHEN m.from_id = ' . $userid . '  AND m.from_role = ' . $roleid . ' THEN "from" END) AS is_user'),
                'agents_users.login_status',
                'agents_users_roles.role_name'
            )
            ->orderBy('m.created_at', 'DESC')
            ->groupBy('m.post_id');

        $count = $query1->count();
        $result = $query1->skip($limit * 10)->take(10)->get();
        $obj = [];

        foreach ($result as $value) {
            $agentscompare = $this->checkcompare($value, $post_id, $userid, $roleid);
            $post_share_count = $this->getspecificnotificationbypost_id($value, $post_id, $userid, $roleid);
            $post_messages_count = $this->getspecificmessagenotificationbypost_id($value, $post_id, $userid, $roleid);
            $obj[] = (object) array_merge((array) $value, (array) $post_messages_count, (array) $post_share_count, (array) $agentscompare);
        }

        $result = $obj;
        $coun = floor($count / 10);
        $prview = $limit == 0 ? 0 : $limit - 1;
        $next = $coun == $limit ? 0 : ($count <= 10 ? 0 : $limit + 1);
        $rlimit = $limit * 10 == 0 ? 1 : $limit * 10;
        $llimit = $next * 10 == 0 ? $count : $next * 10;
        $data = ['result' => $result, 'count' => $count, 'llimit' => $llimit, 'rlimit' => $rlimit, 'prview' => $prview, 'next' => $next];
        return $data;
    }

    /*  check compare details */
    public function checkcompare($value, $post_id, $userid, $roleid)
    {
        $queryc = DB::table('agents_compare')
            ->where([
                'post_id' => $value->post_id,
                'sender_id' => $userid,
                'sender_role' => $roleid,
            ])
            ->whereRaw('FIND_IN_SET(' . $value->id . ',compare_item_id)')
            ->select('agents_compare.*');
        $result = $queryc->first();
        $data = [];
        $data['compare'] = ['result' => $result];
        return $data;
    }

    /* Get specific notification by post id */
    public function getspecificnotificationbypost_id($value1, $post_id, $userid, $roleid)
    {
        $query = DB::table('agents_notification')
            ->whereIn('notification_type', [1, 2, 3, 4, 5, 8, 9, 10])
            ->where([
                'sender_id' => $value1->details_id,
                'sender_role' => $value1->details_id_role_id,
                'receiver_id' => $userid,
                'receiver_role' => $roleid,
                'status' => 1,
            ])
            ->select('agents_notification.*');
        $count = $query->count();
        $query->orderBy('notification_id', 'DESC');
        $result = $query->get();
        $obj = [];
        foreach ($result as $value) {
            if ($value->notification_type == 10) {
                $mergedata = $this->AskedQuestionReturnAnswer($value, $post_id, $userid, $roleid);
                if (!empty($mergedata)) {
                    $obj[] = (object) array_merge((array) $value, (array) $mergedata);
                }
            }
            if (in_array($value->notification_type, [1, 2, 3, 4, 5])) {
                $mergedata = $this->sharedatajoin($value, $post_id, $userid, $roleid);
                if (!empty($mergedata)) {
                    $obj[] = (object) array_merge((array) $value, (array) $mergedata);
                }
            }
            if (in_array($value->notification_type, [8, 9])) {
                $mergedata = $this->retingdatajoin($value, $post_id, $userid, $roleid);
                if (!empty($mergedata)) {
                    $obj[] = (object) array_merge((array) $value, (array) $mergedata);
                }
            }
        }
        $result = $obj;
        $data = [];
        $data['notificatio'] = ['result' => $result, 'count' => $count];
        return $data;
    }

    /* For get specific message notification by post id */
    public function getspecificmessagenotificationbypost_id($value, $post_id, $userid, $roleid)
    {
        $query1 = DB::table('agents_notification as n')
            ->join('agents_conversation as c', function ($join) {
                $join->on('c.conversation_id', '=', 'n.notification_item_id')
                    ->orOn('c.conversation_id', '=', 'n.notification_child_item_id');
            })
            ->leftJoin('agents_users_details as u', 'u.details_id', '=', 'n.sender_id')
            ->where(function ($query) {
                $query->whereRaw(DB::raw(
                    'CASE WHEN n.notification_type = 6
                        THEN n.notification_item_id = c.conversation_id
                        WHEN n.notification_type = 7
                        THEN n.notification_child_item_id = c.conversation_id END'
                ));
            })
            ->where([
                'n.sender_id' => $value->details_id,
                'n.sender_role' => $value->details_id_role_id,
                'n.receiver_id' => $userid,
                'n.receiver_role' => $roleid,
                'n.status' => 1,
                'c.post_id' => $post_id,
            ])
            ->whereIn('n.notification_type', [6, 7])
            ->select('n.*', 'c.conversation_id', 'c.post_id', 'c.snippet', 'u.name', 'u.details_id', 'u.photo')
            ->orderBy('n.created_at', 'DESC')
            ->groupBy('c.conversation_id');
        $result = $query1->get();
        $count = count($result);
        $data = [];
        $data['message_notificatio'] = ['result' => $result, 'count' => $count];
        return $data;
    }

    /* Get applied agents info for buyer */
    public function AppliedAgentsListGetForBuyerlimitfive($post_id, $userid, $roleid)
    {
        $query1 = DB::table('agents_users_conections as m')
            ->join('agents_users_details as u', function ($join) {
                $join->on('u.details_id', '=', 'm.to_id')
                    ->orOn('u.details_id', '=', 'm.from_id');
            })
            ->leftJoin('agents_state', 'agents_state.state_id', '=', 'u.state_id')
            ->leftJoin('agents_city', 'agents_city.city_id', '=', 'u.city_id')
            ->join('agents_users', 'agents_users.id', '=', 'u.details_id')
            ->where(function ($query) use ($post_id, $userid, $roleid) {
                $query->whereRaw(DB::raw(
                    'CASE WHEN m.to_id = ' . $userid . ' AND m.to_role = ' . $roleid . '
					            THEN m.from_id = u.details_id
					            WHEN m.from_id = ' . $userid . '  AND m.from_role = ' . $roleid . '
                                THEN m.to_id = u.details_id END'
                ));
            })
            ->where(['m.post_id' => $post_id])
            ->select(
                'agents_users.id',
                'agents_users.agents_users_role_id',
                'u.brokers_name',
                'agents_state.state_name',
                'agents_city.city_name',
                'm.*',
                'u.name',
                'u.description',
                'u.photo',
                'u.years_of_expreience',
                'u.details_id',
                DB::raw('(CASE WHEN m.to_id = ' . $userid . ' AND m.to_role = ' . $roleid . ' THEN m.from_role  WHEN m.from_id = ' . $userid . '  AND m.from_role = ' . $roleid . ' THEN m.to_role END) AS details_id_role_id'),
                DB::raw('(CASE WHEN m.to_id = ' . $userid . ' AND m.to_role = ' . $roleid . ' THEN "to"  WHEN m.from_id = ' . $userid . '  AND m.from_role = ' . $roleid . ' THEN "from" END) AS is_user')
            )
            ->orderBy('m.created_at', 'DESC');
        $queryunion = $query1;
        $count = $queryunion->count();
        $result = $queryunion->skip(0)->take(5)->get();

        $data = ['result' => $result, 'count' => $count];
        return $data;
    }

    /* For share data process */
    public function sharedatajoin($value, $post_id, $userid, $roleid)
    {
        $queryc = DB::table('agents_shared')
            ->where([
                'agents_shared.shared_item_id' => $value->notification_child_item_id,
                'agents_shared.shared_id' => $value->notification_item_id,
                'agents_shared.shared_item_type_id' => $post_id,
                'agents_shared.sender_id' => $value->sender_id,
                'agents_shared.sender_role' => $value->sender_role,
                'agents_shared.receiver_id' => $userid,
                'agents_shared.receiver_role' => $roleid,
            ])
            ->select('agents_shared.shared_item_type_id as post_id');
        $result = $queryc->first();
        return $result;
    }

    /* For rating data */
    public function retingdatajoin($value, $post_id, $userid, $roleid)
    {
        $query1 = DB::table('agents_rating')
            ->where(['agents_rating.rating_id' => $value->notification_item_id])
            ->select('*');
        $result = $query1->first();
        if ($result->rating_type == 1) {
            $queryc = DB::table('agents_answers')
                ->Join('agents_shared', 'agents_shared.shared_item_id', '=', 'agents_answers.question_id')
                ->where([
                    'agents_answers.question_id' => $result->rating_item_parent_id,
                    'agents_answers.answers_id' => $result->rating_item_id,
                    'agents_answers.from_id' => $userid,
                    'agents_answers.from_role' => $roleid,
                    'agents_shared.shared_item_id' => $result->rating_item_parent_id,
                    'agents_shared.receiver_id' => $userid,
                    'agents_shared.receiver_role' => $roleid,
                    'agents_shared.shared_item_type_id' => $post_id,
                ])
                ->where('agents_shared.shared_type', 1)
                ->select('agents_shared.shared_item_type_id as post_id');
            $result1 = $queryc->first();
        }
        if ($result->rating_type == 2) {
            $queryc = DB::table('agents_conversation_message')
                ->where([
                    'agents_conversation_message.messages_id' => $result->rating_item_id,
                    'agents_conversation_message.conversation_id' => $result->rating_item_parent_id,
                    'agents_conversation_message.post_id' => $post_id,
                ])
                ->select('post_id');
            $result1 = $queryc->first();
        }
        return $result1;
    }

    /* Asked question return answer details */
    public function AskedQuestionReturnAnswer($value, $post_id, $userid, $roleid)
    {
        $queryc = DB::table('agents_answers')
            ->Join('agents_shared', 'agents_shared.shared_item_id', '=', 'agents_answers.question_id')
            ->where([
                'agents_answers.question_id' => $value->notification_child_item_id,
                'agents_answers.answers_id' => $value->notification_item_id,
                'agents_shared.shared_item_id' => $value->notification_child_item_id,
                'agents_shared.sender_id' => $value->receiver_id,
                'agents_shared.sender_role' => $value->receiver_role,
                'agents_shared.receiver_id' => $value->sender_id,
                'agents_shared.receiver_role' => $value->sender_role,
                'agents_shared.shared_item_type_id' => $post_id,
            ])
            ->where('agents_shared.shared_type', 1)
            ->select('agents_shared.shared_item_type_id as post_id');
        return $result1 = $queryc->first();
    }

    /*search post public by agents*/
    public function getSearchAnyByAny($limit, $where = null)
    {
        $bookmark = new Bookmark;
        $rating = new Rating;
        $loginusser = Auth::user();

        // Return empty result if search input type is empty
        if (empty($where['searchinputtype'])) {
            return [
                'result' => [],
                'count' => 0,
                'llimit' => 0,
                'rlimit' => 0,
                'prview' => 0,
                'next' => 0
            ];
        }

        // Create a new query builder instance based on search type
        switch ($where['searchinputtype']) {
            case 'post_contains':
                $query = $this->buildPostQuery($where);
                break;
            case 'name':
                $query = $this->buildUserQuery($where);
                break;
            case 'messages':
                $query = $this->buildMessageQuery($where, $loginusser);
                break;
            case 'questions_asked':
                $query = $this->buildQuestionAskedQuery($where, $loginusser);
                break;
            case 'questions_answered':
                $query = $this->buildQuestionAnsweredQuery($where, $loginusser);
                break;
            case 'answers':
                $query = $this->buildAnswerQuery($where, $loginusser);
                break;
            default:
                return [
                    'result' => [],
                    'count' => 0,
                    'llimit' => 0,
                    'rlimit' => 0,
                    'prview' => 0,
                    'next' => 0
                ];
        }

        // print_r($query->toSql()); exit;

        // Execute the query and return results
        $count = $query->count();
        $result = $query->skip($limit * 10)->take(10)->get();

        // Process results for specific search types
        if ($where['searchinputtype'] == 'post_contains') {
            $result = $this->processPostResults($result);
        } elseif ($where['searchinputtype'] == 'questions_answered' || $where['searchinputtype'] == 'answers') {
            $result = $this->processAnswerResults($result, $bookmark, $rating, $loginusser);
        }

        // Calculate pagination values
        $coun = floor($count / 10);
        $prview = $limit == 0 ? 0 : $limit - 1;
        $next = $coun == $limit ? 0 : ($count <= 10 ? 0 : $limit + 1);
        $rlimit = $limit * 10 == 0 ? 1 : $limit * 10;
        $llimit = $next * 10 == 0 ? $count : $next * 10;

        return [
            'result' => $result,
            'count' => $count,
            'llimit' => $llimit,
            'rlimit' => $rlimit,
            'prview' => $prview,
            'next' => $next
        ];
    }

    // Function to build query for post search
    private function buildPostQuery($where)
    {
        $query = DB::table('agents_posts')
            ->select(
                'agents_posts.*',
                'agents_state.state_name',
                'agents_city.city_name',
                'agents_users.id',
                'agents_users.login_status',
                'agents_users.agents_users_role_id',
                'agents_users.api_token',
                'agents_users_details.name',
                'agents_users_details.details_id',
                'agents_users_details.description',
                'agents_users_details.years_of_expreience',
                'agents_users_details.price_range',
                'agents_users_roles.role_name'
            )
            ->leftJoin('agents_state', 'agents_state.state_id', '=', 'agents_posts.state')
            ->leftJoin('agents_city', 'agents_city.city_id', '=', 'agents_posts.city')
            ->leftJoin('agents_users_roles', 'agents_users_roles.role_id', '=', 'agents_posts.agents_users_role_id')
            ->Join('agents_users', 'agents_users.id', '=', 'agents_posts.agents_user_id')
            ->Join('agents_users_details', 'agents_users_details.details_id', '=', 'agents_users.id')
            ->where('agents_posts.is_deleted', '0')
            ->where('agents_posts.status', '1')
            ->where('agents_posts.applied_post', '2')
            ->groupBy('agents_posts.post_id')
            ->orderBy('agents_posts.created_at', 'DESC');

        // Add conditions based on provided filters
        if (isset($where['date'])) {
            $this->applyDateFilter($query, $where['date'], 'agents_posts');
        }

        if (isset($where['city'])) {
            $this->applyCityFilter($query, $where['city']);
        }

        if (isset($where['state'])) {
            $this->applyStateFilter($query, $where['state']);
        }

        if (isset($where['zipcodes'])) {
            $this->applyZipcodeFilter($query, $where['zipcodes']);
        }

        if (isset($where['address'])) {
            $this->applyAddressFilter($query, $where['address']);
        }

        if (isset($where['cityName'])) {
            $this->applyCityNameFilter($query, $where['cityName']);
        }

        if (isset($where['keyword'])) {
            $this->applyKeywordFilter($query, $where['keyword'], ['posttitle', 'details']);
        }


        return $query;
    }

    // Function to build query for user search
    private function buildUserQuery($where)
    {
        $query = DB::table('agents_users')
            ->select(
                'agents_users.*',
                'agents_users_details.*',
                'agents_state.state_name',
                'agents_users_details.city_id as city_name'
            )
            ->Join('agents_users_details', 'agents_users_details.details_id', '=', 'agents_users.id')
            ->leftJoin('agents_posts', 'agents_posts.agents_user_id', '=', 'agents_users.id')
            ->leftJoin('agents_state', 'agents_state.state_id', '=', 'agents_users_details.state_id')
            ->where('agents_users.is_deleted', '0')
            ->groupBy('agents_users.id')
            ->orderBy('agents_users.created_at', 'DESC');

        // Add conditions based on provided filters
        if (isset($where['date'])) {
            $this->applyDateFilter($query, $where['date'], 'agents_users');
        }

        if (isset($where['usertype'])) {
            $this->applyUserTypeFilter($query, $where['usertype']);
        }

        if (isset($where['cityName'])) {
            $this->applyCityNameFilter($query, $where['cityName'], 'agents_users_details');
        }

        if (isset($where['city'])) {
            $this->applyStateFilter($query, $where['state'], 'agents_users_details');
        }

        if (isset($where['zipcodes'])) {
            $this->applyZipcodeFilter($query, $where['zipcodes'], 'agents_users_details');
        }

        if (isset($where['address'])) {
            $this->applyAddressFilter($query, $where['address'], 'agents_users_details');
        }

        if (isset($where['keyword'])) {
            $this->applyKeywordFilter($query, $where['keyword'], ['name', 'description'], 'agents_users_details');
        }

        return $query;
    }

    // Function to build query for message search
    private function buildMessageQuery($where, $loginusser)
    {
        $query = DB::table('agents_conversation_message as m')
            ->join('agents_users_details as u', function ($join) {
                $join->on('u.details_id', '=', 'm.sender_id')
                    ->orOn('u.details_id', '=', 'm.receiver_id');
            })
            ->leftJoin('agents_users as uu', 'uu.id', '=', 'u.details_id')
            ->leftJoin('agents_posts as p', 'p.post_id', '=', 'm.post_id')
            ->leftJoin('agents_conversation as cc', 'cc.conversation_id', '=', 'm.conversation_id')
            ->where(function ($query1) use ($loginusser) {
                $query1->where([
                    'm.sender_id' => $loginusser->id,
                    'm.sender_role' => $loginusser->agents_users_role_id,
                ]);
                $query1->orWhere([
                    'm.receiver_id' => $loginusser->id,
                    'm.receiver_role' => $loginusser->agents_users_role_id,
                ]);
            })
            ->where(function ($query1) use ($loginusser) {
                $query1->whereRaw(DB::raw(
                    'CASE WHEN m.sender_id = ' . $loginusser->id . ' AND m.sender_role = ' . $loginusser->agents_users_role_id . '
                                    THEN m.receiver_id = u.details_id
                                    WHEN m.receiver_id = ' . $loginusser->id . '  AND m.receiver_role = ' . $loginusser->agents_users_role_id . '
                                    THEN m.sender_id = u.details_id END'
                ));
            })
            ->select(
                'u.details_id as receiver_user_id',
                'm.*',
                'uu.login_status',
                'uu.api_token',
                'u.name',
                'u.photo',
                'p.posttitle',
                'p.details as post_details',
                'cc.snippet',
                DB::raw('(CASE WHEN m.sender_id = ' . $loginusser->id . ' AND m.sender_role = ' . $loginusser->agents_users_role_id . ' THEN m.receiver_role  WHEN m.receiver_id = ' . $loginusser->id . '  AND m.receiver_role = ' . $loginusser->agents_users_role_id . ' THEN m.sender_role END) AS receiver_user_role_id'),
                DB::raw('(CASE WHEN m.sender_id = ' . $loginusser->id . ' AND m.sender_role = ' . $loginusser->agents_users_role_id . ' THEN "sender"  WHEN m.receiver_id = ' . $loginusser->id . '  AND m.receiver_role = ' . $loginusser->agents_users_role_id . ' THEN "receiver" END) AS is_user')
            )
            ->orderBy('m.messages_id', 'DESC');

        // Add conditions based on provided filters
        if (isset($where['date'])) {
            $this->applyDateFilter($query, $where['date'], 'm');
        }

        if (isset($where['keyword'])) {
            $this->applyKeywordFilter($query, $where['keyword'], ['message_text'], 'm');
        }

        return $query;
    }

    // Function to build query for questions asked search
    private function buildQuestionAskedQuery($where, $loginusser)
    {
        $query = DB::table('agents_shared')
            ->leftJoin('agents_question', 'agents_question.question_id', '=', 'agents_shared.shared_item_id')
            ->leftJoin('agents_posts', 'agents_posts.post_id', '=', 'agents_shared.shared_item_type_id')
            ->leftJoin('agents_users_details', 'agents_users_details.details_id', '=', 'agents_shared.receiver_id')
            ->where([
                'agents_shared.shared_type' => '1',
                'agents_shared.receiver_id' => $loginusser->id,
                'agents_shared.receiver_role' => $loginusser->agents_users_role_id,
                'agents_question.is_deleted' => '0'
            ])
            ->select(
                'agents_shared.*',
                'agents_question.question',
                'agents_question.question_type',
                'agents_question.question_id',
                'agents_users_details.name',
                'agents_users_details.photo',
                'agents_users_details.description',
                'agents_posts.posttitle',
                'agents_posts.post_id',
                'agents_posts.details'
            )
            ->orderBy('agents_shared.created_at', 'DESC');

        // Add conditions based on provided filters
        if (isset($where['date'])) {
            $this->applyDateFilter($query, $where['date'], 'agents_shared');
        }

        if (isset($where['keyword'])) {
            $this->applyKeywordFilter($query, $where['keyword'], ['question'], 'agents_question');
        }

        return $query;
    }

    // Function to build query for questions answered search
    private function buildQuestionAnsweredQuery($where, $loginusser)
    {
        $query = DB::table('agents_shared')
            ->leftJoin('agents_answers', 'agents_answers.question_id', '=', 'agents_shared.shared_item_id')
            ->Join('agents_question', 'agents_question.question_id', '=', 'agents_shared.shared_item_id')
            ->Join('agents_posts', 'agents_posts.post_id', '=', 'agents_shared.shared_item_type_id')
            ->Join('agents_users_details', 'agents_users_details.details_id', '=', 'agents_shared.receiver_id')
            ->where([
                'agents_shared.shared_type' => '1',
                'agents_question.is_deleted' => '0',
                'agents_question.add_by' => $loginusser->id,
                'agents_question.add_by_role' => $loginusser->agents_users_role_id
            ])
            ->select(
                'agents_shared.shared_id',
                'agents_shared.created_at as shared_date',
                'agents_question.question',
                'agents_question.question_id',
                'agents_question.question_type',
                'agents_answers.answers',
                'agents_answers.answers_id',
                'agents_answers.from_id',
                'agents_answers.from_role',
                'agents_posts.post_id',
                'agents_posts.posttitle',
                'agents_posts.details',
                'agents_users_details.name',
                'agents_users_details.photo',
                'agents_users_details.description'
            )
            ->orderBy('agents_shared.created_at', 'DESC');

        // Add conditions based on provided filters
        if (isset($where['date'])) {
            $this->applyDateFilter($query, $where['date'], 'agents_shared');
        }

        if (isset($where['keyword'])) {
            // JkWorkz. Need to check if this logic works.. Saw a random column not found error..
            $this->applyKeywordFilter($query, $where['keyword'], ['question'], 'agents_question');
            $this->applyKeywordFilter($query, $where['keyword'], ['answers'], 'agents_answers');

            // Original Code
            // $this->applyKeywordFilter($query, $where['keyword'], ['answers', 'question'], ['agents_answers', 'agents_question']);
        }

        return $query;
    }

    // Function to build query for answer search
    private function buildAnswerQuery($where, $loginusser)
    {
        $query = DB::table('agents_answers')
            ->Join('agents_question', 'agents_question.question_id', '=', 'agents_answers.question_id')
            ->leftJoin('agents_posts', 'agents_posts.post_id', '=', 'agents_answers.post_id')
            ->leftJoin('agents_users_details', 'agents_users_details.details_id', '=', 'agents_question.add_by')
            ->where([
                'agents_answers.from_id' => $loginusser->id,
                'agents_answers.from_role' => $loginusser->agents_users_role_id,
                'agents_question.is_deleted' => '0'
            ])
            ->whereNotIn('agents_question.add_by_role', [1])
            ->select(
                'agents_question.question',
                'agents_question.question_id',
                'agents_question.question_type',
                'agents_answers.*',
                'agents_posts.post_id',
                'agents_posts.posttitle',
                'agents_posts.details',
                'agents_users_details.name',
                'agents_users_details.photo',
                'agents_users_details.description'
            )
            ->orderBy('agents_answers.created_at', 'DESC');

        // Add conditions based on provided filters
        if (isset($where['date'])) {
            $this->applyDateFilter($query, $where['date'], 'agents_answers');
        }

        if (isset($where['keyword'])) {
            // JkWorkz. Need to check if this logic works.. Saw a random column not found error..
            $this->applyKeywordFilter($query, $where['keyword'], ['question'], 'agents_question');
            $this->applyKeywordFilter($query, $where['keyword'], ['answers'], 'agents_answers');

            // Original Code
            // $this->applyKeywordFilter($query, $where['keyword'], ['answers', 'question'], ['agents_answers', 'agents_question']);
        }

        return $query;
    }

    // Function to apply date filter to a query
    private function applyDateFilter(&$query, $dateValue, $tablePrefix = null)
    {
        if (!empty($dateValue)) {
            $dd = explode('-', $dateValue);
            $dd1 = date('Y-m-d', strtotime($dd[0]));
            $dd2 = date('Y-m-d', strtotime($dd[1]));
            $column = $tablePrefix ? "$tablePrefix.created_at" : "created_at";
            $query->whereBetween($column, [$dd1, $dd2]);
        }
    }

    // Function to apply city filter to a query
    private function applyCityFilter(&$query, $cityValue, $tablePrefix = null)
    {
        if (!empty($cityValue)) {
            $column = $tablePrefix ? $tablePrefix . '.city' : 'city';
            $query->where($column, $cityValue);
        }
    }

    // Function to apply state filter to a query
    private function applyStateFilter(&$query, $stateValue, $tablePrefix = null)
    {
        if (!empty($stateValue)) {
            $column = $tablePrefix ? $tablePrefix . '.state' : 'state';
            $query->where($column, $stateValue);
        }
    }

    // Function to apply zipcode filter to a query
    private function applyZipcodeFilter(&$query, $zipcodeValue, $tablePrefix = null)
    {
        if (!empty($zipcodeValue)) {
            $column = $tablePrefix ? $tablePrefix . '.zip' : 'zip';
            $query->where($column, $zipcodeValue);
        }
    }

    // Function to apply address filter to a query
    private function applyAddressFilter(&$query, $addressValue, $tablePrefix = null)
    {
        if (!empty($addressValue)) {
            $query->where(function ($query1) use ($addressValue, $tablePrefix) {
                $column1 = $tablePrefix ? $tablePrefix . '.address1' : 'address1';
                $column2 = $tablePrefix ? $tablePrefix . '.address2' : 'address2';
                $query1->where($column1, 'LIKE', "%" . $addressValue . "%");
                $query1->orWhere($column2, 'LIKE', "%" . $addressValue . "%");
            });
        }
    }

    // Function to apply city name filter to a query
    private function applyCityNameFilter(&$query, $cityNameValue, $tablePrefix = null)
    {
        if (!empty($cityNameValue)) {
            $column = $tablePrefix ? $tablePrefix . '.city_id' : 'city_id';
            $query->where($column, 'LIKE', "%" . $cityNameValue . "%");
        }
    }

    // Function to apply user type filter to a query
    private function applyUserTypeFilter(&$query, $userTypeValue)
    {
        if (!empty($userTypeValue)) {
            $query->where('agents_posts.agents_users_role_id', $userTypeValue);
        }
    }

    // Function to apply keyword filter to a query
    private function applyKeywordFilter(&$query, $keywordValue, $columns, $tablePrefix = null)
    {
        if (!empty($keywordValue)) {
            $query->where(function ($query1) use ($keywordValue, $columns, $tablePrefix) {
                foreach ($columns as $column) {
                    $column = $tablePrefix ? "$tablePrefix.$column" : $column;
                    $query1->orWhere($column, 'LIKE', "%$keywordValue%");
                }
            });
        }
    }

    // Function to process post results
    private function processPostResults($results)
    {
        $obj = [];
        foreach ($results as $value) {
            $post_view_count = $this->postviewcountandagentlist($value, ['agents_posts.agents_user_id' => $value->id, 'agents_posts.agents_users_role_id' => $value->agents_users_role_id]);
            $obj[] = (object) array_merge((array) $value, (array) $post_view_count);
        }
        return $obj;
    }

    // Function to process answer results
    private function processAnswerResults($results, $bookmark, $rating, $loginusser)
    {
        $obj = [];
        foreach ($results as $value) {
            $bok = $bookmark->getBookmarkSingalByAny([
                'bookmark_type' => 4,
                'bookmark_item_id' => $value->answers_id,
                'bookmark_item_parent_id' => $value->question_id,
                'sender_id' => $loginusser->id,
                'sender_role' => $loginusser->agents_users_role_id
            ]);
            $rat = $rating->getRatingSingalByAny(['rating_type' => 1, 'rating_item_id' => $value->answers_id, 'rating_item_parent_id' => $value->question_id]);
            $obj[] = (object) array_merge((array) $value, (array) ['bookmark' => $bok], (array) ['rating' => $rat]);
        }
        return $obj;
    }

    /* reply answers process */
    public function replyanswersgetbypostidanduseridwithbookmarkandrating($value, $loginusser, Request $request)
    {
        $question = new QuestionAnswers;
        $ans = $question->getAnswersByAny(['post_id' => $value->post_id, 'is_deleted' => '0', 'question_id' => $value->question_id, 'from_id' => $value->receiver_id, 'from_role' => $value->receiver_role]);
        if (empty($ans)) {
            $answers[$value->question_id] = '';
        } else {
            $answers[$value->question_id] = $ans;
            if ($request->input('bookmark') && !empty($request->input('bookmark'))) {
                $bookmark = new Bookmark;
                $bok = $bookmark->getBookmarkSingalByAny();
                if (empty($bok)) {
                    $bookmarkdata[$ans->answers_id] = '';
                } else {
                    $bookmarkdata[$ans->answers_id] = $bok;
                }
            }
            if ($request->input('rating') && !empty($request->input('rating'))) {
                $rating = new Rating;
                $rat = $rating->getRatingSingalByAny([
                    'rating_type' => 1,
                    'rating_item_id' => $ans->answers_id,
                    'rating_item_parent_id' => $ans->question_id,
                    'sender_id' => $request->input('add_by'),
                    'sender_role' => $request->input('add_by_role'),
                    'receiver_id' => $request->input('receiver_id'),
                    'receiver_role' => $request->input('question_type')
                ]);
                if (empty($rat)) {
                    $ratingdata[$ans->answers_id] = '';
                } else {
                    $ratingdata[$ans->answers_id] = $rat;
                }
            }
        }
    }

    /* For get all posts show in admin. */
    public function getPostList($request, $limit = NUll, $offset = NULL)
    {
        $result = [];
        $query = DB::table('agents_posts as a')->select('a.*', 'b.name', 'c.role_name');
        $query->Join('agents_users_details as b', 'b.details_id', '=', 'a.agents_user_id');
        $query->Join('agents_users_roles as c', 'c.role_id', '=', 'a.agents_users_role_id');
        $query->where('a.is_deleted', '0');
        if ($request['search']['value'] == 'active' || (isset($request['columns']) && isset($request['columns'][6]) && $request['columns'][6]['search']['value'] == 'active')) {
            // $statusQuery = 1;
            $query->where('a.status', 1);
        } else if ($request['search']['value'] == 'deactive' || (isset($request['columns']) && isset($request['columns'][6]) && $request['columns'][6]['search']['value'] == 'deactive')) {
            // $statusQuery = 0;
            $query->where('a.status', 0);
        } else {
            $statusQuery = '';
        }
        if (
            $request['search']['value'] == 'buyer' ||
            $request['search']['value'] == 'seller'
        ) {
            //$query->where('a.posttitle', 'like', "%".$request['search']['value']."%");
            //$query->orwhere('b.name', 'like', "%".$request['search']['value']."%");
            $query->where('c.role_name', 'like', "%" . $request['search']['value'] . "%");
        }
        if (
            (
                isset($request['columns']) &&
                isset($request['columns'][4]) &&
                $request['columns'][4]['search']['value'] == 'buyer'
            ) ||
            (
                isset($request['columns']) &&
                isset($request['columns'][4]) &&
                $request['columns'][4]['search']['value'] == 'seller'
            )
        ) {
            $query->where('c.role_name', 'like', "%" . $request['columns'][4]['search']['value'] . "%");
        }
        // if ($statusQuery != '') {
        //     $query->where('a.status', $statusQuery);
        // }
        $result['num'] = count($query->get());
        if (!empty($limit)) {
            $query->take($limit)->skip($offset);
        }
        if (isset($request['order'][0]['column'])) {
            $arr = ['a.post_id', 'a.posttitle', 'a.address1', 'b.name', 'c.role_name', 'a.created_at'];
            $columns = isset($arr[$request['order'][0]['column']]) ? $arr[$request['order'][0]['column']] : 'a.post_id';
            $dir = $request['order'][0]['dir'];
            $query->orderBy($columns, $dir);
        } else {
            $query->orderBy('a.post_id', 'DESC');
        }
        $result['result'] = $query->get();
        // dd($query->toSql());
        return $result;
    }

    public function getAppliedPostsBySelectedAgent($agentId)
    {
        $result = DB::table('agents_posts')
            ->where([['applied_user_id', '=', $agentId]])
            ->whereNotNull('closing_date')
            ->count();
        return $result;
    }

    /* Agent selectd for posts */
    public function SelectedPostListGetForAgents($limit = null, $where = null, $selected = null)
    {
        $query1 = DB::table('agents_posts')
            ->leftJoin('agents_users', 'agents_users.id', '=', 'agents_posts.agents_user_id')
            ->leftJoin('agents_state', 'agents_state.state_id', '=', 'agents_posts.state')
            ->leftJoin('agents_users_details', 'agents_users_details.details_id', '=', 'agents_posts.agents_user_id')
            ->where($where);
        $query1->select('agents_state.state_name', 'agents_posts.*', 'agents_posts.updated_at as pupdated_at', 'agents_users.login_status', 'agents_users_details.name', 'agents_users_details.details_id')
            ->orderBy('agents_posts.agent_select_date', 'DESC');
        $queryunion = $query1;
        $count = $queryunion->count();
        $result = $queryunion->skip($limit * 10)->take(10)->get();
        $coun = floor($count / 10);
        $prview = $limit == 0 ? 0 : $limit - 1;
        $next = $coun == $limit ? 0 : ($count <= 10 ? 0 : $limit + 1);
        $rlimit = $limit * 10 == 0 ? 1 : $limit * 10;
        $llimit = $next * 10 == 0 ? $count : $next * 10;
        $data = ['result' => $result, 'count' => $count, 'llimit' => $llimit, 'rlimit' => $rlimit, 'prview' => $prview, 'next' => $next];
        return $data;
    }

    /* Get the unclosed post counts */
    public function get_pending_closed_count($agent_id)
    {
        $min_close_minutes = env('ADD_CLOSE_DATE_HOUR') * 60;

        $pending_closing_date_count = DB::table('agents_posts')
            ->where(['applied_user_id' => $agent_id, 'status' => 1])
            ->whereNotNull('agent_select_date')
            ->whereNull('closing_date')
            ->get();

        $final_count = 0;

        foreach ($pending_closing_date_count as $post) {
            $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $post->agent_select_date, 'UTC'); // Use UTC
            $from = \Carbon\Carbon::now('UTC'); // Use UTC
            $diff_in_minutes = $to->diffInMinutes($from);

            if ($diff_in_minutes >= $min_close_minutes) {
                $final_count++;
            }
        }

        return $final_count;
    }

    public function get_pending_closed_count_jk($agent_id)
    {
        $pending_closing_date_count = DB::table('agents_posts')
            ->where(['applied_user_id' => $agent_id, 'status' => 1])
            ->whereNotNull('agent_select_date')
            ->whereNull('closing_date')
            ->get();

        $final_count = 0;

        foreach ($pending_closing_date_count as $post) {
            $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $post->agent_select_date);
            $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', date('Y-m-d H:s:i'));
            $diff_in_days = $to->diffInDays($from);
            if ($diff_in_days > env('ADD_CLOSE_DATE_DAY')) {
                $final_count++;
            }
        }
        return $final_count;
    }
}
