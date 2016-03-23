<?php

namespace TravelBlog\View\Album;


use Yaoi\View\Hardcoded;

class CreateForm extends Hardcoded
{
    public function render()
    {
        ?>
        <form method="post" action="/albums/create">
            <label>Title <input name="title" /></label>
            <button type="submit">Create</button>
        </form>

        <?php
    }
}