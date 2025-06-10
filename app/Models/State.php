<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class State extends Model
{
    protected $table = 'agents_state';
    protected $primaryKey = "state_id";

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'is_deleted',
        'created_at',
        'updated_at',
    ];

    /* get all data any filed using*/
    public function getStateByAny($where = null, $records = null)
    {
        $query = DB::table('agents_state')->select('*');

        if ($where != null) {
            $query->where($where);
        }

        if (!empty($records)) {
            return $result = $query->first();
        } else {
            return $result = $query->get();
        }
    }

    /* Insert & update state */
    public function inserupdate($data = null, $id = null)
    {
        if (empty($id)) {
            $result = DB::table('agents_state')->insertGetId($data);
        } else {
            $result = DB::table('agents_state')->where($id)->update($data);
        }
        return $result;
    }

    /* get all data any filed using*/
    public function getCityByAny($where = null, $records = null)
    {
        $query = DB::table('agents_city')->select('*');

        if ($where != null) {
            $query->where($where);
        }

        if (!empty($records)) {
            return $result = $query->first();
        } else {
            return $result = $query->get();
        }
    }

    /*get city by state */
    public function getCityByState($where = null)
    {

        $query = DB::table('agents_city')->select('*');

        if ($where != null) {
            $query->where($where);

            return $result = $query->get();
        }
    }

    /* get all data any filed using*/
    public function getAreaByAny($where = null, $records = null)
    {
        $query = DB::table('agents_area')->select('*');

        if ($where != null) {
            $query->where($where);
        }

        return (!empty($records)) ? $query->first() : $query->get();
    }

    /* Get area details */
    public function getAreaList($request, $limit = NUll, $offset = NULL)
    {
        $result = [];
        $query = DB::table('agents_area as a')->select('*');
        $query->where('a.is_deleted', '0');

        if (!empty($request['search']['value'])) {
            $query->where('a.area_name', 'like', "%{$request['search']['value']}%");
        }
        $result['num'] = count($query->get());

        if (!empty($limit)) {
            $query->take($limit)
                ->skip($offset);
        }

        $query->orderBy('a.area_name', 'ASC');
        $result['result'] = $query->get();
        return $result;
    }

    /* Get state details */
    public function getStateList($request, $limit = NUll, $offset = NULL)
    {
        $result = [];
        $query = DB::table('agents_state as a')->select('*');
        $query->where('a.is_deleted', '0');

        if (!empty($request['search']['value'])) {
            $query->where('a.state_name', 'like', "%{$request['search']['value']}%");
            $query->Orwhere('a.state_code', 'like', "%{$request['search']['value']}%");
        }

        $result['num'] = count($query->get());

        if (!empty($limit)) {
            $query->take($limit)->skip($offset);
        }

        $query->orderBy('a.state_name', 'ASC');
        $result['result'] = $query->get();
        return $result;
    }

    /* Get cities details */
    public function getCitiesList($request, $limit = NUll, $offset = NULL)
    {

        $result = [];
        $query = DB::table('agents_city as a')->select('*');
        $query->where('a.is_deleted', '0');

        if (!empty($request['search']['value'])) {
            $query->where('a.city_name', 'like', "%{$request['search']['value']}%");
        }

        $result['num'] = count($query->get());

        if (!empty($limit)) {
            $query->take($limit)->skip($offset);
        }

        $query->orderBy('a.city_name', 'ASC');
        $result['result'] = $query->get();
        return $result;
    }

    /**
     * Get the cities for the state.
     */
    public function cities()
    {
        return $this->hasMany(City::class, 'state_id');
    }

    public function stateAndCity()
    {
        return $this->hasMany(City::class, 'state_id');
    }
}
