<?php


    namespace App\Repositories;


    use App\Models\Equipment_Offer;
    use Core\Model;
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
            $sth->execute( array( ':id' => $id ) );

            // A décommenter pour afficher l'erreur de requête éventuelle
            // var_dump( $this->db_cnx->errorInfo() );


            // Si il y a une erreur, on renvoie un tableau vide
            if (!$sth || $sth->errorCode() !== PDO::ERR_NONE) {

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

        public function multipleCreate( Model $object, $equipment_id, $offer_id ): ?Model
        {
            // Création de la liste des colonnes
            $arr_class_vars = get_object_vars( $object ); // on récupère un tableau associatif de ses propriétés
            $arr_class_vars_keys = array_keys( $arr_class_vars ); // on récupérer un tableau des noms  des propriétés

            // implode() colle tous les éléments avec un séparateur donné
            // on "colle" tous les noms de propriétés avec une virgule
            $str_columns = implode( ',', $arr_class_vars_keys );

            // Création des listes de variables et de valeurs
            $arr_vars = [];
            $arr_values = [];
            // On assemble les valeurs des propriétés dans un tableau indépendant des noms
            foreach ($arr_class_vars_keys as $property) {
                // Construction de la requête à préparer
                array_push( $arr_vars, ':' . $property );

                // Préparation des données pour la requête
                // Construction du tableau des valeurs pour PDO
                // [
                //		'nom_var1' => valeur_var1,
                //		'nom_var2' => valeur_var2
                //		etc.
                // ]
                $arr_values[ $property ] = $object->$property;
            }

            $str_vars = implode( '),(', $arr_vars );


            $query = sprintf(
                'INSERT INTO %s (equipment_id, offer_id) VALUES (:equipment_id, :offer_id)',
                $this->getTable()
            );


            // Préparation de la requête
            $sth = $this->db_cnx->prepare( $query );
            // Exécution de la requête avec remplacement des variables
            // PDO va ajouter les guillements aux valeurs automatiquement
            $sth->execute( [ ':equipment_id' => $equipment_id, ':offer_id' => $offer_id ] );

            // Si l'insertion a fonctionné, on complete $object avec l'id généré par la bdd
            // Et retourne $object
            if ($sth && $sth->errorCode() === PDO::ERR_NONE) {
                $object->id = $this->db_cnx->lastInsertId();

                return $object;
            }

            // En cas d'échec on retourne null
            return null;
        }
    }