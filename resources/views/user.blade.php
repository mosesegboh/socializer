@extends('layouts.app')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">


@section('content')
<div class="container">
    
    <div class="row justify-content-center">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">Your Stats</div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        This is the Page Of  {{ $user->name }}
                    </div>
                    
                    <div class="row justify-content-center">
                        @if (Auth::user()->id !==$user->id )
                            <div class="row justify-content-center">
                                @csrf
                                <input type="hidden" name="userId" id="user-id-follow" value="{{$user->id}}" />
                                <button type="submit" id="follow-button" class="btn btn-primary mt-3">{{ $followStatus ? 'Unfollow' : 'Follow' }}</button>
                            </div>
                        @endif
                    </div>
                    <hr>
                    <div class="row justify-content-center mt-4">
                        <div class="follow-info row justify-content-center">
                            <span class="follow-info  justify-content-center">Following
                                <a href="{{route('view.user-following', $user->id)}}">&nbsp;&nbsp;{{ $user->following }}&nbsp;&nbsp;</a> |
                                <a id="followers" href="{{route('view.user-followers', $user->id)}}">&nbsp;&nbsp;{{ $user->followers }}</a> Followers
                                <input type="hidden" name="userId" id="for-scroll" value="{{$user->name}}" />
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-8">

            @if ($user->id == Auth::user()->name)
                <div class="card">
                    <div class="card-header">Tweet</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        
                        <form action="{{ route('create-tweet')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <textarea class="form-control" id="exampleFormControlTextarea1" name="body" rows="3" value="{{ old('body') }}" maxlength="250" placeholder="What is on your mind"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary mt-3">Tweet</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif

            <div class="card mt-5">
                <div class="card-header">User Tweets</div>

                <div class="card-body">
                    @include('user-tweet')
                </div>
            </div>
            <div class="ajax-load text-center" style="display:none">
                <p><img style="width: 20px; height: 20px;"src="{{ asset('img/preloader.gif') }}">Loading More post</p>
            </div>
            {{-- <div class="mt-3">
                {{ $tweets->links('pagination::bootstrap-4') }}
            </div> --}}
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src="{{ asset('js/user.js') }}" defer></script>

    <script>
    $('#user-search').keyup(function(){
    var query = $(this).val();
    
    if (query.length != 0){
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: "{{ route('search-friend') }}",
            method: "POST",
            data: {query: query,
                _token: _token
                },
            success: function(data){
                if(data){
                    $('#user-list').fadeIn();
                    $('#user-list').html(data);
                }  
            }
        });
        }else{
            $('#user-list').fadeOut(); 
        }
    });

    $(document).on('click', 'li', function(){  
            $('#user-search').val($(this).text());
            $('#user-list').fadeOut();  
        }
    ); 

    $(document).click(function() {
        $('#user-list').fadeOut();  
    });          
    </script>
</div>
@endsection
