<?php

  /**
   * Контроллер проверок предприятий надзорными органами
   */

  declare(strict_types=1);

  namespace App\Controllers;

  class HomeController extends BaseController
  {
      /**
       *
       */
      public function index(): string
      {
          return view('home');
      }
  }
