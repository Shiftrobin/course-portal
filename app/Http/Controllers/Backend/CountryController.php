<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth;
use App\Models\CountryModel;
use App\Http\Requests\CountryRequest;


class CountryController extends Controller
{
    public function AllCountry(){

        $countries = CountryModel::orderBy('id','desc')->get();
        return view('backend.country.all_country',compact('countries'));
        } // end method

    public function AddCountry(){
            return view('backend.country.add_country');
        } // end method

    public function StoreCountry(Request $request){

        //Validation
        $request->validate(
            [
                'name' => 'required|unique:countries|max:200',
            ],
            [
                'name.unique' => 'This Country has already been taken.'
            ]
        );

        CountryModel::insert([
            'name' => $request->name,
            'slug' => Str::slug($request->name,'-'),
            'created_by' => Auth::user()->id
        ]);


        $notification = array(
            'message' => 'Country created successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.country')->with($notification);

    } //end method

    public function EditCountry($id){

        $data['editData'] = CountryModel::findOrFail($id);
        return view('backend.country.add_country',$data);

    } //end method

    public function UpdateCountry(CountryRequest $request,$id){

        CountryModel::findOrFail($id)->update([
              'name' => $request->name,
              'slug' => Str::slug($request->name,'-'),
              'updated_by' => Auth::user()->id
        ]);

        $notification = array(
            'message' => 'Country updated successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.country')->with($notification);

    } //end method

    public function DeleteCountry($id){

        CountryModel::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Country deleted successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } //end method
}
