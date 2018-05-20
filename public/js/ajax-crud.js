$(document).ready(function(){
    
    var url = "/comment";

    //display modal form for task editing
    $(document).on("click",'.edit-comment',function(){
        //console.log('Clicked');
        var reply_id = $(this).val();

        $.get(url + '/' + reply_id + '/edit', function (data) {
            //success data
            //console.log(data);
            $('#reply_id').val(data.id);
            $('#reply').val(data.comment);
            $('#btn-reply').val("update");
            $('#myModal').modal('show');
        }) 
    });

    //delete task and remove it from list
    $(document).on("click",'.delete-comment',function(){
        var comment_id = $(this).val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })
        $.ajax({

            type: "DELETE",
            url: url + '/' + comment_id,
            success: function (data) {
                console.log(data);

                $("#comment" + comment_id).remove();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
    

    //create new task / update existing task
    $("#comment-btn").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })

        e.preventDefault(); 

        if($('#user-comment').val() == "guest_user"){
            var user_id = null;
        }else{

        }
        
        var formData = {
            comment: $('#comment-field').val(),
            user: $('#user-comment').val(),
            post_id : $('#post_id').val(),
            user_id: $('#user_id').val(),
        }

        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#comment-btn').val();

        var type = "POST"; //for creating new resource
        var comment_id = $('#comment_id').val();;
        var my_url = url;

        //console.log(formData);

        $.ajax({

            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',
            success: function (data) {
                //console.log(data);

                if(data.user_id == undefined){
                    data.user = "Guest User";
                }else{
                    data.user = $('#user-comment').val();
                }
                //console.log(data.user);
                var comment = '<div id="comment'+data.id+'" class="numberComments comment-section"><div class="comment-name"><div class="row">'
                comment += '<div class="col-lg-8"><strong><p class="main-comment-name">'+ data.user +'<span class="text-muted" style="font-size: 10px;"> Just now</span></p></strong></div>'
                comment += '<div class="col-md-4"><div class="comment-buttons" ><button type="submit"  class="btn btn-primary main-edit-btn edit-comment" value="'+ data.id +'">Edit</button>'
                comment += '<button type="submit"  class="btn btn-alert main-edit-btn delete-comment" value="'+ data.id +'">Delete</button></div></div></div></div>'
                comment += ' <div class="comment-body"><p class="main-comment">'+ data.comment + '</p></div></div>'

                if (state == "add"){ //if user added a new record
                    $('#comment-section').prepend(comment);
                }else{ //if user updated an existing record

                    $("#comment" + comment_id).replaceWith( comment );
                }

                $('#frm-comment').trigger("reset");

            },
            error: function (data) {
                //console.log('Error:', data);
            }
        });
    });

    $("#edit-btn").click(function (e) {
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })

        e.preventDefault(); 
        
        var formData = {
            comment: $('#reply').val(),
        }

        var type = "PUT"; //for creating new resource
        var comment_id = $('#reply_id').val();;
        var my_url = url + '/' + comment_id;;

        //console.log(formData);

        $.ajax({

            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',
            success: function (data) {
                //console.log(data);

                if(data.user_id == undefined){
                    data.user = "Guest User";
                }else{
                    data.user = $('#user-comment').val();
                }
                   
                var comment = '<div id="comment'+data.id+'" class="numberComments comment-section"><div class="comment-name"><div class="row">'
                comment += '<div class="col-lg-8"><strong><p class="main-comment-name">'+ data.user +'</p></strong></div>'
                comment += '<div class="col-md-4"><div class="comment-buttons" ><button type="submit"  class="btn btn-primary main-edit-btn edit-comment" value="'+ data.id +'">Edit</button>'
                comment += '<button type="submit"  class="btn btn-alert main-edit-btn delete-comment" value="'+ data.id +'">Delete</button></div></div></div></div>'
                comment += ' <div class="comment-body"><p class="main-comment">'+ data.comment + '</p></div></div>'
                
                $("#comment" + comment_id).replaceWith(comment);
                $('#frmReply').trigger("reset");

            },
            error: function (data) {
                //console.log('Error:', data);
            }
        });
    });

    $(document).on("click",'#add-option',function(){
        //console.log('Clicked');
        var id = $("input:last").attr("name").substr(8,1);
        var idInt = parseInt(id) + 1; 
        var pcInt = idInt + 1;
        console.log(idInt);
        var option = '<div class="form-group floating-label-form-group controls opt">'
        option += '<label>Option</label>'
        option += '<input id="option_1" required type="text" placeholder="Option '+ pcInt +'" name="options['+idInt+']" class="form-control"/></div>'
        
        $(".option").append(option);
    });

    $(document).on("click",'#remove-option',function(){
        //console.log($(".opt").length);
        
        if($(".opt").length == 2){

        }else{
            $(".opt:last").remove();
        }
        
    });

});