jQuery.noConflict();

jQuery(document).ready(function($) {

	 $(".add-questions").click(function () {
	 	var id = $(this).attr('id');
	 	var str ='';
	 	str +='<tr>';
	 	str +='<td><div style="cursor:pointer" data-toggle="collapse" data-target="#collapseme'+id+'"><span class="glyphicon glyphicon-plus"></span> - Question '+id+'</div></td>';
	 	str +='</tr>';
	 	str +='<tr>';
	 	str +='<td class="zeroPadding">';
	 	str +='<div class="collapse out" id="collapseme'+id+'">';
	 	str +='<div class="row"><div class="col-sm-6 col-md-6"><input type="text" class="form-control" name="question['+id+'][question]" value="" placeholder="Enter Question....."></div></div>';
	 	str +='<div class="row"><div class="col-sm-3 col-md-3"><h3>Answers</h3></div></div>';
	 	str +='<div class="row"><div class="col-sm-4 col-md-4"><input type="text" class="form-control" name="question['+id+'][answer][]" value="" placeholder="Questions....."></div><div class="col-sm-6 col-md-6"><label class="form-check-label col-md-6"><input type="radio" class="form-check-input" name="question['+id+'][is-correct]" id="optionsRadios1" value="0" checked="">is_correct ?</label></div></div>';
	 	str +='<div class="row" style="margin-top:10px;"><div class="col-sm-4 col-md-4"><input type="text" class="form-control" name="question['+id+'][answer][]" value="" placeholder="Questions....."></div><div class="col-sm-6 col-md-6"><label class="form-check-label col-md-6"><input type="radio" class="form-check-input" name="question['+id+'][is-correct]" id="optionsRadios1" value="1" checked="">is_correct ?</label></div></div>';
	 	str +='<div class="row" style="margin-top:10px;"><div class="col-sm-4 col-md-4"><input type="text" class="form-control" name="question['+id+'][answer][]" value="" placeholder="Questions....."></div><div class="col-sm-6 col-md-6"><label class="form-check-label col-md-6"><input type="radio" class="form-check-input" name="question['+id+'][is-correct]" id="optionsRadios1" value="2" checked="">is_correct ?</label></div></div>';
	 	str +='</div>';
	 	str +='</td>';
	 	str +='</tr>';
        $('#myTable tr:last').before(str);
   		var inr = parseInt(id) + 1;
	 	$(this).attr('id', inr);
     });

$(document).on('click',".input-req span.trash", function (event) {
		$(this).parent().parent().remove();
	});

$(".sector_delete").click(function(){
	if (confirm("Are you sure you want to delete this Item ?")) {
		var data = {
	          'action': 'del_data_byId',
	          'id' : this.id,
	          'table' : 'wp_sector'
	        };
	        // location.reload();
		$.post(ajaxurl,data, function(response){
		    // console.log(response);
		    location.reload();
		});
		return true;
	}
	return false;
});

$(".champion_delete").click(function(){
	if (confirm("Are you sure you want to delete this Item ?")) {
		var data = {
	          'action': 'del_data_byId',
	          'id' : this.id,
	          'table' : 'wp_champions'
	        };
	        // location.reload();
		$.post(ajaxurl,data, function(response){
		    // console.log(response);
		    location.reload();
		});
		return true;
	}
	return false;
});
$(".position_delete").click(function(){
	if (confirm("Are you sure you want to delete this Item ?")) {
		var data = {
	          'action': 'del_data_byId',
	          'id' : this.id,
	          'table' : 'wp_positions'
	        };
	        // location.reload();
		$.post(ajaxurl,data, function(response){
		    // console.log(response);
		    location.reload();
		});
		return true;
	}
	return false;
});

$(".function_delete").click(function(){
	if (confirm("Are you sure you want to delete this Item ?")) {
		var data = {
	          'action': 'del_data_byId',
	          'id' : this.id,
	          'table' : 'wp_function'
	        };
	        // location.reload();
		$.post(ajaxurl,data, function(response){
		    // console.log(response);
		    location.reload();
		});
		return true;
	}
	return false;
});

$(".title_delete").click(function(){
	if (confirm("Are you sure you want to delete this Item ?")) {
		var data = {
	          'action': 'del_data_byId',
	          'id' : this.id,
	          'table' : 'wp_job_title'
	        };
	        // location.reload();
		$.post(ajaxurl,data, function(response){
		    // console.log(response);
		    location.reload();
		});
		return true;
	}
	return false;
});

$("#add_more_req").click(function(e){
		
		var str ='<div stlyle="margin-top: 15px;" class="row input-req">';
		str +='<div class="col-sm-6 col-md-10">';
		str +='<input class="form-control" type="text" name="req[]" value="" placeholder="Enter Requirement ..." />';
        str +='</div>';
        str +='<div class="col-sm-6 col-md-2">';
        str +='<span id="trashii" class="dashicons dashicons-no trash"></span>';
        str +='</div>';
        str +='<br>';
        str +='</div>';
        
		$('#req_row').before(str);
	});
});