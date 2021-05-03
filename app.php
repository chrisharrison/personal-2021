<?php

declare(strict_types=1);

use ChrisHarrison\Clock\SystemClock;
use ChrisHarrison\Personal2021\CompositePipeline;
use ChrisHarrison\Personal2021\Input\LocalInputProvider;
use ChrisHarrison\Personal2021\Output\LocalOutputProvider;
use ChrisHarrison\Personal2021\PipelineRunner;
use ChrisHarrison\Personal2021\Pipelines\Icons;
use ChrisHarrison\Personal2021\Pipelines\Markdown;
use ChrisHarrison\Personal2021\Pipelines\Templater;
use ChrisHarrison\Personal2021\Pipelines\YearsOfExperience;
use ChrisHarrison\Personal2021\RunnerMiddleware\CV;
use ChrisHarrison\Personal2021\RunnerMiddleware\StaticAssets;
use ChrisHarrison\Personal2021\RunnerMiddlewareChain;

require('vendor/autoload.php');

$clock = new SystemClock();

$runner = new PipelineRunner(
    new CompositePipeline([
        // Pipelines
        new YearsOfExperience($clock),
        new Icons(),
        new Markdown(),
        new Templater(file_get_contents(__DIR__ . '/content/templates/default.html')),
    ]),
    new RunnerMiddlewareChain([
        // Middleware
        new StaticAssets(new LocalInputProvider(__DIR__ . '/content/static')),
    ]),
    new LocalInputProvider(__DIR__ . '/content/pages'),
    new LocalOutputProvider(__DIR__ . '/dist')
);

$runner->run();
