<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeSeoModel extends Model
{
    use HasFactory;

    protected $table = 'home_seos';

    protected $fillable = [
    'page_name',
    'title',
    'share_title',
    'description',
    'keywords',
    'page_image',
    'status'
    ];

}
