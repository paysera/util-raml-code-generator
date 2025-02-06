<?php

namespace Paysera\Test\TransferSurveillanceAssistantClient\Entity;

use Paysera\Component\RestClientCommon\Entity\Entity;

class AnalysisReport extends Entity
{
    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

    /**
     * @return AnalysisTaskOutput
     */
    public function getAnalysisTask()
    {
        return (new AnalysisTaskOutput())->setDataByReference($this->getByReference('analysis_task'));
    }
    /**
     * @param AnalysisTaskOutput $analysisTask
     * @return $this
     */
    public function setAnalysisTask(AnalysisTaskOutput $analysisTask)
    {
        $this->setByReference('analysis_task', $analysisTask->getDataByReference());
        return $this;
    }
    /**
     * @return \DateTimeImmutable
     */
    public function getCreatedAt()
    {
        return (new \DateTimeImmutable())->setTimestamp($this->get('created_at'));
    }
    /**
     * @param \DateTimeInterface $createdAt
     * @return $this
     */
    public function setCreatedAt(\DateTimeInterface $createdAt)
    {
        $this->set('created_at', $createdAt->getTimestamp());
        return $this;
    }
}
