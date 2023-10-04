<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Role;
use App\Models\ThemeCategory;
use App\Models\ThemeTemplate;
use App\Models\Usertheme;
use App\Models\Collection;
use App\Models\Payment_card;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'business_name',
        'first_name',
        'last_name',
        'number',
        'user_type',
        'role_id',
        'email',
        'country',
        'password',
        'expiry_date',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function themeCategories()
    {
        return $this->hasMany('App\ThemeCategory');
    }

    public function themeTemplates()
    {
        return $this->hasMany('App\ThemeTemplate');
    }

    public function userthemes()
    {
        return $this->hasMany('App\Usertheme');
    }

    public function collections()
    {
        return $this->hasMany('App\Collection');
    }

    public function internal_updates()
    {
        return $this->belongsTo('App\InternalUpdates', 'id', 'customer_id');
    }

    public function quote_list()
    {
        return $this->belongsTo('App\quote', 'id', 'user_id');
    }

    public function notes()
    {
        return $this->belongsTo('App\InternalUpdateNotes', 'id', 'user_id');
    }

    public function to_do_list()
    {
        return $this->belongsTo('App\ToDoList', 'id', 'user_id');
    }

    public function task_reply()
    {
        return $this->belongsTo('App\TaskReply', 'id', 'user_id');
    }

    public function payment_cards()
    {
        return $this->hasMany('App\Payment_card');
    }

    public function assignpm()
    {
        return $this->belongsTo('App\Assignpm');
    }
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
