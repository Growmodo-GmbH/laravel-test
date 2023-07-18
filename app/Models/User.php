<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use jeremykenedy\LaravelRoles\Traits\HasRoleAndPermission;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, HasRoleAndPermission;

    /**
     * The accessors to append to the model's array.
     *
     * @var array
     */
    protected $appends = [
        'roles'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'password',
        'subscribed'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getRolesAttribute()
    {
        return $this->getRoles();
    }

    public function role()
    {
        return $this->hasOne(RoleUser::class, 'user_id', 'id');
    }
}
