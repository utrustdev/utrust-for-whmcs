
<?php

// Require libraries needed for gateway module functions.
require_once __DIR__ . '/../../../init.php';
require_once __DIR__ . '/../../../includes/gatewayfunctions.php';
require_once __DIR__ . '/../../../includes/invoicefunctions.php';

// Require libraries needed for utrust
require_once __DIR__ . '/../vendor/autoload.php';
use Utrust\Webhook\Event;

// Detect module name from filename.
$gatewayModuleName = basename(__FILE__, '.php');

// Fetch gateway configuration parameters.
$gatewayParams = getGatewayVariables($gatewayModuleName);

// Die if module is not active.
if (!$gatewayParams['type']) {
    die("Module Not Activated");
}

//call Webhooks
$webhooksSecret = $gatewayParams['webhooks_key'];

// Validate payload
$payload = file_get_contents('php://input');
try {
    $event = new Event($payload);
    $event->validateSignature($webhooksSecret);
    http_response_code(200); // Don't delete this

    echo sprintf('Successully validated payload with order reference %s and type %s', $event->getOrderReference(), $event->getEventType());

} catch (\Exception $exception) {
    http_response_code(400); // Don't delete this

    // Handle webhook error
    echo 'Error: ' . $exception->getMessage();
}

// Change payload data to whmcs variables
$json = json_decode($payload, true);
$status = $json['state'];
$success = false;
if ($status == "completed") {
    $status = "Success";
    $success = true;
}

// Varies per payment gateway
$transactionId = $json['resource']['reference'];
$invoiceId = (int) $transactionId;
$paymentAmount = (float) $json['resource']['amount'];
$paymentFee = 0.00;

// remove when bug was fix --------------------------------------\/

$milliseconds = round(microtime(true) * 1000);
$firstnum = substr($milliseconds, 12, 1);
$secondnum = substr($milliseconds, 11, 1);
$thirdnum = substr($milliseconds, 10, 1);
$total = $firstnum + $secondnum + $thirdnum;
sleep($total);

$firstsleep = rand(0, 5);
$secondsleep = rand(0, 5);
while ($firstsleep == $secondsleep) {
    $firstsleep = rand(0, 2);
}

sleep($firstsleep);
sleep($secondsleep);
// remove when bug was fix --------------------------------------/\

// transaction STATUS
$transactionStatus = $success ? 'Success' : 'Failure';

// InvoiceId Check
$invoiceId = checkCbInvoiceID($invoiceId, $gatewayParams['name']);

// TransactionId Check
checkCbTransID($transactionId);

// Send Log Transaction
logTransaction($gatewayParams['name'], $milliseconds . "-" . $total . $payload, $transactionStatus);

// If status is Success then Add Invoice Payment
if ($status == 'Success') {

    addInvoicePayment(
        $invoiceId,
        $transactionId,
        $paymentAmount,
        $paymentFee,
        $gatewayModuleName
    );

}

?>
