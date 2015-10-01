(function($){
	
	$(document).ready(function() {
		
		// This is the part where jSignature is initialized.
		//displayed line width and color . does not effect the saved file.
		var $sigdiv = $("#signature").jSignature({'UndoButton':true,color:"#111",lineWidth:2 }); 
	
		var drawn = 0;
	
		// Initialize sortables
		$('.sortable').sortable();
		$( "#sortable" ).sortable, $( "#sortable-back" ).sortable ({
			items: "li:not(.ui-li-divider)"
			});
			$( "#sortable" ).sortable();
			$( "#sortable" ).disableSelection();
			$( "#sortable" ).bind( "sortstop", function(event, ui) {
			  $('#sortable').listview('refresh');
		});
		
		console.log ("initiated") ;
		
		// Check if something has been drawn on jSignature canvas
		$("#signature").bind('change', function(e){ 
			drawn = 1;
		})

			
		// Check if checkbox is clicked 
		$("#ifSignByHand").change(function(){
			if($(this).is(":checked")){
				$("#signByHandDisclaimer").html("*Thanks for the feedback! Unfortunately a digital signature is required for this pilot. Please sign the panel above and leave this box checked.");
			}else{
				$("#signByHandDisclaimer").html("");
			}
		});
    
    	
    	// Process submit---------------------------------------------------------
		$( ".click_submit .ui-btn" ).on( "tap", function() {
			
			console.log ("submit clicked") ;
		
// 			$(".click_submit .ui-btn"). attr("value", "Sending..."); 
// 			$(".click_submit .ui-btn").attr("value", "Sending...").button("refresh");
				
			//1. Validate Name and Email
			if ($("#name_val").val() == "First MI Last") { 
				//add red box 
				$("#name_val").css("border","2px solid red");
				//move up
				$('html,body').delay(500).animate({scrollTop: $('#bgBottomWrapper').offset().top }, 1000);
				console.log("didn't type name");
				return false;
			} else $("#name_val").css("border","0px");
						
			// 2 .Get iphone mode 
			var phoneModel = $( "#selectPhone option:selected" ).val(); 			
			//validate a choice is made here 
			var e = $("#selectDeviceDiv") ;
			if (phoneModel == "Pick one"){
				$(".ui-field-contain[name='phoneSel']").css("border", "2px solid red");
				$('html,body').delay(500).animate({scrollTop: $('#selectDeviceDiv').offset().top }, 1000);
				console.log("didn't pick ifPay");
				return false; 
			} else $(".ui-field-contain[name='phoneSel']").css("border", "0");
			
			//3. Get order of card preference and pattern
			var sorted_cards = "", sorted_patterns = "";
			var i=0, j=0;
			var card_array = $(".card_type > h3"), pattern_array = $(".pattern_type > h3"); 
			$.each( card_array, function() {
				sorted_cards = sorted_cards + (i+1) + ":" + $(card_array[i]).html() + ", ";
				i++;
			});
			$.each( pattern_array, function() {
				sorted_patterns = sorted_patterns + (j+1) + ":" + $(pattern_array[j]).html() + ", ";
				j++;
			});
			
			//4. Get if user would pay for card 
			var ifPay = $("input[name=pay]:checked").val() ;			
			if ((ifPay != 'yes' )&&(ifPay !=  'no')){
 				console.log("didn't pick ifPay");
 				$("#ifPayWrapper").css("border", "2px solid red");  
 				$('html,body').delay(500).animate({scrollTop: $('#ifPayWrapper').offset().top }, 1000); 				
 				return false;
			}else 		$("#ifPayWrapper").css("border", "0"); 
			    	
			
			//5. Validate signature is drawn
			if (!drawn) {
				$("#signature canvas").css("border", "2px solid red");
				$('html,body').delay(500).animate({scrollTop: $('#signature canvas').offset().top }, 1000); 	
				console.log("didn't sign ");
				return false;
			} else $("#signature canvas").css("border","0px");
			
			/*
			var email_str = $("#email_val").val();
			var n = email_str.indexOf("@capitalone.com");
			if (n <= 0) {
				$("#email_val").css("border", "1px solid red");
				return;
			} else $("#email_val").css("border", "1px solid black");
			*/
					
			
			//6. record if prefer a blankbox 
			var ifSign = $("#ifSignByHand").prop("checked");
			
			
			// 7 .Get office location 
			var officeLoc = $( "#selectOffice option:selected" ).val(); 			
			//validate a choice is made here 
			var e = $("#selectOfficeDiv") ;
			if (officeLoc == "Pick one"){
				$(".ui-field-contain[name='officeSel']").css("border", "2px solid red");
				$('html,body').delay(500).animate({scrollTop: $('#selectOfficeDiv').offset().top }, 1000);
				console.log("didn't pick officeLoc");
				return false; 
			} else $(".ui-field-contain[name='officeSel']").css("border", "0");
			var workspace = $("#workspace").val();
			if ( workspace == "Workspace or internal zip") { 
				//add red box 
				$("#workspace").css("border","2px solid red");
				//move up
				$('html,body').delay(500).animate({scrollTop: $('#workspace').offset().top }, 1000);
				console.log("didn't provide workspace");
				return false;
			} else $("#workspace").css("border","0px");
			officeLoc = $("#workspace").val() + " - " + $( "#selectOffice option:selected" ).val();
						
			
			//8. Validate Last 4
			var last4 = $("#last4").val();
			if ( last4 == "Last 4 Digits" || isNaN(last4) || last4.length != 4 ) { 
				//add red box 
				$("#last4").css("border","2px solid red");
				//move up
				$('html,body').delay(500).animate({scrollTop: $('#last4Div').offset().top }, 1000);
				console.log("didn't provide last 4 digits");
				return false;
			} else $("#last4").css("border","0px");
			
			// Getting signature as SVG and rendering the SVG within the browser. 
			// (!!! inline SVG rendering from IMG element does not work in all browsers !!!)
			// this export plugin returns an array of [mimetype, base64-encoded string of SVG of the signature strokes]
			var datapair = $sigdiv.jSignature("getData", "svgbase64");
			var new_image = new Image();
			new_image.src = "data:" + datapair[0] + "," + datapair[1];
			$(new_image).appendTo($("#someelement")); // append the image (SVG) to DOM.
			
			var string ="name:"+name+ ". ifPay: " + ifPay + ". iphone: " + phoneModel; 
			console.log (string);
					
			// Ajax to submit data ------------------------------------------------------
			$.ajax({
				url: "https://designedbypirates.com/pilot/process_submission.php",
				type: "POST",
				data: { 
					name: $("#name_val").val(), 
					email: $("#email_val").val(), 
					phone: phoneModel,
					preference: sorted_cards, 
					pattern: sorted_patterns, 
					svg: datapair[1] ,
					sign: ifSign,
					pay: ifPay,
					office: officeLoc,
					last4: $("#last4").val()					
				},
				success: function (msg) {
					if (msg == "fail") {
						alert("Something is wrong");
					} else if (msg == "success") {	
						alert("Thanks for your help! We'll get started right away.");
						window.location.replace("https://designedbypirates.com");
					}
				}
			});
			
		});

	
	})
	})(jQuery)