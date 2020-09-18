<?php


    namespace App\Repositories;


    use App\Models\Equipment_Offer;
    use Core\Repository;
    use PDO;

    class EquipmentOfferRepository extends Repository
    {
        public function getTable(): string
        {
            return 'offer_equipment';
        }

        public function equipmentDetails( $id )
        {
            // Tableau de résultats
            $results = [];

            $query = 'SELECT *
                                FROM ' . $this->getTable() . '
                                JOIN
                                    (SELECT * FROM equipments) e on equipment_id = e.id
                                JOIN
                                    ( SELECT id FROM offers) o on offer_id = o.id
                                WHERE offer_id =:id';
            // Exécution de la requête
            $sth = $this->db_cnx->prepare( $query );
            $sth->execute(array(':id' => $id));

            // A décommenter pour afficher l'erreur de requête éventuelle
            // var_dump( $this->db_cnx->errorInfo() );


            // Si il y a une erreur, on renvoie un tableau vide
            if (!$sth || $sth->errorCode() !== PDO::ERR_NONE) {

                return $results;
            }

            // Si la requête a fonctionné, on traite le résultat
            while ($row = $sth->fetch(PDO::FETCH_OBJ)) {
                // ex: $classname contient 'User', alors PHP va exécuter "new User()"
                // $obj_row = new $classname( $row );

                    $results[] = $row;
            }

            return $results;
        }
    }