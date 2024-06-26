<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
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
        'image',
        'Workdep',
        'Workname',
        'email',
        'password',
        'BossID', 
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

}
