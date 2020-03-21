(function () {
    'use strict';

    angular
        .module('demoApp', [
            'vendor.http.custom-client'
        ])
        .controller('DemoController', DemoController)
    ;

    DemoController.$inject = [
        'vendorHttpCustomClientFactory'
    ];
    function DemoController(
        vendorHttpCustomClientFactory
    ) {
        var vm = this;

        /** {CustomClient} client */
        vm.client = vendorHttpCustomClientFactory.getClient({
            baseURL: 'http://localhost:9000',
            middleware: [ // optional, list of middleware
                new PayseraHttpClientCommon.JWTAuthenticationMiddleware(
                    new PayseraHttpClientCommon.Scope('some:scope'),
                    new PayseraHttpClientCommon.SessionStorageTokenProvider(
                        (scope) => ({ scope, accessToken: 'created-token' }),
                        (scope) => ({ scope, accessToken: 'refreshed-token' }),
                        'custom_client', // unique identifier of token
                        'CustomClient' // storage namespace
                    )
                ),
            ]
        });
    }
})();
