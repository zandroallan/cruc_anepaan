<?php

namespace App\Http\Models\Mantenimiento;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class RoleUser extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'role_user';
    protected $fillable = [
        'id', 
        'turnar',
        'role_id', 
        'user_id'        
    ];

    protected $hidden = [
        //'id',
    ];

    public static function obtener_responsable_legal()
    {
        $result= RoleUser::select('user_id',DB::raw('(select count(*) from t_tramites where id_r_area_legal=user_id and year(created_at)='. date('Y') .') as total'))
            ->where('role_id', 5)
            ->where('turnar', 1)
            ->orderBy('total','ASC')
            ->first();

        return $result;
    }  
    
    public static function obtener_responsable_tecnica()
    {
        $result= RoleUser::select('user_id',DB::raw('(select count(*) from t_tramites where id_r_area_tecnica=user_id and year(created_at)='. date('Y') .') as total'))
            ->where('role_id', 4)
            ->where('turnar', 1)
            ->orderBy('total','ASC')
            ->first();

        return $result;
    }
    
    public static function obtener_responsable_financiera()
    {
        $result= RoleUser::select('user_id',DB::raw('(select count(*) from t_tramites where id_r_area_financiera=user_id and year(created_at)='. date('Y') .') as total'))
            ->where('role_id', 6)
            ->where('turnar', 1)
            ->orderBy('total','ASC')
            ->first();

        return $result;
    }
}