(function () {
    'use strict';

    angular
        .module('demoApp', [
            'vendor.http.issued-payment-card-client'
        ])
        .controller('DemoController', DemoController)
    ;

    DemoController.$inject = [
        'vendorHttpIssuedPaymentCardClientFactory'
    ];
    function DemoController(
        vendorHttpIssuedPaymentCardClientFactory
    ) {
        var vm = this;

        /** {IssuedPaymentCardClient} client */
        vm.client = vendorHttpIssuedPaymentCardClientFactory.getClient({
            baseURL: 'http://localhost:9000',
            middleware: [ // optional, list of middleware
                new PayseraHttpClientCommon.JWTAuthenticationMiddleware(
                    new PayseraHttpClientCommon.Scope('some:scope'),
                    new PayseraHttpClientCommon.SessionStorageTokenProvider(
                        (scope) => ({ scope, accessToken: 'created-token' }),
                        (scope) => ({ scope, accessToken: 'refreshed-token' }),
                        'issued_payment_card_client', // unique identifier of token
                        'IssuedPaymentCardClient' // storage namespace
                    )
                ),
            ]
        });
    }
})();
