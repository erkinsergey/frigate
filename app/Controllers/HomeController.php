<?php

  /**
   * Контроллер проверок надзорными органами предприятия
   */

  declare(strict_types=1);

  namespace App\Controllers;

  use CodeIgniter\Exceptions\PageNotFoundException;

  class HomeController extends BaseController
  {
      /**
       *
       */
      public function index(): string
      {
          return view('home');
      }

      /**
       *
       */
      /*public function view(string $page = 'home'): string
      {
          if (! is_file(APPPATH . 'Views/pages/' . $page . '.php')) {
              // Whoops, we don't have a page for that!
              throw new PageNotFoundException($page);
          }

          $data['title'] = ucfirst($page); // Capitalize the first letter

          return view('header', $data)
              . view('pages/' . $page)
              . view('footer');
      }*/
  }
