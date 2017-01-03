<?php

namespace Notifier;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

use Auth;

use Notifier\Mail\WelcomeToNotifier;

use Mail;

use Notifier\Note;
use Notifier\Comment;
use Notifier\LoginLink;

class User extends Authenticatable
{
    use Notifiable, Sluggable, SluggableScopeHelpers, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar', 'active', 'slug', 'is_admin', 'has_active_email'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    protected $casts = ['is_admin' => 'boolean', 'has_active_email' => 'boolean'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }


    /**
     * relationships
     */

        /**
         * user has many notes
         */
        public function notes()
        {
            return $this->hasMany(Note::class);
        }

        /**
         * user has many comments
         */
        public function comments()
        {
            return $this->hasMany(Comment::class);
        }

    /** 
     * is authenticated user admin
     */
    public function isAdmin()
    {
        return $this->is_admin;
    }

    /**
     * getting the authenticated user
     * @return [type] [description]
     */
    public function auth()
    {
        return Auth::user();
    }

    /**
     * activating user
     * @param  [type] $user [description]
     * @return [type]       [description]
     */
    public function activate($user)
    {
        $user->active = true;
        $user->has_active_email = true;

        $user->save();
    }
}
