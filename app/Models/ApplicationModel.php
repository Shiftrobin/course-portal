<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationModel extends Model
{
    use HasFactory;

    protected $table = 'applications';
    protected $fillable = [
           'name',
           'nationality',
           'phone',
           'address',
           'email',
           'qualification',
           'cv',
           'sop',
           'passport',
           'ielts',
           'transcript',
           'certificate',
           'msg',
           'course',
           'university',
           'campus',
           'status'
       ];

}
