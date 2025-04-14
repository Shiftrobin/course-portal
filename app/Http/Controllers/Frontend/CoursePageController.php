<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CourseModel;
use App\Models\ApplicationModel;
use App\Models\CampusModel;
use App\Models\CountryModel;
use App\Models\UniversityModel;
use App\Models\LevelModel;
use App\Models\HomeSeoModel;
use Illuminate\Support\Facades\Validator;
use Mail;
use DB;
use Illuminate\Support\Facades\Cache;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLdMulti;
use HTMLPurifier;
use HTMLPurifier_Config;

class CoursePageController extends Controller
{
    public $robots="index, follow, archive";

    public function index(){

        $HomeSeo = HomeSeoModel::where('page_name','Home Page')->get();
        $actual_link = ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] === 'on' ? "https" : "http" ) . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $HomeLink = "https://$_SERVER[HTTP_HOST]";

        $HomeTitle = $HomeSeo[0]['title'];
        $HomeShareTitle = $HomeSeo[0]['share_title'];
        $HomeDescription = $HomeSeo[0]['description'];
        $HomeKeywords = $HomeSeo[0]['keywords'];
        $HomeImageName = $HomeSeo[0]['page_image'];
        $HomeImage = $HomeLink.'/public/upload/home_seo/'.$HomeImageName;

        SEOMeta::setTitle($HomeTitle);
        SEOMeta::setDescription($HomeDescription);
        SEOMeta::setKeywords($HomeKeywords);
        SEOMeta::setCanonical($actual_link);
        SEOMeta::setRobots($this->robots);

        OpenGraph::addImage($HomeImage);
        OpenGraph::setTitle($HomeTitle);
        OpenGraph::setDescription($HomeDescription);
        OpenGraph::setUrl($actual_link);
        OpenGraph::setSiteName($HomeShareTitle);

        // JsonLdMulti::setTitle($HomeTitle);
        // JsonLdMulti::setDescription($HomeDescription);
        // JsonLdMulti::setType('HomePage');
        // JsonLdMulti::addImage($HomeImage);
        // JsonLdMulti::setUrl($actual_link);

        $data['HomeTitle'] = $HomeTitle;
        $data['HomeDescription'] = $HomeDescription;
        // $data['HomePage'] = 'HomePage';
        $data['HomeImage'] = $HomeImage;
        $data['actualLink'] = $actual_link;


        $data['countries'] = CountryModel::orderBy('name','ASC')->get();
       // $data['courses'] = CourseModel::getCourses('','', '', '', '','');

       //cache queries
       $seconds= 60*60*24;
       //Cache::forget('courses');
       $data['courses'] = Cache::remember('courses', $seconds, function () {
            //return CourseModel::getCourses('','', '', '', '','');
            return CourseModel::getCourses('','', '', '', '');
       });

       return view('frontend.pages.course-list',$data);
    }

    public function getMoreCourses(Request $request){
        $query = $request->search_query;
        $country_id = $request->country_id;
        $university_id = $request->university_id;
        $campus_id = $request->campus_id;
        $level_id = $request->level_id;
        $budget_id = $request->budget_id;

        if($request->ajax()){
          //  $courses = CourseModel::getCourses($query,$country_id, $university_id, $campus_id, $level_id, $budget_id);
            $courses = CourseModel::getCourses($query,$country_id, $university_id, $campus_id, $level_id,);
            return view('frontend.components.course_data', compact('courses'))->render();
       }

    }

    public function apply($universitySlug,$courseSlug,$id) {

            $applyseo = CourseModel::where('id',$id)->first();
           // ss($applyseo); echo '</pre>';die();
            $actual_link = ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] === 'on' ? "https" : "http" ) . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $HomeLink = "https://$_SERVER[HTTP_HOST]";

            $applyTitle = $applyseo->title;
            $applyShareTitle = $applyseo->share_title;
            $applyKeywords = $applyseo->keywords;
            $applyImageName = $applyseo->page_image;
            $applyImage = $HomeLink.'/public/upload/course/'.$applyImageName;
            $applyName = $applyseo->name;

            // Configure HTML Purifier
            $config = HTMLPurifier_Config::createDefault();
            $purifier = new HTMLPurifier($config);

            $applyDescription = $applyseo->overview;
            // Sanitize the HTML content
            $applyDescription = $purifier->purify($applyDescription);
            // Convert to plain text
            $applyDescription = strip_tags($applyDescription);

            $applyEntryRequirements = $applyseo->entry_requirements;
            // Sanitize the HTML content
            $applyEntryRequirements = $purifier->purify($applyEntryRequirements);
            // Convert to plain text
            $applyEntryRequirements = strip_tags($applyEntryRequirements);


            $applyScholarshipDetails = $applyseo->scholarship_details;
            // Sanitize the HTML content
            $applyScholarshipDetails = $purifier->purify($applyScholarshipDetails);
            // Convert to plain text
            $applyScholarshipDetails = strip_tags($applyScholarshipDetails);

            $applyCurrency = $applyseo->currency;
            $applyFees = $applyseo->fees;
            $applyScholarship = $applyseo->scholarship;

            $country = CountryModel::where('id',$applyseo->country_id)->first();
            $country_name = $country->name;
            $university = UniversityModel::where('id',$applyseo->university_id)->first();
            $university_name = $university->name;
            $campus = CampusModel::where('id',$applyseo->campus_id)->first();
            $campus_name = $campus->name;
            $level = LevelModel::where('id',$applyseo->level_id)->first();
            $level_name = $level->name;

            SEOMeta::setTitle($applyTitle);
            SEOMeta::setDescription($applyDescription);
            SEOMeta::setKeywords($applyKeywords);
            SEOMeta::setCanonical($actual_link);
            SEOMeta::setRobots($this->robots);

            if($applyImageName){
                OpenGraph::addImage($applyImage);
            }else
            {
                $logo = $HomeLink.'/public/frontend/assets/img/AIMS-Education.png';
                OpenGraph::addImage($logo);
            }
            OpenGraph::setTitle($applyTitle);
            OpenGraph::setDescription($applyDescription);
            OpenGraph::setUrl($actual_link);
            OpenGraph::setSiteName($applyShareTitle);

            // JsonLdMulti::setType('Course');
            // JsonLdMulti::setTitle($applyName);
            // JsonLdMulti::setDescription($applyDescription);
            // JsonLdMulti::addValue('Entry Requirements', $applyEntryRequirements);
            // JsonLdMulti::addValue('Scholarship Details', $applyScholarshipDetails);
            // JsonLdMulti::addValue('Country', $country_name);
            // JsonLdMulti::addValue('University', $university_name);
            // JsonLdMulti::addValue('Campus', $campus_name);
            // JsonLdMulti::addValue('Level', $level_name);
            // JsonLdMulti::addValue('Currency', $applyCurrency);
            // JsonLdMulti::addValue('Fees', $applyFees);
            // JsonLdMulti::addValue('Scholarship', $applyScholarship);
            // JsonLdMulti::setUrl($actual_link);
            // if($applyImageName){
            //     JsonLdMulti::addImage($applyImage);
            // }else
            // {
            //     $logo = $HomeLink.'/public/frontend/assets/img/AIMS-Education.png';
            //     JsonLdMulti::addImage($logo);
            // }
            // if(! JsonLdMulti::isEmpty()) {
            //     JsonLdMulti::newJsonLd();
            //     JsonLdMulti::addValue('Item', 'Provider');
            //     JsonLdMulti::setType('Organizer');
            //     JsonLdMulti::setTitle($university_name);
            // }

            $data['courseName'] = $applyName;
            $data['courseDescription'] = $applyDescription;
            $data['courseEntryRequirements'] = $applyEntryRequirements;
            $data['courseScholarshipDetails'] = $applyScholarshipDetails;
            $data['countryName'] = $country_name;
            $data['campusName'] = $campus_name;
            $data['levelName'] = $level_name;
            $data['courseCurrency'] = $applyCurrency;
            $data['courseFees'] = $applyFees;
            $data['courseScholarship'] = $applyScholarship;
            $data['actualLink'] = $actual_link;
            $data['universityName'] = $university_name;
            if($applyImageName){
                $data['courseImage'] = $applyImage;
            }else
            {
                $logo = $HomeLink.'/public/frontend/assets/img/AIMS-Education.png';
                $data['courseImage'] = $logo;
            }

            // echo '<pre>'; print_r($course_id); echo '</pre>';die();
            $data['course_data'] = CourseModel::where('id',$id)->first();

            $university_id = $data['course_data']->university_id;
            // echo '<pre>'; print_r($university_id); echo '</pre>';die();
            $data['university_data'] = UniversityModel::where('id',$university_id)->first();

            $campus_id = $data['course_data']->campus_id;
            // echo '<pre>'; print_r($campus_id); echo '</pre>';die();
            $data['campus_data'] = CampusModel::where('id',$campus_id)->first();


            return view('frontend.pages.apply',$data);
        }

    public function applyNowStore(Request $request) {

            $validator = Validator::make(
                $request->all(),
                [
                    'name' => 'required|min:4|max:255',
                    'nationality' => 'required',
                    'phone' => 'required|regex:/(0)[0-9]/|not_regex:/[a-z]/|min:10',
                    'email' => 'required|max:255|email:applications',
                    'cv' => 'nullable|mimes:jpg,jpeg,png,pdf,doc,docx|max:1024',
                    'sop' => 'nullable|mimes:jpg,jpeg,png,pdf,doc,docx|max:1024',
                    'passport' => 'nullable|mimes:jpg,jpeg,png,pdf,doc,docx|max:1024',
                    'ielts' => 'nullable|mimes:jpg,jpeg,png,pdf,doc,docx|max:1024',
                    'transcript' => 'nullable|mimes:jpg,jpeg,png,pdf,doc,docx|max:1024',
                    'certificate' => 'nullable|mimes:jpg,jpeg,png,pdf,doc,docx|max:1024',
                   // 'g-recaptcha-response' => 'required|captcha'
                ],
                [
                 'name.min' => 'Name must be minimum 4 character long',
                 'phone.min' => 'A leading 0 & minimum 10 number is required'
                ]
            );
            if ($validator->fails()) {
                return response()->json([
                            'error' => $validator->errors()
                        ]);
            }

            $application = new ApplicationModel();
            $application->name = $request->name;
            $application->nationality = $request->nationality;
            $application->phone = $request->phone;
            $application->address = $request->address;
            $application->email = $request->email;
            $application->qualification = $request->qualification;
            $application->course = $request->course;
            $application->university = $request->university;
            $application->campus = $request->campus;
            $application->msg = $request->msg;

            $cv = $request->file('cv');
            if ($cv) {
                $cvName = date('YmdHi').$cv->getClientOriginalName();
                $cv->move('public/upload/application_docs/', $cvName);
                $application['cv'] = $cvName;
            }

            $sop = $request->file('sop');
            if ($sop) {
                $sopName = date('YmdHi').$sop->getClientOriginalName();
                $sop->move('public/upload/application_docs/', $sopName);
                $application['sop'] = $sopName;
            }

            $passport = $request->file('passport');
            if ($passport) {
                $passportName = date('YmdHi').$passport->getClientOriginalName();
                $passport->move('public/upload/application_docs/', $passportName);
                $application['passport'] = $passportName;
            }

            $ielts = $request->file('ielts');
            if ($ielts) {
                $ieltsName = date('YmdHi').$ielts->getClientOriginalName();
                $ielts->move('public/upload/application_docs/', $ieltsName);
                $application['ielts'] = $ieltsName;
            }

            $transcript = $request->file('transcript');
            if ($transcript) {
                $transcriptName = date('YmdHi').$transcript->getClientOriginalName();
                $transcript->move('public/upload/application_docs/', $transcriptName);
                $application['transcript'] = $transcriptName;
            }

            $certificate = $request->file('certificate');
            if ($certificate) {
                $certificateName = date('YmdHi').$certificate->getClientOriginalName();
                $certificate->move('public/upload/application_docs/', $certificateName);
                $application['certificate'] = $certificateName;
            }

            //debug
            //$application->save();

            if ($application->save()) {
                //application id from application_docs table
                $GLOBALS['application_id'] =  $application->id;
            }

            // get the docs by application id
            $files = ApplicationModel::where('id', $GLOBALS['application_id'])->first();

           //deubg
           // dd($files);

            $data = array(
                 'name' => $request->name,
                 'nationality' => $request->nationality,
                 'phone' => $request->phone,
                 'address' => $request->address,
                 'email' => $request->email,
                 'qualification' => $request->qualification,
                 'course' => $request->course,
                 'university' => $request->university,
                 'campus' => $request->campus,
                 'msg' => $request->msg,
            );

            Mail::send('frontend.emails.application',$data, function( $message ) use( $data, $files ){
                $message->from('shefat@aimseducation.co.uk',$data['name'].' - '.$data['university'].' | Application Submission on  Course Finder - AIMS Education');
                $message->to($data['email'],$data['name']);
                $message->cc(['marketing@aimseducation.co.uk','Mo.Miah@aimseducation.co.uk']);
                $message->bcc('shefat@aimseducation.co.uk',$data['name'].' - '.$data['university'].' | Application Submission on  Course Finder - AIMS Education');
                $message->subject($data['name'].' - '.$data['university'].' | Application Submission on  Course Finder - AIMS Education');

                if(count((array)$files->cv)>0) {
                    $message->attach(public_path('upload/application_docs/'.$files->cv));
                }
                if(count((array)$files->sop)>0) {
                    $message->attach(public_path('upload/application_docs/'.$files->sop));
                }
                if(count((array)$files->passport)>0) {
                    $message->attach(public_path('upload/application_docs/'.$files->passport));
                }
                if(count((array)$files->ielts)>0) {
                    $message->attach(public_path('upload/application_docs/'.$files->ielts));
                }
                if(count((array)$files->transcript)>0) {
                    $message->attach(public_path('upload/application_docs/'.$files->transcript));
                }
                if(count((array)$files->certificate)>0) {
                    $message->attach(public_path('upload/application_docs/'.$files->certificate));
                }

            });

        return response()->json(
            [
                "success" => "Thanks, you're all set. One of our advisers will contact you soon."
            ]
        );

    }


}
