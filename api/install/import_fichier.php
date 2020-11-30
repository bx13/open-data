

<select name="docs" id="doc-select">
    <option value="">--Selectionner un dataset--</option>
    <option value="departement">Département</option>
    <option value="crime">Criminalité</option>
    <option value="loyer">Loyer</option>
    <option value="population">Population</option>
</select>

<input type="file" id="excelfile" name="file[]" multiple />  
   <input type="button" id="viewfile" value="Export To Table" onclick="ExportToTable()" />  
      <br />  
      <br />  
   <div id="exceltable">  
	   <img src="data/loader.gif" alt="">
</div> 
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.7.7/xlsx.core.min.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/xls/0.7.4-a/xls.core.min.js"></script>  
<script type="text/javascript">
	var type_doc = $("#doc-select").val();
	var reader,index_actu;
	$('#exceltable').hide();
    function ExportToTable() {  
		$('#exceltable').show();
		index_actu=0;
       read_file(index_actu);
 }
	function read_file(index) {
		index_actu = index;
		var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.xlsx|.xls)$/;  
     /*Checks whether the file is a valid excel file*/  
		if (index >= $("#excelfile")[0].files.length) {
			return;
		}
		console.log($("#excelfile")[0].files[index]);
		var file_name= $("#excelfile")[0].files[index].name.toLowerCase();
	
     if (regex.test(file_name)) {  
         var xlsxflag = false; /*Flag for checking whether excel is .xls format or .xlsx format*/  
         if (file_name.indexOf(".xlsx") > 0) {  
             xlsxflag = true;  
         }  
         /*Checks whether the browser supports HTML5*/  
         if (typeof (FileReader) != "undefined") {  
             reader = new FileReader();  
             reader.onload = function (e) {  
				  $('#exceltable').append('<p>'+index+'- '+file_name+'</p>');
                 var data = e.target.result;  
                 /*Converts the excel data in to object*/  
                 if (xlsxflag) {  
                     var workbook = XLSX.read(data, { type: 'binary' });  
                 }  
                 else {  
                     var workbook = XLS.read(data, { type: 'binary' });  
                 }  
                 /*Gets all the sheetnames of excel in to a variable*/  
                 var sheet_name_list = workbook.SheetNames;  
  
                 var cnt = 0; /*This is used for restricting the script to consider only first sheet of excel*/  
                 sheet_name_list.forEach(function (y) { /*Iterate through all sheets*/  
                     /*Convert the cell value to Json*/  
					 if (cnt == 0) {
						 if (xlsxflag) {  
							 var exceljson = XLSX.utils.sheet_to_json(workbook.Sheets[y]);  
						 }  
						 else {  
							 var exceljson = XLS.utils.sheet_to_row_object_array(workbook.Sheets[y]);  
						 }  
						 if (exceljson.length > 0 && cnt == 0) {  
							 BindTable(exceljson,y, '#exceltable');  
							 cnt++;  
						 }  
					}
                 });  
                 $('#exceltable').show();  
             }  
             if (xlsxflag) {/*If excel file is .xlsx extension than creates a Array Buffer from excel*/  
                 reader.readAsArrayBuffer($("#excelfile")[0].files[index]);  
             }  
             else {  
                 reader.readAsBinaryString($("#excelfile")[0].files[index]);  
             }  
         }  
         else {  
            // alert("Sorry! Your browser does not support HTML5!");  
			 $('#exceltable').append('<p>Error HTML5</p>');
			 read_file(index+1);
         }  
     }  
     else {  
         //alert("Please upload a valid Excel file!"); 
		 $('#exceltable').append('<p>Error type file</p>');
			 read_file(index+1);
     }
	}
 function BindTable(jsondata,sheet_name, tableid) {/*Function used to convert the JSON array to Html Table*/ 
	 console.log($("#doc-select").val());
	 var type_data = $("#doc-select").val().trim();
	 console.log(jsondata);
	 var formData = new FormData(); 
			
			formData.append('data',JSON.stringify(jsondata));
			formData.append('sheet_name',sheet_name);
				var xmlhttp;
			var $lien='import_data_'+type_data+'.php';
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
						  $('#exceltable').append('<p>'+this.responseText+'</p>');
						 read_file(index_actu+1);
					 }
				 };
				 xmlhttp.open("POST", $lien, true);

					xmlhttp.send(formData);
     
	 
 }  

</script>