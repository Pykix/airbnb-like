<?php

    namespace App\Repositories;

    use App\Models\Offer;
    use Core\Repository;
    use PDO;

    class StandardRepository extends Repository
    {
        public function getTable(): string
        {
            return 'standard';
        }


    }