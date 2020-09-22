<?php

    namespace App\Repositories;

    use App\Models\Reservation;
    use Core\Repository;
    use PDO;

    class ReservationRepository extends Repository
    {
        public function getTable(): string
        {
            return 'reservation';
        }
        // CRUD
        // Read: Toute la liste
        public function findAll(): array
        {
            return $this->readAll( Reservation::class );
        }


        public function findById( int $id )
        {
            return $this->readById( $id, Reservation::class );
        }

        public function findReservation()
        {
            // Tableau de résultats
            $results = [];

            $query = sprintf( 'select * from %s
                        join
                            offers o on o.id = reservation.offer_id
                        join
                            (select id, username from users) u on reservation.user_id = u.id
                        WHERE u.id =:id', $this->getTable() );

            // Exécution de la requête
            $sth = $this->db_cnx->prepare( $query );
            $sth->execute( array( ':id' => $_SESSION['id'] ) );


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
                $results[] = $row;

            }

            return $results;
        }

        public function findByReservation()
        {
            $results = [];

            $query = sprintf(
                'SELECT * FROM %s
                    Join offers o on o.id = reservation.offer_id
                    WHERE o.author_id = :id',
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