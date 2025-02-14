<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Widget extends Model
{

    protected $fillable = [
        'size',
        'configuration',
        'position',
        'user_module_id',
    ];

    protected $casts = [
        'configuration' => 'array',
    ];

    protected function position(): Attribute
    {
        return Attribute::make(
            set: function () {
                $userId = $this->userModule()->value('user_id');
                $val = $this->whereHas('userModule', function($query) use ($userId) {
                    $query->where('user_id', $userId);
                })->max('position');
                return $val === null ? 0 : $val + 1;
            }
        );
    }

    public function userModule(): BelongsTo
    {
        return $this->belongsTo(UserModule::class);
    }

    public function moduleName()
    {
        return $this->userModule->module()->value('name');
    }
}
