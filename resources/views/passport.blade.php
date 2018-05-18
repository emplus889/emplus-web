@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
    <div class="col-sm-6">
        <passport-clients></passport-clients>
    </div>
    <div class="col-sm-4">
        <passport-authorized-clients></passport-authorized-clients>
    </div>
    <div class="col-sm-4">
    <passport-personal-access-tokens></passport-personal-access-tokens>
    </div>
</div>
    
    
    
</div>
@endsection
