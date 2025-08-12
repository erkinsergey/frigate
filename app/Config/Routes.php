<?php

use App\Controllers\{
    HomeController,
    ExaminationController,
    SupervisorController,
    SmallBusinessSubjectController
};

$routes
    ->get('/', [HomeController::class, 'index'])
    ->get('/sbsubjects/search', [SmallBusinessSubjectController::class, 'search'])
    ->get('/supervisors/search', [SupervisorController::class, 'search'])
    ->post('/examinations/search', [ExaminationController::class, 'search'])
    ->post('/examinations', [ExaminationController::class, 'create']);
