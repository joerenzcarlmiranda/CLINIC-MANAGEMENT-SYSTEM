<?php

return [
    'permissions' => [

        'Admin' => [
            'patient' => ['viewAny', 'view', 'create', 'update', 'delete'],
            'doctor' => ['viewAny', 'view', 'create', 'update', 'delete'],
            'appointment' => ['viewAny', 'view', 'create', 'update', 'delete'],
            'consultation' => ['viewAny', 'view', 'create', 'update', 'delete'],
            'prescription' => ['viewAny', 'view', 'create', 'update', 'delete'],
        ],

        'Doctor' => [
            'patient' => ['viewAny', 'view'],
            'doctor' => ['viewAny', 'view'],
            'appointment' => ['viewAny', 'view', 'update'],
            'consultation' => ['viewAny', 'view', 'create', 'update'],
            'prescription' => ['viewAny', 'view', 'create', 'update'],
        ],

        'Receptionist' => [
            'patient' => ['viewAny', 'view', 'create', 'update'],
            'doctor' => ['viewAny', 'view'],
            'appointment' => ['viewAny', 'view', 'create', 'update'],
            'consultation' => ['viewAny', 'view'],
            'prescription' => ['viewAny', 'view'],
        ],

        'Patient' => [
            'appointment' => ['viewAny', 'view'],
            'consultation' => ['viewAny', 'view'],
            'prescription' => ['viewAny', 'view'],
        ],

    ],
];
