<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'role',
        'address',
        'avatar',
        'last_login_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'last_login_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Relationships
     */

    // A user can have one vendor profile (if role = 'vendor')
    public function vendor()
    {
        return $this->hasOne(Vendor::class);
    }

    // A user can make many bookings (if role = 'user')
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'customer_id');
    }

    // A user can have many notifications
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    // A user can have many reviews
    public function reviews()
    {
        return $this->hasMany(Review::class, 'customer_id');
    }

    // A user can have many refund requests
    public function refundRequests()
    {
        return $this->hasMany(RefundRequest::class);
    }

    // A user can send and receive many chat messages
    public function sentMessages()
    {
        return $this->hasMany(ChatMessage::class, 'sender_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(ChatMessage::class, 'receiver_id');
    }
}
