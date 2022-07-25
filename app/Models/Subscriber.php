<?php

namespace App\Models;

use App\Notifications\SubscriberVerification;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;


/**
 * @property string  $email
 * @property boolean $subscribed
 * @property string  $token
 * @property boolean $verified
 * @property int     $created_at
 * @property int     $updated_at
 * @property int     $deleted_at
 */
class Subscriber extends Model
{
    use HasTimestamps, SoftDeletes, Notifiable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'subscribers';


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'subscribed',
        'verified',
        'token',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'email' => 'string',
        'subscribed' => 'boolean',
        'verified' => 'boolean',
        'token' => 'string',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
        'deleted_at' => 'timestamp',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */
    public $timestamps = true;

    private function generateToken(): void
    {
        $this->token = rtrim(strtr(base64_encode(random_bytes(32)), '+/', '-_'), '=');
        $this->save();
    }

    public function notifyVerification(): void
    {
        $this->generateToken();
        $this->notify(new SubscriberVerification($this->email, $this->token));
    }

    public function verify(bool $value): void
    {
        $this->verified = $value;
        $this->token = null;
        $this->save();
    }

    public function subscribe(bool $value): void
    {
        $this->subscribed = $value;
        $this->save();
    }

}
