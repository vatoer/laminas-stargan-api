<?php
return [
    'controllers' => [
        'factories' => [
            'Status\\V1\\Rpc\\Ping\\Controller' => \Status\V1\Rpc\Ping\PingControllerFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'status.rpc.ping' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/ping',
                    'defaults' => [
                        'controller' => 'Status\\V1\\Rpc\\Ping\\Controller',
                        'action' => 'ping',
                    ],
                ],
            ],
            'status.rest.status' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/status[/:status_id]',
                    'defaults' => [
                        'controller' => 'Status\\V1\\Rest\\Status\\Controller',
                    ],
                ],
            ],
        ],
    ],
    'api-tools-versioning' => [
        'uri' => [
            0 => 'status.rpc.ping',
            1 => 'status.rest.status',
        ],
    ],
    'api-tools-rpc' => [
        'Status\\V1\\Rpc\\Ping\\Controller' => [
            'service_name' => 'Ping',
            'http_methods' => [
                0 => 'GET',
            ],
            'route_name' => 'status.rpc.ping',
        ],
    ],
    'api-tools-content-negotiation' => [
        'controllers' => [
            'Status\\V1\\Rpc\\Ping\\Controller' => 'Json',
            'Status\\V1\\Rest\\Status\\Controller' => 'HalJson',
        ],
        'accept_whitelist' => [
            'Status\\V1\\Rpc\\Ping\\Controller' => [
                0 => 'application/vnd.status.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'Status\\V1\\Rest\\Status\\Controller' => [
                0 => 'application/vnd.status.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
        ],
        'content_type_whitelist' => [
            'Status\\V1\\Rpc\\Ping\\Controller' => [
                0 => 'application/vnd.status.v1+json',
                1 => 'application/json',
            ],
            'Status\\V1\\Rest\\Status\\Controller' => [
                0 => 'application/vnd.status.v1+json',
                1 => 'application/json',
            ],
        ],
    ],
    'api-tools-content-validation' => [
        'Status\\V1\\Rpc\\Ping\\Controller' => [
            'input_filter' => 'Status\\V1\\Rpc\\Ping\\Validator',
        ],
        'Status\\V1\\Rest\\Status\\Controller' => [
            'input_filter' => 'Status\\V1\\Rest\\Status\\Validator',
        ],
    ],
    'input_filter_specs' => [
        'Status\\V1\\Rpc\\Ping\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'ack',
                'description' => 'Acknowledge the request with a timestamp',
            ],
        ],
        'Status\\V1\\Rest\\Status\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Laminas\Validator\StringLength::class,
                        'options' => [
                            'max' => '140',
                        ],
                    ],
                ],
                'filters' => [
                    0 => [
                        'name' => \Laminas\Filter\StringTrim::class,
                        'options' => [
                            'charlist' => '',
                        ],
                    ],
                ],
                'name' => 'message',
                'description' => 'a status message no more than 140 characters.',
                'error_message' => 'a status message. It must be non-empty, and no more than 140 characters.',
            ],
            1 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Laminas\Validator\Regex::class,
                        'options' => [
                            'pattern' => '/^(mwop|andi|zeev|admin)$/',
                        ],
                    ],
                ],
                'filters' => [
                    0 => [
                        'name' => \Laminas\Filter\StringTrim::class,
                        'options' => [
                            'charlist' => '',
                        ],
                    ],
                ],
                'description' => 'the user providing the status message.',
                'name' => 'user',
                'error_message' => 'It must be non-empty, and fulfill a regular expression.',
            ],
            2 => [
                'required' => false,
                'validators' => [
                    0 => [
                        'name' => \Laminas\Validator\Digits::class,
                        'options' => [
                            'message' => '',
                        ],
                    ],
                ],
                'filters' => [],
                'description' => 'an integer timestamp. It does not need to be submitted, but if it is, must consist of only digits. It will always be returned in representations.',
                'name' => 'timestamp',
                'error_message' => 'must consist of only digits',
                'allow_empty' => true,
                'continue_if_empty' => false,
            ],
        ],
    ],
    'service_manager' => [
        'factories' => [
            \Status\V1\Rest\Status\StatusResource::class => \Status\V1\Rest\Status\StatusResourceFactory::class,
        ],
    ],
    'api-tools-rest' => [
        'Status\\V1\\Rest\\Status\\Controller' => [
            'listener' => \Status\V1\Rest\Status\StatusResource::class,
            'route_name' => 'status.rest.status',
            'route_identifier_name' => 'status_id',
            'collection_name' => 'status',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \StatusLib\Entity::class,
            'collection_class' => \StatusLib\Collection::class,
            'service_name' => 'Status',
        ],
    ],
    'api-tools-hal' => [
        'metadata_map' => [
            \Status\V1\Rest\Status\StatusEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'status.rest.status',
                'route_identifier_name' => 'status_id',
                'hydrator' => \Laminas\Hydrator\ArraySerializable::class,
            ],
            \Status\V1\Rest\Status\StatusCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'status.rest.status',
                'route_identifier_name' => 'status_id',
                'is_collection' => true,
            ],
            \StatusLib\Entity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'status.rest.status',
                'route_identifier_name' => 'status_id',
                'hydrator' => \Laminas\Hydrator\ObjectPropertyHydrator::class,
            ],
            \StatusLib\Collection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'status.rest.status',
                'route_identifier_name' => 'status_id',
                'is_collection' => true,
            ],
        ],
    ],
    'api-tools-mvc-auth' => [
        'authorization' => [
            'Status\\V1\\Rest\\Status\\Controller' => [
                'collection' => [
                    'GET' => false,
                    'POST' => true,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ],
                'entity' => [
                    'GET' => false,
                    'POST' => false,
                    'PUT' => true,
                    'PATCH' => true,
                    'DELETE' => true,
                ],
            ],
        ],
    ],
];
