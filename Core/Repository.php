<?php

namespace Core;

use \PDO;

abstract class Repository
{
	protected PDO $db_cnx;

	public abstract function getTable(): string;

	public function __construct( PDO $pdo )
	{
		$this->db_cnx = $pdo;
	}

	/*
	 * CRUD (Create, Read, Update, Delete)
	 */
	// Create
	public function create( Model $object ): ?Model
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
		foreach( $arr_class_vars_keys as $property ) {
			// Construction de la requête à préparer
			array_push( $arr_vars, ':' . $property  );

			// Préparation des données pour la requête
			// Construction du tableau des valeurs pour PDO
			// [
			//		'nom_var1' => valeur_var1,
			//		'nom_var2' => valeur_var2
			//		etc.
			// ]
			$arr_values[ $property ] = $object->$property;
		}

		$str_vars = implode( ',', $arr_vars );

		// INSERT INTO ma_table (colonne_1, colonne_2) VALUES (val_col_1, val_col_2)
		// Préparée:
		// INSERT INTO ma_table (:col1, :col2) VALUES (:val1, :val2)
		// $this->$db_cnx->
		// sprintf() permet de formater une chaîne selon un modèle avec des emplacements vides
		// https://www.php.net/manual/en/function.sprintf.php
		$query = sprintf(
			'INSERT INTO %s (%s) VALUES (%s)',
			$this->getTable(),
			$str_columns,
			$str_vars
		);

		// Préparation de la requête
		$sth = $this->db_cnx->prepare( $query );
		// Exécution de la requête avec remplacement des variables
		// PDO va ajouter les guillements aux valeurs automatiquement
		$sth->execute( $arr_values );

		// Si l'insertion a fonctionné, on complete $object avec l'id généré par la bdd
		// Et retourne $object
		if( $sth && $sth->errorCode() === PDO::ERR_NONE ) {
			$object->id = $this->db_cnx->lastInsertId();

			return $object;
		}

		// En cas d'échec on retourne null
		return null;
	}

	// Read: Toute la liste
	// Protected car elle sera utilisée par le repo enfant à travers une méthode publique
	/**
	 * Récupère une liste complète d'"entités" d'un type donné depuis la BDD
	 * @param string $classname Nom complet de la classe (avec le chemin de namespace)
	 * @return array Tableau d'objets du type passé en argument
	 */
	protected function readAll( string $classname ): array
	{
		// Tableau de résultats
		$arr_objects = [];

		$query = 'SELECT * FROM ' . $this->getTable() . ' ORDER BY date_creation DESC' ;

		// Exécution de la requête
		$sth = $this->db_cnx->query( $query );

		// A décommenter pour afficher l'erreur de requête éventuelle
		// var_dump( $this->db_cnx->errorInfo() );

		// Si il y a une erreur, on renvoie un tableau vide
		if( !$sth || $sth->errorCode() !== PDO::ERR_NONE ) {
			return $arr_objects;
		}

		// Si la requête a fonctionné, on traite le résultat
		while( $row = $sth->fetch() ) {
			// ex: $classname contient 'User', alors PHP va exécuter "new User()"
			$obj_row = new $classname( $row );
			$arr_objects[] = $obj_row;
		}

		return $arr_objects;
	}

    protected function readById( int $id, string $classname ): ?Model
    {
        $query = sprintf(
            'SELECT * FROM %s WHERE id=:id',
            $this->getTable()
        );

        $sth = $this->db_cnx->prepare( $query );
        if( !$sth ) {
            return null;
        }


        // Attachement d'un paramètre avec précision de type
        $sth->bindValue( 'id', $id, PDO::PARAM_INT );

        // Exécution de la requête préparée
        $sth->execute();

        // En cas d'erreur du serveur SQL on retourne null
        if( $sth->errorCode() !== PDO::ERR_NONE ) {
            return null;
        }

        $row = $sth->fetch();
        if( !$row ) {
            return null;
        }

        /*
        // Pour débugguer
        $object = new $classname( $row );
        var_dump($object)
        return $object;
        */

        return new $classname( $row );
    }

    protected function login( string $password, string $name, string $classname ): ?Model
    {
        $query = sprintf(
            'SELECT * FROM %s WHERE username=:username AND password=:password',
            $this->getTable()
        );

        $sth = $this->db_cnx->prepare( $query );
        if( !$sth ) {
            echo 'BONJOUR';
            return null;
        }
        // $sth->execute( [ 'id' => $id ]);


        ;
        // Exécution de la requête préparée
        $sth->execute(array(':username' => $name, ':password' => $password));

        // En cas d'erreur du serveur SQL on retourne null
        if( $sth->errorCode() !== PDO::ERR_NONE ) {
            echo 'BONJOUR BONJOUR';
            return null;
        }

        $row = $sth->fetch();
        if( !$row ) {
            echo 'NORMALEMENT JE DEVRAIS PAS PASSER PAR LA... NORMALEMENT...';
            // TODO : gerer l'erreur connection
            return null;
        }


        $object = new $classname( $row );

        return $object;
    }

	/*
	 * UPDATE
	 */
	public function update( Model $object ): ?Model
	{
		// Création de la liste des colonnes
		$arr_class_vars = get_object_vars( $object ); // on récupère un tableau associatif de ses propriétés
		$arr_class_vars_keys = array_keys( $arr_class_vars ); // on récupérer un tableau des noms  des propriétés

		// Création des listes des couples colonne/variable
		// [ "username=:username", ... ]
		$arr_vars = [];
		// Tableau pour le PDO
		$arr_values = [];
		// On assemble les valeurs des propriétés dans un tableau indépendant des noms
		foreach( $arr_class_vars_keys as $property ) {
			$arr_values[ $property ] = $object->$property;

			// Si c'est ID, on passe à la propriété suivante
			if( $property === 'id' ) {
				continue;
			}

			$value = sprintf( '%1$s=:%1$s', $property );
			$arr_vars[] = $value;
		}

		$str_vars = implode( ',', $arr_vars );

		// UPDATE ma_table SET colonne_1=val_col1, colonne_2=val_col_2 WHERE id=mon_id
		// Préparée:
		// UPDATE ma_table SET col1=:val1, col2=:val2 WHERE id=:id
		// $this->$db_cnx->
		$query = sprintf(
			'UPDATE %s SET %s WHERE id=:id',
			$this->getTable(),
			$str_vars
		);

		// Préparation de la requête
		$sth = $this->db_cnx->prepare( $query );
		// Exécution de la requête avec remplacement des variables
		// PDO va ajouter les guillements aux valeurs automatiquement
		$sth->execute( $arr_values );

		// Si l'insertion a fonctionné, on complete $object avec l'id généré par la bdd
		// Et retourne $object
		if( $sth && $sth->errorCode() === PDO::ERR_NONE ) {
			return $object;
		}

		// En cas d'échec on retourne null
		return null;
	}

	/*
	 * DELETE
	 */
	public function delete( int $id ): bool
	{
		$query = sprintf( 'DELETE FROM %s WHERE id=:id', $this->getTable() );
		$sth = $this->db_cnx->prepare( $query );

		// Si la préparation échoue, on renvoie false
		if( !$sth ) {
			return false;
		}

		$sth->bindValue( 'id', $id, PDO::PARAM_INT );

		$sth->execute();

		return $sth->errorCode() === PDO::ERR_NONE;
	}

}