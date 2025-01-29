<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
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
     * Get the attributes that should be cast.
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

    public function weather()
    {
        return $this->HasMany(\App\Models\Weather::class);
    }

    public function modules()
    {
        return $this->HasMany(\App\Models\UserModule::class);
    }

    public function installedModules()
    {
        return $this->hasManyThrough(\App\Models\Module::class, \App\Models\UserModule::class, 'user_id', 'id', 'id', 'module_id');
    }

    public function notInstalledModules()
    {
        return Module::with(['userModules' => function($query){
            $query->where('user_id', $this->id)
            ->where(function($subQuery) {
                $subQuery->whereNull('id')
                    ->orWhere('enabled', 0);
            });
        }]);
    }
}
