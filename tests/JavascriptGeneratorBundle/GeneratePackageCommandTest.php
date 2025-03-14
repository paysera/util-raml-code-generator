<?php

namespace Tests\JavascriptGeneratorBundle;

use Doctrine\Common\Util\Inflector;
use Paysera\Bundle\JavascriptGeneratorBundle\Command\GeneratePackageCommand;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\Filesystem\Filesystem;
use Tests\TestKernel;

class GeneratePackageCommandTest extends KernelTestCase
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

    protected function setUp(): void
    {
        static::$kernel = null;
        /** @var TestKernel $kernel */
        $kernel = self::createKernel();
        $kernel->boot();

        $container = $kernel->getContainer();
        $application = new Application($kernel);

        $commandInstance = new GeneratePackageCommand(
            $container->get('paysera_code_generator.code_generator'),
            $container->get('filesystem'),
            $container->getParameter('vendor_prefix'),
            $container->get('twig')
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
    public function testGenerateCode(
        string $apiName,
        ?string $libraryName = null,
        ?string $libraryVersion = null,
        ?string $platformVersion = null
    ) {
        $this->removeTargetDir($apiName);
        $arguments = [
            'raml_file' => sprintf('%s/Fixtures/raml/%s/api.raml', __DIR__, $apiName),
            'output_dir' => sprintf('%s/Fixtures/generated/%s', __DIR__, $apiName),
            'client_name' => Inflector::classify($apiName) . 'Client',
        ];
        if ($libraryName !== null) {
            $arguments['--library_name'] = $libraryName;
        }
        if ($libraryVersion !== null) {
            $arguments['--library_version'] = $libraryVersion;
        }
        if ($platformVersion !== null) {
            $arguments['--platform_version'] = $platformVersion;
        }

        $this->commandTester->execute($arguments);

        $this->ensureDirectoryTreeMatches($apiName);
    }

    public function dataProviderTestGenerateCode()
    {
        return [
            ['public-transfers'],
            ['transfer'],
            ['inheritance'],
            ['user-info'],
            ['category'],
            ['account'],
            ['questionnaire'],
            ['issued-payment-card'],
            ['custom'],
            [
                'apiName' => 'package-name',
                'libraryName' => '@vendor-name/overwritten-package-name',
                'libraryVersion' => null,
                'platformVersion' => null,
            ],
            [
                'apiName' => 'package-version',
                'libraryName' => null,
                'libraryVersion' => "3.2.1",
                'platformVersion' => null,
            ],
            [
                'apiName' => 'platform-version',
                'libraryName' => null,
                'libraryVersion' => null,
                'platformVersion' => ">=18.0",
            ],
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

        $expectedIterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator(
                __DIR__ . '/Fixtures/expected/' . $apiName,
                \RecursiveDirectoryIterator::SKIP_DOTS
            ),
            \RecursiveIteratorIterator::SELF_FIRST,
            \RecursiveIteratorIterator::CATCH_GET_CHILD
        );

        $expectedFiles = [];
        foreach ($expectedIterator as $item) {
            /** @var $item \SplFileInfo */
            $expected = str_replace('/expected/', '/generated/', $item->getPathname());
            $expectedFiles[] = $expected;
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

        $generatedIterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator(
                $generatedDir,
                \RecursiveDirectoryIterator::SKIP_DOTS
            ),
            \RecursiveIteratorIterator::SELF_FIRST,
            \RecursiveIteratorIterator::CATCH_GET_CHILD
        );
        foreach ($generatedIterator as $item) {
            /** @var $item \SplFileInfo */
            if (!in_array($item->getPathname(), $expectedFiles, true)) {
                $this->fail(sprintf('Unexpected file generated "%s"', $item->getBasename()));
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
