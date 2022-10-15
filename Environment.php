<?php

namespace MeerSoftware\Environment;

use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Path;
use Quizmatix\MainServer;

class Environment extends \Twig\Environment
{

	private MainServer $server;

	public function __construct(LoaderInterface $loader, $options = [], MainServer $server)
	{
		$this->server = $server;
		parent::__construct($loader, $options);
	}

	public function render($name, array $context = []): string
	{
		$filesystem = new Filesystem();
		$filesystem->remove($this->server->getCacheDirectory());
		return parent::render($name, $context);
	}

}