@extends('layouts.admin')
@extends('layouts.modal')

@section('title', 'Dokumentacija')
    

@section('content')
    <script type="text/javascript" src="//code.jquery.com/jquery-2.0.1.js"></script>
    <style>
            .tree {
                min-height:20px;
                padding:19px;
                margin-bottom:20px;
                background-color:#fbfbfb;
                border:1px solid #999;
                -webkit-border-radius:4px;
                -moz-border-radius:4px;
                border-radius:4px;
                -webkit-box-shadow:inset 0 1px 1px rgba(0, 0, 0, 0.05);
                -moz-box-shadow:inset 0 1px 1px rgba(0, 0, 0, 0.05);
                box-shadow:inset 0 1px 1px rgba(0, 0, 0, 0.05)
            }
            .tree li {
                list-style-type:none;
                margin:0;
                padding:10px 5px 0 5px;
                position:relative
            }
            .tree li::before, .tree li::after {
                content:'';
                left:-20px;
                position:absolute;
                right:auto
            }
            .tree li::before {
                border-left:1px solid #999;
                bottom:50px;
                height:100%;
                top:0;
                width:1px
            }
            .tree li::after {
                border-top:1px solid #999;
                height:20px;
                top:25px;
                width:25px
            }
            .tree li span {
                -moz-border-radius:5px;
                -webkit-border-radius:5px;
                border:1px solid #999;
                border-radius:5px;
                display:inline-block;
                padding:3px 8px;
                text-decoration:none;
            }
            .tree li.parent_li>span {
                cursor:pointer
            }
            .tree>ul>li::before, .tree>ul>li::after {
                border:0
            }
            .tree li:last-child::before {
                height:30px
            }
            .tree li.parent_li>span:hover, .tree li.parent_li>span:hover+ul li span {
                /*background:#eee;*/
                border:1px solid #94a0b4;
                /*color:#000*/
            }
    </style>
    <div class="tree">
        <a id="add" class="btn btn-outline-info " href="javascript:void(0)" data-toggle="modal" data-target="#myModal">
            Dodaj
        </a>
        @php
    
            function showTree($descendent){
                $descendents = \App\Models\Documentation::find($descendent->id)->descendents();
                $return = '<li>';
                if($descendent->is_folder){
                    $return = $return . '<span class="btn btn-outline-primary"><i class="fas fa-folder"></i>&nbsp&nbsp'. $descendent->name. '</span>&nbsp&nbsp
                    <a href="#" href="javascript:void(0)" data-toggle="modal" data-target="#myModal">
                        <i class="fas fa-plus" data-id="'.$descendent->id.'"></i>
                    </a>
                    &nbsp&nbsp<a><i class="text-danger fas fa-folder-minus" data-id="'. $descendent->id .'"></i></a>';
                }
                if($descendent->is_folder == 0){
                    $return = $return . '
                    <a href="'.$descendent->file_path.'" target="_blank"><span class="btn-outline-success"><i class="fas fa-file"></i>
                    &nbsp&nbsp'. $descendent->name.'</span></a>
                    &nbsp&nbsp<a href="directory/download/'.$descendent->id.'"><i class="text-success fas fa-download"></i></a>
                    &nbsp&nbsp<a href="directory/delete/'.$descendent->id.'"><i class="text-danger fas fa-trash-alt"></i></a>
                    ';
                }
                if(count($descendents)){
                    $return = $return . '<ul>';
                    for($i = 0; $i < count($descendents); $i++){
                        if($descendents[$i]->parent_id == $descendent->id){
                            $return = $return . showTree($descendents[$i]);
                        }
                    }
                    $return = $return . '</ul>';
                }
                return $return . '</li>' ;
            }

            echo '<ul>';
            foreach($roots as $root){
                echo showTree($root);
            }
            echo '</ul>';

        @endphp
    </div>

    <script type="text/javascript">
        $(function () {
            $('.tree li:has(ul)').addClass('parent_li').find(' > span').attr('title', 'Collapse this branch');
            $('.tree li.parent_li > span').on('click', function (e) {
                var children = $(this).parent('li.parent_li').find(' > ul > li');
                if (children.is(":visible") ) {
                    children.hide('fast');
                    $(this).attr('title', 'Expand this branch').find(' > i').addClass('fa-plus').removeClass('fa-minus');
                } else {
                    children.show('fast');
                    $(this).attr('title', 'Collapse this branch').find(' > i').addClass('fa-minus').removeClass('fa-plus');
                }
                e.stopPropagation();
            });

            $(".fa-plus").click(function(){
                $('input[type=radio]').prop('checked',false);
                $("#name").val('');
                $('#parent_id').val($(this).data('id'));
            });

            $(".fa-folder-minus").click(function(){
                var id = $(this).data("id");
                console.log(id);
                swal("Da li želite da izbrišete i sadržaj foldera?", {
                    buttons: {
                        da: {
                            text: "Da!",
                            value: "1",
                        },
                        ne:{
                            text: 'Ne!',
                            value: '2',
                        },
                        cancel: "Otkaži",
                    },
                }).then((value) => {
                    if(value == 1){
                        window.location.href = "/directory/delete-all/" + id;
                    }
                    else if(value == 2){
                        window.location.href = "/directory/delete-dir/" + id;
                    }
                });
            });

            $("#add").click(function(){
                $('input[type=radio]').prop('checked',false);
                $("#name").val('');
                $("#expiration_date").val('');
                $("#type_id").val('');
                $("#sector_id").val('');
                $('#parent_id').val("{{ isset($id) ? $id : '0' }}");
            });
            
            $('input[type=radio][name=is_folder]').change(function() {
                if (this.value == '1') {
                    $('#name').attr("placeholder", "Naziv direktorijuma");
                    $('#target-row').hide();
                    $('#target-row-2').hide();
                    $('#target-row-3').hide();
                    $('#target-row-4').hide();
                }
                else if (this.value == '0') {
                    $('#name').attr("placeholder", "Naziv fajla");
                    $('#target-row').show();
                    $('#target-row-2').show();
                    $('#target-row-3').show();
                    $('#target-row-4').show();
                }
            });
        });
    </script>
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

                <div class="row">
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

@endsection
