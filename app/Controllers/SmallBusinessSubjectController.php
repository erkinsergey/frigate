<?php
    
    /**
     * Контроллер субъектов малого предпринимательства (СМП)
     */
    
    declare(strict_types=1);
    
    namespace App\Controllers;
    
    class SmallBusinessSubjectController extends BaseController
    {
        use \CodeIgniter\API\ResponseTrait;
        
        /**
         *
         */
        public function list()
        {
            $model = model('SmallBusinessSubjectModel');
            
            return $this->response->setJSON(
                $model->findAll()
            );
        }
    }
