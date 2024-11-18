<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Category extends Model
{
    protected $fillable = ['name', 'status'];

    public function userPreferences(): MorphMany
    {
        return $this->morphMany(UserPreference::class, 'preference');
    }
}
