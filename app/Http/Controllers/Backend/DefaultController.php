<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UniversityModel;
use App\Models\CampusModel;
use App\Models\LevelModel;
use App\Models\BudgetModel;

class DefaultController extends Controller
{
    public function GetUniversity(Request $request){
        $country_id = $request->country_id;
        $allUniversity = UniversityModel::where('status','1')->where('country_id',$country_id)->orderBy('name','ASC')->get();
        return response()->json($allUniversity);
    }

    public function GetCampus(Request $request){
       $university_id = $request->university_id;
       $allcampus = CampusModel::where('university_id',$university_id)->orderBy('name','ASC')->get();
       return response()->json($allcampus);
    }

    public function GetLevel(Request $request){
        $campus_id = $request->campus_id;
        $allLevel = LevelModel::where('campus_id',$campus_id)->orderBy('name','ASC')->get();
        return response()->json($allLevel);
    }

    public function GetBudget(Request $request){
        $level_id = $request->level_id;
        $allBudget = BudgetModel::where('level_id',$level_id)->get();
        return response()->json($allBudget);
    }

}
