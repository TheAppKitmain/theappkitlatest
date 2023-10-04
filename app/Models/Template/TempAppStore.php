<?php

namespace App\Models\Template;

use Illuminate\Database\Eloquent\Model;

class TempAppStore extends Model
{
    protected $fillable = [
        'user_id', 'done_ios', 'done_android','template_id'
     ];
}
