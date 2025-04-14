<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LevelModel extends Model
{
    use HasFactory;

    protected $table = 'levels';
    protected $fillable = [
        'country_id','university_id','campus_id','name','slug','status'
      ];


    final public static function getLevels(){
        return self::latest()->get();
    }

    public function country(){
        return $this->belongsTo(CountryModel::class,'country_id','id');
    }

    public function university(){
        return $this->belongsTo(UniversityModel::class,'university_id','id');
    }

    public function campus(){
        return $this->belongsTo(CampusModel::class,'campus_id','id');
    }

}
