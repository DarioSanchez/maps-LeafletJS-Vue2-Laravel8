<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Station extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
            'id',
            'name',
            'lat',
            'lng',
            'altitude',
            'status',
            'address',
            'owner',
            'note',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
