<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserOnboarding extends Model
{
    protected $table = 'user_onboarding';
    protected $primaryKey = 'user_id';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'created_date',
        'onboarding_percentage',
        'count_applications',
        'count_accepted_applications',
    ];
}
