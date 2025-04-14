<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampusModel extends Model
{
    use HasFactory;

    protected $table = 'campus';
    protected $fillable = [
           'country_id','university_id','name','slug','status'
       ];

    public function country(){
        return $this->belongsTo(CountryModel::class,'country_id','id');
    }

    public function university(){
        return $this->belongsTo(UniversityModel::class,'university_id','id');
    }

}
