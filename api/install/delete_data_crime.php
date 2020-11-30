<?php
	require("../includes/fonctions.php");
	require("../config/database.php");

set_time_limit(120000);

//delete_historique_criminalite_by_id_departement(56);
$departements= get_all_departement();
foreach ($departements as $item){
	$nb= get_nb_crime_by_departement($item->ID_Departement);
	
	echo '<p>'.$item->ID_Departement.' : '.$nb.' libelle de crime(s) ajouté!  <br><p>';
	
}
