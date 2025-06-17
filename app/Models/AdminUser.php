<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class AdminUser extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'ajsadb_admin_user';
    protected $primaryKey = 'admin_user_id';
    const UPDATED_AT = 'modified';
    const CREATED_AT = 'created';


    public $timestamps = true;

    protected $fillable = [
        'username',
        'email',
        'phone',
        'password',
        'pin',
        'secure_id',
        'login_otp',
        'login_otp_date',
        'status',
        'is_deleted',
        'schedule_notify_format',
        'prior_shift_reminder',
        'image',
        'created',
        'modified'
    ];

    protected $hidden = [
        'password',
        'login_otp'
    ];

    protected $casts = [
        'login_otp_date' => 'datetime',
        'status' => 'boolean',
        'is_deleted' => 'boolean'
    ];

    /**
     * Boot method to generate secure_id
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->secure_id)) {
                $model->secure_id = Str::uuid()->toString();
            }
        });
    }

    /**
     * Get the password for the user (for authentication)
     */
    public function getAuthPassword()
    {
        return $this->password;
    }
}
