<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $table = 'leads';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'enquiry_for',
        'address',
        'lead_type',
        'status',
        'lead_given_date',
        'assigned_user',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

