<?php
	require("includes/fonctions.php");
	require("config/database.php");

set_time_limit(120000);

update_prix_metre_carre();

echo 'mis à jour!  \n  ';
