<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BudgetModel;
use Auth;
use Illuminate\Support\Str;
use App\Models\CountryModel;


class BudgetController extends Controller
{
   public function AllBudget(){
        $budgets = BudgetModel::orderBy('id','desc')->get();
        return view('backend.budget.all_budget',compact('budgets'));
        } // end method

    public function AddBudget(){
            $data['countries'] = CountryModel::get();
            return view('backend.budget.add_budget',$data);
        } // end method

    public function StoreBudget(Request $request){

        //Validation
        $request->validate([
            'range' => 'required',
        ]);

        BudgetModel::insert([

            'country_id' => $request->country_id,
            'university_id' => $request->university_id,
            'campus_id' => $request->campus_id,
            'level_id' => $request->level_id,
            'range' => $request->range,
            'slug' => Str::slug($request->range,'-'),
            'created_by' => Auth::user()->id
        ]);


        $notification = array(
            'message' => 'Budget Name created successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.budget')->with($notification);

    } //end method

    public function EditBudget($id){

        $data['countries'] = CountryModel::get();
        $data['editData']  = BudgetModel::findOrFail($id);
        return view('backend.budget.add_budget',$data);

    } //end method

    public function UpdateBudget(Request $request, $id){

        BudgetModel::findOrFail($id)->update([
            'country_id' => $request->country_id,
            'university_id' => $request->university_id,
            'campus_id' => $request->campus_id,
            'level_id' => $request->level_id,
            'range' => $request->range,
            'slug' => Str::slug($request->range,'-'),
            'updated_by' => Auth::user()->id
        ]);


        $notification = array(
            'message' => 'Budget Name updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.budget')->with($notification);

    } //end method

    public function DeleteBudget($id){

        BudgetModel::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Budget Name deleted successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } //end method
}

