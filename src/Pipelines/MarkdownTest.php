<?php

declare(strict_types=1);

namespace ChrisHarrison\Personal2021\Pipelines;

use PHPUnit\Framework\TestCase;
use ValueObjects\Artifact;

final class MarkdownTest extends TestCase
{
    public function test_converts_markdown_to_html()
    {
        $artifact = Artifact::fromNative([
            'body' => '# Test heading',
            'filepath' => ['root' => 'a', 'filename' => 'b', 'extension' => 'c'],
        ]);

        $subject = new Markdown();

        $this->assertStringContainsString('<h1>Test heading</h1>', $subject->run($artifact)->body()->toNative());
    }
}
