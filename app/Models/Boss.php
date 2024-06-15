<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

class Boss extends Model implements Authenticatable
{
    use AuthenticatableTrait;

    protected $primaryKey = 'BossID';
    protected $table = 'Bosses';
    protected $fillable = [
        'EmployeeID',
        'Full_name',
        'Responsibility',
        'Email',
        'Password',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'EmployeeID');
    }

    public function clearanceForms()
    {
        return $this->hasMany(ClearanceForm::class, 'BossID');
    }
}
