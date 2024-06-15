<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClearanceFormApproval extends Model
{
    protected $primaryKey ='ApprovalID';
    protected $table = 'ClearanceFormApprovals';
    protected $fillable = [
        'ClearanceFormID',
        'StakeholderLocationID',
        'ApprovalDate',
        'ApprovalStatus',
        'Comments',
    ];

    public function clearanceForm()
    {
        return $this->belongsTo(ClearanceForm::class, 'ClearanceFormID');
    }

    public function stakeholder()
    {
        return $this->belongsTo(StakeholderLocation::class, 'StakeholderLocationID');
    }
}