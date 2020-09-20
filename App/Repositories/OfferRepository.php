<?php

    namespace App\Repositories;

    use App\Models\Offer;
    use Core\Repository;
    use PDO;

    class OfferRepository extends Repository
    {
        public function getTable(): string
        {
            return 'offers';
        }

        // Read: Toute la liste
        public function findAll(): array
        {
            return $this->readAll( Offer::class );
        }

        // Read: Un Post par son ID
        public function findById( int $id ): ?Offer
        {
            return $this->readById( $id, Offer::class );
        }

        public function details( $id )
        {
            // Tableau de résultats
            $results = '';

            $query = sprintf( 'SELECT * FROM %s JOIN standard s on s.id = offers.standard_id
                        JOIN
                        (
                            SELECT id, username
                                FROM users
                            ) u on author_id = u.id
                        
                        WHERE offers.id =:id', $this->getTable() );
            // Exécution de la requête
            $sth = $this->db_cnx->prepare( $query );
            $sth->execute( array( ':id' => $id ) );


            // var_dump( $this->db_cnx->errorInfo() );


            // Si il y a une erreur, on renvoie un tableau vide
            if (!$sth || $sth->errorCode() !== PDO::ERR_NONE) {
                echo 'PROBLEME!';
                return $results;
            }

            // Si la requête a fonctionné, on traite le résultat
            while ($row = $sth->fetch( PDO::FETCH_OBJ )) {
                // ex: $classname contient 'User', alors PHP va exécuter "new User()"
                // $obj_row = new $classname( $row );
                $results = $row;

            }

            return $results;
        }

        public function findByAuthor()
        {
            $results = [];

            $query = sprintf(
                'SELECT * FROM %s WHERE author_id=:id',
                $this->getTable()
            );

            $sth = $this->db_cnx->prepare( $query );
            if (!$sth) {
                echo 'alalalalalalalal';
                return null;
            }


            // Exécution de la requête préparée
            $sth->execute( [ ':id' => $_SESSION[ 'id' ] ] );

            // En cas d'erreur du serveur SQL on retourne null
            if ($sth->errorCode() !== PDO::ERR_NONE) {
                return null;
            }

            while ($row = $sth->fetch( PDO::FETCH_OBJ )) {
                // ex: $classname contient 'User', alors PHP va exécuter "new User()"
                // $obj_row = new $classname( $row );
                $results[] = $row;

            }

            /*
            // Pour débugguer
            $object = new $classname( $row );
            var_dump($object)
            return $object;
            */
            return $results;
        }


    }