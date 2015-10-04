<?php
/**
 * Created by PhpStorm.
 * User: vearutop
 * Date: 04.10.2015
 * Time: 12:04
 */

namespace TravelBlog;


use Yaoi\BaseClass;

/**
 * Class Controller
 * @package TravelBlog
 * @method static $this create(Request $request)
 */
class Controller extends BaseClass
{
    protected $request;

    public function __construct(Request $request) {
        $this->request = $request;
    }
}