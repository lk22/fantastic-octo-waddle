<?php

namespace Notifier;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /**
     * table to use
     * @var string
     */
    protected $table = 'contact_messages';

    /**
     * fillable fields are allowed to be mass-assignable
     * @var array
     */
    protected $fillable = ['firstname', 'lastname', 'email', 'body'];

}
