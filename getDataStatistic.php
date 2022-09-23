<?php

	require_once 'config.php';
	require_once 'functions.php';

	$classement = $_GET[ 'classement' ];
	$id = $_GET[ 'id' ];

	class DataSet implements JsonSerializable {
		public $x;
		public $y;

		public function __construct($x, $y) {
			$this->x = $x;
			$this->y = $y;
		}

		public function jsonSerialize () {
			return array(
				'x'=>$this->x,
				'y'=>$this->y
			);
		}
	};

	class Data implements JsonSerializable {

		public $id_joueur;
		public $name;
		public $hidden;
		public $data;

		public function __construct() {
		}	

		public function jsonSerialize () {
			return array(
				'id_joueur'=>$this->id_joueur,
				'name'=>$this->name,
				'hidden'=>$this->hidden,
				'data'=>$this->data
			);
		}
	}

	if ($classement == 'Equipe' || $classement == 'equipe')
	{
		$qry = "SELECT * FROM historic_rang
		LEFT JOIN coequipiers on coequipiers.id = historic_rang.id_owner
		 where type = '$classement'
		 ORDER BY coequipiers.nom, date";
		$result = mysqli_query($con, $qry);
		$currentName = "";
		$data = array();
		$myData = new Data();
		$myData->data = array();
		$first = true;

		while ($row = mysqli_fetch_array($result)) 
		{
			$name = $row["nom"];
			if ($currentName != $name) {
				if ($first)
				{
					$first = false;
				}
				else 
				{
					array_push($data,  $myData);
				}

				$myData = new Data();
				$myData->id_joueur = $row["id"];
				$myData->name = utf8_encode_function($row["nom"]);
				$myData->hidden = true;
				$myData->data = array();
			}

			array_push($myData->data,  new DataSet($row["date"], $row["rang"]));
			
			$currentName = $name;
		}
		
		array_push($data,  $myData);
	}
	else
	{
		$qry = "SELECT * FROM historic_rang
		LEFT JOIN joueurs on joueurs.id_joueur = historic_rang.id_owner
		 where type = '$classement'
		 ORDER BY joueurs.surnom, date";
		$result = mysqli_query($con, $qry);
		$currentName = "";
		$data = array();
		$myData = new Data();
		$myData->data = array();
		$first = true;

		while ($row = mysqli_fetch_array($result)) 
		{
			$name = $row["surnom"];
			if ($currentName != $name) {
				if ($first)
				{
					$first = false;
				}
				else 
				{
					array_push($data,  $myData);
				}

				$myData = new Data();
				$myData->id_joueur = $row["id_joueur"];
				$myData->name = $row["surnom"];
				$myData->hidden = !(intval($row["id_joueur"]) == $id);
				$myData->data = array();
			}

			array_push($myData->data,  new DataSet($row["date"], $row["rang"]));
			
			$currentName = $name;
		}
		
		array_push($data,  $myData);		
	}

	echo json_encode($data, JSON_PRETTY_PRINT);
?>