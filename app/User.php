<?php
namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * @SWG\Definition(
 *  definition="User",
 *  @SWG\Property(
 *      property="id",
 *      type="integer"
 *  ),
 *  @SWG\Property(
 *      property="name",
 *      type="string"
 *  ),
 *  @SWG\Property(
 *      property="family",
 *      type="string"
 *  ),
 *  @SWG\Property(
 *      property="second",
 *      type="string"
 *  ),
 *  @SWG\Property(
 *      property="email",
 *      type="string"
 *  ),
 *  @SWG\Property(
 *      property="img",
 *      type="string"
 *  ),
 *  @SWG\Property(
 *      property="birthday",
 *      type="string"
 *  ),
 *  @SWG\Property(
 *      property="password",
 *      type="string"
 *  ),
 *  @SWG\Property(
 *      property="remember_token",
 *      type="string"
 *  ),
 *  @SWG\Property(
 *      property="email_verified_at",
 *      type="string"
 *  ),
 *  @SWG\Property(
 *      property="created_at",
 *      type="string"
 *  ),
 *  @SWG\Property(
 *      property="updated_at",
 *      type="string"
 *  ),
 * )
 */

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'family', 'second', 'birthday', 'email', 'password', 'img'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
