<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

use App\Events\eventTrigger;


class User extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $table = "agents_users";
    protected $primaryKey = "id";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'activation_link',
        'forgot_token',
        'api_token',
    ];


    /**
     * Retrieve user information.
     *
     * @param array $filter Filter criteria for the user.
     * @return mixed User object or false if not found.
     */
    public static function info($filter = [])
    {
        // Use AuthCheck helper function if available. Otherwise, check for filter.
        if (function_exists('AuthCheck') && AuthCheck()) {
            $user_id = AuthUser();
        } else {
            if (empty($filter)) {
                return false;
            }
        }

        $filter = empty($filter) ? ['id', $user_id] : $filter;

        // Retrieve user using a join instead of a relationship to avoid extra queries.
        return User::where($filter)
            ->where('status', '!=', 0)
            ->leftJoin('agents_users_details', 'agents_users.id', '=', 'agents_users_details.details_id')
            ->select(
                'agents_users.*',
                'agents_users_details.*',
            )
            ->first();
    }


    /**
     * Define the relationship with Userdetails model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function details()
    {
        return $this->hasOne(Userdetails::class, 'details_id', 'id');
    }


    /**
     * Insert or update a user record.
     *
     * @param array|null $data Data to insert or update.
     * @param array|null $id   ID of the record to update (optional).
     * @return mixed The inserted ID or the number of affected rows.
     */
    public function inserupdate($data = null, $id = null)
    {
        if (empty($id)) {
            $result = DB::table('agents_users')->insertGetId($data);
        } else {
            $result = DB::table('agents_users')->where($id)->update($data);
        }
        return $result;
    }


    /**
     * Get a single user by any criteria.
     *
     * @param array|null $where Where clause.
     * @return mixed User object.
     */
    public function getuserSingalByAny($where = null)
    {
        $query = DB::table('agents_users')->select('*');
        if ($where != null) {
            $query->where($where);
        }
        $query->orderBy('created_at', 'DESC');
        return $query->first();
    }


    /**
     * Get a user by email and role.
     *
     * @param array $where Where clause containing email and role.
     * @return mixed User object.
     */
    public function getByEmailOrId($where = [])
    {
        return DB::table('agents_users')->select('*')

        ->where(['agents_users.email' => $where['email'], 'agents_users.agents_users_role_id' => $where['agents_users_role_id']])
            ->first();
    }


    /**
     * Get user data by any criteria.
     *
     * @param array $where Where clause.
     * @return mixed User object.
     */
    public function getByanydata($where = [])
    {
        $query = DB::table('agents_users')->select('*');
        if ($where != null) {
            $query->where($where);
        }
        return $query->first();
    }



    /**
     * Get user details by email, ID, role ID, or forgot token.
     *
     * @param array $where Where clause containing search criteria.
     * @return mixed User details object.
     */
    public function getDetailsByEmailOrId($where = [])
    {
        $query = DB::table('agents_users')->select('*');
        $query->leftJoin('agents_users_details', 'agents_users_details.details_id', '=', 'agents_users.id');

        // Use conditional clauses for better readability.
        if (!empty($where['email'])) {
            $query->where('agents_users.email', $where['email']);
        }

        if (!empty($where['id'])) {
            $query->where('agents_users.id', $where['id']);
        }

        if (!empty($where['role_id'])) {
            $query->where('agents_users.agents_users_role_id', $where['role_id']);
        }

        if (!empty($where['forgot_token'])) {
            $query->where('agents_users.forgot_token', $where['forgot_token']);
        }

        $query->where('agents_users.is_deleted', '0');
        $query->orderBy('agents_users_details.created_at', 'DESC');
        return $query->first();
    }


    /**
     * Generate a random password.
     *
     * @param int $length Desired password length.
     * @return string Randomly generated password.
     */
    public function randPassword($length = 16)
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ{@#()!%&^*-*/-!}';
        return substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
    }


    /**
     * Get a limited number of users by any criteria.
     *
     * @param int         $limit   Number of records to skip.
     * @param array|null $where   Where clause.
     * @param mixed|null $compare Comparison operator. Currently unused.
     * @return array Data including results, count, and pagination information.
     */
    public function getLmitedUsersByAny($limit, $where = null, $compare = null)
    {

        $query = DB::table('agents_users')->select('*');
        $query->leftJoin('agents_users_details', 'agents_users_details.details_id', '=', 'agents_users.id');

        if ($where != null) {
            $query->where($where);
        }

        $query->orderBy('agents_users_details.created_at', 'DESC');
        $count = $query->count();
        $result = $query->skip($limit * 10)->take(10)->get();

        return $this->paginateResults($count, $limit, 10, $result); // Using the private function
    }


    /**
     * Get a limited number of users with photos.
     *
     * @param int         $limit Number of records to skip.
     * @param array|null $where Where clause.
     * @return array Data including results, count, and pagination information.
     */
    public function getforeUsersByAnyonly($limit, $where = null)
    {
        $query = DB::table('agents_users')->select('*');
        $query->Join('agents_users_details', 'agents_users_details.details_id', '=', 'agents_users.id');
        $query->Join('agents_state', 'agents_state.state_id', '=', 'agents_users_details.state_id');
        $query->Join('agents_city', 'agents_city.city_id', '=', 'agents_users_details.city_id');

        if ($where != null) {
            $query->where($where);
        }

        $query->whereNotNull('agents_users_details.photo');
        $query->orderBy('agents_users.id', 'DESC');
        $count = $query->count();
        $result = $query->skip($limit * 4)->take(4)->get();


        return $this->paginateResults($count, $limit, 4, $result); // Using the private function
    }



    /**
     * Get user details with state and city information.
     *
     * @param array|null $where Where clause.
     * @return mixed User details object.
     */
    public function getuserdetailsByAny($where = null)
    {
        $query = DB::table('agents_users')->select('agents_users.*', 'agents_users_details.*', 'agents_state.state_name', 'agents_state.state_id', 'agents_city.city_name');

        $query->Join('agents_users_details', 'agents_users_details.details_id', '=', 'agents_users.id');
        $query->leftJoin('agents_state', 'agents_state.state_id', '=', 'agents_users_details.state_id');
        $query->leftJoin('agents_city', 'agents_city.city_id', '=', 'agents_users_details.city_id');

        if ($where != null) {
            $query->where($where);
        }

        $query->orderBy('agents_users.id', 'DESC');

        return $query->first();
    }


    /**
     * Manage user connections related to a post.
     *
     * @param array|null $where Where clause containing connection details.
     * @return mixed  Connection ID or number of affected rows.
     */
    public function usersconection($where = null)
    {

        $query1 = DB::table('agents_users_conections')->select('*');

        if ($where != null) {
            $query1->where(function ($query) use ($where) {
                $query->where([
                    'to_id' => $where['to_id'],
                    'to_role' => $where['to_role'],
                    'from_id' => $where['from_id'],
                    'from_role' => $where['from_role'],
                    'post_id' => $where['post_id']
                ]);
            })->orWhere(function ($query) use ($where) {
                $query->where([
                    'from_id' => $where['to_id'],
                    'from_role' => $where['to_role'],
                    'to_id' => $where['from_id'],
                    'to_role' => $where['from_role'],
                    'post_id' => $where['post_id']
                ]);
            });
        }

        $query1->orderBy('created_at', 'DESC');

        $result = $query1->first();

        if (empty($result)) {
            $where['created_at'] = Carbon::now()->toDateTimeString();
            $where['updated_at'] = Carbon::now()->toDateTimeString();
            $result = DB::table('agents_users_conections')->insertGetId($where);

            $userdd = DB::table('agents_users_details')->select('*')
                ->where(['details_id' => $where['to_id']])
                ->first();

            $postdd = DB::table('agents_posts')->select('*')
                ->where(['post_id' => $where['post_id']])
                ->first();

            $notifiy = [
                'sender_id' => $where['to_id'],
                'sender_role' => $where['to_role'],
                'receiver_id' => $where['from_id'],
                'receiver_role' => $where['from_role'],
                'notification_type' => 11,
                'notification_message' => "{$userdd->name} contact related to post({$postdd->posttitle})",
                'notification_item_id' => $result,
                'notification_child_item_id' => $where['post_id'],
                'status' => 1,
                'updated_at' => Carbon::now()->toDateTimeString()
            ];

            DB::table('agents_notification')->insertGetId($notifiy);
            event(new eventTrigger([$notifiy, $result, 'NewNotification']));
        } else {
            $result = DB::table('agents_users_conections')
                ->where(['connection_id' => $result->connection_id])
                ->update(['updated_at' => Carbon::now()->toDateTimeString()]);
        }

        return $result;
    }

    /**
     * Get search users by various criteria.
     *
     * @param int         $limit  Number of records to skip.
     * @param array|null $where  Where clause containing search criteria.
     * @return array|null Data including results, count, and pagination information, or null if no search type is specified.
     */
    public function getSearchUsersByAny($limit, $where = null)
    {
        $skillss = new Agentskills;
        $bookmark = new Bookmark;
        $rating = new Rating;
        $loginusser = AuthUser();

        // Determine the search type and execute the corresponding query.
        return match ($where['searchinputtype'] ?? '') {
            'name' => $this->searchUsersByName($limit, $where, $skillss),
            'messages' => $this->searchUsersByMessages($limit, $where, $loginusser),
            'questions_asked' => $this->searchUsersByQuestionsAsked($limit, $where, $loginusser),
            'questions_answered' => $this->searchUsersByQuestionsAnswered($limit, $where, $loginusser, $bookmark, $rating),
            'answers' => $this->searchUsersByAnswers($limit, $where, $loginusser, $bookmark, $rating),
            default => null,
        };
    }

    /**
     * Private helper methods for search functionality
     */
    private function searchUsersByName($limit, $where, $skillss)
    {
        $query = DB::table('agents_users')
            ->select('agents_state.state_name', 'agents_city.city_name', 'agents_users.*', 'agents_users_details.*')
            ->leftJoin('agents_users_details', 'agents_users_details.details_id', '=', 'agents_users.id')
            ->leftJoin('agents_state', 'agents_state.state_id', '=', 'agents_users_details.state_id')
            ->leftJoin('agents_city', 'agents_city.city_id', '=', 'agents_users_details.city_id');

        if (!empty($where['agents_users_role_id'])) {
            $query->where(['agents_users.agents_users_role_id' => $where['agents_users_role_id']]);
        }

        if (!empty($where['date'])) {
            [$dd1, $dd2] = explode('-', $where['date']);
            $dd1 = date('Y-m-d', strtotime($dd1));
            $dd2 = date('Y-m-d', strtotime($dd2));
            $query->whereBetween('agents_users.created_at', [$dd1, $dd2]);
        }

        if (!empty($where['city'])) {
            $query->where('agents_users_details.city_id', 'LIKE', "%{$where['city']}%");
        }

        if (!empty($where['state'])) {
            $query->where('agents_users_details.state_id', $where['state']);
        }

        if (!empty($where['zipcodes'])) {
            $query->where('agents_users_details.zip_code', $where['zipcodes']);
        }

        if (!empty($where['pricerange'])) {
            $query->whereBetween('agents_users_details.total_sales', $where['pricerange']);
        }

        if (!empty($where['address'])) {
            $query->where(function ($query1) use ($where) {
                $query1->where('agents_users_details.address', 'LIKE', "%{$where['address']}%")
                    ->orWhere('agents_users_details.address2', 'LIKE', "%{$where['address']}%");
            });
        }

        if (!empty($where['keyword'])) {
            $query->where(function ($query1) use ($where) {
                $query1->where('agents_users_details.name', 'LIKE', "%{$where['keyword']}%")
                    ->orWhere('agents_users_details.fname', 'LIKE', "%{$where['keyword']}%")
                    ->orWhere('agents_users_details.lname', 'LIKE', "%{$where['keyword']}%");
            });
        }

        $query->where('agents_users.is_deleted', '0');
        $query->where('agents_users.status', '1');
        $query->orderBy('agents_users_details.created_at', 'DESC');
        $query->groupBy('agents_users_details.details_id');

        $count = $query->get()->count();
        $paginationSize = 9;
        $result = $query->skip($limit * $paginationSize)->take($paginationSize)->get();

        $obj = [];
        foreach ($result as $value) {
            $post_view_count = !empty($value->skills) ? $skillss->getskillsByAny([], ['skill_id' => $value->skills]) : '';
            $obj[] = (object) array_merge((array) $value, ['skill_data' => $post_view_count]);
        }

        return $this->paginateResults($count, $limit, $paginationSize, $obj);
    }

    private function searchUsersByMessages($limit, $where, $loginusser)
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
                ])
                    ->orWhere([
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
            });


        if (!empty($where['date'])) {
            [$dd1, $dd2] = explode('-', $where['date']);
            $dd1 = date('Y-m-d', strtotime($dd1));
            $dd2 = date('Y-m-d', strtotime($dd2));
            $query->whereBetween('m.created_at', [$dd1, $dd2]);
        }


        if (!empty($where['keyword'])) {
            $query->where('m.message_text', 'LIKE', "%{$where['keyword']}%");
        }


        $query->select(
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

        $count = $query->count();
        $paginationSize = 9;
        $result = $query->skip($limit * $paginationSize)->take($paginationSize)->get();

        return $this->paginateResults($count, $limit, $paginationSize, $result);
    }

    private function searchUsersByQuestionsAsked($limit, $where, $loginusser)
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
            ]);

        if (!empty($where['date'])) {
            [$dd1, $dd2] = explode('-', $where['date']);
            $dd1 = date('Y-m-d', strtotime($dd1));
            $dd2 = date('Y-m-d', strtotime($dd2));
            $query->whereBetween('agents_shared.created_at', [$dd1, $dd2]);
        }

        if (!empty($where['keyword'])) {
            $query->where('agents_question.question', 'LIKE', "%{$where['keyword']}%");
        }

        $query->select(
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


        $count = $query->count();
        $paginationSize = 9;
        $result = $query->skip($limit * $paginationSize)->take($paginationSize)->get();
        return $this->paginateResults($count, $limit, $paginationSize, $result);
    }

    private function searchUsersByQuestionsAnswered($limit, $where, $loginusser, $bookmark, $rating)
    {
        $query = DB::table('agents_shared')
            ->leftJoin('agents_answers', 'agents_answers.question_id', '=', 'agents_shared.shared_item_id')
            ->join('agents_question', 'agents_question.question_id', '=', 'agents_shared.shared_item_id')
            ->join('agents_posts', 'agents_posts.post_id', '=', 'agents_shared.shared_item_type_id')
            ->join('agents_users_details', 'agents_users_details.details_id', '=', 'agents_shared.receiver_id')
            ->where([
                'agents_shared.shared_type' => '1',
                'agents_question.is_deleted' => '0',
                'agents_question.add_by' => $loginusser->id,
                'agents_question.add_by_role' => $loginusser->agents_users_role_id
            ]);

        if (!empty($where['date'])) {
            [$dd1, $dd2] = explode('-', $where['date']);
            $dd1 = date('Y-m-d', strtotime($dd1));
            $dd2 = date('Y-m-d', strtotime($dd2));
            $query->whereBetween('agents_shared.created_at', [$dd1, $dd2]);
        }

        if (!empty($where['keyword'])) {
            $query->where(function ($query1) use ($where) {
                $query1->where('agents_answers.answers', 'LIKE', "%{$where['keyword']}%")
                    ->orWhere('agents_question.question', 'LIKE', "%{$where['keyword']}%");
            });
        }

        $query->select(
            'agents_shared.shared_id',
            'agents_shared.created_at as shared_date',
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
            ->orderBy('agents_shared.created_at', 'DESC');

        $count = $query->count();
        $paginationSize = 9;
        $result = $query->skip($limit * $paginationSize)->take($paginationSize)->get();

        $obj = [];
        foreach ($result as $value) {
            $bok = $bookmark->getBookmarkSingalByAny([
                'bookmark_type' => 4,
                'bookmark_item_id' => $value->answers_id,
                'bookmark_item_parent_id' => $value->question_id,
                'sender_id' => $loginusser->id,
                'sender_role' => $loginusser->agents_users_role_id
            ]);

            $rat = $rating->getRatingSingalByAny([
                'rating_type' => 1,
                'rating_item_id' => $value->answers_id,
                'rating_item_parent_id' => $value->question_id
            ]);

            $obj[] = (object) array_merge((array) $value, ['bookmark' => $bok], ['rating' => $rat]);
        }

        return $this->paginateResults($count, $limit, $paginationSize, $obj);
    }


    private function searchUsersByAnswers($limit, $where, $loginusser, $bookmark, $rating)
    {
        $query = DB::table('agents_answers')
            ->join('agents_question', 'agents_question.question_id', '=', 'agents_answers.question_id')
            ->leftJoin('agents_posts', 'agents_posts.post_id', '=', 'agents_answers.post_id')
            ->leftJoin('agents_users_details', 'agents_users_details.details_id', '=', 'agents_question.add_by')
            ->where([
                'agents_answers.from_id' => $loginusser->id,
                'agents_answers.from_role' => $loginusser->agents_users_role_id,
                'agents_question.is_deleted' => '0',
            ])
            ->whereNotIn('agents_question.add_by_role', [1]);

        if (!empty($where['date'])) {
            [$dd1, $dd2] = explode('-', $where['date']);
            $dd1 = date('Y-m-d', strtotime($dd1));
            $dd2 = date('Y-m-d', strtotime($dd2));
            $query->whereBetween('agents_answers.created_at', [$dd1, $dd2]);
        }

        if (!empty($where['keyword'])) {
            $query->where('agents_answers.answers', 'LIKE', "%{$where['keyword']}%");
        }


        $query->select(
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

        $count = $query->count();
        $paginationSize = 9;
        $result = $query->skip($limit * $paginationSize)->take($paginationSize)->get();

        $obj = [];
        foreach ($result as $value) {
            $bok = $bookmark->getBookmarkSingalByAny([
                'bookmark_type' => 4,
                'bookmark_item_id' => $value->answers_id,
                'bookmark_item_parent_id' => $value->question_id,
                'sender_id' => $loginusser->id,
                'sender_role' => $loginusser->agents_users_role_id
            ]);
            $rat = $rating->getRatingSingalByAny([
                'rating_type' => 1,
                'rating_item_id' => $value->answers_id,
                'rating_item_parent_id' => $value->question_id
            ]);
            $obj[] = (object) array_merge((array) $value, ['bookmark' => $bok], ['rating' => $rat]);
        }

        return $this->paginateResults($count, $limit, $paginationSize, $obj);
    }

    /**
     * Check if the user has a specific role.
     * @param mixed $role Role ID or array of role IDs.
     * @return bool True if the user has the role, false otherwise.
     */
    public function hasRole($role)
    {
        if (is_array($role)) {
            return in_array($this->attributes['agents_users_role_id'], $role);
        }
        return $this->attributes['agents_users_role_id'] == $role;
    }


    /**
     * Check if the user is an admin.
     * @return bool True if the user is an admin, false otherwise.
     */
    public function isAdmin()
    {
        return $this->attributes['agents_users_role_id'] == 'admin';
    }


    /**
     * Get user data with joined tables information.
     *
     * @param array|null $where Where clause.
     * @return mixed User data object.
     */
    public function GetAllTableJoinUserDataByAnyFirst($where = null)
    {
        $query = DB::table('agents_users')->select(
            'agents_users.*',
            'agents_users_details.city_id as city_name',
            'agents_users_details.*',
            'c.role_name',
            'agents_state.state_name',
            'agents_state.state_code'
        );

        $query->leftJoin('agents_users_details', 'agents_users_details.details_id', '=', 'agents_users.id');
        $query->leftJoin('agents_users_roles as c', 'c.role_id', '=', 'agents_users.agents_users_role_id');
        $query->leftJoin('agents_state', 'agents_state.state_id', '=', 'agents_users_details.state_id');

        if ($where != null) {
            $query->where($where);
        }

        $query->orderBy('agents_users_details.created_at', 'DESC');

        return $query->first();
    }


    /**
     * Update the login status of users who have been inactive for a certain period.
     *
     * @return void
     */
    public function uodatelastfewminuteactivity()
    {
        $formatted_date = Carbon::now()->modify('-10 minutes');
        $result = DB::table('agents_users')
            ->where('login_status', 'Online')
            ->where('login_status', 'online') // Check if this redundant condition is intentional
            ->where('api_token', '<', $formatted_date)
            ->get();

        foreach ($result as $value) {
            $userupdate = User::find($value->id);
            $userupdate->login_status = 'Offline';
            $userupdate->save();
        }
    }


    /**
     * Update user's rating based on existing ratings.
     *
     * @param array $userpostdata User and rating data.
     * @return bool|null True if the rating is updated, false otherwise, null if no ratings are found.
     */
    public function updateusersrating($userpostdata)
    {
        $Rating = new Rating();
        $update = [
            'rating_type' => $userpostdata['rating_type'],
            'receiver_id' => $userpostdata['receiver_id'],
            'receiver_role' => $userpostdata['receiver_role']
        ];

        $acheck = $Rating->getRatingagentbuyerByAny($update);

        if (!empty($acheck)) {
            $postcount = count($acheck);
            $ratingpluse = 0;

            foreach ($acheck as $value) {
                $rr = str_replace('_', '.', $value->rating);
                $ratingpluse += $rr;
            }

            $totalrating = $ratingpluse / $postcount;
            $userdetails = Userdetails::find($userpostdata['receiver_id']);

            switch ($userpostdata['receiver_role']) {
                case 4: // agent
                    $userdetails->agent_rating = $totalrating;
                    break;
                case 2: // buyer
                    $userdetails->buyer_rating = $totalrating;
                    break;
                case 3: // seller
                    $userdetails->seller_rating = $totalrating;
                    break;
            }
            return $userdetails->save();
        }
        return null; // Indicate no ratings were found.


    }


    /**
     * Add or update payment details.
     *
     * @param array|null $data Data to insert or update.
     * @param array|null $id   ID of the record to update (optional).
     * @return mixed The inserted ID or the number of affected rows.
     */
    public function paymentdetailsadd($data = null, $id = null)
    {
        if (empty($id)) {
            $result = DB::table('agents_payment')->insertGetId($data);
        } else {
            $result = DB::table('agents_payment')->where($id)->update($data);
        }
        return $result;
    }



    /**
     * Get payment details by user ID.
     *
     * @param int        $limit   Number of records to skip.
     * @param int|null $userid User ID.
     * @return array Data including results, count, and pagination information.
     */
    public function getPaymentByAny($limit, $userid = null)
    {
        $query = DB::table('agents_payment')->select('*');
        $query->Join('agents_posts', 'agents_posts.post_id', '=', 'agents_payment.post_id');
        $query->Join('agents_users_details', 'agents_users_details.details_id', '=', 'agents_payment.user_id');
        $query->where(['agents_payment.user_id' => $userid]);
        $query->orderBy('agents_payment.updated_at', 'DESC');

        $count = $query->get()->count();
        $result = $query->skip($limit * 10)->take(10)->get();

        return $this->paginateResults($count, $limit, 10, $result);
    }


    /**
     * Send review reminders to buyers and agents.
     */
    public function usersendreviewupdate()
    {
        $formatted_date = Carbon::now()->modify('-24 hours');

        // Send reminders to buyers.
        $buyers = DB::table('agents_posts')
            ->select('agents_posts.*', 'agents_users.*', 'agents_users_details.*')
            ->join('agents_users', 'agents_users.id', '=', 'agents_posts.agents_user_id')
            ->join('agents_users_details', 'agents_users_details.details_id', '=', 'agents_posts.agents_user_id')
            ->where([
                'agents_posts.is_deleted' => '0',
                'agents_posts.applied_post' => '1',
                'agents_posts.buyer_seller_send_review' => '2'
            ])
            ->where('agents_posts.agent_select_date', '<', $formatted_date)
            ->where('agents_posts.cron_time', '<', $formatted_date)
            ->get();


        foreach ($buyers as $value) {
            $this->sendReviewEmail($value, '/search/agents/details/', 'Give a review on post');
        }


        // Send reminders/payment completion notices to agents.
        $agents = DB::table('agents_posts')
            ->select('agents_posts.*', 'agents_users.*', 'agents_users_details.*')
            ->join('agents_users', 'agents_users.id', '=', 'agents_posts.applied_user_id')
            ->join('agents_users_details', 'agents_users_details.details_id', '=', 'agents_posts.applied_user_id')
            ->where([
                'agents_posts.is_deleted' => '0',
                'agents_posts.applied_post' => '1',
                'agents_posts.agent_send_review' => '2'
            ])
            ->where('agents_posts.agent_select_date', '<', $formatted_date)
            ->get();


        foreach ($agents as $value) {
            if ($value->mark_complete == 2) {
                $this->sendReviewEmail($value, '/search/post/details/', 'Payment not completed');
            } elseif ($value->mark_complete == 1 && $value->agent_send_review == 2) {
                $this->sendReviewEmail($value, '/search/post/details/', 'Give a review on post');
            }
        }
    }


    /**
     *  Pagination logic for re-use
     */
    private function paginateResults($count, $limit, $take, $result)
    {
        $coun = floor($count / $take);
        $prview = $limit == 0 ? 0 : $limit - 1;
        $next = $coun == $limit ? 0 : ($count <= $take ? 0 : $limit + 1);
        $rlimit = $limit * $take == 0 ? 1 : $limit * $take;
        $llimit = $next * $take == 0 ? $count : $next * $take;
        return ['result' => $result, 'count' => $count, 'llimit' => $llimit, 'rlimit' => $rlimit, 'prview' => $prview, 'next' => $next];
    }


    /**
     * Send review reminder email.
     * @param object $value Data for the email.
     * @param string $url  URL for the review.
     * @param string $subject Email Subject.
     */
    private function sendReviewEmail($value, $url, $subject)
    {
        $emaildata['url'] = url($url) . "/{$value->applied_user_id}/{$value->post_id}";
        $emaildata['email'] = $value->email;
        $emaildata['name'] = ucwords($value->name);
        $emaildata['posttitle'] = ucwords($value->posttitle);

        // Construct different email bodies based on the subject.
        if ($subject === 'Payment not completed') {
            $emaildata['html'] = "<div><h3>Hello {$value->name},</h3><br><p>Your payment is not completed for post {$value->posttitle}.<br> Pay now.</p><br><p>Visit post and pay <a href='{$emaildata['url']}'>{$emaildata['posttitle']}</a> </p><br><br><center><a href='" . URL('/') . "'> www.92Agents.com </a></center></div>";
        } else {
            $emaildata['html'] = "<div><h3>Hello {$value->name},</h3><br><p>Please give a review and rating for post {$value->posttitle}.</p><br><p>Visit post <a href='{$emaildata['url']}'>{$emaildata['posttitle']}</a> </p><br><br><center><a href='" . URL('/') . "'> www.92Agents.com </a></center></div>";
        }

        Mail::send([], [], function ($message) use ($emaildata, $subject) {
            $message->to($emaildata['email'], $emaildata['name'])
                ->subject($subject)
                ->setBody($emaildata['html'], 'text/html');
            $message->from('kamlesh74420@gmail.com', 'kamlesh74420@gmail.com'); // Replace with your actual email/name
        });
    }

}
