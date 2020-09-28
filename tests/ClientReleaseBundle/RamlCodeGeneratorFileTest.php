<?php

namespace Tests\ClientReleaseBundle;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Process\Process;

class RamlCodeGeneratorFileTest extends TestCase
{
    public function testFileExists()
    {
        // The `raml-code-generator` file location is hard-coded in the `processStep` method
        // `src/Paysera/Bundle/ClientReleaseBundle/Service/ReleaseStep/GeneratePhpClientStep.php`.
        // So, we only check for the existence of that file using process and arguments,
        // otherwise the `release:clients` command will fail for missing file.
        $process = new Process(['bin/raml-code-generator', '-h', '-q']);
        $exitCode = $process->run();

        $this->assertEquals(0, $exitCode, $process->getErrorOutput());
    }
}
