@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading">Create New Post</div>

                <div class="panel-body">
                    @include('post.form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
