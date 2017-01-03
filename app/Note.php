<?php

namespace Notifier;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Cviebrock\EloquentSluggable\Sluggable;

use Notifier\User;
use Notifier\Comment;

class Note extends Model
{

    use Sluggable, SluggableScopeHelpers, SoftDeletes;

    /**
     * table to use
     *
     * @var  $table [<the table to use in database>]
     */
    protected $table = 'notes';

    /**
     * mass-assignable fields to the model
     *
     * @var $fillable
     */
    protected $fillable = array('title', 'body', 'user_id', 'slug');


    /**
     * protected fields from showing in the application
     * 
     * @var $hidden
     */
    protected $hidden = array('user_id');

    /**
     * guarded columns
     *
     * @var $guarded
     */
    protected $guarded = array('user_id');

    /**
     * date columns
     *
     * @var $dates
     */
    protected $dates = array('created_at', 'updated_at', 'deleted_at');


    /**
     * Sluggable
     * @var array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    /**
     * Relationships
     */
    
    	/**
    	 * note belongs to user
    	 */
    	public function author()
    	{
    		return $this->belongsTo(User::class, 'user_id');
    	}


    	/**
    	 * note has many comments
    	 */
    	public function comments()
    	{
    		return $this->hasMany(Comment::class);
    	}

}
