@extends('layouts.admin')
@extends('layouts.modal')

@section('title', 'Zaposleni')


@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <div class="container-fluid ">
        <div class="dashboard-content">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header" id="top">
                        <h2 class="pageheader-title">Zaposleni</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                    @include('partials.success')

                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="card-title mt-1 mb-1">Tabela zaposleni</h5>
                                </div>
                                <div class="col-6">
                                    <a id="add" class="btn btn-sm btn-info float-right ml-3" href="javascript:void(0)" data-toggle="modal" data-target="#myModal">
                                        Dodaj zaposlenog
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <table class="table table-striped table-bordered first">
                                    <thead>
                                    <tr>
                                        <th class="text-center">R. broj</th>
                                        <th class="text-center">Ime i prezime</th>
                                        <th class="text-center">Sektor</th>
                                        <th class="text-center">Pozicija</th>
                                        <th class="text-center">Ugovor</th>
                                        <th class="text-center">Zaposlen od</th>
                                        <th class="text-center">Plata</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                {{--    @foreach($objects as $object)
                                        <tr>
                                            <td class="text-center">{{ $object->text_me }}</td>
                                            <td class="text-center">
                                                <img class="rounded" src="{{ $object->image}}" width="60">
                                            </td>
                                            <td class="text-center">
                                                <a href="{{route('admin/about-project-images')}}" class="show-object-data btn btn-sm btn-outline-success">Galerija</a>
                                            </td>
                                            <td class="text-center">{{ $object->video }}</td>
                                            <td class="text-center">
                                                <form>
                                                    <a href="javascript:void(0)" data-toggle="modal" data-id="{{$object->id}}" data-route="about-project/{{$object->id}}"
                                                       data-target="#myModal" class="edit show-object-data btn btn-sm btn-success">Izmijeni</a>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach--}}
                                <tr>
                                            <td>Row row row</td>
                                            <td>Row row row</td>
                                            <td>Row row row</td>
                                            <td>Row row row</td>
                                            <td>Row row row</td>
                                            <td>Row row row</td>
                                            <td>Row row row</td>
                                    </tr>
                                <tr>
                                    <td>marko</td>
                                    <td>Row row row</td>
                                    <td>Row row row</td>
                                    <td>Row row row</td>
                                    <td>Row row row</td>
                                    <td>Row row row</td>
                                    <td>Row row row</td>
                                </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('js')

    <script>

        $('#myModal').on('hidden.bs.modal', function () {
            $(".submitForm")[0].reset();
            var $image = $("#imageHolder");
            $("#imageHolder").removeAttr("src").replaceWith($image.clone());
        });


        $(".edit").click(function(){
            var url = "{{--{{ route('about-project/edit', ':id') }}--}}";
            url = url.replace(':id', $(this).data('id'));
            $('.objectForm').attr('action', url);
        });



        $('.table').DataTable({
            "language": {
                "emptyTable": "Nema podataka",
                "info": "Prikazano _START_ do _END_ od _TOTAL_ unosa",
                "lengthMenu": "Prikaži _MENU_ unosa",
                "search": "Pretraži:",
                "infoFiltered": "(filtrirano od _MAX_ unosa)",
                "infoEmpty":      "Prikazano 0 do 0 od 0 unosa",
                "zeroRecords": "Nema podataka",
                "paginate": {
                    "first":      "Prva",
                    "last":       "Poslednja",
                    "next":       "Slijedeća",
                    "previous":   "Prethodna"
                },
            },
            "order": [[ 4, "desc" ]],
            "ordering": false
        });

        function showData(returndata){
            $('#imageHolder').attr({ 'src': returndata.image });
            $('#text_me').val(returndata.text_me );
            $('#text_en').val(returndata.text_en );
            $('#video').val(returndata.video );
            /* $('#cover_image').val(returndata.cover_image );*/
            $('#myModal').modal('show');

        }

    </script>

@section('modal-body')
    <div class="modal-header">
        <h4 class="modal-title">Objekat</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>

    <form class="submitForm objectForm" action="{{--{{ route('about-project/store') }}--}}">
        @csrf
        <div class="modal-body">
            <div class="container">



                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="col-form-label" for="text_me">Tekst ME *</label>
                            <textarea class="form-control" id="text_me" name="text_me" placeholder="Tekst ME" ></textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="col-form-label" for="text_en">Tekst en *</label>
                            <input id="text_en" class="form-control" type="text" placeholder="Text EN" name="text_en">
                        </div>
                    </div>
                </div>



                <div class="row">
                    <div class="col-12">
                        <img width="100%" style="max-height:25%" id="imageHolder"/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="col-form-label" for="image">Fotografija *</label>
                            <input type="file" id="image" class="form-control" name="image"/>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="col-form-label" for="video">VIDEO *</label>
                            <input id="video" class="form-control" type="text" placeholder="Text EN" name="video">
                        </div>
                    </div>
                </div>




            </div>
        </div>

@endsection

@endsection
