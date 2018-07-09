(function () {
    'use strict';

    angular
        .module('demoApp', [
            'vendor.http.inheritance-client'
        ])
        .controller('DemoController', DemoController)
    ;

    DemoController.$inject = [
        'vendorHttpInheritanceClientFactory'
    ];
    function DemoController(
        vendorHttpInheritanceClientFactory
    ) {
        var vm = this;

        /** {InheritanceClient} client */
        vm.client = vendorHttpInheritanceClientFactory.getClient({
            baseURL: 'http://localhost:9000',
            middleware: [ // optional, list of middleware
                new PayseraHttpClientCommon.JWTAuthenticationMiddleware(
                    new PayseraHttpClientCommon.Scope('some:scope'),
                    new PayseraHttpClientCommon.SessionStorageTokenProvider(
                        (scope) => ({ scope, accessToken: 'created-token' }),
                        (scope) => ({ scope, accessToken: 'refreshed-token' }),
                        'inheritance_client', // unique identifier of token
                        'InheritanceClient' // storage namespace
                    )
                ),
            ]
        });
    }
})();
