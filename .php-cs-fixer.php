<?php

declare(strict_types=1);

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->exclude('bootstrap/cache')
    ->exclude('storage')
    ->exclude('vendor')
    ->name('*.php')
    ->notName('*.blade.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

return (new PhpCsFixer\Config())
    ->setRules([
        'array_syntax' => [
            'syntax' => 'short',
        ],
        'array_indentation' => true,
        'normalize_index_brace' => true,
        'trailing_comma_in_multiline' => [
            'elements' => ['arrays', 'arguments', 'parameters'],
        ],
        'whitespace_after_comma_in_array' => [
            'ensure_single_space' => true,
        ],
    ])
    ->setFinder($finder)
    ->setRiskyAllowed(false);
