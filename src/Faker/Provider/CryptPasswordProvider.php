<?php

namespace App\Faker\Provider;

use Faker\Provider\Base;


final class CryptPasswordProvider extends Base
{
    /**
     * @return string Encrypted password.
     */
    public function cryptPassword($password) {
        return password_hash( $password, PASSWORD_BCRYPT );
    }
}
