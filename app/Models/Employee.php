<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable; // Import the base User model
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Authenticatable

{
    use HasFactory, Notifiable;
    protected $primaryKey = 'EmployeeID';
    protected $table = 'Employees';
    protected $fillable = [
        'File_number',
        'FirstName',
        'LastName',
        'Workdep',
        'Workname',
        'email',
        'password',  
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function boss()
    {
        return $this->hasOne(Boss::class, 'EmployeeID');
    }

    public function clearanceForms()
    {
        return $this->hasMany(ClearanceForm::class, 'EmployeeID');
    }

    public function employeeLocations()
    {
        return $this->hasMany(EmployeeLocation::class, 'EmployeeID');
    }
}