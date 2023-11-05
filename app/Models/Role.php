<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Role extends Model
{ protected $guarded =[];
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    // protected $fillable = [
    //     'id',
    //     'name',
    //     'active',
    // ];
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
