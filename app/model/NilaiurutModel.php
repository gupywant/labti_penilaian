<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class NilaiurutModel extends Model
{
    protected $table = "nilai_urut";
    protected $fillable = ['id_urut'];
}
