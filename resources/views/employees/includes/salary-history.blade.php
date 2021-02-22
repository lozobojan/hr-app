<!-- The Modal -->

<div class="modal" id="salaryHistory">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="container mt-5 mb-5">
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <h4>Istorija plate</h4>
                        <ul class="timeline">
                            @foreach($salaryHistory as $object)
                                <li>
                                    <a class="text-blue">{{$object->pay}}, {{ $object->bonus }}</a>
                                    <a class="float-right text-blue">{{ $object->created_at }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <form action="">
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Zatvori</button>
                    <span style="display:none" class="dashboard-spinner spinner-xs formSpinner"></span>
                </div>
            </form>
        </div>
    </div>
</div>

