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
                    </div>
                    <hr>
                </div>
            </div>
        </div>
        
        <div class="col-md-8">
            <p>User does not exist.</p>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src="{{ asset('js/user.js') }}" defer></script>
</div>
@endsection
