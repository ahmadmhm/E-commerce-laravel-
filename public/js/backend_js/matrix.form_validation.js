
$(document).ready(function(){
	
	$('input[type=checkbox],input[type=radio],input[type=file]').uniform();
	
	// $('select').select2();
	
	// Form Validation
    $("#basic_validate").validate({
		rules:{
			required:{
				required:true
			},
			email:{
				required:true,
				email: true
			},
			date:{
				required:true,
				date: true
			},
			url:{
				required:true,
				url: true
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});
	
	$("#number_validate").validate({
		rules:{
			min:{
				required: true,
				min:10
			},
			max:{
				required:true,
				max:24
			},
			number:{
				required:true,
				number:true
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});
	
	$("#password_validate").validate({
		rules:{
			current_pwd:{
				required: true,
				minlength:6,
				maxlength:20
			},
			new_pwd:{
				required: true,
				minlength:6,
				maxlength:20
			},
			confirm_pwd:{
				required: true,
				minlength:6,
				maxlength:20,
				equalTo:"#new_pwd"
			},
			pwd:{
				required: true,
				minlength:6,
				maxlength:20
			},
			pwd2:{
				required:true,
				minlength:6,
				maxlength:20,
				equalTo:"#pwd"
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});

	//add category validation
	$("#add_category").validate({
		rules:{
			category_name:{
				required:true
			},
			description:{
				required:true,
			},
			url:{
				required:true,
				//url: true
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});

	$("#add_product").validate({
		rules:{
			category_id:{
				required:true
			},
			product_name:{
				required:true
			},
			product_code:{
				required:true
			},
			product_color:{
				required:true
			},
			product_image:{
				required:true
			},
			price:{
				required:true,
				number:true
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});

	$("#edit_product").validate({
		rules:{
			category_id:{
				required:true
			},
			product_name:{
				required:true
			},
			product_code:{
				required:true
			},
			product_color:{
				required:true
			},
			price:{
				required:true,
				number:true
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});

	//delete category alarm
	$('#deleteCategory').click(function () {
		if(confirm('are you sure for delete this category?')){
			return true;
		}
		return false;
	});

	//delete product alarm
	$('.deleteProduct').click(function () {
		// var product_id = $(this).data('pid');
		var pd_link = $(this).data('link');
		// alert(pd_link);
		swal({
			title: 'are you sure?',
			text: 'you done',
			type: 'warning',
			showCloseButton: false,
			showCancelButton: true,
			focusConfirm: false,
			confirmButtonColor: '#00b0ff',
			cancelButtonText: 'انصراف',
			confirmButtonText: 'ادامه و حذف'
		}
		).then(function(){
			// console.log(pd_link);
			window.location.href=pd_link;
		});

	});

	$('.delete-attribute').click(function () {
		// var attribute_id = $(this).data('pid');
		var pd_link = $(this).data('link');

		swal({
				title: 'are you sure?',
				text: 'you done',
				type: 'warning',
				showCloseButton: false,
				showCancelButton: true,
				focusConfirm: false,
				confirmButtonColor: '#00b0ff',
				cancelButtonText: 'انصراف',
				confirmButtonText: 'ادامه و حذف'
			}
		).then(function(){
			// console.log(pd_link);
			window.location.href=pd_link;
		});
	});

	$(document).ready(function(){
		var maxField = 20; //Input fields increment limitation
		var addButton = $('.add_button'); //Add button selector
		var wrapper = $('.field_wrapper'); //Input field wrapper
		var fieldHTML = '<div class="field_wrapper" style="margin-left: 16%">' +
			'<input type="text" name="sku[]" id="sku" placeholder="SKU" style="width: 18%; margin-top: 5px; margin-right: 3px"/>' +
			'<input type="text" name="size[]" id="size" placeholder="Size" style="width: 18%; margin-top: 5px; margin-right: 3px"/>' +
			'<input type="text" name="price[]" id="price" placeholder="Price" style="width: 18%; margin-top: 5px; margin-right: 3px"/>' +
			'<input type="text" name="stock[]" id="stock" placeholder="Stock" style="width: 18%; margin-top: 5px; margin-right: 0px"/>' +
			'<a href="javascript:void(0);" class="remove_button">remove</a></div>'; //New input field html
		var x = 1; //Initial field counter is 1

		//Once add button is clicked
		$(addButton).click(function(){
			//Check maximum number of input fields
			if(x < maxField){
				x++; //Increment field counter
				$(wrapper).append(fieldHTML); //Add field html
			}
		});

		//Once remove button is clicked
		$(wrapper).on('click', '.remove_button', function(e){
			e.preventDefault();
			$(this).parent('div').remove(); //Remove field html
			x--; //Decrement field counter
		});
	});

});
