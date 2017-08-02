$('#submit_leave_req').on('click',function (e) {
	e.preventDefault();
	var leave_sub = $('#leave_subject').val();
	var leave_res = $('#leave_reason').val();
	var leave_Rsn_brf = $('#leae_reason_brief').val();

	if(leave_sub != '' && leave_res != '' && leave_Rsn_brf != ''){
		var datas = "sub="+leave_sub+"&reason="+leave_res+"&message="+leave_Rsn_brf ;
		var ajax_url = "leave_process.php";
		$.ajax({
			type : 'post',
			data: datas,
			url: ajax_url,
			success: function(res){
				$('#successMsg').show().fadeOut(4000);
				$('#leave_subject').val('');
				$('#leave_reason').val('');
				$('#leae_reason_brief').val('');
			}
		});
	}
});

$(document).on('click','.leave_btn',function () {
	var user_id = $(this).attr('data_user_id');
	var datas = "user_id="+user_id;
	var ajax_url = "get_leae_details.php";
	$.ajax({
		type : 'post',
			data: datas,
			url: ajax_url,
			success: function(res){
				$('#response_text').html(res);
			}
	});
});

$(document).on('click','#approve_leave',function (e) { 
	e.preventDefault();
	var uniq = $('input#unique_id').val();
	var us = $('input#user_ids').val();
	var app_btn = 1;
	var datas = "user_id="+us+"&&unique_id="+uniq+"&&approve_btn="+app_btn;
	var ajax_url = "get_leae_details.php";
	$.ajax({
		type : 'post',
			data: datas,
			url: ajax_url,
			success: function(res){
				window.location.reload();
			}
	});
});

$(document).on('click','#cancel_leave',function (e) { 
	
	e.preventDefault();
	var uniq = $('input#unique_id').val();
	var us = $('input#user_ids').val();
	var app_btn2 = 1;
	var datas = "user_id="+us+"&&unique_id="+uniq+"&&approve_btn2="+app_btn2;
	var ajax_url = "get_leae_details.php";
	$.ajax({
		type : 'post',
			data: datas,
			url: ajax_url,
			success: function(res){
				window.location.reload();
			}
	});
});



function refresh_div() {
        $.ajax({
            url:'notification.php',
            type:'POST',
            success:function(results) {
                $("#notification").html(results);
            }
        });
    }

t = setInterval(refresh_div,1000);

var text ;
$('#emp_list a').draggable({
	 helper: "clone",
	 revert: true,        
        scroll: false,        
        zIndex: 9999999999,
         start: function(event) {
         	text = $(this).clone();
         	//alert(text);
         }
});

$('#droppable').droppable({
	drop: function() {
		$('#droppable').prepend(text);
	}
});


$('#send_email').on('click',function (e) {
		e.preventDefault();
		var users = [];
		var sub = $('#email_sub').val();
		var msgs = $('#email_message').val();
		$('#droppable a').each(function (argument) {			
			users.push($(this).attr('data-user-email'));
		});		
		var to = 'receiver=';
		for(i=0;i<users.length;i++){
			to = to+users[i]+',';
		}
		//console.log(to);
		var datas = to+'&&subject='+sub+'&&msg='+msgs;
		$.ajax({
            url:'send_mail.php',
            type:'POST',
            data: datas,
            success:function(results) {
                $("#notification").html(results);
            }
        });

});
