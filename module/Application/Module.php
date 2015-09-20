<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
/* from
*
* https://samsonasik.wordpress.com/2012/10/23/zend-framework-2-create-login-authentication-using-authenticationservice-with-rememberme/
*
*/
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Authentication\Storage;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Adapter\DbTable as DbTableAuthAdapter;
use Application\View\Helper\Welcome as Welcome;
use Zend\Session\SessionManager;
use Zend\Session\Container;
use Zend\Log\Logger;
use Zend\Log\Writer\FirePhp as FirePhpWriter;
use Zend\Log\Writer\FirePhp\FirePhpBridge;
use Application\View\Helper\TopicToolbar as TopicToolbar;

require_once 'vendor/firephp/firephp-core/lib/FirePHPCore/FirePHP.class.php';

class Module implements AutoloaderProviderInterface
{
    public function getServiceConfig()
    {
        return array(
            'factories'=>array(
                'log' => function($sm) {
                    $log = new Logger();
                    $writer = new FirePhpWriter(new FirePhpBridge(new \FirePHP()));
                    $log->addWriter($writer);
                    return $log;
                },
                'Application\Storage\Login' => function($sm) {
                    return new \Application\Storage\Login('nhpress');
                },
                'Zend\Session\SessionManager' => function ($sm) {
                    $config = $sm->get('config');
                    if (isset($config['session'])) {
                        $session = $config['session'];
  
                        $sessionConfig = null;
                        if (isset($session['config'])) {
                            $class = isset($session['config']['class']) ? $session['config']['class'] : 'Zend\Session\Config\SessionConfig';
                            $options = isset($session['config']['options']) ? $session['config']['options'] : array();
                            $sessionConfig = new $class();
                            $sessionConfig->setOptions($options);
                        }
                        $sessionStorage = null;
                        if (isset($session['storage'])) {
                            $class = $session['storage'];
                            $sessionStorage = new $class();
                        }
                        $sessionSaveHandler = null;
                        if (isset($session['save_handler'])) {
                            $sessionSaveHandler = $sm->get($session['save_handler']);
                        }
                        $sessionManager = new SessionManager($sessionConfig, $sessionStorage,$sessionSaveHandler);
                   } else {
                        $sessionManager = new SessionManager();
                   }
                   Container::setDefaultManager($sessionManager);
                   return $sessionManager;
            },
            'AuthService' => function($sm) {
                $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
		$dbTableAuthAdapter = new DbTableAuthAdapter($dbAdapter);
		$dbTableAuthAdapter->setTableName('Correspondant');
		$dbTableAuthAdapter->setIdentityColumn('username');
		$dbTableAuthAdapter->setCredentialColumn('password');
                $authService = new AuthenticationService();
                $authService->setAdapter($dbTableAuthAdapter);
                $authService->setStorage($sm->get('Application\Storage\Login'));
    
                return $authService;
                },
            ),
        );
    }
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        $serviceManager = $e->getApplication()->getServiceManager();
	$viewModel = $e->getApplication()->getMvcEvent()->getViewModel();

	$welcome = new Welcome();
	$welcome->clearState();

	$viewModel->welcome = $welcome;

     //   $this->bootstrapSession($e);
    }
/*    public function bootstrapSession($e)
    {
        $session = $e->getApplication()
                     ->getServiceManager()
                     ->get('Zend\Session\SessionManager');
        $session->start();
	
	$container = new Container('initialized');
        if (!isset($container->init)) {
            $serviceManager = $e->getApplication()->getServiceManager();
            $request = $serviceManager->get('Request');
   
            $session->regenerateId(true);
            $container->init = 1;
            $container->remoteAddr = $request->getServer()->get("REMOTE_ADDR");
            $container->httpUserAgent = $request->getServer()->get("HTTP_USER_AGENT");
 
            $config = $serviceManager->get('Config');
            if (!isset($config['session'])) {
                return;
            } 
  
            $sessionConfig = $config['session'];
            if (isset($sessionConfig['validators'])) {
                $chain = $session->getValidatorChain();
   
                foreach ($sessionConfig['validators'] as $validator) {
                    switch($validator) {
                        case 'Zend\Session\Validator\HttpUserAgent':
                            $validator = new $validator($container->httpUserAgent);
                            break;
                        case 'Zend\Session\Validator\RemoteAddr':
                            $validator = new $validator($container->remoteAddr);
                            break;
                        default:
                            $validator = new $validator();
                   }
                   $chain->attach('session.validate',array($validator,'isValid'));
               }
           }
        }
    }
 * 
 */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    public function getViewHelperConfig()
    {
        return array(
            'factories' => array(
                'test_helper' => function($sm) {
                    $helper = new View\Helper\CustomHelper;
                    return $helper;
                },
		'toolbar' => function($sm) {
		    $helper = new View\Helper\Toolbar;
		    return $helper;
		},
				'topictoolbar' => function($sm) {
		    $helper = new TopicToolbar($sm);
		    return $helper;
		}
		
            )
        );   
    }
}
