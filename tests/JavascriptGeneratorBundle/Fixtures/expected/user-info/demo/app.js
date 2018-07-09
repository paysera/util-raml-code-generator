(function () {
    'use strict';

    angular
        .module('demoApp', [
            'vendor.http.user-info-client'
        ])
        .controller('DemoController', DemoController)
    ;

    DemoController.$inject = [
        'vendorHttpUserInfoClientFactory'
    ];
    function DemoController(
        vendorHttpUserInfoClientFactory
    ) {
        var vm = this;

        /** {UserInfoClient} client */
        vm.client = vendorHttpUserInfoClientFactory.getClient({
            baseURL: 'http://localhost:9000',
            middleware: [ // optional, list of middleware
                new PayseraHttpClientCommon.JWTAuthenticationMiddleware(
                    new PayseraHttpClientCommon.Scope('some:scope'),
                    new PayseraHttpClientCommon.SessionStorageTokenProvider(
                        (scope) => ({ scope, accessToken: 'created-token' }),
                        (scope) => ({ scope, accessToken: 'refreshed-token' }),
                        'user_info_client', // unique identifier of token
                        'UserInfoClient' // storage namespace
                    )
                ),
            ]
        });
    }
})();
