<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;

use Filament\Models\Contracts\FilamentUser; # fungsi agar tidak dapat masuk ke /admin panel
use Filament\Panel; # fungsi agar tidak dapat masuk ke /admin panel
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser # fungsi agar tidak dapat masuk ke /admin panel
// class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'is_admin',
        'branch_id',
        'created_oleh',
        'updated_oleh',
    ];

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
        'password' => 'hashed',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    // fungsi agar tidak dapat masuk ke /admin panel
    public function canAccessPanel(Panel $panel): bool
    {
        // return $this->email == 'mangunwirayuda@gmail.com' || $this->email == 'shills@example.com';
        // return str_ends_with($this->email, '@gmail.com') && $this->hasVerifiedEmail();
        // return $this->name == 'Mangun Wirayuda';
        // return $this->hasVerifiedEmail();
        return $this->is_admin == 1;
    }
}
