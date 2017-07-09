
<?php

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
  // Get the json for APIAI
  $requestBody = file_get_contents('php://input');
  $json = json_decode($requestBody);

  // Fetch the params from the json
  $insuranceType = $json->result->parameters->insuranceType;
  $healthInsuranceFor = $json->result->parameters->healthInsuranceFor;
  $travelInsuranceDestination = $json->result->parameters->travelInsuranceDestination;

  // Process the response and add business logic
  switch ($insuranceType) {
    case 'travel':
      $speech = "So you need travel insurance";
      break;

    case 'health':
      $speech = "So you need health insurance";
      break;
    
    case 'pet':
      $speech = "So you need pet insurance";
      break;
    
    case 'property':
      $speech = "So you need property insurance";
      break;

    case 'motor':
      $speech = "So you need motor insurance";
      break;
    
    default:
      $speech = "Sorry, couldnt get you. Please let me know what insurance do you need?";
      break;
  }

  // Create the speech response
  $response = new \stdClass();
  $response->speech = $speech;
  $response->displayText = $speech;
  $response->source = "apiai-php-insurance-chatbot";

  // Create and Send the json back to APIAI
  $jsonResponse = json_encode($response);
  echo $jsonResponse;
}
else
{
  echo "Method not allowed";
}

?>

