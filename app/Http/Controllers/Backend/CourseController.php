<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CourseModel;
use App\Models\CountryModel;
use App\Models\CourseNameModel;
use App\Models\UniversityModel;
use Illuminate\Support\Str;
use Auth;
use App\Http\Requests\CourseRequest;

class CourseController extends Controller
{
    public function AllCourse(){

        //$courses = CourseModel::orderBy('id','desc')->get();

         $courses = CourseModel::with(['country','university','campus','level','budget'])->lazyByIdDesc(20)->each(function($course_datas){
		     CourseModel::where('id',$course_datas->id);          
    	 });    

        // dd($courses);      

        return view('backend.course.all_course',compact('courses'));
    } // end method

    public function AddCourse(){
            $data['countries'] = CountryModel::orderBy('id','desc')->get();
            $data['courses'] = CourseNameModel::orderBy('id','desc')->get();
            return view('backend.course.add_course',$data);
    } // end method

    public function StoreCourse(Request $request){

        //Validation
        $request->validate([
            'name'=>'required',
            'fees'=>'required',
        ]);

        $data = new CourseModel();

        $data->country_id = $request->country_id;
        $data->university_id = $request->university_id;
        $data->campus_id = $request->campus_id;
        $data->level_id = $request->level_id;
        $data->budget_id = $request->budget_id;
        $data->name = $request->name;
        $data->slug = Str::slug($request->name,'-');
        $data->currency = $request->currency;
        $data->fees = $request->fees;
        $data->scholarship = $request->scholarship;
        $data->overview = $request->overview;
        $data->entry_requirements = $request->entry_requirements;
        $data->scholarship_details = $request->scholarship_details;

        $data->created_by = Auth::user()->id;

        // if($request->university_id){
        //     $university_slug = UniversityModel::where('id',$request->university_id)->first();
        //     $data['url'] = Str::slug($university_slug->name,'-').'-'. Str::slug($request->name,'-');
        // }
        $data['url'] = 'null';

        if($request->university_id){
            $university_name = UniversityModel::where('id',$request->university_id)->first();
            $data['title'] =  $request->name.' | '.$university_name->name;
            $data['share_title'] =  $request->name.' | '.$university_name->name;
        }
        $data->description = $request->description;
        $data->keywords = $request->keywords;

        if ($request->file('page_image')) {
            $file = $request->file('page_image');
            $filename = str_replace(' ', '-', $file->getClientOriginalName());
            $file->move(public_path('upload/course'), $filename);
            $data['page_image'] = $filename;
        }

        $data->save();

        $notification = array(
            'message' => 'Course created successfully',
            'alert-type' => 'success'
        );

       // return redirect()->back()->with($notification);
       return redirect()->route('all.course')->with($notification);

    } //end method

    public function EditCourse($id){

        $data['countries'] = CountryModel::get();
        $data['editData'] = CourseModel::findOrFail($id);
        $data['courses'] = CourseNameModel::get();
        return view('backend.course.add_course',$data);

    } //end method

    public function UpdateCourse(CourseRequest $request,$id){

        $data = CourseModel::find($id);

        $data->country_id = $request->country_id;
        $data->university_id = $request->university_id;
        $data->campus_id = $request->campus_id;
        $data->level_id = $request->level_id;
        $data->budget_id = $request->budget_id;
        $data->name = $request->name;
        $data->slug = Str::slug($request->name,'-');
        $data->currency = $request->currency;
        $data->fees = $request->fees;
        $data->scholarship = $request->scholarship;
        $data->description = $request->description;
        $data->overview = $request->overview;
        $data->entry_requirements = $request->entry_requirements;
        $data->scholarship_details = $request->scholarship_details;
        $data->title = $request->title;
        $data->share_title = $request->share_title;
        $data->keywords = $request->keywords;

        $data->updated_by = Auth::user()->id;

        if ($request->file('page_image')) {
        	$file = $request->file('page_image');
        	@unlink(public_path('upload/course/'.$data->page_image));
            $filename = str_replace(' ', '-', $file->getClientOriginalName());
        	$file->move(public_path('upload/course'), $filename);
        	$data['page_image'] = $filename;
         }

        // if($request->university_id){
        //     $university_slug = UniversityModel::where('id',$request->university_id)->first();
        //     $data['url'] = Str::slug($university_slug->name,'-').'-'. Str::slug($request->name,'-');
        // }
        $data['url'] = 'null';

        $data->save();

        $notification = array(
            'message' => 'Course updated successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
        //return redirect()->route('all.course')->with($notification);

    } //end method

    public function DeleteCourse($id){

        $course = CourseModel::findOrFail($id);
        if (file_exists('public/upload/course/'.$course->page_image) AND !empty($course->page_image)) {
            unlink('public/upload/course/'.$course->page_image);
        }
        $course->delete();

        $notification = array(
            'message' => 'Course deleted successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.course')->with($notification);
        // return redirect()->back()->with($notification);
    } //end method
}

