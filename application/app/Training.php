<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    protected $table = 'trainings';
    protected $fillable = ['title','category_id','description','image','content'];

    public function category(){
    	return $this->belongsTo('App\Category');
    }
}
