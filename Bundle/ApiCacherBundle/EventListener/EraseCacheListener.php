<?php
/**
 * Created by PhpStorm.
 * User: naggelakis
 * Date: 24/3/15
 * Time: 15:53
 */

namespace HSpace\Bundle\ApiCacherBundle\EventListener;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\DependencyInjection\ContainerInterface;


class EraseCacheListener
{
    protected $container;

    public function __construct(ContainerInterface $container) // this is @service_container
    {
        $this->container = $container;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $kernel    = $event->getKernel();
        $request   = $event->getRequest();
        $container = $this->container;
    }

    public function onKernelResponse(FilterResponseEvent $event)
    {
        print_r('d');exit;
        $request = $event->getRequest();
        $erase = $request->get('EraseCache');
        if(isset($erase) && $erase === 'true'){
            print_r($erase);exit;
        }

    }
}