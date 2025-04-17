<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    protected $fillable = ['name', 'status'];
    
    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
}