<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    use HasFactory;

    protected $table = 'employee';
    protected $fillable = ['id','name','department_id','department_role','created_at','updated_at'];
    protected $primaryKey = 'id';
}
