(function () {
    'use strict';

    angular
        .module('demoApp', [
            'vendor.http.transfer-client'
        ])
        .controller('DemoController', DemoController)
    ;

    DemoController.$inject = [
        'vendorHttpTransferClientFactory'
    ];
    function DemoController(
        vendorHttpTransferClientFactory
    ) {
        var vm = this;

        /** {TransferClient} client */
        vm.client = vendorHttpTransferClientFactory.getClient({
            baseURL: 'http://localhost:9000',
            middleware: [ // optional, list of middleware
                new PayseraHttpClientCommon.JWTAuthenticationMiddleware(
                    new PayseraHttpClientCommon.Scope('some:scope'),
                    new PayseraHttpClientCommon.SessionStorageTokenProvider(
                        (scope) => ({ scope, accessToken: 'created-token' }),
                        (scope) => ({ scope, accessToken: 'refreshed-token' }),
                        'transfer_client', // unique identifier of token
                        'TransferClient' // storage namespace
                    )
                ),
            ]
        });
    }
})();
