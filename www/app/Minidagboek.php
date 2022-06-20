<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Minidagboek extends Model
{
	protected $fillable = array('datum', 'weekdag', 'muziek', 'gebeurtenis');
    protected $table = 'minidagboek';
    protected $dates = ['datum'];
    protected $primaryKey = 'datum';
    public $timestamps = false;
}
