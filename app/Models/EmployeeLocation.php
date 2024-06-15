<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeLocation extends Model
{
    protected $table = 'EmployeeLocations';
    protected $fillable = [
        'EmployeeID',
        'LocationID',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'EmployeeID');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'LocationID');
    }
}