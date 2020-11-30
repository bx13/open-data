<?php
	require("includes/fonctions.php");
	require("config/database.php");

set_time_limit(120000);

$nb=0;
$nbi=0;
$annee=2019;
$mois=9;

$data = get_total_crime_by_annee_and_departement($annee);
$rang=1;
foreach ($data as $item){

	if (!this_classement_already_exist($item->ID_Departement,$annee,$mois)) { // date derniere donnee

		insert_classement($item->ID_Departement,$annee,$mois,$rang,null,null,$item->Nb_crime);
		$nb++;
	} else {
		update_classement_securite($item->ID_Departement,$annee,$mois,$rang,$item->Nb_crime);
		$nbi++;
	}
	
	$rang++;
}
echo $nb.' classement(s) ajouté!  <br>';
echo $nbi.'classement(s) mis à jour!  \n  ';
