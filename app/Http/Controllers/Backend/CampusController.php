<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UniversityModel;
use Illuminate\Support\Str;
use Auth;
use App\Models\CountryModel;
use App\Models\CampusModel;
use App\Http\Requests\CampusRequest;

class CampusController extends Controller
{
    public function AllCampus(){
        $campus = CampusModel::orderBy('id','desc')->get();
        return view('backend.campus.all_campus',compact('campus'));
        } // end method

    public function AddCampus(){
            $data['countries'] = CountryModel::get();
            return view('backend.campus.add_campus',$data);
        } // end method

    public function StoreCampus(Request $request){

        //Validation
        $request->validate([
            'name' => 'required:campus|max:300',
        ]);

        CampusModel::insert([
            'country_id' => $request->country_id,
            'university_id' => $request->university_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name,'-'),
            'created_by' => Auth::user()->id
        ]);


        $notification = array(
            'message' => 'Campus created successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.campus')->with($notification);

    } //end method

    public function EditCampus($id){
        $data['countries'] = CountryModel::get();
        $data['editData']  = CampusModel::findOrFail($id);
        return view('backend.campus.add_campus',$data);

    } //end method

    public function UpdateCampus(CampusRequest $request,$id){

        CampusModel::findOrFail($id)->update([
              'country_id' => $request->country_id,
              'university_id' => $request->university_id,
              'name' => $request->name,
              'slug' => Str::slug($request->name,'-'),
              'updated_by' => Auth::user()->id
        ]);


        $notification = array(
            'message' => 'Campus updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.campus')->with($notification);

    } //end method

    public function DeleteCampus($id){

        CampusModel::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Campus deleted successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } //end method
}
