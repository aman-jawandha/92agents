<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Auth;

class Rating extends Model
{protected $table = 'agents_rating';
    protected $primaryKey = 'rating_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'rating',
        'review',
        'rating_type',
        'rating_item_id',
        'rating_item_parent_id',
        'sender_id',
        'sender_role',
        'receiver_id',
        'receiver_role',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];


    /** Define relationships if necessary.  For example: **/

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id'); // Assuming sender is a User
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');  // Assuming receiver is a User
    }


    //Example of a scope to filter by rating type
    public function scopeOfType($query, $type)
    {
        return $query->where('rating_type', $type);
    }

	/* get all data any filed using*/
    public function getDetailsByAny($limit,$where=null){
		$query= DB::table('agents_rating')->select('*');
		if($where != null){

			$query->where($where);

		}

		$query->orderBy('created_at','DESC');

		$count = $query->count();

		$result = $query->skip($limit*3)->take(3)->get();

		$coun = floor($count/3);

        $prview = $limit == 0 ? 0 : $limit-1;

        $next   = $coun==$limit ? 0 : ($count <= 3 ? 0 : $limit+1);

        $rlimit = $limit*3==0 ? 1 : $limit*3;

        $llimit = $next*3 == 0 ? $count : $next*3;

	 	$data = array('result' => $result,'count' => $count,'llimit' => $llimit, 'rlimit' => $rlimit,'prview' => $prview, 'next' => $next);

		return $data;

	}


	/* For rating insert & update */
	public function inserupdate($data=null,$id=null)
	{
		if(empty($id)){

			$result = DB::table('agents_rating')->insertGetId($data);

		}else{

			$result = DB::table('agents_rating')->where($id)->update($data);

		}

		return $result;

	}

	/* get all data any filed using*/
    public function getRatingByAny($where=null){

		$query= DB::table('agents_rating')->select('*');
		if($where != null){

			$query->where($where);

		}
		$query->orderBy('created_at','DESC');

		return $result = $query->get();

	}

	/* get all data any filed using*/
    public function getRatingSingalByAny($where=null){

		$query= DB::table('agents_rating')->select('*');

		if($where != null){

			$query->where($where);

		}

		$query->orderBy('created_at','DESC');

		return $result = $query->first();

	}

	/* get all data any filed using*/
    public function GetRatingListbypost($where=null){

		$query= DB::table('agents_rating')->select('*');

		$query->Join('agents_posts', 'agents_posts.post_id', '=', 'agents_rating.rating_item_parent_id');

		if($where != null){

			$query->where($where);

		}

		$query->where(array('agents_posts.is_deleted' => '0'));

		$query->orderBy('agents_rating.created_at','DESC');

		$query->groupBy('agents_rating.rating_item_parent_id');

		return $result = $query->get();

	}

	/* get all data any filed using*/
    public function getRatingagentbuyerByAny($where=null){

		$query= DB::table('agents_rating')->select('*');

		if($where != null){

			$query->where($where);

		}

		$query->orderBy('created_at','DESC');

		$query->groupBy('rating_item_parent_id');

		return $result = $query->get();

	}

}

