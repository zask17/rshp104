<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    

     public $timestamps = false;
    
    // Secara default Laravel mencari 'roles', kita paksa mencari 'role'
    protected $table = 'role'; 

    // Primary Key yang Anda gunakan
    protected $primaryKey = 'idrole'; 

    // Kolom yang dapat diisi
    protected $fillable = ['idrole', 'nama_role'];
    
    // Relasi many-to-many ke User melalui tabel pivot RoleUser
    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user', 'idrole', 'iduser');
    }
}
