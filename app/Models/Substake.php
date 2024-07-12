<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Substake extends Model
{
    use HasFactory;

    // The table associated with the model
    protected $table = 'substakes'; // Adjust if necessary
    protected $primaryKey = 'SubstakesID';
    protected $fillable = [
        'SubstakesID',
        'StakeholderLocationID',
        'FullName',
        'Workdep',
        'image',
        'email',
        'password'
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
