<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	protected $fillable = [
		'nome',
		'provider_id',
	];

	public function images(){
	    return $this->hasMany(Image::class);
	}

	public function users(){
	    return $this->belongsTo(User::class, 'provider_id');
	}
}
