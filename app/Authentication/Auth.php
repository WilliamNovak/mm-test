<?php

namespace MadeiraMadeira\Application\Authentication;

use MadeiraMadeira\Application\Exceptions\AuthFailureException;
use Api\Users\Models\User;

/**
 * Authentication Trait.
 *
 * @author William Novak <williamnvk@gmail.com>
 */
class Auth {

    /**
     * @var User
     */
    private $user;
    /**
     * @var object
     */
    private $accessData = false;

    /**
     * ...
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * ...
     */
    public function authorize()
    {
        $email = null;
        $password = null;
        $mod = null;

        /**
         * Apache
         * Else: Another servers.
         */
        if ( isset($_SERVER['PHP_AUTH_USER']) ) {
            $email = $_SERVER['PHP_AUTH_USER'];
            $password = $_SERVER['PHP_AUTH_PW'];
            $mod = 'PHP_AUTH_USER';
        } elseif ( isset( $_SERVER['HTTP_AUTHORIZATION'] ) ) {


            if ( preg_match( '/^basic/i', $_SERVER['HTTP_AUTHORIZATION'] ) ) {
                list($email, $password) = explode( ':', base64_decode( substr( $_SERVER['HTTP_AUTHORIZATION'], 6 ) ) );
            }

            $mod = 'HTTP_AUTHORIZATION';

        }

        if ( is_null($email) || $mod === null ) {
            throw new AuthFailureException("access denied, no authentication data retrived.");
        }

        if ( !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new AuthFailureException("invalid e-mail.");
        }

        $email = strtolower($email);

        /**
         * Find user by e-mail.
         */
        $user = $this->user->select()->where('email', '=', "'{$email}'")->first();
        if (is_null($user)) {
            throw new AuthFailureException("invalid user or user not found.");
        }

        /**
         * If password dont math.
         */
        if ($user['password'] !== md5($password)){
            throw new AuthFailureException("invalid password.");
        }

        $this->store($user);

    }

    /**
     * Check if user is authenticated.
     *
     * @return bool
     */
    public function isAuthenticated()
    {
        return (bool) (is_object($this->accessData));
    }

    /**
     * Store data of user authorized.
     *
     * @param array $userObject
     */
    private function store($userObject = [])
    {
        $this->accessData = $userObject;
        $object = new \StdClass;
        $object->id = $userObject['id'];
        $object->first_name = $userObject['first_name'];
        $object->last_name = $userObject['last_name'];
        $object->email = $userObject['email'];
        $this->accessData = $object;
    }

    /**
     * Return user data.
     *
     * @return object
     */
    public function data()
    {
        return $this->accessData;
    }

}
