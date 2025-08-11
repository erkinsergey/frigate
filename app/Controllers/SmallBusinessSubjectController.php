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
         * Поиск
         */
        public function search()
        {
            $data = [
                'name' => trim($this->request->getPostGet('q') ?? '')
            ];
            
            $rule = [
                'name' => 'required|min_length[3]|max_length[255]'
            ];
            
            $model = model('SmallBusinessSubjectModel');
            
            return $this->response->setJSON(
                $this->validateData($data, $rule)
                    ? $model->searchByName($data['name'])
                    : []
            );
        }
    }
