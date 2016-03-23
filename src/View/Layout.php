<?php

namespace TravelBlog\View;

use Yaoi\View\Raw;
use Yaoi\View\Renderer;
use Yaoi\View\Stack;

class Layout extends \Yaoi\BaseClass implements \Yaoi\View\Renderer
{
    protected $contentBlock;
    protected $title = 'TravelBlog';
    protected $heading;

    public function __construct()
    {
        $this->contentBlock = new Stack();
    }

    public function setHeading($heading) {
        $this->heading = $heading;
        return $this;
    }

    public function pushContent($contentBlock) {
        if (!$contentBlock instanceof Renderer) {
            $contentBlock = new Raw($contentBlock);
        }
        $this->contentBlock->push($contentBlock);
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