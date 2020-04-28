/*price range*/

 $('#sl2').slider();

	var RGBChange = function() {
	  $('#RGB').css('background', 'rgb('+r.getValue()+','+g.getValue()+','+b.getValue()+')')
	};	
		
/*scroll to top*/

$(document).ready(function(){
	$(function () {
		$.scrollUp({
	        scrollName: 'scrollUp', // Element ID
	        scrollDistance: 300, // Distance from top/bottom before showing element (px)
	        scrollFrom: 'top', // 'top' or 'bottom'
	        scrollSpeed: 300, // Speed back to top (ms)
	        easingType: 'linear', // Scroll to top easing (see http://easings.net/)
	        animation: 'fade', // Fade, slide, none
	        animationSpeed: 200, // Animation in speed (ms)
	        scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
					//scrollTarget: false, // Set a custom target element for scrolling to the top
	        scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
	        scrollTitle: false, // Set a custom <a> title if required.
	        scrollImg: false, // Set true to use image
	        activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
	        zIndex: 2147483647 // Z-Index for the overlay
		});
	});

	$('.changeImage').click(function () {
		var src = $(this).attr('src');
		$('.mainImage').attr('src',src);
	});

	//for easy zoom
    var $easyzoom = $('.easyzoom').easyZoom();

    // Setup thumbnails example
    var api1 = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');

    $('.thumbnails').on('click', 'a', function(e) {
        var $this = $(this);

        e.preventDefault();

        // Use EasyZoom's `swap` method
        api1.swap($this.data('standard'), $this.attr('href'));
    });

    // Setup toggles example
    var api2 = $easyzoom.filter('.easyzoom--with-toggle').data('easyZoom');

    $('.toggle').on('click', function() {
        var $this = $(this);

        if ($this.data("active") === true) {
            $this.text("Switch on").data("active", false);
            api2.teardown();
        } else {
            $this.text("Switch off").data("active", true);
            api2._init();
        }
    });

    $('#registerForm').validate({
		rules:{
			email:{
				required:true,
				email: true,
				remote: 'check-email',
			},
			name:{
				required:true,
				minlength:3,
				accept:"[a-zA-Z]+"
			},
			password:{
				required:true,
				minlength:6,
			}
		},
		messages:{
			name:{
				required:"Please enter your name",
				minlength:"too little name",
				accept:"enter only letters",
			},
			password:{
				required:"Please enter your password",
				minlength:"too little password",
			},
			email:{
				required:"Please enter your email",
				email:"enter valid email",
				remote:"email already exists!!",
			},
		}
	});

	$('#loginForm').validate({
		rules:{
			email:{
				required:true,
				email: true,
			},
			password:{
				required:true,
			}
		},
		messages:{
			password:{
				required:"Please enter your password",
			},
			email:{
				required:"Please enter your email",
				email:"enter valid email",
			},
		}
	});

	$('#updateAccountForm').validate({
		rules:{
			name:{
				required:true,
				minlength:3,
				accept:"[a-zA-Z]+"
			},
			address:{
				required:true,
				minlength:10,
			},
			city:{
				required:true,
				minlength:4,
			},
			state:{
				required:true,
				minlength:5,
			},
			country:{
				required:true,
			},
			pincode:{
				required:true,
				minlength:2,
				accept:"[0-9]+"
			},
			mobile:{
				required:true,
				minlength:10,
				accept:"[0-9]+"
			},

		},
		messages:{
			name:{
				required:"Please enter your name",
				minlength:"too little name",
				accept:"enter only letters",
			},
			address:{
				required:"Please enter your address",
				minlength:"too little address",
			},
			city:{
				required:"Please enter your city",
				minlength:"too little city",
			},
			state:{
				required:"Please enter your state",
				minlength:"too little state",
			},
			country:{
				required:"Please select a country",
			},
			pincode:{
				required:"Please enter your state",
				minlength:"too little pincode",
				accept:"enter only numbers",
			},
			mobile:{
				required:"Please enter your state",
				minlength:"too little mobile number",
				accept:"enter only numbers",
			},
		}
	});

	$("#passwordForm").validate({
		rules:{
			current_password:{
				required: true,
				minlength:6,
				maxlength:20
			},
			new_password:{
				required: true,
				minlength:6,
				maxlength:20
			},
			confirm_password:{
				required: true,
				minlength:6,
				maxlength:20,
				equalTo:"#new_password"
			},
			messages:{
				current_password:{
					required:"Please enter your current password",
					minlength:"too little for current password",
					maxlength:"too big for current password",
				},
				new_password:{
					required:"Please enter your new password",
					minlength:"too little for new password",
					maxlength:"too big for new password",
				},
				confirm_password:{
					required:"Please enter your confirm password",
					minlength:"too little for confirm password",
					maxlength:"too big for confirm password",
					EqualTo:"confirm password must be equal to new password",
				},
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
    
    $("#current_password").focusout(function () {
        var current_password = $(this).val();
        var link = $(this).data('link');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: link,
            data: {current_password: current_password },
            dataType: 'json',
            success: function (response) {

                if(response.status == false){
                    $("#for_current_password").html('<span style="color: red">the password is Incorrect</span>');
                }else if(response.status == true){
                    $("#for_current_password").html('<span style="color: green">the password is correct</span>');
                }
            },
            error: function (data) {
                console.log(data);
            }
        });
    });

    $("#billtoship").on('click', function () {
		if($(this).prop('checked') == true){
			$("#shipping_name").val($("#billing_name").val());
			$("#shipping_address").val($("#billing_address").val());
			$("#shipping_city").val($("#billing_city").val());
			$("#shipping_state").val($("#billing_state").val());
			$("#shipping_country").val($("#billing_country").val());
			$("#shipping_pincode").val($("#billing_pincode").val());
			$("#shipping_mobile").val($("#billing_mobile").val());
		}else{
			$("#shipping_name").val('');
			$("#shipping_address").val('');
			$("#shipping_city").val('');
			$("#shipping_state").val('');
			$("#shipping_country").val('');
			$("#shipping_pincode").val('');
			$("#shipping_mobile").val('');

		}
	});


});
