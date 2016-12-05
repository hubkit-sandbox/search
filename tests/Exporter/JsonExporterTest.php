<?php

/*
 * This file is part of the RollerworksSearch package.
 *
 * (c) Sebastiaan Stok <s.stok@rollerscapes.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Rollerworks\Component\Search\Tests\Exporter;

use Rollerworks\Component\Search\Exporter\JsonExporter;
use Rollerworks\Component\Search\ExporterInterface;
use Rollerworks\Component\Search\Input\JsonInput;
use Rollerworks\Component\Search\InputProcessorInterface;
use Rollerworks\Component\Search\Test\SearchConditionExporterTestCase;

final class JsonExporterTest extends SearchConditionExporterTestCase
{
    public function provideSingleValuePairTest()
    {
        return json_encode(
            [
                'fields' => [
                    'name' => [
                        'single-values' => [
                            'value ',
                            '-value2',
                            'value2-',
                            '10.00',
                            '10,00',
                            'hÌ',
                            '٤٤٤٦٥٤٦٠٠',
                            'doctor"who""',
                        ],
                        'excluded-values' => ['value3'],
                    ],
                ],
            ]
        );
    }

    public function provideMultipleValuesTest()
    {
        return json_encode(
            [
                'fields' => [
                    'name' => [
                        'single-values' => ['value', 'value2'],
                    ],
                    'date' => [
                        'single-values' => ['12-16-2014'],
                    ],
                ],
            ]
        );
    }

    public function provideRangeValuesTest()
    {
        return json_encode(
            [
                'fields' => [
                    'id' => [
                        'ranges' => [
                            ['lower' => '1', 'upper' => '10'],
                            ['lower' => '15', 'upper' => '30'],
                            ['lower' => '100', 'upper' => '200', 'inclusive-lower' => false],
                            ['lower' => '310', 'upper' => '400', 'inclusive-upper' => false],
                        ],
                        'excluded-ranges' => [
                            ['lower' => '50', 'upper' => '70'],
                        ],
                    ],
                    'date' => [
                        'ranges' => [
                            ['lower' => '12-16-2014', 'upper' => '12-20-2014'],
                        ],
                    ],
                ],
            ]
        );
    }

    public function provideComparisonValuesTest()
    {
        return json_encode(
            [
                'fields' => [
                    'id' => [
                        'comparisons' => [
                            ['operator' => '>', 'value' => '1'],
                            ['operator' => '<', 'value' => '2'],
                            ['operator' => '<=', 'value' => '5'],
                            ['operator' => '>=', 'value' => '8'],
                        ],
                    ],
                    'date' => [
                        'comparisons' => [
                            ['operator' => '>=', 'value' => '12-16-2014'],
                        ],
                    ],
                ],
            ]
        );
    }

    public function provideMatcherValuesTest()
    {
        return json_encode(
            [
                'fields' => [
                    'name' => [
                        'pattern-matchers' => [
                            ['type' => 'CONTAINS', 'value' => 'value', 'case-insensitive' => false],
                            ['type' => 'STARTS_WITH', 'value' => 'value2', 'case-insensitive' => true],
                            ['type' => 'ENDS_WITH', 'value' => 'value3', 'case-insensitive' => false],
                            ['type' => 'REGEX', 'value' => '^foo|bar?', 'case-insensitive' => false],
                            ['type' => 'NOT_CONTAINS', 'value' => 'value4', 'case-insensitive' => false],
                            ['type' => 'NOT_CONTAINS', 'value' => 'value5', 'case-insensitive' => true],
                            ['type' => 'EQUALS', 'value' => 'value9', 'case-insensitive' => false],
                            ['type' => 'NOT_EQUALS', 'value' => 'value10', 'case-insensitive' => false],
                            ['type' => 'EQUALS', 'value' => 'value11', 'case-insensitive' => true],
                            ['type' => 'NOT_EQUALS', 'value' => 'value12', 'case-insensitive' => true],
                        ],
                    ],
                ],
            ]
        );
    }

    public function provideGroupTest()
    {
        return json_encode(
            [
                'fields' => [
                    'name' => [
                        'single-values' => ['value', 'value2'],
                    ],
                ],
                'groups' => [
                    [
                        'fields' => [
                            'name' => [
                                'single-values' => ['value3', 'value4'],
                            ],
                        ],
                    ],
                    [
                        'fields' => [
                            'name' => [
                                'single-values' => ['value8', 'value10'],
                            ],
                        ],
                        'logical-case' => 'OR',
                    ],
                ],
            ]
        );
    }

    public function provideMultipleSubGroupTest()
    {
        return json_encode(
            [
                'groups' => [
                    [
                        'fields' => [
                            'name' => [
                                'single-values' => ['value', 'value2'],
                            ],
                        ],
                    ],
                    [
                        'fields' => [
                            'name' => [
                                'single-values' => ['value3', 'value4'],
                            ],
                        ],
                    ],
                ],
            ]
        );
    }

    public function provideNestedGroupTest()
    {
        return json_encode(
            [
                'groups' => [
                    [
                        'groups' => [
                            [
                                'fields' => [
                                    'name' => [
                                        'single-values' => ['value', 'value2'],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        );
    }

    public function provideEmptyValuesTest()
    {
        return json_encode([]);
    }

    public function provideEmptyGroupTest()
    {
        return json_encode(['groups' => [[]]]);
    }

    /**
     * @return ExporterInterface
     */
    protected function getExporter()
    {
        return new JsonExporter();
    }

    /**
     * @return InputProcessorInterface
     */
    protected function getInputProcessor()
    {
        return new JsonInput();
    }
}
