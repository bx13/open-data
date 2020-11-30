<?php
	require("../includes/fonctions.php");
	require("../config/database.php");


if(isset($_POST)){
	extract($_POST);
	$data = json_decode($data);
	$nb=0;
	$nbi=0;
	foreach ($data as $item){
		$ID_Departement= $item->code_departement;
		if(strpos($ID_Departement, '2A') !== false){
				$ID_Departement= '210';
			}
			if(strpos($ID_Departement, '2B') !== false){
				$ID_Departement= '211';
			}
		if (!this_departement_already_exist($ID_Departement)) {
			insert_departement($ID_Departement,$item->nom_departement,0);
			$nb++;
		}else{
			update_nom_departement($ID_Departement,$item->nom_departement);
			$nbi++;
		}
		
	}
	echo $nb.' élément(s) ajouté!';
	echo $nbi.' élément(s) mis à jour!';
	
} else {
	echo 'Error';
}