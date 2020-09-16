$(function() {
    $(".alert").fadeTo(10000, 500).slideUp(500, function(){
        $(".alert").alert('close');
    });
}); 
$(document).ready(function() {
	// Data Picker Initialization
	$('#pickadate').pickadate({
		format: 'yyyy-mm-dd',
	});
	$('#pickatime').pickatime({});
	$('.mdb-select').material_select();
});     