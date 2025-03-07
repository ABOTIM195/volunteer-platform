<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    use HasFactory;

    /**
     * الحقول التي يمكن تعبئتها بشكل جماعي
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'is_active',
    ];

    /**
     * الحقول التي يجب تحويلها إلى أنواع محددة
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];
}