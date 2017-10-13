<?php
/**
 * Created by PhpStorm.
 * User: abstruct
 * Date: 2017-10-13
 * Time: 4:22 PM
 */

namespace model;


interface User
{

    public function create($username, $password, $password_confirmation);
}