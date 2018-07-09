(function () {
    'use strict';

    angular
        .module('demoApp', [
            'vendor.http.account-client'
        ])
        .controller('DemoController', DemoController)
    ;

    DemoController.$inject = [
        'vendorHttpAccountClientFactory'
    ];
    function DemoController(
        vendorHttpAccountClientFactory
    ) {
        var vm = this;

        /** {AccountClient} client */
        vm.client = vendorHttpAccountClientFactory.getClient({
            baseURL: 'http://localhost:9000',
            middleware: [ // optional, list of middleware
                new PayseraHttpClientCommon.JWTAuthenticationMiddleware(
                    new PayseraHttpClientCommon.Scope('some:scope'),
                    new PayseraHttpClientCommon.SessionStorageTokenProvider(
                        (scope) => ({ scope, accessToken: 'created-token' }),
                        (scope) => ({ scope, accessToken: 'refreshed-token' }),
                        'account_client', // unique identifier of token
                        'AccountClient' // storage namespace
                    )
                ),
            ]
        });
    }
})();
