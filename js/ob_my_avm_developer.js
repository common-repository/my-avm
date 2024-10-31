jQuery(document).ready(function($){

	$('#publishAvm').click(function(){
		var nav_address1 = $('#avm_address1').val();
		var nav_address2 = $('#avm_address2').val();
		var myavm_zip = $('#avm_zip').val();
		var myavm_text = $('#avm_text').val();
		var myavm_email = $('#avm_email').val();

		var error = 0;
		
		if(nav_address1 == ""){
			$('#avm_address1_err').text('This field is required');
			error++;
		}else if(nav_address1 !== ''){
			$('#avm_address1_err').text('');
		}
		
		if(nav_address2 == ""){
			$('#avm_address2_err').text('This field is required');
			error++;
		}else if(nav_address2 !== ''){
			$('#avm_address2_err').text('');
		}
		
		if(myavm_zip == ""){
			$('#avm_zip_err').text('This field is required');
			error++;
		}else if(myavm_zip !== ''){
			$('#avm_zip_err').text('');
		}
		
		if(myavm_zip == ""){
			$('#avm_zip_err').text('This field is required');
			error++;
		}else if(myavm_zip !== ''){
			$('#avm_zip_err').text('');
		}
		
		if(myavm_email == ""){
			$('#avm_email_err1').text('This field is required');
			error++;
		}else if(myavm_email !== ''){
			$('#avm_email_err1').text('');
		}
		
		if(error > 0){
			return false;
		}else{
			$("#myAvmForm").submit();
			return true;
		}
		
	});

});
function copy_myavm(element_id){
	
	var aux = document.createElement("div");
	aux.setAttribute("contentEditable", true);
	aux.innerHTML = document.getElementById(element_id).innerHTML;
	aux.setAttribute("onfocus", "document.execCommand('selectAll',false,null)"); 
	document.body.appendChild(aux);
	
	document.execCommand("copy");
	document.body.removeChild(aux);
	//var link = document.createElement("a");
	document.getElementById('copybtn').innerHTML ='Copied';
	
	return false;

}