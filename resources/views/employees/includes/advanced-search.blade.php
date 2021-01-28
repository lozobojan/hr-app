<div class="row advancedSearchOptions d-none">
    <div class="col">

        <form action="{{route('employees.filter')}}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-2 pl-1">
                    <div class="form-group">
                        <label>Tip zaposlenja</label>
                        <select name="type" id="typeFilter" class="form-control">
                            <option></option>
                            @foreach($types as $type)
                                <option value="{{ $type->id }}">
                                    {{ $type->type }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-2 pl-1">
                    <div class="form-group">
                        <label for="sectorFilter">Sektor</label>
                        <select name="sector" id="sectorFilter" class="form-control">
                            <option></option>
                            @foreach($sectors as $sector)
                                <option value="{{ $sector->id }}">
                                    {{ $sector->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-2 pl-1">
                    <div class="form-group">
                        <label for="sectorFilter">Grad</label>
                        <select name="city" id="sectorFilter" class="form-control">
                            <option></option>
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}">
                                    {{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="col-md-2 pl-1">
                    <div class="form-group">
                        <label for="bank">Banka</label>
                        <input type="text" name="bank_name" class="form-control">
                    </div>
                </div>

                <div class="col-md-3 pl-1">
                    <div class="form-group">
                        <label for="salary">Plata</label>
                        <div class="input-group">
                            <span class="input-group-text"> > </span>
                            <input type="number" name="salary_greater" class="form-control">
                            <span class="input-group-text"><</span>
                            <input type="number" name="salary_less" class="form-control">
                        </div>
                    </div>
                </div>

            </div>
            <div class="text-center">
                <button class="btn btn-success btn-sm" type="submit"><i
                        class="fa fa-filter "></i> Filtriraj
                </button>

                <a class="btn btn-secondary btn-sm filterTableClear"
                   href="{{route('employees')}}"><i class="fa fa-eraser "></i> Očisti filter</a>
            </div>
        </form>


    </div>
</div>
