<?php

namespace App\Models\Admin;

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

    public function eps()
        {
            return $this->belongsTo(Eps::class);
        }
}
