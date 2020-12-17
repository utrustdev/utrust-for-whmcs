<?php
require_once __DIR__ . '/vendor/autoload.php';
use Utrust\ApiClient;
use Utrust\Validator;

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

// Configure Gateway Data
function utrust_MetaData()
{
    return array(
        'DisplayName' => 'Utrust',
        'APIVersion' => '1.1', // Use API Version 1.1
        'DisableLocalCredtCardInput' => true,
        'TokenisedStorage' => false,
    );
}

// Configure Gateway configurations
function utrust_config()
{
    return array(
        // the friendly display name for a payment gateway should be
        // defined here for backwards compatibility
        'FriendlyName' => array(
            'Type' => 'System',
            'Value' => 'Utrust',
        ),
        'api_key' => array(
            'Type' => 'text',
            'Default' => '',
            'Description' => 'Insert API Key',
        ),
        'webhooks_key' => array(
            'Type' => 'text',
            'Default' => '',
            'Description' => 'Insert Webhooks key',
        ),
        'testMode' => array(
            'FriendlyName' => 'Test Mode',
            'Type' => 'yesno',
            'Description' => 'Tick to enable test mode',
        ),
    );
}

function utrust_link($params)
{

    // Gateway Configuration Parameters
    $accountId = $params['accountID'];
    $secretKey = $params['secretKey'];
    $dropdownField = $params['dropdownField'];
    $radioField = $params['radioField'];
    $textareaField = $params['textareaField'];
    $successurl = $params['returnurl'] . "&paymentsuccess=true";
    $failurl = $params['returnurl'] . "&paymentfailed=true";
    $api_key = $params['api_key'];
    $webhooks_key = $params['webhooks_key'];

    // TestMode verify
    if ($params['testMode'] == 'on') {
        $testMode = 'sandbox';
    } else {
        $testMode = 'production';
    }

    // Invoice Parameters
    $invoiceId = $params['invoiceid'];
    $description = $params["description"];
    $amount = $params['amount'];
    $currencyCode = $params['currency'];
    $transid = $params['transid'];

    // Client Parameters
    $firstname = $params['clientdetails']['firstname'];
    $lastname = $params['clientdetails']['lastname'];
    $email = $params['clientdetails']['email'];
    $address1 = $params['clientdetails']['address1'];
    $address2 = $params['clientdetails']['address2'];
    $city = $params['clientdetails']['city'];
    $state = $params['clientdetails']['state'];
    $postcode = $params['clientdetails']['postcode'];
    $country = $params['clientdetails']['country'];
    $phone = $params['clientdetails']['phonenumber'];

    // System Parameters
    $companyName = $params['companyname'];
    $systemUrl = $params['systemurl'];
    $returnUrl = $params['returnurl'];
    $langPayNow = $params['langpaynow'];
    $moduleDisplayName = $params['name'];
    $moduleName = $params['paymentmethod'];
    $whmcsVersion = $params['whmcsVersion'];

    $postfields = array();
    $postfields['username'] = $username;
    $postfields['invoice_id'] = $invoiceId;
    $postfields['description'] = $description;
    $postfields['amount'] = $amount;
    $postfields['currency'] = $currencyCode;
    $postfields['first_name'] = $firstname;
    $postfields['last_name'] = $lastname;
    $postfields['email'] = $email;
    $postfields['address1'] = $address1;
    $postfields['address2'] = $address2;
    $postfields['city'] = $city;
    $postfields['state'] = $state;
    $postfields['postcode'] = $postcode;
    $postfields['country'] = $country;
    $postfields['phone'] = $phone;
    $callback = $systemUrl . '/modules/gateways/callback/utrust.php';

    // Utrust
    $utrustApi = new ApiClient($api_key, $testMode);

    // Build Order data array
    $orderData = [
        'reference' => "$invoiceId",
        'amount' => [
            'total' => $amount,
            'currency' => $currencyCode,
        ],
        'return_urls' => [
            'return_url' => $successurl,
            'cancel_url' => $failurl,
            'callback_url' => $callback,
        ],
        'line_items' => [
            [
                'sku' => "$invoiceId",
                'name' => $description,
                'price' => $amount,
                'currency' => $currencyCode,
                'quantity' => 1,
            ],
        ],
    ];

    // Build Customer data array
    $customerData = [
        'first_name' => $firstname,
        'last_name' => $lastname,
        'email' => $email,
        'country' => $country,
    ];
    try {
        // Validate data
        $orderIsValid = Validator::order($orderData);
        $customerIsValid = Validator::customer($customerData);

        // Make the API request
        if ($orderIsValid == true && $customerIsValid == true) {
            $response = $utrustApi->createOrder($orderData, $customerData);
        }

        // Use the $redirect_url to redirect the customer to our Payment Widget
        //echo $response->attributes->redirect_url;
    } catch (Exception $e) {
        // Handle error (e.g.: show message to the customer)
        echo 'Something went wrong: ' . $e->getMessage();
    }

    // Return url link to pay
    $htmlOutput = '<form method="post" action="' . $response->attributes->redirect_url . '">';
    foreach ($postfields as $k => $v) {
        $htmlOutput .= '<input type="hidden" name="' . $k . '" value="' . urlencode($v) . '" />';
    }
    $htmlOutput .= '<input type="submit" value="' . $langPayNow . '" />';
    $htmlOutput .= '</form>';
    return $htmlOutput;
}
