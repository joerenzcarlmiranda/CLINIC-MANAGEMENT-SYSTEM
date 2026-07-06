<?php

return [
    'permissions' => [

        'Admin' => [
            'patient' => ['viewAny', 'view', 'create', 'update', 'delete'],
        ],

        'Doctor' => [
            'patient' => ['viewAny', 'view', 'update'],
        ],

        'Receptionist' => [
            'patient' => ['viewAny', 'view', 'create', 'update'],
        ],

        'Patient' => [
            //
        ],

    ],
];
