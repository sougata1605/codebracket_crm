<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeadFollowUp extends Model
{
    protected $fillable = [
        'lead_id',
        'note',
        'calling_type',
        'status',
        'follow_up_date',
    ];

    protected $casts = [
        'follow_up_date' => 'datetime',
    ];

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }
}
