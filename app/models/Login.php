<?php

use Illuminate\Auth\UserInterface;

use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Login extends Eloquent implements UserInterface, RemindableInterface  {

    use RemindableTrait;

    protected $table = 'login';

    protected $guarded = array();

    protected $fillable = array('login','senha','status');

    protected $primaryKey = 'id';

    public static $rules = array(
                                 'login' => 'required',
                                 'senha' => 'required'
                                 );


    public function Cliente() {
        return $this->belongsTo('Cliente');
    }


    public function Funcionario() {
        return $this->belongsTo('Funcionario');
    }


    public function Perfil() {
        return $this->belongsToMany('Perfil', 'loginperfil')->withPivot('status', 'empresa_id')/*->wherePivot('status', 1) //IF need by status */;
    }

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('senha');

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        // return $this->password;
        return $this->attributes['senha'];
    }

    /**
     * Get the e-mail address where password reminders are sent.
     *
     * @return string
     */
    public function getReminderEmail()
    {
        return $this->email;
    }

    public static function validate($data) {
        return Validator::make($data,static::$rules);
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }

}
