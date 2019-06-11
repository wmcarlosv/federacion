<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $table = 'documents';
    protected $fillable = ['title','category_id','description','image','file','content'];

    public function category(){
    	return $this->belongsTo('App\Category');
    }
}
