<?php

namespace Tests\PhpGeneratorBundle;

use Paysera\Bundle\PhpGeneratorBundle\Command\GenerateRestClientCommand;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\Filesystem\Filesystem;
use Tests\TestKernel;

class GenerateRestClientCommandTest extends KernelTestCase
{
    static $class = TestKernel::class;

    /**
     * @var CommandTester
     */
    private $commandTester;

    /**
     * @var Filesystem
     */
    private $filesystem;

    protected function setUp()
    {
        static::$kernel = null;
        /** @var TestKernel $kernel */
        $kernel = self::createKernel();
        $kernel->boot();

        $container = $kernel->getContainer();
        $application = new Application($kernel);

        $commandInstance = new GenerateRestClientCommand(
            $container->get('paysera_code_generator.code_generator'),
            __DIR__ . '/Fixtures/raml',
            __DIR__ . '/Fixtures/generated'
        );

        $application->add($commandInstance);

        $this->filesystem = $container->get('filesystem');
        $this->commandTester = new CommandTester($commandInstance);

        static::$kernel = $kernel;
    }

    /**
     * @dataProvider dataProviderTestGenerateCode
     *
     * @param string $apiName
     */
    public function testGenerateCode($apiName)
    {
        $this->removeTargetDir($apiName);
        $this->commandTester->execute([
            'api_name' => $apiName,
            'namespace' => 'Paysera\\Test\\TestClient'
        ]);

        $this->ensureDirectoryTreeMatches($apiName);
    }

    public function dataProviderTestGenerateCode()
    {
        return [
            ['account'],
            ['category'],
            ['transfer'],
            ['transfer-surveillance'],
            ['auth'],
            ['user-info'],
            ['inheritance'],
        ];
    }

    /**
     * @param string $apiName
     */
    private function ensureDirectoryTreeMatches($apiName)
    {
        $generatedDir = __DIR__ . '/Fixtures/generated/' . $apiName;
        if (!$this->filesystem->exists($generatedDir)) {
            $this->fail(sprintf('Expected output directory "%s" not found', $generatedDir));
        }

        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator(
                __DIR__ . '/Fixtures/expected/' . $apiName,
                \RecursiveDirectoryIterator::SKIP_DOTS
            ),
            \RecursiveIteratorIterator::SELF_FIRST,
            \RecursiveIteratorIterator::CATCH_GET_CHILD
        );

        foreach ($iterator as $item) {
            /** @var $item \SplFileInfo */
            $expected = str_replace('/expected/', '/generated/', $item->getPathname());
            $this->assertFileExists($expected);
            if ($item->isFile()) {
                $expectedContents = file_get_contents($item->getPathname());
                $actualContents = file_get_contents($expected);

                $this->assertEquals(
                    $expectedContents,
                    $actualContents,
                    sprintf('Contents are different for file "%s"', $item->getBasename())
                );
            }
        }
    }

    private function removeTargetDir($apiName)
    {
        $generatedDir = __DIR__ . '/Fixtures/generated/' . $apiName;

        if (!$this->filesystem->exists($generatedDir)) {
            return;
        }

        $files = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($generatedDir, \RecursiveDirectoryIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::CHILD_FIRST
        );

        /** @var \SplFileInfo $fileInfo */
        foreach ($files as $fileInfo) {
            if ($fileInfo->isDir()) {
                rmdir($fileInfo->getRealPath());
            } else {
                unlink($fileInfo->getRealPath());
            }
        }
        rmdir($generatedDir);
    }
}
