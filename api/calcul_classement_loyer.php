<?php
	require("includes/fonctions.php");
	require("config/database.php");

set_time_limit(120000);

$nb=0;
$nbi=0;
$annee=2019;
$mois=9;

$data = get_prix_loyer_by_annee_and_departement(2018); // A partir de 2018, on prend le plus reçent
$rang=1;
$last_prix=0;
$last_rang=1;
foreach ($data as $item){
	if ($item->Prix_loyer!= NULL){

		if ($item->Prix_loyer == $last_prix) {
			$rang_actuel = $last_rang;
		} else {
			$rang_actuel = $rang;
			$last_rang=$rang;
		}
		
		echo $rang_actuel." - Departement ".$item->ID_Departement." : ".$item->Prix_loyer." <br>";
		$last_prix = $item->Prix_loyer;
		if (!this_classement_already_exist($item->ID_Departement,$annee,$mois)) { // date derniere donnee

			insert_classement($item->ID_Departement,$annee,$mois,null,$rang_actuel,$item->Prix_loyer,null);
			$nb++;
		} else {
			update_classement_loyer($item->ID_Departement,$annee,$mois,$rang_actuel,$item->Prix_loyer);
			$nbi++;
		}


		$rang++;
	}
}
echo $nb.' classement(s) ajouté!  <br>';
echo $nbi.'classement(s) mis à jour!  \n  ';
