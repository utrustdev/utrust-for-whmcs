![Utrust integrations](https://user-images.githubusercontent.com/1558992/67495646-1e356b00-f673-11e9-8854-1beac877c586.png)

# Utrust for WHMCS

Accept Bitcoin, Ethereum, Utrust Token and other cryptocurrencies directly on your system with the Utrust payment gateway for WHMCS.
Utrust is cryptocurrency agnostic and provides fiat settlements.
The Utrust plugin extends WHMCS allowing you to take cryptocurrency payments directly on your store via the Utrust API.
Find out more about Utrust at [utrust.com](https://utrust.com).

## Requirements

- Utrust Merchant account
- WHMCS version 7 or above

## Install

### How to install

1. Download our latest release zip file on the [releases page](https://github.com/utrustdev/utrust-for-WHMCS/releases).
2. Extract the zip file.
3. Copy the content to your server root folder of WHMCS.
4. Once copied, follow the Setup instructions bellow.

## Setup

### On the Utrust side

1. Go to [Utrust merchant dashboard](https://merchants.utrust.com).
2. Log in or sign up if you didn't yet.
3. On the left sidebar choose _Integrations_.
4. Select _Custom API_ and click the button _Generate Credentials_.
5. You will see now your `Api Key` and `Webhook Secret`, save them somewhere safe temporarily.

   :warning: You will only be able to see the `Webhook Secret` once, after refreshing or changing page it will be no longer available to copy; if needed, you can always generate new credentials.

   :no_entry_sign: Don't share your credentials with anyone. They can use it to place orders **on your behalf**.

### On the WHMCS side

1. Go to your WHMCS admin dashboard.
2. Navigate to the _Modules and Services_ -> _Modules and Services_.
3. Search for _Utrust_ in the list and click _Configure_
4. Add your `Api Key` and `Webhook Secret` and click Save.

5. Go to your WHMCS admin dashboard.
6. Navigate to _System Settings_ -> _Payment Gateways_ -> _All Payment Gateways_ and activate Utrust.
7. Navigate to _System Settings_ -> _Payment Gateways_ -> _Manager Existing Gateways_.
8. Add your `Api Key` and `Webhook Secret` and Save.

## Support

Feel free to reach [by opening an issue on GitHub](https://github.com/utrustdev/utrust-for-WHMCS/issues/new) if you need any help with the Utrust for WHMCS plugin.

If you're having specific problems with your account, then please contact support@utrust.com.

In both cases, our team will be happy to help :purple_heart:.

## Contribute

You can contribute by simply letting us know your suggestions or any problems that you find [by opening an issue on GitHub](https://github.com/utrustdev/utrust-for-WHMCS/issues/new).

You can also fork the repository on GitHub and open a pull request for the `master` branch with your missing features and/or bug fixes.
Please make sure the new code follows the same style and conventions as already written code.
Our team is eager to welcome new contributors into the mix :blush:.

## License

The Utrust for WHMCS plugin is maintained with :purple_heart: by the Utrust development team, and is available to the public under the GNU GPLv3 license. Please see [LICENSE](https://github.com/utrustdev/utrust-for-WHMCS/blob/master/LICENSE) for further details.

&copy; Utrust 2020
