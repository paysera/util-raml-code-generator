<?php

namespace Vendor\Test\NamedScalarApiBundle\Service;

use Vendor\Test\NamedScalarApiBundle\Entity as Entities;
use Vendor\Test\NamedScalarApiBundle\Repository\PaymentRepository;
use Doctrine\ORM\EntityManager;

class PaymentManager
{
    private $paymentRepository;
    private $entityManager;

    public function __construct(
        PaymentRepository $paymentRepository,
        EntityManager $entityManager
    ) {
        $this->paymentRepository = $paymentRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @param Entities\Payment $payment
     * @return Entities\Payment
     */
    public function createPayment(Entities\Payment $payment)
    {
        //TODO: generated_code
    }
}
