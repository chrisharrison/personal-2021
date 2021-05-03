<?php

declare(strict_types=1);

namespace ChrisHarrison\Personal2021\Pipelines;

use ChrisHarrison\Personal2021\Pipeline;
use ValueObjects\Artifact;

final class Templater implements Pipeline
{
    private $template;

    public function __construct(string $template)
    {
        $this->template = $template;
    }

    public function run(Artifact $artifact): Artifact
    {
        return $artifact->withBody(strtr(
            $this->template,
            [
                '{$PAGE_TITLE}' => $artifact->title()->toNative(),
                '{$PAGE_CSS}' => 'css/' . $artifact->filepath()->filename()->toNative() . '.css',
                '{$CONTENT}' => $artifact->body()->toNative(),
            ],
        ));
    }
}
