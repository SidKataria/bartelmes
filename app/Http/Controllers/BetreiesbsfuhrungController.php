<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Aoo\Models\Powerplants;
use App\Models\Customers;

use DB;

class BetreiesbsfuhrungController extends BaseController
{
    //General function [assing general values and powerplants to fill the Powerplant select box
    public function show(){
        $powerplants = DB::select('SELECT DISTINCT(Projektname) , PlantID FROM crm_powerplants');

        $subplants = DB::select('SELECT SubplantID FROM crm_powerplants');

        $company = DB::select('SELECT * FROM crm_customer');

        return view('betreiesbsfuhrung', ['powerplants' => $powerplants, 'subplants' =>$subplants, 'company' => $company]);    
    }
    
    //Function sending back the Subpowerplants correspoding to the selected Powerplant
    public function getSubplants($id) 
    {
        $subplants = DB::table('crm_powerplants')->where('PlantID', $id)->pluck('SubplantID');
        return response()->json($subplants);
    }
}
