<?php
	require("../includes/fonctions.php");
	require("../config/database.php");

set_time_limit(120000);

if(isset($_POST)){
	extract($_POST);
	$data = json_decode($data);
	$nb=0;
	$nbi=0;
	$sheet_name = explode("-", $sheet_name);
	$sheet_name_lenth= sizeof($sheet_name);
	$ID_Departement = $sheet_name[$sheet_name_lenth-1];
	if(strpos($ID_Departement, '2A') !== false){
		$ID_Departement= '210';
	}
	if(strpos($ID_Departement, '2B') !== false){
		$ID_Departement= '211';
	}
	foreach ($data as $item){
		
		
		if (!this_categorie_crime_already_exist($item->Index)) {
			
			insert_categorie_crime($item->Index,$item->{'Libellé index'});
			$nb++;
		}
		$nb_mois=0;
		foreach ($item as $key=>$value){
			if ($key !='Index' && $key !='Libellé index'){
				$date = explode("_", $key);
				insert_historique_criminalite($ID_Departement,$item->Index,$date[0],$date[1],$value);
				$nbi++;
				$nb_mois++;
			}
			if ($nb_mois == 33) {
				break;    /* Vous pourriez aussi utiliser 'break 1;' ici. */
			}
		}
		
		
	}
	echo $nb.' libelle de crime(s) ajouté!  <br>
 ';
	echo $nbi.'crime(s) ajouté!  \n  ';
	
} else {
	echo 'Error';
}