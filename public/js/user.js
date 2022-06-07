$(document).on('click', '.tweet_id', function(e){
    e.preventDefault();
    if ($(this).hasClass("bi-star")) {
        var id = $(this).attr('id');
        $(this).removeClass("bi-star");
        $(this).addClass("bi-star-fill");
        
        $.ajax({
            url: "/like-tweet/"+id,
            method:"GET",
            dataType:'json',
            data:{
                '_token':'{{ csrf_token() }}',
                data: id,
            },

            success:function(data){
                if(data.status == 1){
                    $('#likesCount-' + data.tweetId).html(data.data);
                    
                    flashy('You liked a tweet successfully', {
                        type : 'flashy__success'
                    });
                }
            }
        });
    }else if ($(this).hasClass("bi-star-fill")) {

        var id = $(this).attr('id');
        $(this).removeClass("bi-star-fill");
        $(this).addClass("bi-star");
        
        $.ajax({
            url: "/unlike-tweet/"+id,
            method:"GET",
            dataType:'json',
            data:{
                '_token':'{{ csrf_token() }}',
                data: id,
            },

            success:function(data){
                if(data.status == 1){
                    $('#likesCount-' + data.tweetId).html(data.data);
                    
                    flashy('You unliked a tweet successfully', {
                        type : 'flashy__success'
                    });
                }
            }
        });

    }else {
        //do nothing
    }
});

//follow
$(document).on('click', '#follow-button', function(e){
var text = $('#follow-button').text() ;
if($('#follow-button').text() == 'Follow') {
    e.preventDefault();
    var id = $('#user-id-follow').val()
    
    $.ajax({
        url: "/follow-user/"+id,
        method:"GET",
        dataType:'json',
        data:{
            '_token':'{{ csrf_token() }}',
            data: id,
        },

        success:function(data){
            if(data.status == 1){
                $('#followers').html('&nbsp;&nbsp;&nbsp;'+data.data[0]);
                $('#follow-button').text('Unfollow')
                flashy('You have successfully Followed', {
                    type : 'flashy__success'
                });
            }
        }
    });
}

//unfollow
if ($('#follow-button').text() == 'Unfollow') {
    var id = $('#user-id-follow').val()
   
    $.ajax({
        url: "/unfollow-user/"+id,
        method:"GET",
        dataType:'json',
        data:{
            '_token':'{{ csrf_token() }}',
            data: id,
        },

        success:function(data){
            if(data.status == 1){
                $('#followers').html('&nbsp;&nbsp;&nbsp;'+data.data[0]);
                $('#follow-button').text('Follow')
                flashy('You have successfully Unfollowed', {
                    type : 'flashy__success'
                });
            }
        }
    });
}
});


//load more items
var page = 1;
$(window).scroll(function() {
    if($(window).scrollTop() + $(window).height() >= $(document).height()) {
        page++;
        loadMoreData(page);
    }
});

function loadMoreData(page){
var searchWord  = document.getElementById('for-scroll').value;
$.ajax(
    {
        url: '?page=' + page + '&searchWord=' + searchWord,
        type: "get",
        beforeSend: function()
        {
            $('.ajax-load').show();
        }
    })
    .done(function(data)
    {
        if(data.html == ""){
            $('.ajax-load').html("No more records found");
            return;
        }
        $('.ajax-load').hide();
        $("#post-data").append(data.html);
    })
    .fail(function(jqXHR, ajaxOptions, thrownError)
    {
        console.log('server is not responding');
    });
}

