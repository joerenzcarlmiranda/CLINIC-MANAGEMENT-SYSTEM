<?php

return [
    'permissions' => [

        'Admin' => [
            'patient' => ['viewAny', 'view', 'create', 'update', 'delete'],
            'doctor'  => ['viewAny', 'view', 'create', 'update', 'delete'],
        ],

        'Doctor' => [
            'patient' => ['viewAny', 'view', 'update'],
            'doctor'  => ['viewAny', 'view'],
        ],

        'Receptionist' => [
            'patient' => ['viewAny', 'view', 'create', 'update'],
            'doctor'  => ['viewAny', 'view'],
        ],

        'Patient' => [
            //
        ],

    ],
];
