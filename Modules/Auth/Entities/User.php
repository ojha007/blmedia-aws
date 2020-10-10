<?php


namespace Modules\Auth\Entities;


use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{

    use Notifiable, SoftDeletes, HasRoles;

    protected $guard_name = 'web';
    protected $fillable = [
        'user_name', 'email',
        'password', 'status', 'avatar', 'is_super'
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isSuper(): bool
    {
        return $this->getAttribute('is_super') == 1;
    }

    public function hasAnyPermission(...$permissions): bool
    {
        if (is_array($permissions[0])) {
            $permissions = $permissions[0];
        }
        foreach ($permissions as $permission) {
            if ($this->can($permission)) {
                return true;
            }
        }

        return false;
    }

    public function removeRole($role)
    {
        if (is_a($role, get_class($this->getRoleClass()))) {
            $this->roles()->detach($this->getStoredRole($role));
        } else {
            $this->roles()->detach($this->getStoredRole($role));
        }
        $this->load('roles');
    }


}
