<?php

namespace Paysera\Util\RamlCodeGenerator\Tests\CodeGenerator;

use Paysera\Util\RamlCodeGenerator\CodeGenerator;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Filesystem\Filesystem;

class CodeGeneratorTest extends TestCase
{
    /**
     * @var CodeGenerator
     */
    private $codeGenerator;

    /**
     * @var Filesystem
     */
    private $filesystem;

    protected function setUp()
    {
        include __DIR__ . '/../../container.php';

        $container['parameters.raml_directory'] = __DIR__ . '/Fixtures/raml';
        $container['parameters.generated_directory'] = __DIR__ . '/Fixtures/generated';

        $this->codeGenerator = $container['code_generator'];
        $this->filesystem = $container['filesystem'];
    }

    /**
     * @dataProvider dataProviderTestGenerateCode
     *
     * @param string $apiName
     */
    public function testGenerateCode($apiName)
    {
        $this->codeGenerator->generateCode($apiName, 'Paysera\\Test\\TestClient');

        $this->ensureDirectoryTreeMatches($apiName);
    }

    public function dataProviderTestGenerateCode()
    {
        return [
            ['account'],
            ['category'],
            ['transfer'],
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
}
