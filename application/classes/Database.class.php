<?php
	
	require_once "Database.auth.class.php";
	require_once "Database.settings.alt.php";

	// MERK!
	// Løsningen kjører på skolens databaseserver ut av esken, men da denne er høyst usikker
	// er det ingen garanti for at dataene i databasen ligger der ved tidspunkt for retting.
	// Vi har derfor også sørget for at det eksisterer en mulig tilkobling til en privat
	// databaseserver - for å bruke denne dersom cube.iu.hio.no skulle gå ned eller det skulle
	// være andre feil, vennligst fjern eller kommenter ut linje 4, og fjern kommentaren på
	// linje 14. Med vennlig hilsen, Gruppe 25.

	// require_once "Database.settings.php";

	class Database extends mysqli {

		public function __construct() {
			global $db1, $db2, $db3, $db4;
			$host = $db1;
			$user = $db2;
			$pass = $db3;
			$use  = $db4;

			parent::__construct($host, $user, $pass, $use);
			$this->set_charset("utf8");
			$this->query("SET autocommit = 0");
		}

		public function connected() {
			if ($this->connect_error) {
				return false;
			}

			else {
				return true;
			}
		}

		public function run($query) {
			$resultat = $this->query($query);
			return $resultat;
		}


	}

?>