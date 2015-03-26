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
use Symfony\Component\HttpFoundation\Request;


class EraseCacheListener
{
    protected $request;
    protected $root_cache;


    public function __construct(Request $request) // this is @service_container
    {
        $this->request = $request;
        $this->root_cache = __DIR__.'/../Cache';
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();
        $erase = $request->get('eraseCache');
        if(isset($erase) && $erase === 'true'){
            array_map('unlink', glob($this->root_cache.'/*'));
        }
    }


}