<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UniversityModel extends Model
{
    use HasFactory;

    protected $table = 'universities';
    protected $fillable = [
        'country_id','name','slug','status'
      ];


    //  final public static function getUniversities(){
    //     return self::latest()->get();
    // }

    public function country(){
        return $this->belongsTo(CountryModel::class,'country_id','id');
    }

}
