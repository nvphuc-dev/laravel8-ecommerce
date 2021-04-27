<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeAbout extends Model
{
	use HasFactory;

	protected $fillable = [
		'big_title',
		'title',
		'short_discription',
		'long_discription',
	];
}
