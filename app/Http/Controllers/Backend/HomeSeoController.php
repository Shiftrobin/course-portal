<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\HomeSeoModel;

class HomeSeoController extends Controller
{
    public function AllHomeseo(){
        $data['countHomeseo'] = HomeSeoModel::count();
        $data['homeseo'] = HomeSeoModel::orderBy('id','desc')->get();
        return view('backend.homeseo.all_homeseo',$data);
        } // end method

    public function AddHomeseo(){
            return view('backend.homeseo.add_homeseo');
        } // end method

    public function StoreHomeseo(Request $request){
        $homeseo = new HomeSeoModel();
        $homeseo->page_name = $request->page_name;
    	$homeseo->title = $request->title;
        $homeseo->share_title = $request->share_title;
    	$homeseo->description = $request->description;
        $homeseo->keywords = $request->keywords;
    	$homeseo->created_by = Auth::user()->id;

        if ($request->file('page_image')) {
            $file = $request->file('page_image');
            $filename = str_replace(' ', '-', $file->getClientOriginalName());
            $file->move(public_path('upload/home_seo'), $filename);
            $homeseo['page_image'] = $filename;
        }
    	$homeseo->save();

        $notification = array(
            'message' => 'Home SEO Properties created successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.homeseo')->with($notification);

    } //end method

    public function EditHomeseo($id){
        $data['editData']  = HomeSeoModel::findOrFail($id);
        return view('backend.homeseo.add_homeseo',$data);

    } //end method

    public function UpdateHomeseo(Request $request,$id){
        $homeseo = HomeSeoModel::findOrFail($id);
        $homeseo->page_name = $request->page_name;
    	$homeseo->title = $request->title;
        $homeseo->share_title = $request->share_title;
    	$homeseo->description = $request->description;
        $homeseo->keywords = $request->keywords;
    	$homeseo->updated_by = Auth::user()->id;

        if ($request->file('page_image')) {
        	$file = $request->file('page_image');
        	@unlink(public_path('upload/home_seo/'.$homeseo->page_image));
            $filename = str_replace(' ', '-', $file->getClientOriginalName());
        	$file->move(public_path('upload/home_seo'), $filename);
        	$homeseo['page_image'] = $filename;
         }
        $homeseo->save();
        $notification = array(
            'message' => 'Home SEO Properties updated successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.homeseo')->with($notification);

    } //end method

    public function DeleteHomeseo($id){
        $homeseo = HomeSeoModel::findOrFail($id);
        if (file_exists('public/upload/home_seo/'.$homeseo->page_image) AND !empty($homeseo->page_image)) {
            unlink('public/upload/home_seo/'.$homeseo->page_image);
        }
        $homeseo->delete();
        $notification = array(
            'message' => 'Home SEO Properties deleted successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } //end method

}
