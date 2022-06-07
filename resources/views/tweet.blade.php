@if(!empty($tweets))
    @foreach ($tweets as $tweet)
        <div id="post-data" class="">
            <hr>
            @csrf
            {{$tweet->body}}
        
            <button id="like-form" style="background:none; border:none;padding:0;" class="like-button">
                <i class='like-icon {{(Helpers::checkLikeStatus($tweet->id)) ? 'bi-star-fill' : 'bi-star';}} tweet_id' id="{{$tweet->id}}"  style="font-size:12px;" title="Like this tweet"> 
                    <span id="likesCount-{{$tweet->id}}"><span>{{$tweet->likes}}</span></span>
                    <i> 
                        likes
                    </i> 
                </i>
            </button>

            <div class="mt-4">
                <i style="font-size:12px;">by {{$tweet->user->name}}</i>
                @if($tweet->shared_by)         
                    <strong>shared tweet</strong>
                @endif     
            </div> 
        </div> 
    @endforeach
@endif