<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Settings;
use App\Models\Manager;
use App\Models\ManagerCommission;
use View;
use Redirect;
use Session;
use DB;

class AffiliateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
       //if not login redirect to login page
		if(!Session::has('dnradmin_id')) { return Redirect::to('dnradmin/');}

        $managers = Manager::from('tblManager as m')
            ->leftJoin('tblManager as parent', 'm.fldManagerMainID', '=', 'parent.fldManagerID')
            ->where('m.fldManagerType', '=', 2)
            ->orderBy('m.fldManagerID', 'DESC')
            ->select([
                'm.*',
                DB::raw("CONCAT(parent.fldManagerFirstname, ' ', parent.fldManagerLastname) as mainManagerName")
            ])
            ->get();
		$administrator = Settings::where('fldAdministratorID','=',Session::get('dnradmin_id'))->first();
		$managerClass = 'class=active';

		foreach($managers as $manager) {
			//check commission
			$commission = ManagerCommission::calculateCommissionYearAdmin($manager->fldManagerID);
			$manager->fldManagerCommission = $commission;
		// echo 'comm: '.$commission.'<br>';
		}

		//die('Ln45');

		$pageTitle = "Affiliate";

	    return View::make('_admin.Affiliate.Affiliate', array('managers' => $managers,'administrator'=>$administrator,'managerClass'=>$managerClass,'pageTitle'=>$pageTitle));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
