<?php

namespace Vendor\Test\NamedScalarApiBundle\Controller;

use Vendor\Test\NamedScalarApiBundle\Entity as Entities;
use Vendor\Test\NamedScalarApiBundle\Service\PaymentManager;
use Vendor\Test\NamedScalarApiBundle\PaymentPermissions;
use Paysera\Bundle\SecurityBundle\Service\AuthorizationChecker;
use Doctrine\ORM\EntityManager;

class PaymentApiController
{
    private $authorizationChecker;
    private $entityManager;
    private $paymentManager;
    
    public function __construct(
        PaymentManager $paymentManager,
        AuthorizationChecker $authorizationChecker,
        EntityManager $entityManager
    ) {
        $this->paymentManager = $paymentManager;
        $this->authorizationChecker = $authorizationChecker;
        $this->entityManager = $entityManager;
    }

    /**
     * Create payment
     * POST /payments
     *
     * @param Entities\Payment $payment
     * @return Entities\Payment
     */
    public function createPayment(Entities\Payment $payment)
    {
        $this->authorizationChecker->check(PaymentPermissions::CREATE_PAYMENT);
        $result = $this->paymentManager->createPayment($payment);
        $this->entityManager->flush();
        return $result;
    }
}
