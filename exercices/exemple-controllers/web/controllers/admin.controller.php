<?php

class AdminController
{
    protected $fooBar;

    public function __construct($fooBar)
    {
        $this->fooBar = $fooBar;
    }

    public function indexAction()
    {
        return 'Admin/Index';
    }

    public function optionsAction()
    {
        return 'Admin/About';
    }
}
