@if(!empty($tweets))
@foreach ($tweets as $tweet)
    <div id="post-data" class="">
        <hr>
        @csrf
        {{$tweet->body}}
        <button id="like-form" style="background:none; border:none;padding:0;" class="like-button">
            <i class='like-icon {{(Helpers::checkLikeStatus($tweet->id)) ? 'bi-star-fill' : 'bi-star';}} tweet_id' id="{{$tweet->id}}"  style="font-size:12px;" title="Like this tweet"> 
                <span id="likesCount-{{$tweet->id}}">
                    <span>
                        {{$tweet->likes}}
                    </span>
                </span>
                <i> 
                    likes
                </i>
            </i>
        </button>
        
        @if (!$tweet->shared_by_name)
            <form action="{{route('share-tweet')}}" method="POST">
                <input type="hidden" id="tweetId" name="tweetId" value="{{$tweet->id}}"/>
                @csrf
                <button style="background:none; border:none;padding:0;" type="submit" class="share-tweet-button">
                    <i style="font-size:12px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;share tweet&nbsp;&nbsp;&nbsp;</i>
                    <i class="bi bi-share" title="Share this Tweet"></i>
                </button>
            </form> 
        @endif
        
        <div class="mt-4">
            <i style="font-size:12px;">by {{$tweet->user->name}}</i>
            @if($tweet->shared_by)         
                <strong>shared tweet</strong>
                <i>was shared by {{$tweet->shared_by_name}}</i>
            @endif
        </div>
    </div> 
@endforeach
@endif