<?php

namespace TravelBlog\View\Auth;


use TravelBlog\Identity\OAuth2\Client\Driver\Vk;
use Yaoi\View\Hardcoded;

class LoginForm extends Hardcoded
{
    public function render()
    {
        ?>
        <form action="/auth/sign-in" method="post">
            <label>Login <input name="login" /></label>
            <label>Password <input name="password" type="password" /></label>
            <button type="submit">Sign in</button>
        </form>
        <a href="/auth/register">Register</a>


        <?php
        // TODO: Implement render() method.
    }

}