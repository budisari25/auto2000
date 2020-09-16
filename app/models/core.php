<?php

use League\Plates\Engine;
use League\Plates\Extension\ExtensionInterface;

class Core implements ExtensionInterface
{
    public $call; // must be public
    
    public function __construct()
    {
        $this->call = new Racik\Core();
    }

    public function register(Engine $engine)
    {
        $engine->registerFunction('core', [$this, 'getObject']);
    }    
    
	public function getObject()
    {
        return $this;
    }
}