<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Incident extends Model
{
    use SoftDeletes;
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
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

}
