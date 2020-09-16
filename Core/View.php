<?php

namespace Core;

class View
{
	private const VIEW_PATH = ROOT_PATH . 'App' . DS . 'Views' . DS;

	private string $_path_file;

	private bool $_view_file_exists = false;
	public function getViewFileExists(): bool { return $this->_view_file_exists; }

	public function get404(): void
	{
		http_response_code( 404 );

		if( $this->_view_file_exists ) {
			$this->render();

			return;
		}

		require_once ROOT_PATH . 'Core' . DS . 'ErrorViews' . DS . '404.php';
	}

	public function __construct( string $view_name )
	{
		$this->_path_file = self::VIEW_PATH . $view_name . '.php';

		// Test de l'existance du fichier
		$this->_view_file_exists = is_readable( $this->_path_file );
	}

	public function render( array $view_data = [] ): void
	{
		if( !$this->_view_file_exists ) {
			echo 'Une erreur s\'est produite...';
			return;
		}

		// Crée des variables à partir d'un tableau associatif
		// Ex: [ 'toto' => 2, 'truc' => 'lol' ]
		// Extract crée les variables $toto et $truc
		extract( $view_data );

		require_once $this->_path_file;
	}
}