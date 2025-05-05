<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;

use Filament\Models\Contracts\FilamentUser; # fungsi agar tidak dapat masuk ke /admin panel
use Filament\Models\Contracts\HasAvatar;
use Filament\Models\Contracts\HasName;
use Filament\Panel; # fungsi agar tidak dapat masuk ke /admin panel
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser, HasAvatar, HasName # fungsi agar tidak dapat masuk ke /admin panel, beserta custom Foto Avatar dan Username
// class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'image',
        'name',
        'email',
        'email_verified_at',
        'password',
        'is_admin',
        'level',
        'phone',
        'street_address',
        'village',
        'district',
        'city',
        'state',
        'zip_code',
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
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    // fungsi hapus image
    protected static function boot()
    {
        parent::boot();
        static::updating(function ($model) {
            if ($model->isDirty('image') && ($model->getOriginal('image') !== null)) {
                Storage::disk('public')->delete($model->getOriginal('image'));
            }
        });
    }

    // fungsi agar tidak dapat masuk ke /admin panel
    public function canAccessPanel(Panel $panel): bool
    {
        // return $this->email == 'mangunwirayuda@gmail.com' || $this->email == 'shills@example.com';
        // return str_ends_with($this->email, '@gmail.com') && $this->hasVerifiedEmail();
        // return $this->name == 'Mangun Wirayuda';
        // return $this->hasVerifiedEmail();

        if ($panel->getId() === 'admin' && $this->is_admin == 1) {
            return true;
        } elseif ($panel->getId() === 'customer' && $this->is_admin == 0) {
            return true;
        } else {
            return false;
        }
    }
    public function getFilamentAvatarUrl(): ?string
    {
        if (isset($this->image)) {
            return url('storage/' . $this->image);
        } else {
            return url('storage/users/avatar/user.png');
        }
    }
    public function getFilamentName(): string
    {
        return "{$this->name} ~ {$this->branch->name}";
    }
}
