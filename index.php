<!DOCTYPE html>
<html>
  <head>
	  <meta charset="utf-8">
	  <meta http-equiv="X-UA-Compatible" content="IE=edge">
	  <meta name="viewport" content="width=device-width, user-scalable=no, shrink-to-fit=no">
    <title>Loge-Secure | France</title>
    <link href="jqvmap/dist/jqvmap.css" media="screen" rel="stylesheet" type="text/css">
    <link href="css/style.css" media="screen" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="jqvmap/dist/jquery.vmap.js"></script>
    <script type="text/javascript" src="jqvmap/dist/maps/jquery.vmap.france.js" charset="utf-8"></script>
	  
    <script type="text/javascript" src="js/jquery.nicescroll.min.js" charset="utf-8"></script>

    <script type="text/javascript">
		var $json=null,$info_json=null;
		 var emoji = {
          good: escapeXml('🤗'),
          incertain:  escapeXml('🤔'),
          flippant:  escapeXml('😰'),
          diabolique:  escapeXml('😈'),
        };
      function escapeXml(string) {
        return string.replace(/[<>]/g, function (c) {
          switch (c) {
            case '<': return '\u003c';
            case '>': return '\u003e';
          }
        });
      } 
	var hex = function(x) {
			x = x.toString(16);
			return (x.length == 1) ? '0' + x : x;
		};
	function get_color(nb,max,complement,type=0) {
		var color1 = 'FF0000';
		var color2 = '00FF00';
		var ratio;
		if (type==0) {
		   	ratio= nb/parseFloat(max) * (1+ complement);
		   } else {
			   //
		   }
		
		
		if (ratio>1){
			ratio=1;
		}

		var r = Math.ceil(parseInt(color1.substring(0,2), 16) * ratio + parseInt(color2.substring(0,2), 16) * (1-ratio));
		var g = Math.ceil(parseInt(color1.substring(2,4), 16) * ratio + parseInt(color2.substring(2,4), 16) * (1-ratio));
		var b = Math.ceil(parseInt(color1.substring(4,6), 16) * ratio + parseInt(color2.substring(4,6), 16) * (1-ratio));

		return hex(r) + hex(g) + hex(b);	  
	 }
      function get_type_emoji(securite) {
		  var type_emoji='good';
		  if (securite>15 && securite<=50) {
					  type_emoji='incertain';
				  }
				  if (securite>50 && securite<=80) {
					  type_emoji='flippant';
				  }
				  if (securite>80) {
					  type_emoji='diabolique';
				  }
        return type_emoji;
      }
		 function get_classement() {
	 
				var xmlhttp;
			var $lien='api/get_classement_all_departement.php';
				if (window.XMLHttpRequest) {
					// code for modern browsers		

					xmlhttp = new XMLHttpRequest();

				 } else {
					// code for old IE browsers

					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");

				} 
				 xmlhttp.onreadystatechange = function(){

					 if (this.readyState == 4 && this.status == 200){
						//$('#exceltable').hide();
						// alert(this.responseText);
						  $json= JSON.parse(this.responseText);
						 console.log($json);
						  
					 }
				 };
				 xmlhttp.open("GET", $lien, true);

					xmlhttp.send();
     
	 
 }
		 function get_info_departement(code) {
	 		$('#view_more .content').html('<div class="center w-100"><img class="loader" src="api/install/data/loader.gif" alt=""><div>');
				var xmlhttp;
			var $lien='api/get_info_departement.php?id='+code;
				if (window.XMLHttpRequest) {
					// code for modern browsers		

					xmlhttp = new XMLHttpRequest();

				 } else {
					// code for old IE browsers

					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");

				} 
				 xmlhttp.onreadystatechange = function(){

					 if (this.readyState == 4 && this.status == 200){
						//$('#exceltable').hide();
						// alert(this.responseText);
						  $info_json= JSON.parse(this.responseText);
						 console.log($info_json);
						 var rang_s,rang_sh,rang_l,type_emoji,nb_logement;
						 if (code=="fr-2a"){
							  code = "fr-210";
						  }
						  if (code=="fr-2b"){
							  code = "fr-211";
						  }
				  
						  if ($json[code]['Securite']==1) {
							  rang_s='1er';

						  } else {
							  rang_s= $json[code]['Securite']+'ème';
						  }
						 
						  if ($json[code]['Securite_par_hab']==1) {
							  rang_sh='1er';

						  } else {
							  rang_sh= $json[code]['Securite_par_hab']+'ème';
						  }
						 if ($json[code]['Cout_de_vie']== null) {
							  rang_l= null;
						  }else if ($json[code]['Cout_de_vie']==1) {
							  rang_l='1er';
						  } else {
							  rang_l= $json[code]['Cout_de_vie']+'ème';
						  }
						 if ($info_json["loyer"]["Nb_logement"]== null) {
							 	nb_logement = '?';
							 } else {
								 nb_logement = $info_json["loyer"]["Nb_logement"];
							 }
						 type_emoji=get_type_emoji($json[code]['Securite']);
						 var $logement;
						 if ($info_json['loyer']["Surface_moyenne"] == null){
							 $logement ='<div class="center"><em>Aucune information disponible</em></div>';
						 } else{
							 $logement ='<div> Loyer moyen par m<sup>2</sup> : <span >'+parseFloat($json[code]['Prix_metre_carre']).toFixed(2)+'€</span> </div>	\
								<div>Loyer mensuel moyen : <span>'+$info_json["loyer"]["Loyer_mensuel_moyen"]+'€</span></div>	\
								<div>Surface moyenne : '+$info_json["loyer"]["Surface_moyenne"]+' m<sup>2</sup></div>	\
								<div>Nombre de logement : '+nb_logement+'</div>	\
								<div>Population : '+$info_json["population"]+'</div>	\
								<div>Classement : <span>'+rang_l+'</span></div>	';
						 }
						 $('#view_more .content').html(' <div class="emoji center">'+emoji[type_emoji]+'</div> \
							<div class="logement">	\
								<div class="titre s-bold center">Statistique de logement</div>	\
								'+$logement+'\
							</div>	\
							<div class="securite">	\
								<div class="titre s-bold center">Statistique de Sécurité</div>	\
								<div>Cambriolage : '+$info_json["cambriolage"]+'</div>	\
								<div>Coût et blessure : '+$info_json["blessure"]+'</div>	\
								<div>Violation de domicile : '+$info_json["violation_domicile"]+'</div>	\
								<div>Harcelement sexuel, agression sexuelle ou viol : '+$info_json["harcelement"]+'</div>	\
								<div>Usage de stupéfiant : '+$info_json["stupefiant"]+'</div>	\
								<div>Escroqueries et abus de confiance : '+$info_json["escroqueries"]+'</div>	\
								<div>Classement général : <span>'+rang_s+'</span></div>	\
								<div>Classement par habitant : <span>'+rang_sh+'</span></div>	\
								<p></p>	\
							</div>');
							 $(".nice_scroll").getNiceScroll().resize();
						 $(".nice_scroll").getNiceScroll(0).doScrollTop(0, 0);
							  
						  
					 }
				 };
				 xmlhttp.open("GET", $lien, true);

					xmlhttp.send();
     
	 
 }
    jQuery(document).ready(function() {
	  get_classement();
      var pins = {
        };
     
      jQuery('#vmap').vectorMap({
          map: 'france_fr',
          enableZoom: true,
          showTooltip: true,
          backgroundColor: '#333',
          borderColor: '#333',
          pins: pins,
          color: '#fff',
          pinMode: 'content',
          selectedColor: '#64d6d6',
          hoverColor: '#d9f5f5',
          hoverOpacity: null,
          normalizeFunction: 'linear',
          selectedRegions: '#64d6d6',
          onRegionClick: function(element, code, region)
          {
             
			  $('#view_more').addClass('open nice_scroll');
			  $('#view_more .header span').html(region);
			  get_info_departement(code);
			  
			  
			  //$('#view_more .logement').html(message);
          },
          onLabelShow: function(event, label, code)
          {	
			  if (code=="fr-2a"){
				  code = "fr-210";
			  }
			  if (code=="fr-2b"){
				  code = "fr-211";
			  }
			  console.log(code);
			 
			  
			  if ($json != null) {
				  console.log($json[code]);
			  	  console.log($json[code].Securite);
				  console.log($json[code]['Securite']);
				  var rang_s,rang_sh,rang_l,type_emoji;
				  
				  if ($json[code]['Securite']==1) {
					  rang_s='1er';
					  
				  } else {
					  rang_s= $json[code]['Securite']+'ème';
				  }
				  if ($json[code]['Securite_par_hab']==1) {
					  rang_sh='1er';
					  
				  } else {
					  rang_sh= $json[code]['Securite_par_hab']+'ème';
				  }
				  
				  if ($json[code]['Cout_de_vie']== null) {
					  rang_l= null;
				  }else if ($json[code]['Cout_de_vie']==1) {
					  rang_l='1er';
				  } else {
					  rang_l= $json[code]['Cout_de_vie']+'ème';
				  }
				  var content_cout_de_vie='';
				  if(rang_l!= null) {
					  content_cout_de_vie= '<div class="cout_vie bold left bold ml-30">Coût de la vie : <span class="s-bold">'+rang_l+'</span> </div><div class="loyer bold left ml-30"> Loyer moyen par m<sup>2</sup> : <span class="s-bold">'+parseFloat($json[code]['Prix_metre_carre']).toFixed(2)+'€</span> </div>';
				  }
				  type_emoji=get_type_emoji($json[code]['Securite']);
				  label.html('<div class="map-details"><div class="emoji">'+emoji[type_emoji]+'</div><div class="nom-departement s-bold">'+label.text()+'</div><div class="classement bold italic">Classement : </div><div class="securite bold left ml-30"> Indice securité : <span class="s-bold">'+rang_s+'</span> </div><div class="securite bold left ml-30"> Securité / hab : <span class="s-bold">'+rang_sh+'</span> </div>'+content_cout_de_vie+' <div class="plus bold "> <a href="#" class="btn-detail" data-m-code="'+code+'">Loge-Secure</a></div></div>');
			  } else {
				  label.html('<div class="center w-100"> <img class="loader" src="api/install/data/loader.gif" alt=""><div>');
			  }
			  
              
          },
          onRegionOver: function(event, code)
          {
              if (code == 'ca')
              {
                  event.preventDefault();
              }
          },
      });
	  $('body').on("click","#close_view_more",function (e) {
		  	e.preventDefault();
			$('#view_more').removeClass('open');
		  	$('#view_more .content').html('<div class="center w-100"><img class="loader" src="api/install/data/loader.gif" alt=""><div>');
		  $(".nice_scroll").getNiceScroll().resize();
		});
		 $(document).on('change','#type_coloration',function(){
              var type=$("#type_coloration").val().trim();
			 change_coloration(type);
        });
		$('.nice_scroll').niceScroll({
									  cursorwidth:12,
									  cursoropacitymin:0.4,
									  cursorcolor:'#499a9a',
									  cursorborder:'none',
									  cursorborderradius:4,
									  autohidemode:'leave',
										cursorwidth: "6px",
										zindex: 0,
										autohidemode: true,
										railpadding: { top: 10, right: 4, left: 0, bottom: 10 }

								});
		
    });
		function change_coloration(type) {
			console.log('change_coloration');
			var complement;
			
			$.each( $json, function( key, value ) {
			  if(key!='crime-max' && key!='loyer-max') {
				  var code = key;
					  if (code=="fr-210"){
						  code ="fr-2a" ;
					  }
					  if (code=="fr-211"){
						  code = "fr-2b";
					  }
				  if (type=="crime"){
						complement = 3.65; //0.35
					  var color = get_color(value['Nb_crime'],$json['crime-max'],complement);
					  console.log(color);
					  console.log(key);
					  //$('#vmap').vectorMap('set', 'color', {key: '#'+color});
					  
					  $('#jqvmap1_'+code).attr('fill','#'+color).attr('original','#'+color);
					}
				  if (type=="crime-hab"){
						complement = 0.37;  //0.17
					  var color = get_color(value['Nb_crime_par_hab'],$json['crime-hab-max'],complement);
					  console.log(color);
					  console.log(key);
					  console.log(value['Nb_crime_par_hab']);
					  console.log($json['crime-hab-max']);
					  //$('#vmap').vectorMap('set', 'color', {key: '#'+color});
					  
					  $('#jqvmap1_'+code).attr('fill','#'+color).attr('original','#'+color);
					}
				  if(type=='observatoire') {
					  if (value['Cout_de_vie'] !== null) {
						  $('#jqvmap1_'+code).attr('fill','#9bc0c1').attr('original','#9bc0c1');
					  } else{
						  $('#jqvmap1_'+code).attr('fill','#fff').attr('original','#fff');
					  }
					  
				  }
				  if(type=='loyer') {
					  if (value['Cout_de_vie'] !== null) {
						  complement = 0.02;
					  		var color = get_color(value['Prix_metre_carre'],$json['loyer-max'],complement);
						  $('#jqvmap1_'+code).attr('fill','#'+color).attr('original','#'+color);
					  } else{
						  $('#jqvmap1_'+code).attr('fill','#fff').attr('original','#fff');
					  }
					  
				  }
				  if(type=='normal') {
					  $('#jqvmap1_'+code).attr('fill','#fff').attr('original','#fff');
				  }
				  
			  }
			});
			
		}
    </script>
  </head>
  <body>
	 <div id="div_select">
		 <select name="docs" id="type_coloration">
			<option value="">--Selectionner un coloration--</option>
			<option value="normal">Normal</option>
			<option value="crime">Criminalité</option>
			<option value="crime-hab">Crime par habitant</option>
			<option value="observatoire">Observatoire de loyer</option>
			<option value="loyer">Prix du loyer</option>
		</select>
	</div>
	 
    <div id="vmap"></div>
  	<div id="view_more" class="nice_scroll">
		<div class="header center s-bold">
			<span></span>
			<a href="#" id="close_view_more">x</a>
		</div>
		<div class="content ">
			
		</div>
  	</div>
  </body>
	
</html>
               