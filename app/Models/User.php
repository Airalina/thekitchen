<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasRoles;
    use Notifiable;
    use SoftDeletes;
    use TwoFactorAuthenticatable;


    const ROLES = [
        'super_admin' => 'super admin',
        'client' => 'cliente',
        'employee' => 'empleado',
    ];

    const PERMISSIONS = [
        'user.index' => 'user.index',
        'user.create' => 'user.create',
        'user.update' => 'user.update',
        'user.show' => 'user.show',
        'user.delete' => 'user.delete',
        'role.index' => 'role.index',
        'role.create' => 'role.create',
        'role.update' => 'role.update',
        'role.show' => 'role.show',
        'role.delete' => 'role.delete',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'dni',
        'domicile',
        'email',
        'password',
        'phone',
        'username'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
        'rols',
    ];

    public static function search($search = '', $orderBy = 'id')
    {
        return self::where('id', 'LIKE', '%' . $search . '%')
            ->orWhere('name', 'LIKE', '%' . $search . '%')
            ->orWhere('email', 'LIKE', '%' . $search . '%')
            ->orderBy($orderBy);
    }
    public function getRolsAttribute()
    {   
        return $this->getRoleNames();
    }
}
