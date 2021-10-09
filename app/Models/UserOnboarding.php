<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserOnboarding extends Model
{
    use HasFactory;
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

    /**
     * Mutator function to set created_date column, befoure save into db
     */
    public function setCreatedDateAttribute($value)
    {
        if (empty($value) || $value == ' ') {
            return $this->attributes['created_date'] = null;
        }
        return $this->attributes['created_date'] = date('Y-m-d h:m:s', strtotime($value));
    }



    /**
     * Mutator function to set onboarding_percentage column, befoure save into db
     */
    public function setOnboardingPercentageAttribute($value)
    {
        if (empty($value)) {
            return $this->attributes['onboarding_percentage'] = 0;
        }
        return $this->attributes['onboarding_percentage'] = $value;
    }



    /**
     * Mutator function to set count_applications column, befoure save into db
     */
    public function setCountApplicationsAttribute($value)
    {
        if (empty($value) || $value == '') {
            return $this->attributes['count_applications'] = 0;
        }
        return $this->attributes['count_applications'] = $value;
    }



    /**
     * Mutator function to set count_accepted_applications column, befoure save into db
     */
    public function setCountAcceptedApplicationsAttribute($value)
    {
        if (empty($value) || $value == ' ') {
            return $this->attributes['count_accepted_applications'] = 0;
        }
        return $this->attributes['count_accepted_applications'] = $value;
    }
}
