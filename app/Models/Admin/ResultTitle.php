<?php

namespace App\Models\Admin;

use App\Models\User;
use App\Models\File;
use App\Models\Admin\Result;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ResultTitle extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'response',
        'result_id',
        'estatus',
        'eps_id',
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

    public function result()
        {
            return $this->hasMany(Result::class);
        }
}