<?php 
require("includes/fonctions.php");
require("config/database.php");

set_time_limit(120000);


$json= [];
$data = get_classement_all_departement(2019,9);
$crime_max=0;
$crime_hab_max=0;
$loyer_max=0;

foreach ($data as $item){
	$id=$item->ID_Departement;
	if ($item->Nb_crime>$crime_max) {
		$crime_max= $item->Nb_crime;
	}
	if ($item->Nb_crime_par_hab>$crime_hab_max) {
		$crime_hab_max= $item->Nb_crime_par_hab;
	}
	if ($item->Prix_metre_carre>$loyer_max) {
		$loyer_max= $item->Prix_metre_carre;
	}
	if($id < 10) {
		$id = '0'.$id;
	}
	$json["fr-".$id] = $item;
}
$json["crime-max"]=$crime_max;
$json["crime-hab-max"]=$crime_hab_max;
$json["loyer-max"]=$loyer_max;
//$json["nb-min"]=$min;
echo json_encode($json);
?>