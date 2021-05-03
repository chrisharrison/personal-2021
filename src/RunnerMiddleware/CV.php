<?php

declare(strict_types=1);

namespace ChrisHarrison\Personal2021\RunnerMiddleware;

use ChrisHarrison\Personal2021\Output\LocalOutputStream;
use ChrisHarrison\Personal2021\RunnerMiddleware;
use mikehaertl\wkhtmlto\Pdf;
use ValueObjects\Artifact;
use ValueObjects\Artifacts;
use ValueObjects\Filepath;

final class CV implements RunnerMiddleware
{
    public function run(callable $stack): Artifacts
    {
        /** @var Artifacts $artifacts */
        $artifacts = $stack();

        $cv = $artifacts->filter(function (Artifact $artifact) {
            return $artifact->filepath()->filename()->toNative() === 'cv';
        })->first();

        if ($cv->isNull()) {
            return $artifacts;
        }

        $tempDir = tempnam(sys_get_temp_dir(), '');
        if (file_exists($tempDir)) {
            unlink($tempDir);
        }
        mkdir($tempDir);

        $outputStream = new LocalOutputStream($tempDir);

        $artifacts->iterate(function (Artifact $artifact) use ($outputStream) {
            $outputStream->write($artifact);
        });

        $pdf = new Pdf('file://' . $cv->filepath()->withRoot($tempDir)->full());

        $content = $pdf->toString();
        if ($content === false) {
            throw new \Exception($pdf->getError());
        }

        $pdfArtifact = Artifact::null()
            ->withBody($pdf->toString())
            ->withTitle('CV PDF')
            ->withFilepath(Filepath::fromString('chris-harrison-cv.pdf'));

        return $artifacts->add($pdfArtifact);
    }
}
