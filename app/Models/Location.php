<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $primaryKey = 'LocationID';
    protected $table = 'Locations';
    protected $fillable = [
        'LocationName',
    ];
    public function employeeLocations()
    {
        return $this->hasMany(EmployeeLocation::class, 'LocationID');
    }

    public function stakeholderLocations()
    {
        return $this->hasMany(StakeholderLocation::class, 'LocationID');
    }
}