<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LevelModel;
use Auth;
use App\Models\UniversityModel;
use Illuminate\Support\Str;
use App\Models\CountryModel;
use App\Models\CampusModel;

class LevelController extends Controller
{
      public function AllLevel(){
            $levels = LevelModel::orderBy('id','desc')->get();
            return view('backend.level.all_level',compact('levels'));
        } // end method

    public function AddLevel(){
            $data['countries'] = CountryModel::get();
            return view('backend.level.add_level',$data);
        } // end method

    public function StoreLevel(Request $request){

        //Validation
        $request->validate([
            'name' => 'required',
        ]);

        LevelModel::insert([
            'country_id' => $request->country_id,
            'university_id' => $request->university_id,
            'campus_id' => $request->campus_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name,'-'),
            'created_by' => Auth::user()->id
        ]);


        $notification = array(
            'message' => 'Level Name created successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.level')->with($notification);

    } //end method

    public function EditLevel($id){
        $data['countries'] = CountryModel::get();
        $data['editData']  = LevelModel::findOrFail($id);
        return view('backend.level.add_level',$data);

    } //end method

    public function UpdateLevel(Request $request,$id){

        LevelModel::findOrFail($id)->update([
            'country_id' => $request->country_id,
            'university_id' => $request->university_id,
            'campus_id' => $request->campus_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name,'-'),
            'updated_by' => Auth::user()->id
        ]);


        $notification = array(
            'message' => 'Level Name updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.level')->with($notification);

    } //end method

    public function DeleteLevel($id){

        LevelModel::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Level Name deleted successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } //end method
}

