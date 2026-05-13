<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'role', 'avatar'];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function avatarUrl(): ?string
    {
        if (empty($this->avatar)) {
            return null;
        }

        return asset('storage/'.$this->avatar);
    }

    public function isSuperAdmin(): bool
    {
        return $this->role === 'super_admin';
    }
}
