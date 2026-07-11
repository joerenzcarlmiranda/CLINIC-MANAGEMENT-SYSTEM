<?php

return [
    'permissions' => [

        'Admin' => [
            'patient' => ['viewAny', 'view', 'create', 'update', 'delete'],
            'doctor'  => ['viewAny', 'view', 'create', 'update', 'delete'],
            'appointment'  => ['viewAny', 'view', 'create', 'update', 'delete'],
        ],

        'Doctor' => [
            'patient' => ['viewAny', 'view'],
            'doctor'  => ['viewAny', 'view'],
            'appointment'  => ['viewAny', 'view', 'create', 'update', 'delete'],
        ],

        'Receptionist' => [
            'patient' => ['viewAny', 'view', 'create', 'update'],
            'doctor'  => ['viewAny', 'view'],
            'appointment'  => ['viewAny', 'view', 'create', 'update', 'delete'],
        ],

        'Patient' => [
            'appointment'  => ['viewAny', 'view', 'create', 'update', 'delete'],
        ],

    ],
];
