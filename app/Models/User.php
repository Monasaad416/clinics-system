<?php
namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable , HasRoles , SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'image',
        'department_id',
        'roles_name',
        'branch_id',
        'salary',
    ];



   public function me($user)
{
    return $this->id === $user->id;
}
    public function department()
    {
        return $this->belongsTo('App\Models\Department');
    }

    public function salary()
    {
        return $this->morphOne('App\Models\Salary', 'salariable');
    }

    public function branch()
    {
        return $this->belongsTo('App\Models\Branch');
    }

 

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'roles_name' => 'array',
    ];
}
