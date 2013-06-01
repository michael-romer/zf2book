<?php
namespace HelloworldMod;

class Module
{
	public function getConfig()
	{
		return array (
			'router' => array(
				'routes' => array(
					'sayhello' => array(
						'type' => 'Zend\Mvc\Router\Http\Literal',
						'options' => array(
						'route'    => '/welcome'
						)
					)
				)
			),
            'view_manager' => array(
                'template_map' => array(
                    'helloworld/index/index'
                        => __DIR__ . '/view/helloworld-mod/index/index.phtml'
                )
            )
		);
	}
}