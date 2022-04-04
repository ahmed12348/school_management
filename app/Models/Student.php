<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class Student extends Model
{
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

    public $fillable = ['id','name'];

    protected $dates = ['deleted_at'];
    public function schools()
    {
     return $this->belongsTo(School::class,'school_id')->withdefault();
    }

}
