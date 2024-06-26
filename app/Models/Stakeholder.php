<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stakeholder extends Model
{
    protected $primaryKey = 'StakeholderID';
    protected $table = 'Stakeholders';
    protected $fillable = [
        'Workdep',
        'FullName',
        'image',
    ];

    public function stakeholderLocations()
    {
        return $this->hasMany(StakeholderLocation::class, 'StakeholderID');
    }

    public function clearanceFormApprovals()
    {
        return $this->hasMany(ClearanceFormApproval::class, 'StakeholderID');
    }
}