<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubstakeApproval extends Model
{
    use HasFactory;

    // The table associated with the model
    protected $table = 'substakesapproval';

    // The primary key for the table
    protected $primaryKey = 'SubstakesID';
    public $incrementing = false;
    protected $keyType = 'int';

    // The attributes that are mass assignable
    protected $fillable = [
        'ClearanceFormID',
        'ApprovalStatus',
        'Comments',
        'created_at',
        'updated_at'
    ];

    // The attributes that should be cast to native types
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Defining the relationship with Substake
    public function substake()
    {
        return $this->belongsTo(Substake::class, 'SubstakesID');
    }
}
