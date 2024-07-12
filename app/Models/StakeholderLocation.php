<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable; // Import the base User model
use Illuminate\Notifications\Notifiable;

class StakeholderLocation extends Authenticatable
{
    protected $primaryKey = 'StakeholderLocationID';
    protected $table = 'StakeholderLocations';
    protected $fillable = [
        'StakeholderID',
        'LocationID',
        'Email',
        'Password',
        'Priority',
    ];

    public function stakeholder()
    {
        return $this->belongsTo(Stakeholder::class, 'StakeholderID');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'LocationID');
    }
}