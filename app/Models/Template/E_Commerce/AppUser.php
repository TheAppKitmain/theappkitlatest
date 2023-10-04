<?php

namespace App\Models\Template\E_Commerce;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

use Illuminate\Database\Eloquent\Model;

class AppUser extends Authenticatable
{

    use HasApiTokens, Notifiable;
    
    protected $guard = 'app_user';

    protected $fillable = [
       'owner_id','template_id','name', 'email','user_profile','number','password','updated_at','created_at'
   ];

   public function orders(){
    return $this->belongsTo('App\Models\Template\E_Commerce\Order');
    }

}
