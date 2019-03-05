<?php

namespace App;

//use App\Mailer\UserMailer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Naux\Mail\SendCloudTemplate;

use Mail;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar','is_active', 'confirmation_token','setting','followers_count','followings_count',
        'questions_count','comments_count','answers_count','likes_count'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function owns(Model $model){
        return $this->id==$model->user_id;
    }
    /**
     * send password reset email to user's email base on token.
     *
     * @param string $token
     */
    public function sendPasswordResetNotification($token)
    {
        $data = ['url' => url('password/reset',$token)];
        $template = new SendCloudTemplate('yinfeng_password_reset', $data);
        Mail::raw($template, function ($message){
        $message->from('yf@laravist.com', 'yinfeng.com');
        $message->to($this->email);
        });
    }
}
