<?php

use App\Controllers\{
    HomeController,
    ExaminationController,
    SmallBusinessSubjectController
};

$routes
    ->get('/', [HomeController::class, 'index'])
    ->get('/sbsubjects/list.json', [SmallBusinessSubjectController::class, 'list'])
    ->post('/examinations/search', [ExaminationController::class, 'search']);
