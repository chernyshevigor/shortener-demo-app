<?php

declare(strict_types=1);

return (new PhpCsFixer\Config())
    ->setRiskyAllowed(true)
    ->setRules([
        '@Symfony' => true,
        '@Symfony:risky' => true,
        '@PHP81Migration' => true,
        '@PHP80Migration:risky' => true,
        'blank_line_before_statement' => [
            'statements' => [
                'break',
                'case',
                'continue',
                'declare',
                'default',
                'do',
                'exit',
                'for',
                'foreach',
                'goto',
                'if',
                'include',
                'include_once',
                'require',
                'require_once',
                'return',
                'switch',
                'throw',
                'try',
                'while',
                'yield',
                'yield_from',
            ],
        ],
        'final_class' => true,
        'final_internal_class' => ['annotation_exclude' => ['@not-fix']],
        'phpdoc_add_missing_param_annotation' => true,
        'phpdoc_order' => true,
        'phpdoc_types_order' => true,
        'date_time_immutable' => true,
        'global_namespace_import' => ['import_classes' => true, 'import_constants' => true, 'import_functions' => true],
        'phpdoc_to_comment' => false,
        'blank_line_between_import_groups' => false,
        // strict
        'declare_strict_types' => true,
        'strict_comparison' => true,
        'strict_param' => true,
        'no_useless_else' => true,
        'concat_space' => ['spacing' => 'one'],
        'static_lambda' => true,
        'control_structure_continuation_position' => true,
        'date_time_create_from_format_call' => true,
    ]);
