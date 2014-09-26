<?php

class IndexController
{
    protected $fooBar;

    public function __construct($fooBar)
    {
        $this->fooBar = $fooBar;
    }

    public function indexAction()
    {
        return 'Index/Index';
    }

    public function aboutAction()
    {
        return 'Index/About';
    }

    public function contactAction()
    {
        return 'Index/Contact';
    }
}
