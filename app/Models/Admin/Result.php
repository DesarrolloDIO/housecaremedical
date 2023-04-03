<?php

namespace App\Models\Admin;

use App\Models\User;
use App\Models\File;
use App\Models\Admin\Eps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'patient_identification',
        'identification_type',
        'name',
        'age',
        'email',
        'eps_id',
        'estatus',
        'user_id',
        'update_user_id'
    ];

    public function file()
        {
            return $this->morphMany(File::class, 'fileable');
        }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function update_user(){
        return $this->belongsTo(User::class, 'update_user_id');
    }
    
    public function eps()
        {
            return $this->belongsTo(Eps::class);
        }
        
    public function scopeName($query, $name){
        if($name != ''){
            return $this->where('name', 'like', '%'.$name.'%');
        }
    }

}
