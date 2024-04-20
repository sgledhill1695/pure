<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Dog extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'allergies' => 'array',
    ];

    protected $fillable = ['name', 'breed', 'age', 'allergies'];

    public function subscription(): HasOne
    {
        return $this->hasOne(Subscription::class);
    }
}
