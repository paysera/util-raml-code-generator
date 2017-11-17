<?php

namespace Paysera\Bundle\WordNetBundle\Repository;

use Doctrine\DBAL\Connection;
use Paysera\Bundle\WordNetBundle\Entity\PartsOfSpeech;

class PartsOfSpeechRepository
{
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function getPartsOfSpeech($word)
    {
        $statement = $this->connection->createQueryBuilder()
            ->select(['s.pos AS pos', 'l.lexdomainname AS lexdomain', 's.definition AS definition'])
            ->from('wordsXsensesXsynsets', 's')
            ->leftJoin('s', 'lexdomains', 'l', 'l.lexdomainid = s.lexdomainid')
            ->where('s.lemma = :word')
            ->setParameter('word', $word)
            ->execute()
        ;

        $partsOfSpeech = new PartsOfSpeech();
        $partsOfSpeech->setWord($word);

        foreach ($statement->fetchAll() as $record) {
            if ($record['pos'] === 'n') {
                $partsOfSpeech->addNounDomain($record['lexdomain'], $record['definition']);
            }
            if ($record['pos'] === 'v') {
                $partsOfSpeech->addVerbDomain($record['lexdomain'], $record['definition']);
            }
            if ($record['pos'] === 'a') {
                $partsOfSpeech->addAdjectiveDomain($record['lexdomain'], $record['definition']);
            }
            if ($record['pos'] === 'r') {
                $partsOfSpeech->addAdverbDomain($record['lexdomain'], $record['definition']);
            }
            if ($record['pos'] === 's') {
                $partsOfSpeech->addAdjectiveSatelliteDomain($record['lexdomain'], $record['definition']);
            }
        }

        return $partsOfSpeech;
    }
}
