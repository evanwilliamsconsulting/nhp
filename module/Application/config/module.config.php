<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
return array(
    'router' => array(
        'routes' => array(
            'login' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/auth/login',
                    'defaults' => array(
                       '__NAMESPACE__' => 'Application\Controller',
                       'controller' => 'Auth',
                       'action' => 'login',
                    ),
                ), 
                'may_terminate' => true,
                'child_routes' => array(
                    'process' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:action]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ), 
            'correspondant' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/correspondant/',
                    'defaults' => array(
                       '__NAMESPACE__' => 'Application\Controller',
                       'controller' => 'correspondant',
                       'action' => 'index',
                    ),
                ), 
                'may_terminate' => true,
                'child_routes' => array(
                    'process' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:action]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ), 
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'application' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/application',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                     ),
                 ),
             ),
             'object' => array(
                 'type' => 'Segment',
                 'options' => array(
                      'route' => '/[:controller]/[:action]',
                      'constraints' => array(
                          'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                          'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                      ),
                      'defaults' => array(
                          '__NAMESPACE__' => 'Application\Controller',
                          'controller'    => 'Index',
                          'action'        => 'index',
                      ),
                  ),
              ),
             'item' => array(
                 'type' => 'Segment',
                 'options' => array(
                      'route' => '/[:controller]/[:action]/[:item]',
                      'constraints' => array(
                          'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                          'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                      ),
                      'defaults' => array(
                          '__NAMESPACE__' => 'Application\Controller',
                          'controller'    => 'Index',
                          'action'        => 'view',
                      ),
                  ),
              ),
         ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'factories' => array(
            'translator' => 'Zend\Mvc\Service\TranslatorServiceFactory',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Auth' => 'Application\Controller\AuthController',
            'Application\Controller\Success' => 'Application\Controller\SuccessController',
            'Application\Controller\Index' => 'Application\Controller\IndexController',
            'Application\Controller\Issue' => 'Application\Controller\IssueController',
            'Application\Controller\Broadsheet' => 'Application\Controller\BroadsheetController',
            'Application\Controller\Block' => 'Application\Controller\BlockController',
            'Application\Controller\Container' => 'Application\Controller\ContainerController',
            'Application\Controller\RichColumn' => 'Application\Controller\RichColumnController',
            'Application\Controller\Textcolumn' => 'Application\Controller\TextcolumnController',
            'Application\Controller\Headline' => 'Application\Controller\HeadlineController',
            'Application\Controller\Pix' => 'Application\Controller\PixController',
            'Application\Controller\PixLink' => 'Application\Controller\PixlinkController',
            'Application\Controller\Wordage' => 'Application\Controller\WordageController',
            'Application\Controller\Correspondant' => 'Application\Controller\CorrespondantController',
            'Application\Controller\Article' => 'Application\Controller\ArticleController',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'layout/correspondant'           => __DIR__ . '/../view/layout/correspondant.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
    'view_helpers' => array(  
        'invokables' => array(  
            'customHelper' => 'Application\View\Helper\CustomHelper',  
                // more helpers here ...  
        )  
    ),  
    // doctrine
    'doctrine' => array(
	'driver' => array(
	    'application_entities' => array(
		'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
		'cache' => 'array',
		'paths' => array(__DIR__ . '/../src/Application/Entity')
	    ),
	    'orm_default' => array(
		'drivers' => array(
		    'Application\Entity' => 'application_entities'
		)
	    )
	)
    )
);
