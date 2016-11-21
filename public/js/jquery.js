jQuery(document).ready(function() {
	
	//tooltip
	$('[data-toggle="tooltip"]').tooltip();

	//Creates extra inputfield.
	var i = 0;
	$("#createField").click(function() {
      	i++

        $("#multiOrderForm").removeClass("hidden").append($("#orderForm").clone().attr("id", "orderForm"+i).fadeIn());

      	$("#deleteField").removeClass("hidden");
	});

	//Removes extra inputfield.
	$("#deleteField").click(function() {
		i--
	    $("#multiOrderForm>div:last-child").remove();

      
	    if(i == 0) {
      		$("#deleteField").addClass("hidden");
	    } else {
      		$("#deleteField").removeClass("hidden");
      	}
    });

	//toggle inputfiels on profile page
    $("#toggleName").click(function() {
    	$("#name").slideToggle("slow");
    });

    $("#toggleEmail").click(function() {
    	$("#email").slideToggle("slow");
    });

    $("#togglePassword").click(function() {
    	$("#password").slideToggle("slow");
    });

    $("#toggleCyclist").click(function() {
    	$("#cyclist").slideToggle("slow");
    });
	
	// Unhides inputfield.
	if($("#monthField").hasClass("collapse")) {
        $(".select-year").change(function() {
			     $("#monthField").collapse("slide", "slow");
		});
	}

	// Slide effect for clicked line of list.
	$(".select").click(function() {

		// Prevents animate if allready has margin or is animated (double clik prevent)   
		if($(this).css("margin-left") != "20px" && !$(this).is(":animated")) {
			$(this).animate({marginLeft: "+=20px", fontSize: "1.3em"});
			
			$(".select").each(function(){
				if($(this).css("margin-left") == "20px") {
					$(this).animate({marginLeft: "-=20px", fontSize: "1em"});
				}

				// Change inner HTML
				$(".add-or-update").html("aanpassen");
				
				// Show button
				$("#remove").removeClass('hidden');
			});

			
		} 

		if ($(this).css("margin-left") == "20px") {
			$(this).animate({marginLeft: "-=20px", fontSize: "1em"});

			// Set value back to default
			$("#firstValue").attr("value", "");
			$("#secondValue").attr("value", "");
			$("#thirdValue").attr("value", "");

			// Change inner HTML
			$(".add-or-update").html("toevoegen");

			$("#remove").addClass('hidden');
						

		} else {
			
			// Gets the values of clicked line. 
			var firstValue = $(this).find(">:nth-child(2)").html();
			var secondValue = $(this).find(">:nth-child(3)").html();
			var thirdValue = $(this).find(">:nth-child(4)").html();
			var forthValue = $(this).find(">:nth-child(5)").html();

						
			//  Update input with clicked values.
			$(".firstValue").attr("value", firstValue);
			$(".secondValue").attr("value", secondValue);
			$(".thirdValue").attr("value", thirdValue).trigger('change');
			$(".forthValue").attr("value", forthValue).trigger('change');
			
		}
		
	});

	$("#changeMonth").click(function() {
		$("#yearField").slideToggle();
		$("#chooseUser").toggleClass("hidden");
		$("#sendField").slideToggle();
		
		var text = $(this).html();
		if(text == "Andere maand") {
			var text = "Laatste maand";
		} else {
			var text = "Andere maand";
		}
		$(this).text(text);
		
	});

	$("#chooseUser").click(function() {
		$("#userField").slideToggle();

		var text = $(this).html();
		if(text == "Gebruiker kiezen") {
			var text = "Alle gebruikers";
		} else {
			var text = "Gebruiker kiezen";
		}
		$(this).text(text);
	});

	$("#for_user_rights").click(function(){
		$(".user_rights").slideToggle();
 	});

	$("#for_admin_rights").click(function(){
		$(".admin_rights").slideToggle();
 	});


	$(".users").click(function(){
		var test = $(this).next().html();
		alert(test);
	});

	$(".thirdValue").change(function(){
		var value = $(this).val();
			
		 if(value == 1) {
			$(".is-admin").removeClass("hidden");
			$(".is-not-admin").addClass("hidden");
	 	} else { 
	 		$(".is-admin").addClass("hidden")
			$(".is-not-admin").removeClass("hidden");
	 	}
	});

	$(".forthValue").change(function(){
		var value = $(this).val();
		
		if(value == 1) {
			$(".is-deactivated").removeClass("hidden");
			$(".is-not-deactivated").addClass("hidden");
	 	} else { 
	 		$(".is-deactivated").addClass("hidden")
			$(".is-not-deactivated").removeClass("hidden");
	 	}
	});

	$("#fist_cyclist").click(function() {
		if($(this).is(':checked')) {
			$("#output_fist_cyclist").html('<b>Opgeven</b>');
		} else {
			$("#output_fist_cyclist").html('<b>Afmelden</b>');
		}
	});

	$("#second_cyclist").click(function() {
		if($(this).is(':checked')) {
			$("#output_second_cyclist").html('<b>Opgeven</b>');
		} else {
			$("#output_second_cyclist").html('<b>Afmelden</b>');
		}
	});
	


});

