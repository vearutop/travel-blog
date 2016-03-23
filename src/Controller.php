<?php
namespace TravelBlog;


use Yaoi\BaseClass;
use Yaoi\Io\Request;

/**
 * Class Controller
 * @package TravelBlog
 * @method static $this create(Request $request)
 */
class Controller extends BaseClass
{
    /** @var Request  */
    protected $request;

    public function __construct(Request $request) {
        $this->request = $request;
    }
}