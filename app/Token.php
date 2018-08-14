<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    const EXPIRATION_TIME = 15; //minutes

    protected $fillable = ['code','user_id','used'];

    public function __construct(array $attributes = [])
    {
        if(!isset($attributes['code'])){
            $attributes['code'] = $this->generateCode();
        }

        parent::__construct($attributes);
    }

    // generate code
    public function generateCode($codeLength = 4)
    {
        $min = pow(10, $codeLength);
        $max = $min * 10 - 1;
        $code = mt_rand($min,$max);

        return $code;
    }

    public function sendCode()
    {
        if (! $this->user) {
            throw new \Exception("No user attached to this token.");
        }

        if (! $this->code) {
            $this->code = $this->generateCode();
        }

        try {
            app('twilio')->messages->create($this->user->getPhoneNumber(),
                ['from' => env('TWILIO_NUMBER'), 'body' => "Your verification code is {$this->code}"]);
        } catch (\Exception $ex) {
            return false; //enable to send SMS
        }

        return true;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // if token not used or expired
    public function isValid()
    {
        return !$this->isUsed() && !$this->isExpired();
    }

    // if current token used
    public function isUsed()
    {
        return $this->used;
    }

    // if current token expired
    public function isExpired()
    {
        return $this->created_at->diffInMinutes(Carbon::now()) > static::EXPIRATON_TIME;
    }
}
