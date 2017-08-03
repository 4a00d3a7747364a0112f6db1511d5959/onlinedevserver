//casting from js 
jQuery('.casting-tab-name').click(function(e) {	
	jQuery('.casting-tab-details').hide();
    var ids = jQuery(this).attr('data-href');
	jQuery(ids).show();
});

jQuery(document).ready(function(){
  $("#menu-toggle").click(function(){
    $("#menu-info").slideToggle(400);
  });
});

// ***** vip accordion ***** // 
(function($) {
    $('.accordion > li:eq(0) .accordion-tab').addClass('');
	
	//if ( $( '.accordion > li:eq(0) .accordion-tab' ).hasClass( "active" ) ) {
		if ( $( '.accordion > li:eq(0) .accordion-tab' ).hasClass( "active" ) ) {
	//$('.accordian-active p').show();
	$('.accordian-active.accordion-panel').show();
	}
    $('.accordion .accordion-tab').click(function(j) {
		//alert();
		/*if ( $( '.accordion > li:eq(0) .accordion-tab' ).hasClass( "active" ) ) {
		$('.accordion').find('.accordion-panel.active').removeClass('active');	
		}*/
		
        var dropDown = $(this).closest('li').find('.accordion-panel');

        $(this).closest('.accordion').find('.accordion-panel').not(dropDown).slideUp();

        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
        } else {
            $(this).closest('.accordion').find('.accordion-tab.active').removeClass('active');
            $(this).addClass('active');
        }

        dropDown.stop(false, true).slideToggle();

        j.preventDefault();
    });
})(jQuery);
// ***** vip accordion end***** // 


// multiselect //

$(".dropdown dt a").on('click', function() {
  $(".dropdown dd ul").slideToggle('fast');
});

$(".dropdown dd ul li a").on('click', function() {
  $(".dropdown dd ul").hide();
});

function getSelectedValue(id) {
  return $("#" + id).find("dt a span.value").html();
}

$(document).bind('click', function(e) {
  var $clicked = $(e.target);
  if (!$clicked.parents().hasClass("dropdown")) $(".dropdown dd ul").hide();
});

$('.mutliSelect input[type="checkbox"]').on('click', function() {

  var title = $(this).closest('.mutliSelect').find('input[type="checkbox"]').val(),
    title = $(this).val() + ",";

  if ($(this).is(':checked')) {
    var html = '<span title="' + title + '">' + title + '</span>';
    $('.multiSel').append(html);
    $(".hida").hide();
  } else {
    $('span[title="' + title + '"]').remove();
    var ret = $(".hida");
    $('.dropdown dt a').append(ret);

  }
});



