<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeadActivity extends Model
{
    protected $fillable = [
        'lead_id',
        'follow_up_date',
        'calling_type',
        'status',
        'note'
    ];

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }
}

