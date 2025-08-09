<?php
    
    /**
     * Контроллер контролирующих органов (КО)
     */
    
    declare(strict_types=1);
    
    namespace App\Controllers;
    
    class SupervisorController extends BaseController
    {
        use CodeIgniter\API\ResponseTrait;
        
        /**
         *
         */
        public function list(): string
        {
            return view('home');
        }
    }
