<?php

namespace App\Models;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Student extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded =[];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

}
