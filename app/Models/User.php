<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use SoftDeletes;


    // The User model requires this trait
    use HasRoles;

//    protected $guard_name = 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'email', 'password', 'cnic', 'license_number', 'address', 'mobile_no', 'status',
        'domestic',
        'commercial',
        'industrial'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];


    public function scopeStartsBefore(Builder $query, $date): Builder
    {
        if (!empty($date)) {
            $datetime1 = null;
            $datetime2 = null;

            if (isset($date) && !empty($date)) {
                $dates = explode(' – ', $date);
                $fdate = @$dates[0];
                $tdate = @$dates[1];
                if (!empty($fdate) && !empty($tdate)) {
                    $datetime1 = new \DateTime($fdate);
                    $datetime2 = new \DateTime($tdate);
                }
            }

            $date_from = null;
            $date_to = null;

            if (!empty($date)) {
                $date_from = $datetime1->format('Y-m-d');
                $date_to = $datetime2->format('Y-m-d');
            }


        }

        return $query->whereBetween('date', [$date_from, $date_to]);
    }


    public function divisionSubDivision()
    {
        return $this->belongsTo(DivisionSubDivision::class, 'division_sub_division_id');
    }
}
