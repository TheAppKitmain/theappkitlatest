<?php

namespace App\Models\Template\E_Commerce;

use Illuminate\Database\Eloquent\Model;

class E_commerce_theme extends Model
{
     
    protected $table = 'e_comm_themes';

    protected $fillable = [
        'owner_id','template_name', 'template_id','updated_at','created_at',
    ];

   protected $connection = 'mysql2';

}
