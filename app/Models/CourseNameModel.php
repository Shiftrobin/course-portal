<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseNameModel extends Model
{
    use HasFactory;

    protected $table = 'course_names';
    protected $fillable = [
           'name','slug','status'
       ];

    final public static function getCourseNames(){
        return self::latest()->get();
    }

}
