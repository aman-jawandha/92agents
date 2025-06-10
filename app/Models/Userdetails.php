<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Userdetails extends Model
{

    protected $table = 'agents_users_details';
    protected $primaryKey = 'details_id';

    protected $casts = [
        'show_individual_yearly_figures' => 'boolean',
        'got_lender_approval_for_short_sale' => 'boolean',
        'terms_and_conditions' => 'boolean',
        'contract_verification' => 'boolean',
        'firsttime_home_buyer' => 'boolean',
        'do_u_have_a_home_to_sell' => 'boolean',
        'if_so_do_you_need_help_selling' => 'boolean',
        'interested_buying' => 'boolean',
        'need_Cash_back' => 'boolean',
        'education' => 'array',
        'employment' => 'array',
        'default_proposals' => 'array',
        'real_estate_education' => 'array',
        'sales_history' => 'array',
        'language_proficiency' => 'array',
        'specific_requirements' => 'array',


    ];

    protected $fillable = [
        // Add all fillable fields here.  This is a best practice
        // for security reasons to prevent mass assignment vulnerabilities.
        'name', 'fname', 'lname', 'address', 'address2', 'phone', 'phone_home',
        'phone_work', 'state_id', 'city_id', 'area', 'fax_no', 'zip_code',
        'description', 'photo', 'company', 'website', 'education', 'employment',
        'skills', 'licence_number', 'state_licence', 'default_proposals',
        'question_1', 'answer_1', 'question_2', 'answer_2', 'franchise',
        'other_franchise', 'company_name', 'years_of_expreience', 'office_address',
        'brokers_name', 'MLS_public_id', 'MLS_office_id', 'real_estate_education',
        'certifications', 'industry_experience', 'specialization',
        'show_individual_yearly_figures', 'sales_history', 'total_sales',
        'associations_awards', 'publications', 'community_involvement',
        'language_proficiency', 'additional_details', 'when_u_want_to_buy',
        'price_range', 'property_type', 'firsttime_home_buyer',
        'specific_requirements', 'do_u_have_a_home_to_sell',
        'if_so_do_you_need_help_selling', 'interested_buying',
        'got_lender_approval_for_short_sale', 'bids_emailed',
        'do_you_need_financing', 'need_Cash_back', 'terms_and_conditions',
        'statement_document', 'agent_rating', 'buyer_rating', 'seller_rating',
        'contract_verification'
    ];

    public function EditFieldsUserdetailsModel($where = [], $update = [])
    {
        $result = DB::table('agents_users_details')->where($where)->update($update);
        return $result;
    }

    /*public function securtyQuestion(){
		 $result =DB::table('agents_securty_question')->where('is_deleted','0')->get();
		return $result;
	}*/

    /* get all data any filed using*/
    public function getCertificationsByAny($where = null, $wherein = null)
    {
        $query = DB::table('agents_certifications')->select('*');

        if ($where != null) {
            $query->where($where);
        }
        if ($wherein != null && !empty($wherein)) {
            $certifications_idarray = explode(',', $wherein['certifications_id']);
            $query->whereIn('certifications_id', $certifications_idarray);
        }
        return $result = $query->get();
    }

    /* get all data any filed using*/
    public function getSpecializationByAny($where = null)
    {

        $query = DB::table('agents_users_agent_skills')->select('*');

        if ($where != null) {
            $query->where($where);
        }
        return $result = $query->get();
    }
    /* get all data any filed using*/
    public function getFranchiseByAny($where = null, $records = null)
    {
        $query = DB::table('agents_franchise')->select('*');

        if ($where != null) {
            $query->where($where);
        }
        if (!empty($records)) :
            return $result = $query->first();
        else :
            return $result = $query->get();
        endif;
    }

    /* For get franchisee details */
    public function getFranchiseeList($request, $limit = NUll, $offset = NULL)
    {

        $result = [];
        $query = DB::table('agents_franchise as a')->select('*');
        $query->where('a.is_deleted', '0');

        if (!empty($request['search']['value'])) {
            $query->where('a.franchise_name', 'like', "%" . $request['search']['value'] . "%");
        }
        $result['num'] =  count($query->get());

        if (!empty($limit)) {
            $query->take($limit)
                ->skip($offset);
        }

        $query->orderBy('a.franchise_id', 'DESC');
        $result['result'] =  $query->get();
        return $result;
    }

    /* get specialization details for list */
    public function getSpecializationList($request, $limit = NUll, $offset = NULL)
    {

        $result = [];
        $query = DB::table('agents_users_agent_skills as a')->select('*');
        $query->where('a.is_deleted', '0');

        if (!empty($request['search']['value'])) {
            $query->where('a.skill', 'like', "%" . $request['search']['value'] . "%");
        }
        $result['num'] =  count($query->get());

        if (!empty($limit)) {
            $query->take($limit)
                ->skip($offset);
        }

        $query->orderBy('a.skill', 'DESC');
        $result['result'] =  $query->get();
        return $result;
    }

    /* Get certification details for list */
    public function getCertificationsList($request, $limit = NUll, $offset = NULL)
    {

        $result = [];
        $query = DB::table('agents_certifications as a')->select('*');
        $query->where('a.is_deleted', '0');

        if (!empty($request['search']['value'])) {
            $query->where('a.certifications_name', 'like', "%" . $request['search']['value'] . "%");
            $query->where('a.certifications_description', 'like', "%" . $request['search']['value'] . "%");
        }
        $result['num'] =  count($query->get());

        if (!empty($limit)) {
            $query->take($limit)
                ->skip($offset);
        }

        $query->orderBy('a.certifications_id', 'DESC');
        $result['result'] =  $query->get();
        return $result;
    }

    /* For get agent details for list */
    public function getAgentList($request, $limit = NUll, $offset = NULL)
    {

        $result = [];
        //echo '<pre>'; print_r($request); die;
        $query = DB::table('agents_users as a')->select('a.*', 'b.*', 'c.role_name');
        $query->Join('agents_users_details as b', 'b.details_id', '=', 'a.id');
        $query->Join('agents_users_roles as c', 'c.role_id', '=', 'a.agents_users_role_id');
        $query->where('a.is_deleted', '0');

        if (!empty($request['roleId'])) {
            $query->where('a.agents_users_role_id', $request['roleId']);
        }

        if (!empty($request['search']['value'])) {
            $query->where(function ($query1) use ($request) {
                $query1->where('a.email', 'like', "%" . $request['search']['value'] . "%")
                    ->orwhere('b.name', 'like', "%" . $request['search']['value'] . "%")
                    ->orwhere('b.address', 'like', "%" . $request['search']['value'] . "%")
                    ->orwhere('b.phone', 'like', "%" . $request['search']['value'] . "%");
            });
            /*$query->where('a.email', 'like', "%".$request['search']['value']."%");
			$query->orwhere('b.name', 'like', "%".$request['search']['value']."%");
			$query->orwhere('b.address', 'like', "%".$request['search']['value']."%");
			$query->orwhere('b.phone', 'like', "%".$request['search']['value']."%");*/
        }

        $result['num'] =  count($query->get());

        if (!empty($limit)) {
            $query->take($limit)
                ->skip($offset);
        }

        $query->orderBy('a.id', 'DESC');
        $result['result'] =  $query->get();
        return $result;
    }

    /* Get seller buyer details for list */
    public function getSellerBuyerList($request, $limit = NUll, $offset = NULL)
    {
        $result = [];
        $query = DB::table('agents_users as a')->select('a.*', 'b.*', 'c.role_name');
        $query->Join('agents_users_details as b', 'b.details_id', '=', 'a.id');
        $query->Join('agents_users_roles as c', 'c.role_id', '=', 'a.agents_users_role_id');
        $query->where('a.is_deleted', '0');

        if (!empty($request['roleId'])) {
            $query->whereIn('a.agents_users_role_id', $request['roleId']);
        }

        if (!empty($request['search']['value'])) {
            $query->where(function ($query1) use ($request) {
                $query1->where('a.email', 'like', "%" . $request['search']['value'] . "%")
                    ->orwhere('b.name', 'like', "%" . $request['search']['value'] . "%")
                    ->orwhere('b.address', 'like', "%" . $request['search']['value'] . "%")
                    ->orwhere('b.phone', 'like', "%" . $request['search']['value'] . "%")
                    ->orwhere('c.role_name', 'like', "%" . $request['search']['value'] . "%");
            });
            /*$query->where('a.email', 'like', "%".$request['search']['value']."%");
			$query->orwhere('b.name', 'like', "%".$request['search']['value']."%");
			$query->orwhere('b.address', 'like', "%".$request['search']['value']."%");
			$query->orwhere('b.phone', 'like', "%".$request['search']['value']."%");
			$query->orwhere('c.role_name', 'like', "%".$request['search']['value']."%");*/
        }


        $result['num'] =  count($query->get());

        if (!empty($limit)) {
            $query->take($limit)
                ->skip($offset);
        }

        # dummy column just for managing index of array
        $sort_columns = ['dummy', 'b.name', 'a.email', 'b.address', 'b.phone', 'b.created_at'];
        if ($request['order'][0]['column'] != 0 && $request['order'][0]['dir'] != "") {
            $query->orderBy($sort_columns[$request['order'][0]['column']], $request['order'][0]['dir']);
        } else {
            $query->orderBy('a.id', 'DESC');
        }
        $query->orderBy('a.id', 'DESC');
        $result['result'] =  $query->get();
        return $result;
    }
    public function newSellerBuyerList($request, $limit = NUll, $offset = NULL)
    {

        $result = [];
        $date = date('Y-m-d H:i:s', strtotime('-7 days'));
        $query = DB::table('agents_users as a')->select('a.*', 'b.*', 'c.role_name');
        $query->Join('agents_users_details as b', 'b.details_id', '=', 'a.id');
        $query->Join('agents_users_roles as c', 'c.role_id', '=', 'a.agents_users_role_id');
        $query->where('a.is_deleted', '0');
        $query->where('a.created_at', '>', $date);

        if (!empty($request['search']['value'])) {
            $query->where('a.email', 'like', "%" . $request['search']['value'] . "%");
            $query->orwhere('b.name', 'like', "%" . $request['search']['value'] . "%");
            $query->orwhere('b.address', 'like', "%" . $request['search']['value'] . "%");
            $query->orwhere('b.phone', 'like', "%" . $request['search']['value'] . "%");
            $query->orwhere('c.role_name', 'like', "%" . $request['search']['value'] . "%");
        }
        if (!empty($request['roleId'])) {
            $query->whereIn('a.agents_users_role_id', $request['roleId']);
        }
        $result['num'] =  count($query->get());

        if (!empty($limit)) {
            $query->take($limit)
                ->skip($offset);
        }


        $query->orderBy('a.id', 'DESC');
        $result['result'] =  $query->get();
        return $result;
    }

    public function city()
    {
        return $this->hasOne(City::class, 'city_id', 'city_id');
    }

    public function state()
    {
        return $this->hasOne(State::class, 'state_id', 'state_id');
    }
}
