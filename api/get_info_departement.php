<?php 
require("includes/fonctions.php");
require("config/database.php");

set_time_limit(120000);

$id_departement = explode("-", htmlspecialchars($_REQUEST['id']))[1];
	if(strpos($id_departement, '2a') !== false){
		$id_departement= '210';
	}
	if(strpos($id_departement, '2b') !== false){
		$id_departement= '211';
	}

$json= [];


$json["loyer"]= get_info_loyer_by_departement($id_departement,2018);
$json["cambriolage"]=get_total_crime_by_id_categorie_and_departement(27,$id_departement,2019) + get_total_crime_by_id_categorie_and_departement(28,$id_departement,2019);
$json["blessure"]=get_total_crime_by_id_categorie_and_departement(6,$id_departement,2019) + get_total_crime_by_id_categorie_and_departement(7,$id_departement,2019);
$json["violation_domicile"]=get_total_crime_by_id_categorie_and_departement(14,$id_departement,2019);
$json["harcelement"]=get_total_crime_by_id_categorie_and_departement(48,$id_departement,2019)+get_total_crime_by_id_categorie_and_departement(49,$id_departement,2019)+get_total_crime_by_id_categorie_and_departement(46,$id_departement,2019)+get_total_crime_by_id_categorie_and_departement(47,$id_departement,2019);
$json["stupefiant"]=get_total_crime_by_id_categorie_and_departement(55,$id_departement,2019)+get_total_crime_by_id_categorie_and_departement(56,$id_departement,2019)+get_total_crime_by_id_categorie_and_departement(57,$id_departement,2019);
$json["escroqueries"]=get_total_crime_by_id_categorie_and_departement(91,$id_departement,2019);
$json["population"]=get_departement_by_id($id_departement)->Nb_hab;

//$json["nb-min"]=$min;
echo json_encode($json);
?>