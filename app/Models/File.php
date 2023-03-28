<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'fileable_type',
        'ifileable_id',
        'created_at',
        'updated_at'
    ];

    public $timestamps = true;

    public function fileable(){
        return $this->morphTo();
    }
}
