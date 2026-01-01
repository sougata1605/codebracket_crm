<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Models\LeadFollowUp;
use Illuminate\Database\Eloquent\Casts\Attribute;

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

    public function followUps()
    {
        return $this->hasMany(LeadFollowUp::class);
    }


     protected function name(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => ucfirst($value),
        );
    }


    protected function enquiryFor(): Attribute
{
    return Attribute::make(
        set: fn ($value) => ucfirst($value),
    );
}
   

    public function activities()
    {
        return $this->hasMany(LeadFollowUp::class);
    }
}
