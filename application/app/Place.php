<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $table = 'places';
    protected $fillable = ['name','isactive','entry_id','phone','location_id','direction','country','city','image','description'];

    public function entry(){
    	return $this->belongsTo('App\Entry');
    }

    public function location(){
    	return $this->belongsTo('App\Location');
    }
}
