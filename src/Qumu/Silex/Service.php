<?php
namespace Qumu\Silex;

abstract class Service
{
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }
}
