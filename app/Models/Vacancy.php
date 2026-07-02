<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vacancy extends Model
{
    protected $fillable = ['title', 'company', 'location', 'salary', 'category', 'description'];

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }
}