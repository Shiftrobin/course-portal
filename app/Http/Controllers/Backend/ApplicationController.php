<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\ApplicationDocsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\ApplicationModel;
use App\Models\ApplicationDocModel;
use Auth;

class ApplicationController extends Controller
{
    public function AllApplication() {

        $applications = ApplicationModel::orderBy('id','desc')->get();
        return view('backend.application.all_application',compact('applications'));

    } // end method

    public function ShowApplication($id) {
        $application = ApplicationModel::where('id',$id)->first();
        return view('backend.application.show_application',compact('application'));

    }

    public function ApplicationExport(){
        return Excel::download(new ApplicationDocsExport, 'applicationList.xlsx');
    }

    public function DeleteApplication ($id) {

        $Application = ApplicationModel::find($id);

        if (file_exists('public/upload/application_docs/'.$Application->cv) AND !empty($Application->cv)) {
            unlink('public/upload/application_docs/'.$Application->cv);
        }
        if (file_exists('public/upload/application_docs/'.$Application->sop) AND !empty($Application->sop)) {
            unlink('public/upload/application_docs/'.$Application->sop);
        }
        if (file_exists('public/upload/application_docs/'.$Application->passport) AND !empty($Application->passport)) {
            unlink('public/upload/application_docs/'.$Application->passport);        }

        if (file_exists('public/upload/application_docs/'.$Application->ielts) AND !empty($Application->ielts)) {
            unlink('public/upload/application_docs/'.$Application->ielts);
        }
        if (file_exists('public/upload/application_docs/'.$Application->transcript) AND !empty($Application->transcript)) {
            unlink('public/upload/application_docs/'.$Application->transcript);
        }
        if (file_exists('public/upload/application_docs/'.$Application->certificate) AND !empty($Application->certificate)) {
            unlink('public/upload/application_docs/'.$Application->certificate);
        }

    	$Application->delete();

        $notification = array(
            'message' => 'Application deleted successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

}
