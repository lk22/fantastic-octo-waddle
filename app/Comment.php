<?php

namespace Notifier;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Notifier\User;
use Notifier\Note;

class Comment extends Model
{

    use SoftDeletes;

    /**
     * table to use
     *
     * @var $table
     */
    protected $table = 'comments';

    /**
     * mass-assignable fields
     *
     * @var $fillable
     */
  	protected $fillable = array('body', 'user_id', 'note_id', 'slug');

  	/**
     * hidden fields
     *
     * @var $hidden
     */
  	protected $hidden = array('user_id', 'note_id');

  	/**
     * guarded fields
     *
     * @var $guarded
     */
  	protected $guarded = array('user_id', 'note_id');

  	/**
     * date fields
     *
     * @var $dates
     */
  	protected $dates = array('created_at', 'updated_at', 'deleted_at');

  	/**
  	 * Relationships
  	 */
  	
    		/**
    		 * comment belongs to one user
    		 */
    		public function author()
    		{
    			 return $this->belongsTo(User::class);
    		}

    		/**
    		 * comment belongs to one note
    		 */
    		public function note()
    		{
    			 return $this->belongsTo(Note::class);
    		}
}
