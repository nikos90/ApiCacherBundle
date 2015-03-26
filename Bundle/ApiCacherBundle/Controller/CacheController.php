<?php
/**
 * Created by PhpStorm.
 * User: naggelakis
 * Date: 26/3/15
 * Time: 10:40
 */

namespace HSpace\Bundle\ApiCacherBundle\Controller;

use Acme\HelloBundle\Helper\CommonHelper;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use HSpace\Bundle\ApiCacherBundle\Library\ApiCacher;

class CacheController extends Controller
{
    protected  $common;
    protected $queue;
    protected $cacher;

    public function __construct(){
        $this->common = new CommonHelper();
        $this->cacher = new ApiCacher();
    }

    public function buildAction(Request $request){

        ob_start();
        echo 'Success'; // send the response
        header('Connection: close');
        header('Content-Length: '.ob_get_length());
        ob_end_flush();
        ob_flush();
        flush();

        $queue = $request->get('queue');
        if(is_array($queue) && count($queue)>0){
            $this->queue = $queue;
            $this->execute();
        }

    }

    protected function execute(){

        if(is_array($this->queue) && count($this->queue)>0){
            foreach($this->queue as $endpoint=>$data){
                if(is_array($data)){ $fields = $data; }else{ $fields = null; }
                $this->cacher->request_multi($endpoint,$fields,false,false,true);
                unset($this->queue[$endpoint]);
            }
            $this->cacher->execute();
        }
    }
}