<?php 
use Illuminate\Support\Facades\Session;
?>
@section('commonscripts')

<div class="modal fade" id="confirm-delete-modal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Delete Item</h4>
      </div>
      <div class="modal-body">
        <p>You are about to delete the item &hellip;</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" id="delete-ok" class="btn btn-primary">Ok</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="generic-alert" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Message</h4>
      </div>
      <div class="modal-body">
        <p></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>        
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">

$(document).ready(function(){
	var row=null;
	var id = null;
	var form = null;
	var url = null;
	var data=null;
	$('.btn-delete').click(function(e){
		row= $(this).parents('tr');
		id= row.data('id');
		form= $('#form-delete');
		url= form.attr('action').replace(':PERSON_ID', id);
		data= form.serialize();	
		$.fn.confirmDelete();
			
	});
	
	$('#form-delete').submit(function(e){
		e.preventDefault();
		$.fn.confirmDelete();
	});
	
	$.fn.confirmDelete=function (){
		 $("#confirm-delete-modal").modal('show');
	} 

	$("#delete-ok").click(function(){
		if(url !== null){
			$.post(url, data, function(result){	
				console.log(result);			
				if(result.code == "error"){
					//alert(result.message);
					$("#generic-alert .modal-body > p").text(result.message);
					$("#generic-alert").modal('show');
				}
				else
					row.fadeOut();
			}).fail(function(result){
				//alert(result);
				$("#generic-alert .modal-body > p").text(result.message);
				$("#generic-alert").modal('show');
			});
			 
		}
		else if($("#form-delete") !== null){
			$("#form-delete")[0].submit();						
		}
		$("#confirm-delete-modal").modal("hide");
	});

	var itemCounter = -1;
		
	addItem= function(el, container, jsonValues, namePrefix){
		if(itemCounter == -1)
			itemCounter = $("#" + container).children().length - 2;

		console.log("before add: "+ itemCounter + "item: " + el.name.split(namePrefix)[1]);
		
		if(el.name.split(namePrefix)[1] >= itemCounter){

			$("#form-group" + (itemCounter))
			.append('<a href="#" class="btn-remove-item"><span class="glyphicon glyphicon-minus-sign"></span>Remove</a>');
			
			itemCounter++;
			var selectElem= $('<select id="'+ namePrefix + itemCounter +'" name="'+ namePrefix + itemCounter +'" class="form-control"/>');
									
			var action= 'addItem(this,"' + container + '",' + JSON.stringify(jsonValues) + ',"' + namePrefix+'");'
			selectElem.attr('onchange', action);
			
			$(jsonValues).each(function(key, val){
					
				//console.log(val.key + "=>" +val.val);
				selectElem.append($('<option/>')
						.attr('value', val.key)						
						.text(val.val));	
			});		

			var newFormGroup= $('<div id="form-group' + itemCounter+ '" class="form-group"/>');
			newFormGroup.append(selectElem);
			$("#" + container).append(newFormGroup);	
		}
	};

	$(document).on('click', '.btn-remove-item', function(e){
		$(this).parent().remove();
	});

	$('#detailModal').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget); 
		var data = button.data('detail'); 
		var modal = $(this);
		for(key in data){
			var element=modal.find('#' + key); 
			if(element.is('input'))
				element.val(data[key]);
			else if(element.is('img'))
				element.attr('src',data[key]);
				
			console.log(key + " => " + data[key] );	
		}
				
			
		  //modal.find('.modal-title').text('New message to ' + recipient)
		  //modal.find('.modal-body input').val(recipient)
	})
	

});
</script>
@endsection