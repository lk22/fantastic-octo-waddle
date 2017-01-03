<?php

namespace Notifier;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Notifier\Note;
use Notifier\Comment;

class Category extends Model
{
    /**
     * name of table to use
     *
     * @var $table
     */
    protected $table = 'categories';

    /**
     * allowed fields to be assigned into model
     *
     * @var $fillable
     */
    protected $fillable = array('name');

    /** 
     * Relationships
     */
    
    	/** 
    	 * category belongs to a note
    	 */
    	public function notes()
    	{
    		return $this->belongsToMany(Note::class)->withPivot('note_id');
    	}

    	/**
    	 * category belongs to a comment
    	 */
    	public function comments()
    	{
    		return $this->belongsToMany(Comment::class)->withPivot('comment_id');
    	}
}
