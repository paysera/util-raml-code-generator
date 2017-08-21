(function () {
    'use strict';

    angular
        .module('demoApp', [
            'paysera.http.account'
        ])
        .controller('DemoController', DemoController)
    ;

    DemoController.$inject = [
        'payseraHttpAccountClientFactory'
    ];
    function DemoController(
        payseraHttpAccountClientFactory
    ) {
        var vm = this;

        /**
         * @param Scope scope
         * @returns {Promise.<Token>}
         */
        function initialTokenProvider(scope) {
            return Promise.resolve('some-token-value').then((value) => {
                return new payseraHttpClientCommon.Token(scope, 'Bearer ' + value)
            });
        }

        /**
         * @param Scope scope
         * @returns {Promise.<Token>}
         */
        function refreshTokenProvider(scope) {
            return fetch(
                'http://localhost:3000/token',
                {
                    method: 'post',
                    body: JSON.stringify({'scope': scope.getValue()})
                }
            ).then((response) => {
                return response.json();
            }).then((response) => {
                return new payseraHttpClientCommon.Token(scope, 'Bearer ' + response.token_value);
            });
        }

        /** {CategoryClient} client */
        let client = payseraHttpAccountClientFactory.getClient({
            baseUrl: 'http://localhost:3000',
            scope: 'some:scope',
            initialTokenProvider: initialTokenProvider,
            refreshTokenProvider: refreshTokenProvider
        });

        // check out src/service/CategoryClient.js for available methods
    }
})();
