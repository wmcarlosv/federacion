<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['name','price','cover','entry_id','description','phone','whatsapp','email','direction','content'];

    public function entry(){
    	return $this->belongsTo('App\Entry');
    }
}
