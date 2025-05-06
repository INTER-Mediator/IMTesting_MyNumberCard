<?php
/**
 * INTER-Mediator
 * Copyright (c) INTER-Mediator Directive Committee (http://inter-mediator.org)
 * This project started at the end of 2009 by Masayuki Nii msyk@msyk.net.
 *
 * INTER-Mediator is supplied under MIT License.
 * Please see the full license for details:
 * https://github.com/inter-mediator/inter-mediator/blob/master/dist-docs/License.txt
 *
 * @copyright     Copyright (c) INTER-Mediator Directive Committee (http://inter-mediator.org)
 * @link          https://inter-mediator.com/
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

require_once('vendor/inter-mediator/inter-mediator/INTER-Mediator.php');

IM_Entry(
    [
        [
            'name' => 'authuser', 'key' => 'id','records' => 1,
            'authentication' => ['all' => ['target' => 'field-user', 'field' => 'username',],],
        ],
    ],
    [
        'authentication' => [
            'authexpired' => '3600', // Set as seconds.
            'storing' => 'credential', // session-storage, 'cookie'(default), 'cookie-domainwide', 'none'
        ],
    ],
    ['db-class' => 'PDO'],
    2
);
