<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_date',
        'name',
        'surname',
        'email',
        'emp_code',
        'active',
        'start_date',
        'address',
        'salary',
        'contact_number'
    ];

    public function groups()
    {
        return $this->belongsToMany(EmployeeGroup::class, 'employee_group_relation');
    }
}
