<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Models\RoleUser;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // /**
    //  * The attributes that are mass assignable.
    //  *
    //  * @var array<int, string>
    //  */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $table = 'user';
    protected $primaryKey = 'iduser';
    protected $fillable = [
        'nama',
        'email',
        'password',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public function pemilik()
    {
        return $this->hasOne(Pemilik::class, 'iduser', 'iduser');
    }

    public function roleUser()
    {
        // Pastikan nama model yang benar adalah RoleUser
        return $this->hasMany(RoleUser::class, 'iduser', 'iduser');
    }
    //     /**
    //      * Mendapatkan Role aktif dari user saat ini.
    //      * Ini mereplikasi logika 'status = 1' di login_post.php
    //      *
    //      * @return \App\Models\Role|null
    //      */
    //     public function activeRole()
    //     {
    //         return $this->roles()
    //                     ->wherePivot('status', 1)
    //                     ->first();
    //     }


    //     public function role()
    //     {
    //         return $this->hasOne(Role::class, 'iduser', 'iduser')
    //                     ->where('status', 1);
    //     }

    //     public function isAdministrator()
    //     {
    //         return $this->role()->first()->role->nama_role === 'Administrator';
    //     }
}
