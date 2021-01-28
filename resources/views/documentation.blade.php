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
<div class="modal-header">
    <h4 class="modal-title">Dodaj</h4>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>

<form class="submitForm objectForm" action="{{ route('directory/create') }}">
    @csrf
    <div class="modal-body">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label class="col-form-label" for="name">Naziv</label>
                        <input id="name" class="form-control" type="text" placeholder="Naziv direktorijuma ili fajla" name="name">
                    </div>
                </div>
            </div>

            <div class="row" hidden>
                <div class="col-12">
                    <div class="form-group">
                        <label class="col-form-label" for="parent_id">Lokacija:</label>
                        <input type="text" name="parent_id" id="parent_id" value="">
                    </div>
                </div>
            </div>

            <div class="row" id="target-type">
                <div class="col-12">
                    <label class="col-form-label">Tip:</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="is_folder" id="file" value="0">
                        <label class="form-check-label" for="is_folder">
                            Fajl
                        </label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="is_folder" id="folder" value="1">
                        <label class="form-check-label" for="is_folder">
                            Folder
                        </label>
                    </div>
                </div>
            </div>
            
            <div id="file_input">
            
                <div class="row" id="target-row">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="col-form-label" for="file_path">Dokument</label>
                            <input type="file" id="file_path" class="form-control" name="file_path">
                        </div>
                    </div>
                </div>

                <div class="row" id="target-row-2">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="col-form-label" for="expiration_date">Rok dokumenta</label>
                            <input type="date" min="" id="expiration_date" class="form-control" name="expiration_date">
                        </div>
                    </div>
                </div>

                <div class="row" id="target-row-3">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="col-form-label" for="expiration_date">Sektor</label>
                            <select name="sector_id" class="form-control" id="sector_id">
                                <option value="" selected></option>
                                @foreach($sectors as $sector)
                                <option value="{{$sector->id}}">{{$sector->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row" id="target-row-4">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="col-form-label" for="type_id">Tip</label>
                            <select name="type_id" class="form-control" id="type_id">
                                <option value="" selected></option>
                                @foreach($types as $type)
                                <option value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

@endsection