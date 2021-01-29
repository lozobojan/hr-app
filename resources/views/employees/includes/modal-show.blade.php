<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Objekat</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form class="submitForm objectForm" action="{{ route('employees/store') }}">
                @csrf
                <div class="modal-body">
                    <div class="container">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Osnovne infomracije</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Plata</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Status posla</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contact2-tab" data-toggle="tab" href="#contact2" role="tab" aria-controls="contact2" aria-selected="false">Opis posla</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="col-form-label" for="name">Ime *</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Ime" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="col-form-label" for="last_name">Prezime *</label>
                                            <input id="last_name" class="form-control" type="text" placeholder="Prezime" name="last_name">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 text-center">
                                        <img width="40%" style="max-height:100%" id="imageHolder"/>
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



                                {{--       <div class="row">
                                           <div class="col-12">
                                               <img width="100%" style="max-height:25%" id="imageHolder"/>
                                           </div>
                                       </div>--}}

                                {{--      <div class="row">
                                          <div class="col-12">
                                              <div class="form-group">
                                                  <label class="col-form-label" for="image">Fotografija *</label>
                                                  <input type="file" id="image" class="form-control" name="image"/>
                                              </div>
                                          </div>
                                      </div>--}}

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="col-form-label" for="birth_date">Datum rodjenja *</label>
                                            <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                                                <input name="birth_date" id="birth_date" type="text" class="form-control datetimepicker-input" data-target="#datetimepicker4" />
                                                <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="col-form-label" for="qualifications">Kvalifikacije *</label>
                                            <textarea class="form-control" id="qualifications" name="qualifications" placeholder="Kvalifikacije" ></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="col-form-label" for="text_me">Adresa *</label>
                                            <textarea class="form-control" id="home_address" name="home_address" placeholder="Adresa" ></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="col-form-label" for="city_id">Grad *</label>
                                            <select class="js-" style="width: 100%;" name="city_id" id="city_id">
                                                <option value="">Odaberite grad</option>
                                                @foreach($cities as $city)
                                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="col-form-label" for="jmbg">JMBG *</label>
                                            <input type="number" class="form-control" id="jmbg" name="jmbg" placeholder="JMBG" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="col-form-label" for="gender">Pol *</label><br>
                                            <input type="radio" id="male" name="gender" value="0" @if($employee->gender == 0) checked @endif>
                                            <label for="male">Male</label><br>
                                            <input type="radio" id="female" name="gender" value="1" @if($employee->gender == 1) checked @endif>
                                            <label for="female">Female</label><br>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="col-form-label" for="email">Email *</label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="col-form-label" for="pid">Nadredjeni *</label>
                                            <select class="js-" style="width: 100%;" name="pid" id="pid">
                                                <option value="">Odaberite nadredjenog</option>
                                                @foreach($objects as $employee)
                                                    <option value="{{ $employee->id }}">{{ $employee->name }} {{ $employee->last_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="col-form-label" for="additional_info_contact">Dodatne kontakt informacije *</label>
                                            <textarea class="form-control" id="additional_info_contact" name="additional_info_contact" placeholder="Dodatne kontakt informacije" ></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="col-form-label" for="telephone_number">Fiksni broj *</label>
                                            <input type="text" class="form-control" id="telephone_number" name="telephone_number" placeholder="Fiksni broj" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="col-form-label" for="mobile_number">Mobilni broj *</label>
                                            <input type="text" class="form-control" id="mobile_number" name="mobile_number" placeholder="Mobilni broj" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="col-form-label" for="office_number">Broj kancelarije *</label>
                                            <input type="text" class="form-control" id="office_number" name="office_number" placeholder="Broj kancelarije" >
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="col-form-label" for="pay">Plata *</label>
                                            <input type="number" class="form-control" id="pay" name="pay" placeholder="Plata" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="col-form-label" for="bonus">Bonus *</label>
                                            <input type="number" class="form-control" id="bonus" name="bonus" placeholder="Bonus" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="col-form-label" for="bank_name">Ime banke *</label>
                                            <input type="text" class="form-control" id="bank_name" name="bank_name" placeholder="Ime banke" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="col-form-label" for="bank_number">Broj banke *</label>
                                            <input type="number" class="form-control" id="bank_number" name="bank_number" placeholder="Broj banke" />
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="col-form-label" for="type">Tip *</label>
                                            <select class="js-example-basic-single" style="width: 100%; line-height: 36px;" name="type" id="type">
                                                <option value="">Odaberite tip</option>
                                                @foreach($types as $type)
                                                    <option value="{{ $type->id }}">
                                                        {{ $type->type }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="col-form-label" for="status">Status *</label>
                                            <input type="text" class="form-control" id="status" name="status" placeholder="Status posla" />
                                        </div>
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="col-form-label" for="birth_date">Datum zaposlenja *</label>
                                            <div class="input-group date" id="datetimepickerdatzap" data-target-input="nearest">
                                                <input name="date_hired" id="date_hired" type="text" class="form-control datetimepicker-input" data-target="#datetimepickerdatzap" />
                                                <div class="input-group-append" data-target="#datetimepickerdatzap" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="col-form-label" for="birth_date">Zaposlen do *</label>
                                            <div class="input-group date" id="datetimepickertill" data-target-input="nearest">
                                                <input name="date_hired_till" id="date_hired_till" type="text" class="form-control datetimepicker-input" data-target="#datetimepickertill" />
                                                <div class="input-group-append" data-target="#datetimepickertill" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="col-form-label" for="additional_info">Dodatne informacije *</label>
                                            <input type="text" class="form-control" id="additional_info" name="additional_info" placeholder="Dodatne informacije" />
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane fade" id="contact2" role="tabpanel" aria-labelledby="contact2-tab">

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="col-form-label" for="skills">Sektor *</label>
                                            <select class="js-example-basic-single" style="width: 100%; line-height: 36px;" name="sector_id" id="sector_id">
                                                <option value="">Odaberite sektor</option>
                                                @foreach($sectors as $sector)
                                                    <option value="{{ $sector->id }}"
                                                    >{{ $sector->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="col-form-label" for="workplace">Radno mjesto *</label>
                                            <input type="text" class="form-control" id="workplace" name="workplace" placeholder="Radno mjesto" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="col-form-label" for="job_description">Opis posla *</label>
                                            <input type="text" class="form-control" id="job_description" name="job_description" placeholder="Opis posla" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="col-form-label" for="skills">Skills *</label>
                                            <input type="text" class="form-control" id="skills" name="skills" placeholder="Skills" />
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>





                    </div>
                </div>

                <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Zatvori</button>
                <button type="submit" class="submitFormBtn btn btn-primary">Sačuvaj</button>
                <span style="display:none" class="dashboard-spinner spinner-xs formSpinner"></span>
            </div>
            </form>
        </div>
    </div>
</div>

