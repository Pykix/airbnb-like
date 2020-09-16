<?php
namespace Core;

class Route
{
	public string $uri;
	public string $controller;
	public string $action;

	public function __construct( string $uri, string $controller, string $action )
	{
		$this->action = $action;
		$this->controller = $controller;
		$this->uri = $uri;
	}
}