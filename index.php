
<?php
include_once("classes/health_insurance.php");

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
    case 'health':
      $healthInsurance = new HealthInsurance();
      $healthInsurance->for = $healthInsuranceFor;
      $healthInsurance->selfAge = "";
      $healthInsurance->fatherAge = "";
      $healthInsurance->motherAge = "";
      echo health_insurance($healthInsurance);
      break;

    case 'travel':
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
}
else
{
  echo "Method not allowed";
}


function health_insurance($healthInsurance){
   // Create the speech response
  $speech = "";
  switch ($healthInsurance->for) {
    case '':
      $speech = "For whom are you looking health insurance? For yourself, family or parents?";
      break;
    case 'family':
      $speech = "Ok, so you need insurance for your family.\n How many members are there in your family?";
      break;
    case 'parents':
      $speech = "Ok, so you need insurance for your parents. \n Do you need insurance for your Father, Mother or Both?";
      break;
    case 'self':
      $speech = "Ok, so you need insurance for your self. \n May I know your age please?";
      break; 
    default:
      $speech = "Sorry, cant get it. For whom are you looking health insurance? For yourself, family or parents?";
      break;
  }

  $response = new \stdClass();
  $response->speech = $speech;
  $response->displayText = "test";
  $response->source = "apiai-php-insurance-chatbot";

  // Create and Send the json back to APIAI
  $jsonResponse = json_encode($response);
  return $jsonResponse;
}

?>

