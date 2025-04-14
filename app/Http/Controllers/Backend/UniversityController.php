<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UniversityModel;
use Illuminate\Support\Str;
use Auth;
use App\Models\CountryModel;
use App\Http\Requests\UniversityRequest;



class UniversityController extends Controller
{
    public function AllUniversity(){

        $universities = UniversityModel::orderBy('id','desc')->get();
        return view('backend.university.all_university',compact('universities'));
        } // end method

    public function AddUniversity(){
            $data['countries'] = CountryModel::get();
            return view('backend.university.add_university',$data);
        } // end method

    public function StoreUniversity(Request $request){

        //Validation
        // $request->validate([
        //     'name' => 'required|unique:universities|max:300',
        // ]);

        UniversityModel::insert([
            'name' => $request->name,
            'country_id' => $request->country_id,
            'slug' => Str::slug($request->name,'-'),
            'created_by' => Auth::user()->id
        ]);


        $notification = array(
            'message' => 'University created successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.university')->with($notification);

    } //end method

    public function EditUniversity($id){
        $data['countries'] = CountryModel::get();
        $data['editData']  = UniversityModel::findOrFail($id);
        return view('backend.university.add_university',$data);

    } //end method


    //UniversityRequest 
    public function UpdateUniversity(Request $request,$id){

        UniversityModel::findOrFail($id)->update([
              'name' => $request->name,
              'country_id' => $request->country_id,
              'slug' => Str::slug($request->name,'-'),
              'updated_by' => Auth::user()->id
        ]);


        $notification = array(
            'message' => 'University updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.university')->with($notification);

    } //end method

    public function DeleteUniversity($id){

        UniversityModel::findOrFail($id)->delete();

        $notification = array(
            'message' => 'University deleted successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } //end method
    
    public function status($id){

        //get id
        $data = UniversityModel::select('status')
                            ->where('id',$id)
                            ->first();

        //check status
        if($data->status == '1'){
            $status = '0';
        }else{
            $status = '1';
        }

        //update status
        $values = array('status' => $status);
        UniversityModel::where('id',$id)->update($values);

        return redirect()->route('all.university')->with('success','Status updated successfully');

    }
    
}

