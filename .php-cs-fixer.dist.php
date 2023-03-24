<?php

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__)
    ->exclude('var')
;

return (new PhpCsFixer\Config())
    ->setRules([
        '@Symfony' => true,
        'concat_space' => false,
        'array_syntax' => ['syntax' => 'short'],
        'yoda_style' => false,
        'php_unit_method_casing' => ['case' => 'snake_case'],
        'ordered_imports' => ['sort_algorithm' => 'alpha'],
        'no_unused_imports' => true,
        'global_namespace_import' => ['import_classes' => true],
    ])
    ->setFinder($finder)
;
