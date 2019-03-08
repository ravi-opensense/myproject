<?php

namespace Drupal\firstmodule\Controller;
use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;
use Symfony\Component\HttpFoundation\JsonResponse;

 class FirstmoduleController extends ControllerBase {
  public function get_article($api_key, $id) {
   //echo $api_key, $id;

    $config= \Drupal::service('config.factory')->getEditable('firstmodule.settings');
    $key= $config->get('site_api_key');
    //return print $api_key;
    if($key == $api_key){
        $serializer = \Drupal::service('serializer');
        $node = Node::load($id);
        if(!empty($node)){
        $data = $serializer->serialize($node, 'json', ['plugin_id' => 'entity']);
    	$data= json_decode($data);
    	//print_r($data);die;
        return new JsonResponse($data);
       } else{
       	return drupal_set_message('Article is is not exists');
     
       }
    }
    else{
    	return drupal_set_message('Api key is not exists in config');
    }
   //die;	
  }
}