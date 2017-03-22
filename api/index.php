<?php
// echo "OK";

require 'vendor/autoload.php';
include "../../lib/sel_config.php";
conndb();


//$app = new \Slim\App(["settings" => $config]);
$app = new \Slim\App(["settings"]);

// CorsSlim for Cross domain request
$corsOptions = array(
    "origin" => "*",
    "exposeHeaders" => array("Content-Type", "X-Requested-With", "X-authentication", "X-client"),
    "allowMethods" => array('GET', 'POST', 'PUT', 'DELETE', 'OPTIONS')
);
$cors = new \CorsSlim\CorsSlim($corsOptions);
$app->add($cors);


$app->get('/place/{place}', function($request, $response){
    $place = $request->getAttribute('place'); 
    if($place=='tam'){
        $sql = "select gid, tam_code, tam_nam_t, amp_code, prov_code from ln9p_tam";
    }elseif($place=='amp'){
        $sql = "select gid, amp_code, amp_nam_t, prov_code from ln9p_amp";
    }elseif ($place=='prov') {
        $sql = "select gid, prov_code, prov_nam_t from ln9p_prov";
    }
    
    $rs = pg_query($sql);
    $result = array();
    while($row = pg_fetch_array($rs)){
      array_push($result, $row);
    }
    $newResponse = $response->withJson($result);
    return $newResponse;
});


$app->get('/', function($request, $response){

    $sql = "select * from ln9p_vill";
    $rs = pg_query($sql);

    $result = array();

    /*foreach ($this->db->query($sql) as $row) {
      array_push($result, $row);
    }*/

    while($row = pg_fetch_array($rs)){
      array_push($result, $row);
    }


    $newResponse = $response->withJson($result);
    return $newResponse;

});

$app->get('/parcel/{alrCode}', function($request, $response){  
    $alrCode = $request->getAttribute('alrCode');  
    $sql = "select * from alr_parcel where alrcode = '$alrCode'";
    $rs = pg_query($sql);
    
    $result = array();

    while($row = pg_fetch_array($rs)){
      array_push($result, $row);
    }

    $newResponse = $response->withJson($result);
    return $newResponse;
});

$app->get('/k', function($request, $response){  
    //$alrCode = $request->getAttribute('alrCode');  
    $sql = "select * from cwr";
    $rs = pg_query($sql);
    
    $result = array();

    while($row = pg_fetch_array($rs)){
      array_push($result, $row);
    }

    $newResponse = $response->withJson($result);
    return $newResponse;
});

$app->get('/cwr/{alrCode}', function($request, $response){  
    $alrCode = $request->getAttribute('alrCode');  
    $sql = "select * from active_land_cwr where alrcode = '$alrCode'";
    $rs = pg_query($sql);
    
    $result = array();

    while($row = pg_fetch_array($rs)){
      array_push($result, $row);
    }

    $newResponse = $response->withJson($result);
    return $newResponse;
});

$app->get('/cwr2/{alrCode}', function($request, $response){  
    $alrCode = $request->getAttribute('alrCode');  
    $sql = "select * from active_land_cwr2 where alrcode = '$alrCode'";
    $rs = pg_query($sql);
    
    $result = array();

    while($row = pg_fetch_array($rs)){
      array_push($result, $row);
    }

    $newResponse = $response->withJson($result);
    return $newResponse;
});

$app->get('/cwr3/{alrCode}', function($request, $response){  
    $alrCode = $request->getAttribute('alrCode');  
    $sql = "select * from active_land_cwr3 where alrcode = '$alrCode'";
    $rs = pg_query($sql);
    
    $result = array();

    while($row = pg_fetch_array($rs)){
      array_push($result, $row);
    }

    $newResponse = $response->withJson($result);
    return $newResponse;
});
$app->get('/rain_now/{tamcode}', function($request, $response){  
    $tamCode = $request->getAttribute('tamcode');  
    $sql = "select * from rain_now where tam_code = '$tamCode'";
    $rs = pg_query($sql);
    
    $result = array();

    while($row = pg_fetch_array($rs)){
      array_push($result, $row);
    }

    $newResponse = $response->withJson($result);
    return $newResponse;
});

$app->get('/rain30y/{tamcode}', function($request, $response){  
    $tamCode = $request->getAttribute('tamcode');  
    $sql = "select * from rain30y where tam_code = '$tamCode'";
    $rs = pg_query($sql);
    
    $result = array();

    while($row = pg_fetch_array($rs)){
      array_push($result, $row);
    }

    $newResponse = $response->withJson($result);
    return $newResponse;
});

$app->get('/evap30y/{tamcode}', function($request, $response){  
    $tamCode = $request->getAttribute('tamcode');  
    $sql = "select * from evap30y where tam_code = '$tamCode'";
    $rs = pg_query($sql);
    
    $result = array();

    while($row = pg_fetch_array($rs)){
      array_push($result, $row);
    }

    $newResponse = $response->withJson($result);
    return $newResponse;
});



$app->get('/quest_q', function($request, $response){  
    //$id = $request->getAttribute('id');  
    $sql = "select * from quest_mobile";
    $rs = pg_query($sql);
    
    $result = array();

    while($row = pg_fetch_array($rs)){
      array_push($result, $row);
    }

    $newResponse = $response->withJson($result);
    return $newResponse;
});


$app->post('/signin', function($request, $response){

	$username = $request->getParam('username');
  $password = $request->getParam('password');

  $result = array();

  $newResponse = $response->withJson($result);
  return $newResponse;

});






$app->run();
closedb();
 ?>
