<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth;
use App\Models\CourseNameModel;
use App\Http\Requests\CourseNameRequest;


class CourseNameController extends Controller
{
    public function AllCourseName(){

      //$course_names = CourseNameModel::orderBy('id','desc')->get();
         $course_names = CourseNameModel::lazyByIdDesc()->each(function($course_name_datas){
		    CourseNameModel::where('id',$course_name_datas->id);
        });
        return view('backend.course_name.all_course_name',compact('course_names'));
    } // end method

    public function AddCourseName(){
            return view('backend.course_name.add_course_name');
    } // end method

    public function StoreCourseName(Request $request){

        //Validation
        $request->validate(
            [
                'name' => 'required|unique:course_names|max:300',
            ],
            [
                'name.unique' => 'This Course Name has already been taken.'
            ]
        );

        CourseNameModel::insert([
            'name' => $request->name,
            'slug' => Str::slug($request->name,'-'),
            'created_by' => Auth::user()->id
        ]);


        $notification = array(
            'message' => 'Course Name created successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.course_name')->with($notification);

    } //end method

    public function EditCourseName($id){

        $data['editData'] = CourseNameModel::findOrFail($id);
        return view('backend.course_name.add_course_name',$data);

    } //end method

    public function UpdateCourseName(Request $request,$id){

        CourseNameModel::findOrFail($id)->update([
              'name' => $request->name,
              'slug' => Str::slug($request->name,'-'),
              'updated_by' => Auth::user()->id
        ]);

        $notification = array(
            'message' => 'Course Name updated successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.course_name')->with($notification);

    } //end method

    public function DeleteCourseName($id){

        CourseNameModel::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Course Name deleted successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    } //end method
}
