(function () {
    'use strict';

    angular
        .module('demoApp', [
            'vendor.http.category-client'
        ])
        .controller('DemoController', DemoController)
    ;

    DemoController.$inject = [
        'vendorHttpCategoryClientFactory'
    ];
    function DemoController(
        vendorHttpCategoryClientFactory
    ) {
        var vm = this;

        /** {CategoryClient} client */
        vm.client = vendorHttpCategoryClientFactory.getClient({
            baseURL: 'http://localhost:9000',
            middleware: [ // optional, list of middleware
                new PayseraHttpClientCommon.JWTAuthenticationMiddleware(
                    new PayseraHttpClientCommon.Scope('some:scope'),
                    new PayseraHttpClientCommon.SessionStorageTokenProvider(
                        (scope) => ({ scope, accessToken: 'created-token' }),
                        (scope) => ({ scope, accessToken: 'refreshed-token' }),
                        'category_client', // unique identifier of token
                        'CategoryClient' // storage namespace
                    )
                ),
            ]
        });
    }
})();
