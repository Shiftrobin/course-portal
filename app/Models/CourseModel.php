<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class CourseModel extends Model
{
    use HasFactory;

    protected $table = 'courses';
    protected $fillable = [
        'country_id',
        'university_id',
        'campus_id',
        'level_id',
        'budget_id',
        'name',
        'slug',
        'currency',
        'fees',
        'scholarship',
        'description',
        'overview',
        'entry_requirements',
        'scholarship_details',
        'url',
        'title',
        'share_title',
        'keywords',
        'page_image',
        'status'
      ];



    public function country(){
        return $this->belongsTo(CountryModel::class,'country_id','id');
    }

    public function university(){
        return $this->belongsTo(UniversityModel::class,'university_id','id');
    }

    public function campus(){
        return $this->belongsTo(CampusModel::class,'campus_id','id');
    }

    public function level(){
        return $this->belongsTo(LevelModel::class,'level_id','id');
    }

    public function budget(){
        return $this->belongsTo(BudgetModel::class,'budget_id','id');
    }


    public static function getCourses($search_keyword, $country_id, $university_id, $campus_id, $level_id /*,$budget_id*/ ){

        $courses = DB::table('courses');

        $search_keyword = lcfirst($search_keyword);

        if($search_keyword && !empty($search_keyword)) {
            $courses->where(function($q) use ($search_keyword){
                $q->where('courses.name', 'like', "%{$search_keyword}%");
            });
        }

         // Filter By country
        if($country_id &&  !empty($country_id) ) {
            $courses = $courses->where('courses.country_id', $country_id);
        }

         // Filter By university
        if($university_id &&  !empty($university_id) ) {
            $courses = $courses->where('courses.university_id', $university_id);
        }
           // Filter By university
        if($campus_id &&  !empty($campus_id) ) {
            $courses = $courses->where('courses.campus_id', $campus_id);
        }

            // Filter By level
        if($level_id &&  !empty($level_id) ) {
            $courses = $courses->where('courses.level_id', $level_id);
        }

            // Filter By budget
        // if($budget_id &&  !empty($budget_id) ) {
        //     $courses = $courses->where('courses.budget_id', $budget_id);
        // }

       // return $courses->paginate(12);
       return $courses->orderBy('id','desc')->paginate(18);
       //return $course->orderBy('id's,'desc')->get();
      //return $course->orderBy('id','desc')->limit(18);
  
    }

    


    // public static function getListOfCourse($search_keyword){

    //     $courses = DB::table('courses');

    //     $search_keyword = lcfirst($search_keyword);

    //     if($search_keyword && !empty($search_keyword)) {
    //         $courses->where(function($q) use ($search_keyword){
    //             $q->where('courses.name', 'like', "%{$search_keyword}%");
    //         });
    //     }       
      
    //    return $courses->orderBy('id','desc')->paginate(18);
     
    // }



}
