$(document).on('click', '.tweet_id', function(e){
    e.preventDefault();
    if ($(this).hasClass("bi-star")) {
        var id = $(this).attr('id');
        console.log(id);
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
        console.log(id);
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

var page = 1;
$(window).scroll(function() {
    if($(window).scrollTop() + $(window).height() >= $(document).height()) {
        page++;
        loadMoreData(page);
    }
});

function loadMoreData(page){
$.ajax(
        {
            url: '?page=' + page,
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
