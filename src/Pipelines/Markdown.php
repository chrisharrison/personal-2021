<?php

declare(strict_types=1);

namespace ChrisHarrison\Personal2021\Pipelines;

use ChrisHarrison\Personal2021\Pipeline;
use ValueObjects\Artifact;
use ValueObjects\ArtifactBody;
use ValueObjects\FilepathExtension;

final class Markdown implements Pipeline
{
    public function run(Artifact $artifact): Artifact
    {
        $markdownTransformation = ArtifactBody::fromNative(
            \Michelf\MarkdownExtra::defaultTransform($artifact->body()->toNative()),
        );
        return $artifact
            ->withBody($markdownTransformation)
            ->withFilepath($artifact->filepath()->withExtension(FilepathExtension::fromNative('html')));
    }
}
