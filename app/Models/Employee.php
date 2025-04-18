<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employee extends Model
{
    protected $primaryKey = 'id';
    public function getRouteKeyName()
{
    return 'id'; 
}
    protected $fillable = [
        'name', 'email', 'phone', 
        'joining_date', 'department_id', 'profile_photo'
    ];
    
    
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}