<?php
    
    /**
     * Модель контролирующего органа (КО)
     */
    
    declare(strict_types=1);
    
    namespace App\Models;
    
    use CodeIgniter\Model;
    
    class SupervisorModel extends Model
    {
        protected $table = 'supervisors';
        
        /**
         *
         */
        public function searchByName(string $likeName): array
        {
            return
                $this
                    ->like($field = 'LOWER(name)', mb_strtolower($likeName), $side = 'both', $escape = true)
                    ->limit(100)
                    ->findAll();
        }
    }
