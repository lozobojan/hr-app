@extends('layouts.admin')

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
        @php

            function type($current){
                $current_descendents = \App\Models\Documentation::find($current->id)->descendents();
                if(count($current_descendents))
                    return '<span class="btn btn-warning"><i class="fas fa-minus"></i>&nbsp&nbsp'. $current->name. "</span>";
                else if($current->is_folder)
                    return '<span class="btn btn-danger"><i class="far fa-times-circle"></i>&nbsp&nbsp'. $current->name. "</span>";
                return '<span class="btn btn-success"><i class="fas fa-leaf"></i>&nbsp&nbsp'. $current->name. "</span>";
            }

            echo '<ul>';
            for($j = 0; $j < count($roots); $j++){

                $descendents = \App\Models\Documentation::find($roots[$j]->id)->descendents();

                echo '<li>';
                echo '<span class="btn btn-primary"><i class="fas fa-folder"></i>&nbsp&nbsp'. $roots[$j]->name. "</span>";
                echo '&nbsp&nbsp<a href="#"><i class="fas fa-plus"></i></a>';
                if(count($descendents)){
                    echo '<ul>';
                    for($i = 0; $i < count($descendents); $i++){

                        echo '<li>';
                        echo type($descendents[$i]);
                        echo '&nbsp&nbsp<a href="#"><i class="fas fa-plus"></i></a>';

                        if(count($descendents[$i]->descendents()))
                            echo '<ul>';

                        // Ako je leaf
                        if(!count($descendents[$i]->descendents())){
                            echo '</li>';

                            // Zatvaramo zagrade sve do parent-a sledeceg descendent-a
                            $curr_id = $descendents[$i]->parent_id;

                            while($i !== count($descendents)-1 && $curr_id !== $descendents[$i+1]->parent_id){
                                echo '</ul></li>';
                                $curr_id = \App\Models\Documentation::where('id', $curr_id)->get()->first()->parent_id;
                            }
                        }

                    }
                    echo '</ul>';
                    echo '</li>';
                }
                else
                    echo '</li>';
            }

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
        });
    </script>
@endsection
