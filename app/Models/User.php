<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'phone',
        'email'
    ];

    protected function email(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => Crypt::encryptString($value),
            get: fn (string $value) => Crypt::decryptString($value)
        );
    }


    protected function phone(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Str::mask($value,"*",3,4),
        );
    }


}
