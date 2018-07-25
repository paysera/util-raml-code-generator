(function () {
    'use strict';

    angular
        .module('demoApp', [
            'vendor.http.questionnaire-client'
        ])
        .controller('DemoController', DemoController)
    ;

    DemoController.$inject = [
        'vendorHttpQuestionnaireClientFactory'
    ];
    function DemoController(
        vendorHttpQuestionnaireClientFactory
    ) {
        var vm = this;

        /** {QuestionnaireClient} client */
        vm.client = vendorHttpQuestionnaireClientFactory.getClient({
            baseURL: 'http://localhost:9000',
            middleware: [ // optional, list of middleware
                new PayseraHttpClientCommon.JWTAuthenticationMiddleware(
                    new PayseraHttpClientCommon.Scope('some:scope'),
                    new PayseraHttpClientCommon.SessionStorageTokenProvider(
                        (scope) => ({ scope, accessToken: 'created-token' }),
                        (scope) => ({ scope, accessToken: 'refreshed-token' }),
                        'questionnaire_client', // unique identifier of token
                        'QuestionnaireClient' // storage namespace
                    )
                ),
            ]
        });
    }
})();
