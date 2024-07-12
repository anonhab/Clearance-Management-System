<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClearanceForm extends Model
{
    protected $primaryKey = 'ClearanceFormID';
    protected $table = 'ClearanceForms';
    protected $fillable = [
        'EmployeeID',
        'BossID',
        'Leaving_case',
        'hasRequest',
        'Status',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'EmployeeID');
    }

    public function boss()
    {
        return $this->belongsTo(Boss::class, 'BossID');
    }

    public function clearanceFormApprovals()
    {
        return $this->hasMany(ClearanceFormApproval::class, 'ClearanceFormID');
    }
}