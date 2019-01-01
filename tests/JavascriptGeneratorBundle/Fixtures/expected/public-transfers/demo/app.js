(function () {
    'use strict';

    angular
        .module('demoApp', [
            'vendor.http.public-transfers-client'
        ])
        .controller('DemoController', DemoController)
    ;

    DemoController.$inject = [
        'vendorHttpPublicTransfersClientFactory'
    ];
    function DemoController(
        vendorHttpPublicTransfersClientFactory
    ) {
        var vm = this;

        /** {PublicTransfersClient} client */
        vm.client = vendorHttpPublicTransfersClientFactory.getClient({
            baseURL: 'http://localhost:9000',
            middleware: [ // optional, list of middleware
                new PayseraHttpClientCommon.JWTAuthenticationMiddleware(
                    new PayseraHttpClientCommon.Scope('some:scope'),
                    new PayseraHttpClientCommon.SessionStorageTokenProvider(
                        (scope) => ({ scope, accessToken: 'created-token' }),
                        (scope) => ({ scope, accessToken: 'refreshed-token' }),
                        'public_transfers_client', // unique identifier of token
                        'PublicTransfersClient' // storage namespace
                    )
                ),
            ]
        });
    }
})();
