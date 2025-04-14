<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BudgetModel extends Model
{
    use HasFactory;

    protected $table = 'budgets';
    protected $fillable = [
        'country_id',
        'university_id',
        'campus_id',
        'level_id',
        'range',
        'slug',
        'status'
      ];


   final public static function getBudgets(){
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

    public function level(){
        return $this->belongsTo(LevelModel::class,'level_id','id');
    }



}
