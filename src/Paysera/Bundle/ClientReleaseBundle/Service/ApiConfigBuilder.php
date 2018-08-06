<?php
declare(strict_types=1);

namespace Paysera\Bundle\ClientReleaseBundle\Service;

use Paysera\Bundle\ClientReleaseBundle\Entity\ApiConfig;
use Paysera\Bundle\ClientReleaseBundle\Entity\ApiConfigList;
use Paysera\Bundle\ClientReleaseBundle\Exception\InvalidConfigurationException;
use Paysera\Bundle\ClientReleaseBundle\Service\ClientDefinitionBuilder\ClientDefinitionBuilderInterface;

class ApiConfigBuilder
{
    /**
     * @var ClientDefinitionBuilderInterface[]
     */
    private $clientDefinitionBuilders;

    public function __construct()
    {
        $this->clientDefinitionBuilders = [];
    }

    public function addClientDefinitionBuilder(ClientDefinitionBuilderInterface $clientDefinitionBuilder, string $type)
    {
        $this->clientDefinitionBuilders[$type] = $clientDefinitionBuilder;
    }

    /**
     * @param string $configFile
     * @return ApiConfigList
     */
    public function buildApiConfigs(string $configFile): ApiConfigList
    {
        if (!file_exists($configFile)) {
            throw new InvalidConfigurationException(sprintf(
                'Given configuration file "%s" not exists',
                $configFile
            ));
        }
        $list = new ApiConfigList();
        $config = json_decode(file_get_contents($configFile), true);
        foreach ($config as $apiName => $apiData) {
            $apiConfig = $this->parseApiConfigData($apiData, $apiName, dirname($configFile));
            $list->addItem($apiName, $apiConfig);
        }

        return $list;
    }

    private function parseApiConfigData(array $data, string $apiName, string $baseDir): ApiConfig
    {
        $config = (new ApiConfig())->setApiName($apiName);

        if (isset($data['raml_file'])) {
            $ramlFile = $data['raml_file'];

            if (strpos($ramlFile, '/') === false) {
                $config->setRamlFile($baseDir . '/' . $ramlFile);
            } else {
                $config->setRamlFile($ramlFile);
            }
        }
        if (isset($data['clients'])) {
            foreach ($data['clients'] as $clientType => $clientData) {
                if (!isset($this->clientDefinitionBuilders[$clientType])) {
                    throw new InvalidConfigurationException(sprintf(
                        'Missing ClientDefinitionBuilder for type "%s"',
                        $clientType
                    ));
                }
                $clientDefinition = $this->clientDefinitionBuilders[$clientType]->buildClientDefinition($clientData);
                $clientDefinition->setClientType($clientType);
                $config->addClient($clientType, $clientDefinition);
            }
        }

        return $config;
    }
}
