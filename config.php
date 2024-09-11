<?php

// See https://hupkit.github.io/hupkit/config.html#local-configuration

return [
    'schema_version' => 2,
    'main_branch' => 'main',
    'branches' => [
        ':default' => [
            'sync-tags' => true,
            'split' => [
                'lib/ApiPlatform' => 'git@github.com:hubkit-sandbox/search-api-platform.git',
                'lib/Core' => 'git@github.com:hubkit-sandbox/search-core.git',
                'lib/Doctrine/Dbal' => 'git@github.com:hubkit-sandbox/search-doctrine-dbal.git',
                'lib/Doctrine/Orm' => 'git@github.com:hubkit-sandbox/search-doctrine-orm.git',
                'lib/Elasticsearch' => 'git@github.com:hubkit-sandbox/search-elasticsearch.git',
                'lib/Symfony/SearchBundle' => 'git@github.com:hubkit-sandbox/RollerworksSearchBundle.git',
                'lib/Symfony/Validator' => 'git@github.com:hubkit-sandbox/search-symfony-validator.git',
            ],
        ],
    ],
];
