<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use function PHPUnit\Framework\isNull;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public function advert()
    {
        return $this->hasMany(Advert::class, 'creator_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'admin',
        'surname',
        'email',
        'phone',
        'password',
        'on_black_list',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    public function setPhoneAttribute($phone)
    {
        $phone = preg_replace("/[^a-zA-Z0-9\s]/", '', $phone);

        $this->attributes['phone'] = '+7' . substr($phone, 1);
    }

    public function setNameAttribute($name)
    {
        $this->attributes['name'] = Str::title(strtolower($name));
    }

    public function setSurnameAttribute($surname)
    {
        $this->attributes['surname'] = Str::title(strtolower($surname));
    }
}
