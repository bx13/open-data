<?php
	require("../includes/fonctions.php");
	require("../config/database.php");


if(isset($_POST)){
	extract($_POST);
	$data = json_decode($data);
	$nb=0;
	$nbi=0;
	foreach ($data as $item){
		
		$ID_Departement= $item->{'ï»¿Code DÃ©partement'}; // Mauvaise gestion de caractere UTF-8
		$nom_Departement = $item->{'DÃ©partement'};
		
		if(strpos($ID_Departement, '2A') !== false){
				$ID_Departement= '210';
			}
			if(strpos($ID_Departement, '2B') !== false){
				$ID_Departement= '211';
			}
		if (!this_departement_already_exist($ID_Departement)) {
			insert_departement($ID_Departement,$nom_Departement,$item->{'Population'});
			$nb++;
		} else {
			update_population_departement($ID_Departement,$item->{'Population'});
			$nbi++;
		}
		
	}
	echo $nb.' élément(s) ajouté! <br>';
	echo $nbi.' élément(s) mis à jour!';
	
} else {
	echo 'Error';
}