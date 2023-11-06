<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Ticket extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'user_id',
        'category_id',
        'title',
        'description',
        'status',
        'assigned_user',
        'assigned_at',
        'active',
    ];
    protected $guarded =[];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_user');
    }

    public function ticketDetails()
    {
        return $this->hasMany(TicketDetail::class, 'ticket_id');
    }

    public function incident()
    {
        return $this->hasMany(Incident::class);
    }
}
