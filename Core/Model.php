<?php

namespace Core;

/**
 * Class Model
 * @package Core
 *
 * Classe abstraite de base pour les modèles (utilise le pattern hydrator)
 */
abstract class Model implements IModel
{
	// Null ou int (sera null pour les nouveaux enregistrements)
	public ?int $id;

	public function __construct( array $data = [] )
	{
		$this->hydrate( $data );
	}

	/**
	 * Hydrate l'objet à partir d'un résultat de BDD
	 * @param array $data Tableau associatif renvoyé par la BDD
	 */
	private function hydrate( array $data ): void
	{
		foreach( $data as $column => $value ) {
			if( property_exists( get_called_class(), $column ) ) {
				$this->$column = $value;
			}
		}
	}
}