<?php

namespace TravelBlog\View\Auth;


use Yaoi\View\Hardcoded;

class RegisterForm extends Hardcoded
{

    private $submitUrl;

    /**
     * @param mixed $submitUrl
     * @return RegisterForm
     */
    public function setSubmitUrl($submitUrl)
    {
        $this->submitUrl = $submitUrl;
        return $this;
    }


    public function render()
    {
        ?>
        <form action="<?=$this->submitUrl?>" method="post">
            <label>Login <input name="login" /></label>
            <label>Password <input name="password" type="password" /></label>
            <label>Repeat password <input name="repeat_password" type="password" /></label>
            <label>Email <input name="email" /></label>
            <button type="submit">Register</button>
        </form>
<?php
    }

}