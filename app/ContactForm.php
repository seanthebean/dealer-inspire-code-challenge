<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactForm extends Model
{
    protected $table = 'contact_messages';
    protected $guarded = ['id'];
    public $timestamps = false;
}
