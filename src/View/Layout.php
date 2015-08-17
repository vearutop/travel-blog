<?php

namespace TravelBlog\View;

class Layout extends \Yaoi\BaseClass implements \Yaoi\View\Renderer
{
    protected $contentBlock;
    protected $title = 'TravelBlog';
    protected $heading;

    public function setHeading($heading) {
        $this->heading = $heading;
        return $this;
    }

    public function setContentBlock($contentBlock) {
        $this->contentBlock = $contentBlock;
        return $this;
    }

    public function isEmpty()
    {
        return false;
    }

    public function render()
    {
?>
<html>
<head>
    <title><?= $this->title ?></title>
</head>
<body>
<h1><?= $this->heading ?></h1>
<div><?= $this->contentBlock ?></div>
</body>
</html>
<?php
    }

    public function __toString()
    {
        ob_start();
        $this->render();
        return ob_get_clean();
    }

}