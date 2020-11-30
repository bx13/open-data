<?php

if(!function_exists('get_departement_by_id')){
	function get_departement_by_id($id){
		
			global $db;
		
			$q=$db->prepare('SELECT * FROM departement WHERE ID_Departement=?');// on ecrit le nom de tous les champs qu'on veut recuperer
		$q->execute([$id]);
		
		$data = current($q->fetchAll(PDO::FETCH_OBJ));
		$q->closeCursor();
		
		
		return $data;
		
	
	
}
}
if(!function_exists('this_departement_already_exist')){
	function this_departement_already_exist($id){
		
			global $db;
		
			$q=$db->prepare('SELECT * FROM departement WHERE ID_Departement=?');// on ecrit le nom de tous les champs qu'on veut recuperer
		$q->execute([$id]);
		
		$count= $q->rowCount();
		
		$q->closeCursor();
		
		return $count;
		
	
	
}
}
if(!function_exists('this_categorie_crime_already_exist')){
	function this_categorie_crime_already_exist($id){
		
			global $db;
		
			$q=$db->prepare('SELECT * FROM categorie_crime WHERE ID_Categorie_crime=?');// on ecrit le nom de tous les champs qu'on veut recuperer
		$q->execute([$id]);
		
		$count= $q->rowCount();
		
		$q->closeCursor();
		
		return $count;
		
	
	
}
}

if(!function_exists('this_agglomeration_already_exist')){
	function this_agglomeration_already_exist($id){
		
			global $db;
		
			$q=$db->prepare('SELECT * FROM agglomeration WHERE ID_Agglomeration=?');// on ecrit le nom de tous les champs qu'on veut recuperer
		$q->execute([$id]);
		
		$count= $q->rowCount();
		
		$q->closeCursor();
		
		return $count;
		
	
	
}
}

if(!function_exists('this_classement_already_exist')){
	function this_classement_already_exist($ID_Departement,$Annee,$Mois){
		
			global $db;
		
			$q=$db->prepare('SELECT * FROM classement WHERE Annee=? AND Mois=? AND ID_Departement=?');// on ecrit le nom de tous les champs qu'on veut recuperer
		$q->execute([$Annee,$Mois,$ID_Departement]);
		
		$count= $q->rowCount();
		
		$q->closeCursor();
		
		return $count;
		
	
	
}
}

if(!function_exists('insert_classement')){
	function insert_classement($ID_Departement,$Annee,$Mois,$Securite,$Cout_de_vie,$Prix_metre_carre,$Nb_Crime){

			global $db;
		
		$q=$db->prepare("INSERT INTO classement(ID_Departement,Annee,Mois,Securite,Cout_de_vie,Prix_metre_carre,Nb_Crime) VALUES(?,?,?,?,?,?,?) ");// on ecrit le nom de tous les champs qu'on veut recuperer
		$q->execute([$ID_Departement,$Annee,$Mois,$Securite,$Cout_de_vie,$Prix_metre_carre,$Nb_Crime]);
		
		
		
		$q->closeCursor();
}
}
if(!function_exists('update_population_departement')){
	function update_population_departement($ID_Departement,$Nb_hab){
		global $db;
		
		$q = $db->prepare("UPDATE departement SET Nb_hab=? WHERE ID_Departement=? ");
			$q->execute([$Nb_hab,$ID_Departement]);
			
}
}
if(!function_exists('update_nom_departement')){
	function update_nom_departement($ID_Departement,$Nom){
		global $db;
		
		$q = $db->prepare("UPDATE departement SET Nom=? WHERE ID_Departement=? ");
			$q->execute([$Nom,$ID_Departement]);
			
}
}
if(!function_exists('update_classement_securite_par_hab')){
	function update_classement_securite_par_hab($ID_Departement,$Annee,$Mois,$Securite_par_hab,$Nb_crime_par_hab){
		global $db;
		
		$q = $db->prepare("UPDATE classement SET Securite_par_hab=?,Nb_crime_par_hab=? WHERE ID_Departement=? AND Annee=? AND Mois=?");
			$q->execute([$Securite_par_hab,$Nb_crime_par_hab,$ID_Departement,$Annee,$Mois]);
			
}
}
if(!function_exists('update_classement_securite')){
	function update_classement_securite($ID_Departement,$Annee,$Mois,$Securite,$Nb_Crime){
		global $db;
		
		$q = $db->prepare("UPDATE classement SET Securite=?,Nb_crime=? WHERE ID_Departement=? AND Annee=? AND Mois=?");
			$q->execute([$Securite,$Nb_Crime,$ID_Departement,$Annee,$Mois]);
			
}
}
if(!function_exists('update_classement_loyer')){
	function update_classement_loyer($ID_Departement,$Annee,$Mois,$Cout_de_vie,$Prix_metre_carre){
		global $db;
		
		$q = $db->prepare("UPDATE classement SET Cout_de_vie=?,Prix_metre_carre=? WHERE ID_Departement=? AND Annee=? AND Mois=?");
			$q->execute([$Cout_de_vie,$Prix_metre_carre,$ID_Departement,$Annee,$Mois]);
			
}
}
if(!function_exists('update_prix_metre_carre')){
	function update_prix_metre_carre(){
		global $db;
		
		$q = $db->prepare("UPDATE observatoire SET Prix_metre_carre= Loyer_mensuel_moyen/Surface_moyenne");
			$q->execute();
			
}
}
if(!function_exists('insert_departement')){
	function insert_departement($ID_Departement,$Nom,$Nb_hab){

			global $db;
		
		$q=$db->prepare("INSERT INTO departement(ID_Departement,Nom,Nb_hab) VALUES(?,?,?) ");// on ecrit le nom de tous les champs qu'on veut recuperer
		$q->execute([$ID_Departement,$Nom,$Nb_hab]);
		
		
		
		$q->closeCursor();
}
}
if(!function_exists('insert_categorie_crime')){
	function insert_categorie_crime($ID_Categorie_crime,$Libelle){

			global $db;
		
		$q=$db->prepare("INSERT INTO categorie_crime(ID_Categorie_crime,Libelle) VALUES(?,?) ");// on ecrit le nom de tous les champs qu'on veut recuperer
		$q->execute([$ID_Categorie_crime,$Libelle]);
		
		
		
		$q->closeCursor();
}
}
if(!function_exists('insert_historique_criminalite')){
	function insert_historique_criminalite($ID_Departement,$ID_Categorie_crime,$Annee,$Mois,$Nb_crime){

			global $db;
		
		$q=$db->prepare("INSERT INTO historique_criminalite(ID_Departement,ID_Categorie_crime,Annee,Mois,Nb_crime) VALUES(?,?,?,?,?) ");// on ecrit le nom de tous les champs qu'on veut recuperer
		$q->execute([$ID_Departement,$ID_Categorie_crime,$Annee,$Mois,$Nb_crime]);
		
		
		
		$q->closeCursor();
}
}

if(!function_exists('insert_agglomeration')){
	function insert_agglomeration($ID_Agglomeration,$ID_Departement,$Nom){

			global $db;
		
		$q=$db->prepare("INSERT INTO agglomeration(ID_Agglomeration,ID_Departement,Nom) VALUES(?,?,?) ");// on ecrit le nom de tous les champs qu'on veut recuperer
		$q->execute([$ID_Agglomeration,$ID_Departement,$Nom]);
		
		
		
		$q->closeCursor();
}
}
if(!function_exists('insert_agglomeration')){
	function insert_agglomeration($ID_Agglomeration,$ID_Departement,$Nom){

			global $db;
		
		$q=$db->prepare("INSERT INTO agglomeration(ID_Agglomeration,ID_Departement,Nom) VALUES(?,?,?) ");// on ecrit le nom de tous les champs qu'on veut recuperer
		$q->execute([$ID_Agglomeration,$ID_Departement,$Nom]);
		
		
		
		$q->closeCursor();
}
}
if(!function_exists('insert_observatoire')){
	function insert_observatoire($ID_Agglomeration,$Annee,$Zone,$Type_habitat,$Epoque_construction,$Anciennete_locataire_homogene,$Nb_piece,$Loyer_mensuel_moyen,$Surface_moyenne,$Nb_logement,$Prix_metre_carre){

			global $db;
		
		$q=$db->prepare("INSERT INTO observatoire(ID_Agglomeration,Annee,Zone,Type_habitat,Epoque_construction,Anciennete_locataire_homogene,Nb_piece,Loyer_mensuel_moyen,Surface_moyenne,Nb_logement,Prix_metre_carre) VALUES(?,?,?,?,?,?,?,?,?,?,?) ");// on ecrit le nom de tous les champs qu'on veut recuperer
		$q->execute([$ID_Agglomeration,$Annee,$Zone,$Type_habitat,$Epoque_construction,$Anciennete_locataire_homogene,$Nb_piece,$Loyer_mensuel_moyen,$Surface_moyenne,$Nb_logement,$Prix_metre_carre]);
		
		
		
		$q->closeCursor();
}
}
if(!function_exists('get_nb_crime_by_departement')){
	function get_nb_crime_by_departement($id){
		
			global $db;
		
			$q=$db->prepare('SELECT * FROM historique_criminalite WHERE ID_Departement=?');// on ecrit le nom de tous les champs qu'on veut recuperer
		$q->execute([$id]);
		
		$count= $q->rowCount();
		
		$q->closeCursor();
		
		return $count;
		
	
	
}
}
if(!function_exists('delete_historique_criminalite_by_id_departement')){
	function delete_historique_criminalite_by_id_departement($id){
		
			global $db;
		
		$q=$db->prepare("DELETE FROM historique_criminalite WHERE ID_Departement =?");// on ecrit le nom de tous les champs qu'on veut recuperer
		$q->execute([$id]);
		
		$q->closeCursor();
		
		
	
}
}
if(!function_exists('get_all_departement')){
	function get_all_departement(){
		
			global $db;
		
			$q=$db->prepare('SELECT * FROM departement');// on ecrit le nom de tous les champs qu'on veut recuperer
		$q->execute();
		$data= $q->fetchAll(PDO::FETCH_OBJ);
		$q->closeCursor();
		
		
		return $data;
	
		
	
	
}
}
if(!function_exists('get_total_crime_by_departement')){
	function get_total_crime_by_departement(){
		
			global $db;
		
			$q=$db->prepare('SELECT d.ID_Departement,(Select sum(h.Nb_crime*c.Coeff) FROM historique_criminalite h INNER JOIN categorie_crime c ON h.ID_Categorie_crime = c.ID_Categorie_crime WHERE c.Coeff > 0 AND d.ID_Departement = h.ID_Departement AND h.Annee > 2017 ) as Nb_crime FROM departement d WHERE Pris_en_compte = 1 ORDER BY Nb_crime ASC');// on ecrit le nom de tous les champs qu'on veut recuperer
		$q->execute();
		$data= $q->fetchAll(PDO::FETCH_OBJ);
		$q->closeCursor();
		
		
		return $data;
	
		
	
	
}
}
if(!function_exists('get_total_crime_by_departement')){
	function get_total_crime_by_departement(){
		
			global $db;
		
			$q=$db->prepare('SELECT d.ID_Departement,(Select sum(h.Nb_crime*c.Coeff) FROM historique_criminalite h INNER JOIN categorie_crime c ON h.ID_Categorie_crime = c.ID_Categorie_crime WHERE c.Coeff > 0 AND d.ID_Departement = h.ID_Departement AND h.Annee > 2017 ) as Nb_crime FROM departement d WHERE Pris_en_compte = 1 ORDER BY Nb_crime ASC');// on ecrit le nom de tous les champs qu'on veut recuperer
		$q->execute();
		$data= $q->fetchAll(PDO::FETCH_OBJ);
		$q->closeCursor();
		
		
		return $data;
	
		
	
	
}
}
if(!function_exists('get_prix_loyer_by_annee_and_departement')){
	function get_prix_loyer_by_annee_and_departement($annee){
		
			global $db;
		
			$q=$db->prepare('SELECT d.ID_Departement,(Select sum(o.Prix_metre_carre)/ count(o.Prix_metre_carre) FROM observatoire o INNER JOIN agglomeration a ON o.ID_Agglomeration = a.ID_Agglomeration WHERE d.ID_Departement = a.ID_Departement AND o.Annee >= ? AND Zone IS NULL AND Type_habitat IS NULL AND Epoque_construction IS NULL AND Anciennete_locataire_homogene IS NULL AND Nb_piece IS NULL AND  o.Prix_metre_carre > 0  GROUP BY o.Annee ORDER BY o.Annee DESC LIMIT 1) as Prix_loyer FROM departement d WHERE Pris_en_compte = 1 ORDER BY Prix_loyer ASC');// on ecrit le nom de tous les champs qu'on veut recuperer
		$q->execute([$annee]);
		$data= $q->fetchAll(PDO::FETCH_OBJ);
		$q->closeCursor();
		
		
		return $data;
	
		
	
	
}
}
if(!function_exists('get_classement_all_departement')){
	function get_classement_all_departement($annee,$mois){
		
			global $db;
		
			$q=$db->prepare('SELECT * FROM classement WHERE Annee=? AND Mois=?');// on ecrit le nom de tous les champs qu'on veut recuperer
		$q->execute([$annee,$mois]);
		$data= $q->fetchAll(PDO::FETCH_OBJ);
		$q->closeCursor();
		
		
		return $data;
	
		
	
	
}
}
if(!function_exists('get_info_loyer_by_departement')){
	function get_info_loyer_by_departement($id,$annee){
		
			global $db;
		
			$q=$db->prepare('Select sum(o.Loyer_mensuel_moyen)/ count(o.Loyer_mensuel_moyen) as Loyer_mensuel_moyen, sum(o.Surface_moyenne)/ count(o.Surface_moyenne) as Surface_moyenne, sum(o.Nb_logement) as Nb_logement FROM observatoire o INNER JOIN agglomeration a ON o.ID_Agglomeration = a.ID_Agglomeration WHERE a.ID_Departement=? AND o.Annee >= ? AND Zone IS NULL AND Type_habitat IS NULL AND Epoque_construction IS NULL AND Anciennete_locataire_homogene IS NULL AND Nb_piece IS NULL AND  o.Prix_metre_carre > 0  GROUP BY o.Annee ORDER BY o.Annee DESC LIMIT 1');// on ecrit le nom de tous les champs qu'on veut recuperer
		$q->execute([$id,$annee]);
		$data= current($q->fetchAll(PDO::FETCH_OBJ));
		$q->closeCursor();
		
		
		return $data;
	
		
	
	
}
}
if(!function_exists('get_total_crime_by_id_categorie_and_departement')){
	function get_total_crime_by_id_categorie_and_departement($id_categorie,$id_departement,$annee){
		
			global $db;
		
			$q=$db->prepare('Select sum(h.Nb_crime) as Nb_crime FROM historique_criminalite h INNER JOIN categorie_crime c ON h.ID_Categorie_crime = c.ID_Categorie_crime WHERE c.ID_Categorie_crime =? AND h.ID_Departement=? AND h.Annee = ? ');// on ecrit le nom de tous les champs qu'on veut recuperer
		$q->execute([$id_categorie,$id_departement,$annee]);
		$data= current($q->fetchAll(PDO::FETCH_OBJ));
		$q->closeCursor();
		
		
		return $data->Nb_crime;
	
		
	
	
}
}

if(!function_exists('get_total_crime_by_annee_and_departement')){
	function get_total_crime_by_annee_and_departement($annee){
		
			global $db;
		
			$q=$db->prepare('SELECT d.ID_Departement,(Select sum(h.Nb_crime*c.Coeff) FROM historique_criminalite h INNER JOIN categorie_crime c ON h.ID_Categorie_crime = c.ID_Categorie_crime WHERE c.Coeff > 0 AND d.ID_Departement = h.ID_Departement AND h.Annee = ? ) as Nb_crime FROM departement d WHERE Pris_en_compte = 1 ORDER BY Nb_crime ASC');// on ecrit le nom de tous les champs qu'on veut recuperer
		$q->execute([$annee]);
		$data= $q->fetchAll(PDO::FETCH_OBJ);
		$q->closeCursor();
		
		
		return $data;
	
		
	
	
}
}
if(!function_exists('get_total_crime_par_hab_by_annee_and_departement')){
	function get_total_crime_par_hab_by_annee_and_departement($annee,$mois){
		
			global $db;
		
			$q=$db->prepare('SELECT d.ID_Departement,(Select c.Nb_crime/d.Nb_hab*1000 FROM classement c WHERE d.ID_Departement = c.ID_Departement AND c.Annee = ? AND c.Mois = ? ) as Nb_crime_par_hab FROM departement d WHERE Pris_en_compte = 1 ORDER BY Nb_crime_par_hab ASC');// on ecrit le nom de tous les champs qu'on veut recuperer
		$q->execute([$annee,$mois]);
		$data= $q->fetchAll(PDO::FETCH_OBJ);
		$q->closeCursor();
		
		
		return $data;
	
		
	
	
}
}
