<?php

namespace App\Models\Template\Food_Delivery;

use Illuminate\Database\Eloquent\Model;

class FoodWorkingDay extends Model
{
    protected $fillable=['day_id','owner_id','name','start_time','end_time','status'];
    protected $primaryKey = 'day_id';
    protected $table = "food_workingdays";

}
