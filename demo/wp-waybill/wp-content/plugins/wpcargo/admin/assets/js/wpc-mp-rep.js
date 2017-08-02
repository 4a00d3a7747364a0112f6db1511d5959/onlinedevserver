jQuery(document).ready(function ($) {

	var wpc_mp_vat_percentage = wpcargo_mp_rep.wpc_mp_vat_percentage;

	'use strict';

	var sum = 0;

	$('.wpc-repeater').repeater({

		defaultValues: {

			'wpc-pm-qty': '',

			'wpc-pm-length': '',

			'wpc-pm-width': '',

			'wpc-pm-height': '',

			'wpc-pm-description': '',

			'wpc-pm-price': '',
			
			'p': ''

		},				

		show: function () {

			$(this).slideDown;

			$('.wpc-mp-tr').css('display','');

			calculateSum();



			$(".price").on("keydown keyup", function() {

				calculateSum();

			});

		},				

		hide: function (deleteElement) {

			if(confirm('Are you sure you want to delete this element?')) {

				$(this).slideUp(deleteElement);

				setTimeout(function(){

					calculateSum();



					$(".price").on("keydown keyup", function() {

						calculateSum();

					});

				}, 500);

			}

		}



	})					

	

calculateSum();



$(".price").on("keydown keyup", function() {

	calculateSum();

});



function calculateSum() {

	var sum = 0;

	//iterate through each textboxes and add the values

	$(".price").each(function() {

	//add only if the value is number

	

		if (!isNaN(this.value) && this.value.length != 0) {

			sum += parseFloat(this.value);

			$(this).css("background-color", "#FEFFB0");

		}

		else if (this.value.length != 0){

			$(this).css("background-color", "red");

		}

	});

	

	var mp_subtotal = sum.toFixed(2);

	var mp_vat = sum * wpc_mp_vat_percentage;

	var mp_total = parseFloat(mp_subtotal)+parseFloat(mp_vat);

	

	$("input#wpc-total-price").val(mp_total.toFixed(2));

	

	$("span.wpc-pm-subtotal-text").html(mp_subtotal);

	$("span.wpc-pm-vat-text").html(mp_vat.toFixed(2));					

	$("span.wpc-pm-tp-text").html(mp_total.toFixed(2));

	

}

});