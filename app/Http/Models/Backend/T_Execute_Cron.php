<?php

namespace App\Http\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class T_Execute_Cron extends Model
 {
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 't_execute_cron';
    protected $fillable = [
        'id', 
        'cron',
        'description'
    ];

    protected $hidden = [
        //'id',
    ];
 }
