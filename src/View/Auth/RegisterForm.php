<?php

namespace TravelBlog\View\Auth;


use Yaoi\View\Hardcoded;

class RegisterForm extends Hardcoded
{
    public function render()
    {
        ?>
        <form action="/auth/register/receive" method="post">
            <label>Login <input name="login" /></label>
            <label>Password <input name="password" type="password" /></label>
            <label>Repeat password <input name="repeat_password" type="password" /></label>
            <label>Email <input name="email" /></label>
            <button type="submit">Register</button>
        </form>
<?php
    }

}