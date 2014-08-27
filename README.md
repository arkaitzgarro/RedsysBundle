Redsys - Payment Suite
=====

Configuration
-----

Configure the RedsysBundle configuration in your `config.yml`

``` yml
redsys:

    # Merchant code provided by Redsys
    merchant_code: XXXXXXXXXXXX

    # Secret Key provided by Redsys
    secret_key: XXXXXXXXXXXX

    # Url to which the payment form is sent
    url: 'https://sis-t.redsys.es:25443/sis/realizarPago'

    # Configuration for payment success redirection
    #
    # Route defines which route will redirect if payment successes
    # If order_append is true, Bundle will append order identifier into route
    #    taking order_append_field value as parameter name and
    #    PaymentOrderWrapper->getOrderId() value
    payment_success:
        route: order_thanks
        order_append: true
        order_append_field: order_id

    # Configuration for payment fail redirection
    #
    # Route defines which route will redirect if payment fails
    # If order_append is true, Bundle will append order identifier into route
    #    taking order_append_field value as parameter name and
    #    PaymentCardWrapper->getOrderId() value
    payment_fail:
        route: order_view
        order_append: true
        order_append_field: order_id

    # Configuration for Redsys form display route
    #
    # By default, controller execute route is /checkout/payment/redsys
    controller_execute_route:
        es: /procesar/pago/redsys
        en: /checkout/payment/redsys
        fr: /acheter/paiment/redsys

    # Configuration for the route that Redsys will send the transaction result request to
    #
    # By default, controller route is /checkout/payment/result
    controller_result_route:
        es: /procesar/pago/resultado
        en: /checkout/payment/result
        fr: /acheter/paiment/resultat

```

Extra Data
-----

PaymentBridge Service must return, at least, these fields.

* terminal

The following fields are optional

* transaction_type
* product_description
* merchant_titular
* merchant_name

Router
-----

RedsysBundle allows developer to specify the route of controller where redsys
payment is processed as well as the route that will receive the transaction response.
By default, this values are  `/checkout/payment/redsys` and `/checkout/payment/result` but this values can be
changed in configuration file.
Anyway, the bundle routes must be parsed by the framework, so these lines must
be included into routing.yml file

``` yml
redsys_payment_routes:
    resource: .
    type: redsys
```
