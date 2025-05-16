<?php

require_once('vendor/inter-mediator/inter-mediator/INTER-Mediator.php');

IM_Entry(
    [
        [
            'paging' => true,
            'records' => 10,
            'name' => 'authuser',
            'view' => 'authuser',
            'table' => 'authuser',
            'key' => 'id',
            'repeat-control' => 'confirm-delete confirm-insert',
            'sort' => [
                ['field' => 'id', 'direction' => 'ASC'],
            ],
        ],
        [
            'name' => 'belonggroup',
            'view' => 'authcor',
            'table' => 'authcor',
            'key' => 'id',
            'repeat-control' => 'confirm-delete insert',
            'relation' => [
                ['foreign-key' => 'user_id', 'join-field' => 'id', 'operator' => '='],
            ],
            'sort' => [
                ['field' => 'dest_group_id', 'direction' => 'ASC'],
            ],
        ],
        [
            'name' => 'groupname',
            'view' => 'authgroup',
            'sort' => [
                ['field' => 'id', 'direction' => 'ASC'],
            ],
        ],
    ],
    [
        'authentication' => [ // table only, for all operations
            'authexpired' => '7200', // Set as seconds.
            'storing' => 'credential',
            'user' => ['admin'],
        ],
    ],
    [
        'db-class' => 'PDO',
    ],
    2
);
