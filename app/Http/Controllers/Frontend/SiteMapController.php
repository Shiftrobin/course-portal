<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\CourseModel;

class SiteMapController extends Controller
{
     // Define a public variable 
     public $courses;

     // Constructor to initialize the variable 
     public function __construct() { 
       $this->courses = CourseModel::with(['country','university','campus','level','budget'])->lazyByIdDesc(20)->each(function($course_datas){
            CourseModel::where('id',$course_datas->id);          
        });       
     }

     public function index(){
        $sitemap = Sitemap::create('https://aimseducation.co.uk/courses/')
       // $sitemap = Sitemap::create()
        ->add(Url::create('/'));  
        foreach($this->courses as $item){
            $sitemap->add(Url::create(url('')."/apply/{$item['university']['slug']}/{$item->slug}/{$item->id}")->setLastModificationDate($item->updated_at));
        }
        // Sitemap generate
        $sitemap->writeTofile(('sitemap.xml'));
        return 'Sitemap Created Succesfully';
    }
}
