<?php

namespace App\Models\Admin;

use App\Models\User;
use App\Models\Admin\Result;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Eps extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'estatus',
        'user_id',
        'update_user_id'
    ];

    public function result()
        {
            return $this->belongsTo(Result::class);
        }

    public function user(){
            return $this->belongsTo(User::class, 'user_id');
        }

    public function update_user(){
        return $this->belongsTo(User::class, 'update_user_id');
    }

    public function scopeName($query, $name){
        if($name != ''){
            return $this->where('name', 'like', '%'.$name.'%');
        }
    }

    

}
