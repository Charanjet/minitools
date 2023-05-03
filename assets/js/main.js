(function($){
    // Preloader Area
    
	$(window).on('load', function() {
		$('.preloader').addClass('preloader-deactivate');
        //show intro popup on load
        $('#intro-modal').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
	});
	function messageRender(message,dclass){
        $('.chat_area ul').append('<li class="chat-list clearfix '+ dclass +' ">\n' +
            '<div class="chat-body1 clearfix">\n' +
            '<p>'+message+'</p>\n' +
            '</div>\n' +
            '</li>');
    }

    //entry form
    $('#entry-form').submit(function (e) {
        e.preventDefault();
        var email = $('#entry-form input[name="email"]').val();
        var fname = $('#entry-form input[name="fname"]').val();
        $.ajax({
            url: baseUrl+'confirmation.php',
            type: 'post',
            data: {'email':email,'fname':fname},
            success: function (data) {
                var data = JSON.parse(data);
                if (data.response=="Success"){
                    $('#intro-modal').modal('hide');
                    //set cookies for not to ask for popup again for 30days
                    let decodedCookie = decodeURIComponent(document.cookie);
                    if(decodedCookie.search('loggedin')!=0){
                        const d = new Date();
                        d.setTime(d.getTime() + (7*24*60*60*1000));
                        let expires = "expires="+ d.toUTCString();
                        document.cookie = "loggedin=1;"+expires;
                    }
                }else {
                    console.log(data);
                }
            }
        });
    });


	//gpt functions
    $('#chat_form').submit(function (e) {
        e.preventDefault();
        var message = $('#message').val();
        var input_lang_raw = $('#langs').val();
        var input_lang_code =  $("#langs-list option[value='"+input_lang_raw+"']").data('value');
        messageRender(message,'float-left');
        $('#gpt-query-btn').attr('disabled','true');
        $("#loadMe").modal({
            backdrop: "static", //remove ability to close modal with click
            keyboard: false, //remove option to close with keyboard
            show: true //Display loader!
        });
        //ajax request to translation
        $.ajax({
            url: baseUrl+'translate.php',
            type: 'post',
            data: {'message':message,'inp-lang':input_lang_code},
            success: function (data) {
                var data = JSON.parse(data);
                let msg = data.response;
                $('#gpt-query-btn').removeAttr('disabled');
                $("#loadMe").modal("hide");
                messageRender((data.response).trim(),'float-right');
            }
        });

    });

	$('#comment-form').submit(function (e) {
        e.preventDefault();
        var name = $('input[name="commenter-name"]').val();
        var email = $('input[name="commenter-email"]').val();
        var comment = $('textarea[name="commenter-message"]').val();

        $.ajax({
            url:baseUrl+"comment.php",
            type:"POST",
            data:{name:name,email:email,comment:comment},
            success:function (data) {
                if (data.code=="200"){
                    $('.success-popup').click();
                }else{
                    $('.thank-you-pop h1').html('OOPS!');
                    $('.thank-you-pop p').html('Something Went wrong with server! Please contact <h3 class="cupon-pop"><span><a href="mailto:info@websmash.in">info@websmash.in</a></span></h3>');
                    $('.success-popup').click();
                }
            }
        });
    });
}(jQuery));