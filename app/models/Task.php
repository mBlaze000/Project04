<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Task extends Eloquent {

# Relationship method...
    public function user() {
    
    	# Tasks belong to User
	    return $this->belongsTo('User');
    }
}
