<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Substake extends Model
{
    use HasFactory;

    // The table associated with the model
    protected $table = 'Substakes';

    // The primary keys for the table
    protected $primaryKey = ['SubstakesID', 'StakeholderLocationID'];
    public $incrementing = false;
    protected $keyType = 'int';

    // The attributes that are mass assignable
    protected $fillable = [
        'FullName',
        'Workdep',
        'image',
        'email',
        'password',
        'created_at',
        'updated_at'
    ];

    // The attributes that should be cast to native types
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Defining the relationship with SubstakeApproval
    public function substakeApprovals()
    {
        return $this->hasMany(SubstakeApproval::class, 'SubstakesID');
    }

    // Defining the relationship with StakeholderLocation
    public function stakeholderLocation()
    {
        return $this->belongsTo(StakeholderLocation::class, 'StakeholderLocationID');
    }
}
