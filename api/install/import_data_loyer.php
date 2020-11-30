<?php
	require("../includes/fonctions.php");
	require("../config/database.php");

set_time_limit(120000);

if(isset($_POST)){
	extract($_POST);
	$data = json_decode($data);
	$nb=0;
	$nbi=0;
	foreach ($data as $item){
		
		if (!empty($item->Observatory)){
			$ID_Agglomeration = substr(trim($item->Observatory),1);

			$ID_Departement= substr($ID_Agglomeration,0,-2);
			if(strpos($ID_Departement, '2A') !== false){
				$ID_Departement= '210';
			}
			if(strpos($ID_Departement, '2B') !== false){
				$ID_Departement= '211';
			}
			$nom_agglomeration = (empty($item->agglomeration))? null : $item->agglomeration;
			if (!this_agglomeration_already_exist($ID_Agglomeration)) {

				insert_agglomeration($ID_Agglomeration,$ID_Departement,$nom_agglomeration);
				$nb++;
			}

			$Data_year = (empty($item->Data_year))? null : $item->Data_year;
			$Zone_complementaire = (empty($item->Zone_complementaire))? null : $item->Zone_complementaire;
			$Type_habitat = (empty($item->Type_habitat))? null : $item->Type_habitat;
			$epoque_construction_homogene = (empty($item->epoque_construction_homogene))? null : $item->epoque_construction_homogene;
			$anciennete_locataire_homogene = (empty($item->anciennete_locataire_homogene))? null : $item->anciennete_locataire_homogene;
			$nombre_pieces_homogene = (empty($item->nombre_pieces_homogene))? null : $item->nombre_pieces_homogene;
			$nombre_logements = (empty($item->nombre_logements))? null : $item->nombre_logements;
			$loyer_moyen = (empty($item->loyer_moyen))? null : $item->loyer_moyen;
			$surface_moyenne = (empty($item->surface_moyenne))? null : $item->surface_moyenne;
			$moyenne_loyer_mensuel = (empty($item->moyenne_loyer_mensuel))? null : $item->moyenne_loyer_mensuel;

			insert_observatoire($ID_Agglomeration,$Data_year,$Zone_complementaire,$Type_habitat,$epoque_construction_homogene,$anciennete_locataire_homogene,$nombre_pieces_homogene,$moyenne_loyer_mensuel,$surface_moyenne,$nombre_logements,$loyer_moyen);
			$nbi++;

		}
	}
	echo $nb.' agglomeration ajouté!  <br>
 ';
	echo $nbi.'observatoire(s) ajouté!  \n  ';
	
} else {
	echo 'Error';
}