@extends('layouts.admin')
@extends('layouts.modal')

@section('title', 'Dokumentacija')

@section('css')
<link rel="stylesheet" href="{{ asset('css/tree.css') }}">
@endsection

@section('js')
<script src="{{ asset('js/tree.js') }}"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-2.0.1.js"></script>
@endsection

@section('content')
<div class="tree">
    <a id="add" class="btn btn-outline-info " href="javascript:void(0)" data-toggle="modal" data-target="#myModal" data-id="{{ isset($id) ? $id : 0 }}">
        Dodaj
    </a>
    <ul>
        @foreach($roots as $root)
        {!!$root->showTree()!!}
        @endforeach
    </ul>
</div>
@endsection

@section('modal-body')
    @include('documentation.modal')
@endsection