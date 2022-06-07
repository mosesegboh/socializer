@extends('layouts.app')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">


@section('content')
<div class="container">
    
    <div class="row justify-content-center"> 
        <div class="col-md-8">
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

            <div class="card mt-5">
                <div class="card-header">Your Followers</div>

                <div class="card-body">
                    @if(!empty($followersName))
                        @foreach ($followersName as $follower)
                            <div class="">
                               
                                <form action="{{route('view.user')}}" method="GET">
                                    @csrf
                                    <input type="hidden" name="searchWord" value="{{ $follower[1]}}" />
                                    <button type="submit" style="background:none; border:none;padding:0;">{{$follower[1]}}</button>
                               </form>
                            </div> 
                            <hr>
                        @endforeach
                    @endif   
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
</div>
@endsection
