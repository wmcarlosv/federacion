<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    protected $table = 'notices';
    protected $fillable = ['title','category_id','description','image','content'];

    public function category(){
    	return $this->belongsTo('App\Category');
    }
}
