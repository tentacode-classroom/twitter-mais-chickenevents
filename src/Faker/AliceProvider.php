<?php
/**
 * Created by IntelliJ IDEA.
 * User: maxencemottard
 * Date: 19/10/2018
 * Time: 10:42
 */

namespace App\Faker;

use Faker\Provider\Base as BaseProvider;


class AliceProvider extends BaseProvider
{
    /**
     * @return string Encrypted password.
     */
    public function cryptPassword($password) {
        return password_hash( $password, PASSWORD_BCRYPT );
    }
}
