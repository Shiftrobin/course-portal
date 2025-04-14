<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CourseModel;
use App\Models\ApplicationModel;
use App\Models\CampusModel;
use App\Models\CountryModel;
use App\Models\UniversityModel;
use App\Models\HomeSeoModel;
use Illuminate\Support\Facades\Validator;
use Mail;
use DB;
use Illuminate\Support\Facades\Cache;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;

class DefaultPageController extends Controller
{
        public function applyList(){

        $HomeSeo = HomeSeoModel::where('page_name','Apply List Page')->get();
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

        OpenGraph::addImage($HomeImage);
        OpenGraph::setTitle($HomeTitle);
        OpenGraph::setDescription($HomeDescription);
        OpenGraph::setUrl($actual_link);
        OpenGraph::setSiteName($HomeShareTitle);

        $data['countries'] = CountryModel::orderBy('name','ASC')->get();     

       //cache queries 
       $seconds= 60*60*24;
       //Cache::forget('courses');
       $data['courses'] = Cache::remember('applyList', $seconds, function () {
               return CourseModel::getCourses('','', '', '', '');
       });

       return view('frontend.pages.apply-list',$data);
    }

    public function applyByUniversity($universitySlug){     

        $HomeSeo = HomeSeoModel::where('page_name','Apply by University Page')->get();
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

        OpenGraph::addImage($HomeImage);
        OpenGraph::setTitle($HomeTitle);
        OpenGraph::setDescription($HomeDescription);
        OpenGraph::setUrl($actual_link);
        OpenGraph::setSiteName($HomeShareTitle);


        //get the university id from univesities table
        $idOfUniversity = UniversityModel::where('slug',$universitySlug)->first();
        $university_id = $idOfUniversity->id;
        //dd($university_id);

        //get the courses from courses table
        $data['courses'] = CourseModel::where('university_id',$university_id)->orderBy('id','desc')->paginate(18);  

        //dd($data['courses']);
        return view('frontend.pages.apply-by-university',$data);
    }


    
    public function applyByUniversityAndCourse($universitySlug,$courseSlug){     

        $HomeSeo = HomeSeoModel::where('page_name','Apply by University and Course Page')->get();
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

        OpenGraph::addImage($HomeImage);
        OpenGraph::setTitle($HomeTitle);
        OpenGraph::setDescription($HomeDescription);
        OpenGraph::setUrl($actual_link);
        OpenGraph::setSiteName($HomeShareTitle);


        //get the university id from univesities table
        $idOfUniversity = UniversityModel::where('slug',$universitySlug)->first();
        $university_id = $idOfUniversity->id;
        //dd($university_id);

        //get course name by course slug from courses table
        $nameOfCourse = CourseModel::where('slug', $courseSlug)->first();
        $course_name = $nameOfCourse->name;
        //dd($course_name);

        //get the courses from courses table
        $data['courses'] = CourseModel::where('university_id',$university_id)->where('name',$course_name)->get();  

        //dd($data['courses']);
        return view('frontend.pages.apply-by-university-and-course',$data);
    }


}
