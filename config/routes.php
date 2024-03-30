<?php 

use WFM\Router;

Router::add('^admin\/(?P<controller>[a-z-]+)\/?(?P<action>[a-z-]+)?$', ['controller' => 'Main', 'action' => 'index', 'admin_prefix' => 'admin']);

Router::add('^admin\/?$', ['controller' => 'Main', 'action' => 'index', 'admin_prefix' => 'admin']);

Router::add('^$', ['controller' => 'Main', 'action' => 'index']);

Router::add('^(?P<controller>[a-z-]+)\/(?P<action>[a-z-]+)?$', ['controller' => 'Main', 'action' => 'index']);
