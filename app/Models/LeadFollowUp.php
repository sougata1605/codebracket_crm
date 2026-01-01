<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

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
        'follow_up_date' => 'date',
        'follow_up_datetime'  =>'datetime'
    ];

    protected function followUpDate(): Attribute
    {
        return Attribute::make(
            set: fn ($value) =>
                $value ? Carbon::parse($value) : null
        );
    }


    protected function followUpDateTime(): Attribute
    {
        return Attribute::make(
            set: fn ($value) =>
                $value ? Carbon::parse($value) : null
        );
    }

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }
}
