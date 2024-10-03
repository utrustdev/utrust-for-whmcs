![xMoney Crypto integrations](https://github.com/user-attachments/assets/66de9ccd-adab-456c-a673-09c20d182c4c)

# xMoney Crypto for WHMCS

Accept Bitcoin, Ethereum, eGLD, UTK Token, and other juicy cryptocurrencies directly on your online store and get settled in the currency of your choice.

With xMoney Crypto Pay, grow your business by allowing your customers to enjoy a vast portfolio of fiat & crypto currencies when purchasing goods and services, with a zero-fee exchange rate.

Find out more at [xMoney.com/crypto-pay](https://xmoney.com/crypto-pay)

xMoney is the world's digital payments network for all things money. Crypto-enabled & Fiat-ready, with a suite of solutions for anyone, anywhere. Powered by [MultiversX](https://multiversx.com/).

## Requirements

- xMoney Crypto Merchant account
- WHMCS version 7 or above

## Install

### How to install

1. Download our latest release zip file on the [releases page](https://github.com/utrustdev/utrust-for-WHMCS/releases).
2. Extract the zip file.
3. Copy the content to your server root folder of WHMCS.
4. Once copied, follow the Setup instructions bellow.

## Setup

### On the Utrust side

1. Go to [xMoney Crypto merchant dashboard](https://merchants.crypto.xmoney.com/).
2. Log in or sign up if you didn't yet.
3. On the left sidebar choose _Integrations_.
4. Select _WHMCS_ and click the button _Generate Credentials_.
5. You will see now your `Api Key` and `Webhook Secret`, save them somewhere safe temporarily.

   :warning: You will only be able to see the `Webhook Secret` once, after refreshing or changing page it will be no longer available to copy; if needed, you can always generate new credentials.

   :no_entry_sign: Don't share your credentials with anyone. They can use it to place orders **on your behalf**.

### On the WHMCS side

1. Go to your WHMCS admin dashboard.
2. Navigate to _System Settings_ -> _Payment Gateways_ -> _All Payment Gateways_ and activate Utrust.
3. Navigate to _System Settings_ -> _Payment Gateways_ -> _Manager Existing Gateways_.
4. Add your `Api Key` and `Webhook Secret`
5. Click Save.

## Support

Feel free to reach [by opening an issue on GitHub](https://github.com/utrustdev/utrust-for-WHMCS/issues/new) if you need any help with the Utrust for WHMCS plugin.

If you're having specific problems with your account, then please contact [support@xmoney.com](https://mailto:support@xmoney.com/).

In both cases, our team will be happy to help :purple_heart:.

## Contribute

You can contribute by simply letting us know your suggestions or any problems that you find [by opening an issue on GitHub](https://github.com/utrustdev/utrust-for-WHMCS/issues/new).

You can also fork the repository on GitHub and open a pull request for the `master` branch with your missing features and/or bug fixes.
Please make sure the new code follows the same style and conventions as already written code.
Our team is eager to welcome new contributors into the mix :blush:.

## License

The xMoney Crypto for WHMCS plugin is maintained with :purple_heart: by the xMoney Crypto development team, and is available to the public under the GNU GPLv3 license. Please see [LICENSE](https://github.com/utrustdev/utrust-for-WHMCS/blob/master/LICENSE) for further details.

&copy; Utrust 2024
