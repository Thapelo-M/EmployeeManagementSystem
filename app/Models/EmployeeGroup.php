<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeGroup extends Model
{
    use HasFactory;

    protected $fillable = ['group_name'];

    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'employee_group_relation');
    }
}
