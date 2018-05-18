@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
        <form method="POST" action="{{ route('simpan') }}">
            <div class="form-group">
                <input type="text" name="name" value="" class="form-control">
            </div>
            <button class="btn-default" type="submit">tambah</button>
        </form>
            
        </div>
    </div>
</div>
@endsection
