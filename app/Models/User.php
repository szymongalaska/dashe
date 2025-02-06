<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
    // implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use Notifiable;

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

    /**
     * Get all modules
     * @return HasMany<UserModule, User>
     */
    public function modules(): HasMany
    {
        return $this->HasMany(\App\Models\UserModule::class);
    }

    /**
     * Get installed modules for user
     * @return HasManyThrough<Module, UserModule, User>
     */
    public function installedModules(): HasManyThrough
    {
        return $this->hasManyThrough(\App\Models\Module::class, \App\Models\UserModule::class, 'user_id', 'id', 'id', 'module_id')->where('enabled', true);
    }

    public function hasAnyModules(): bool
    {
        return $this->installedModules()->count() > 0;
    }

    /**
     * Get not installed modules for user
     * @return Module
     */
    public function notInstalledModules()
    {
        return Module::doesntHave('userModules', 'and', function ($query) {
            $query->where('user_id', $this->id);
        })->orWhereHas('userModules', function ($query) {
            $query->where('enabled', false);
        });
    }

    /**
     * Check if module is installed for user
     * @param string $module Module name
     * @return bool
     */
    public function isModuleInstalled(string $module): bool
    {
        return $this->installedModules()->where('name', $module)->exists();
    }

    public function disabledModules()
    {
        return $this->modules()->where('enabled', false);
    }

    /**
     * Get module data of user
     * @param string $module Module name
     * @return UserModule|null
     */
    public function module(string $module): UserModule|null
    {
        return $this->modules()->with('module')->whereRelation('module', 'name', $module)->where('enabled', true)->first();
    }
}
