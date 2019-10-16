<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'picture' ,'role_id','IsBlocked'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the role of the user
     *
     * @return \App\Role
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
        //hasOne
    public function prof()
    {
        return $this->hasOne('App\Professeur');
    }
    public function commericale_interne()
    {
        return $this->hasOne('App\Responsable_commericale_interne');
    }
    public function responsable_technique()
    {
        return $this->hasOne('App\Responsable_technique');
    }
    public function responsable()
    {
        return $this->hasOne('App\Responsable');
    }
    public function eleve()
    {
        return $this->hasOne('App\Eleve');
    }

    /**
     * Get the path to the profile picture
     *
     * @return string
     */
    public function profilePicture()
    {
        if ($this->picture) {
            return "/storage/{$this->picture}";
        }

        return 'http://i.pravatar.cc/200';
    }

    /**
     * Check if the user has admin role
     *
     * @return boolean
     */
    public function isAdmin()
    {
        return $this->role_id == 1;
    }

    /**
     * Check if the user has creator role
     *
     * @return boolean
     */
    public function isCreator()
    {
        return $this->role_id == 2;
    }

    /**
     * Check if the user has user role
     *
     * @return boolean
     */
    public function isMember()
    {
        return $this->role_id == 3;
    }
    public function isBlocked()
    {
        return $this->IsBlocked;
    }
}
