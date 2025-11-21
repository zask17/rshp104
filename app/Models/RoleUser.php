<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class RoleUser extends Model
{
    // use HasFactory;
    public $timestamps = false;

    // Definisikan nama tabel yang benar (jika berbeda dari konvensi)
    protected $table = 'role_user'; 
    
    // Definisikan kolom yang dapat diisi
    protected $fillable = [
        'iduser',
        'idrole',
        'status',
    ];

    // Relasi kembali ke model User
    public function user()
    {
        return $this->belongsTo(User::class, 'iduser', 'iduser');
    }

    // Relasi ke model Role
    public function role()
    {
        return $this->belongsTo(Role::class, 'idrole'. 'idrolee');
    }
}