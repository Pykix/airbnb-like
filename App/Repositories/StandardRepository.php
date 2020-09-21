<?php

    namespace App\Repositories;

    use App\Models\Offer;
    use App\Models\Standard;
    use Core\Repository;
    use PDO;

    class StandardRepository extends Repository
    {
        public function getTable(): string
        {
            return 'standard';
        }

        public function findById( int $id ): ?Standard
        {
            return $this->readById( $id, Standard::class );
        }

    }