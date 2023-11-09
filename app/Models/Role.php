<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{

    use HasFactory;
    protected $guarded =[];
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
