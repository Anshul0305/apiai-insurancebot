
<?php

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
  $requestBody = file_get_contents('php://input');
  $json = json_decode($requestBody);
  $busRoute = $json->result->parameters->BusRoute;
  $destination = $json->result->parameters->BusDestination;
  $speech = "Next ".$busRoute." Towards ".$destination." is coming soon....";
  
  $response = new \stdClass();
  $response->speech = $speech;
  $response->displayText = $speech;
  $response->source = "apiai-php-bustimer";
  $jsonResponse = json_encode($response);
 
  echo $jsonResponse;
}
else
{
  echo "Method not allowed";
}

?>

