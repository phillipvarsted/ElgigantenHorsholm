<!-- NEW KUNDEOPGAVE -->
<div class="modal fade" id="nyKundeopgave" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Opret ny kundeopgave</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form method="post" action="{{route('kundeopgaver.post')}}">
                <div class="modal-body">
                    <div class="row">
                        @csrf
                        <div class="col-xl-2"></div>
                        <div class="col-xl-7 my-2">

                            <div class="form-group row">
                                <label class="col-form-label col-3 text-lg-right text-left">Salgs ordre nr.</label>
                                <div class="col-9">
                                    <input class="form-control form-control-lg form-control-solid" type="text" placeholder="2200XXXXXX" name="salgs_id">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-form-label col-3 text-lg-right text-left">Produkt</label>
                                <div class="col-9">
                                    <input class="form-control form-control-lg form-control-solid" type="text" placeholder="iPhone 11 Pro" name="produkt">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-form-label col-3 text-lg-right text-left">Service</label>
                                <div class="col-9">
                                    <select class="form-control form-control-lg form-control-solid" name="service">
                                        <option value="">-- Vælg service --</option>
                                        @foreach(\App\Models\Service::all() as $service)
                                            <option value="{{$service->id}}">{{$service->service}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-form-label col-3 text-lg-right text-left">Ekstra information</label>
                                <div class="col-9">
                                    <textarea class="form-control form-control-lg form-control-solid" type="text" rows="7" placeholder="Evt. oplysninger der skal bruges til at udføre service.." name="ekstra"></textarea>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Annuller</button>
                    <button type="submit" class="btn btn-success font-weight-bold">Opret kundeopgave</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END NEW KUNDEOPGAVE -->

<!-- NEW KUNDEOPGAVE -->
<div class="modal fade" id="nyService" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Opret ny servicesag</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form method="post" action="{{route('externalservice.post')}}">
                <div class="modal-body">
                    <div class="row">
                        @csrf
                        <div class="col-xl-2"></div>
                        <div class="col-xl-7 my-2">

                            <div class="form-group row">
                                <label class="col-form-label col-3 text-lg-right text-left">Bluecare Ticket nr.</label>
                                <div class="col-9">
                                    <input class="form-control form-control-lg form-control-solid" type="text" placeholder="XXXXXX" name="bluecare_ticket_nr">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-form-label col-3 text-lg-right text-left">Varekode</label>
                                <div class="col-9">
                                    <input class="form-control form-control-lg form-control-solid" type="text" placeholder="" name="varekode">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-form-label col-3 text-lg-right text-left">Varens navn</label>
                                <div class="col-9">
                                    <input class="form-control form-control-lg form-control-solid" type="text" placeholder="" name="varekode">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-form-label col-3 text-lg-right text-left">Hvem er ejer?</label>
                                <div class="col-9">
                                    <select class="form-control form-control-lg form-control-solid" name="ejer">
                                        <option value="">-- Vælg ejer --</option>
                                        <option value="kundens">Kundens produkt</option>
                                        <option value="vores">Vores produkt</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Annuller</button>
                    <button type="submit" class="btn btn-success font-weight-bold">Opret service</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END NEW KUNDEOPGAVE -->


<!-- Modal-->
<div class="modal fade" id="confirmCompleteTodo" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Markér To Do som færdig?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form method="post" action="{{route('kundeopgaver.post')}}">
                <div class="modal-body">
                    <div class="row">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="col-lg-12">Er du sikker på, opgaven er færdiggjort?</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-danger font-weight-bold" data-dismiss="modal">Nej</button>
                    <button type="submit" class="btn btn-success font-weight-bold">Ja</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- MODAL CREATE NEW TODO RECURRING-->
<div class="modal fade" id="nyTodoRecurring" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Opret ny To Do</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form method="post" action="{{route('manager.lukkeliste.post')}}">
                <div class="modal-body">
                    <div class="row">
                        @csrf
                        <div class="col-xl-2"></div>
                        <div class="col-xl-7 my-2">

                            <div class="form-group row">
                                <label class="col-form-label col-3 text-lg-right text-left">To Do</label>
                                <div class="col-9">
                                    <input class="form-control form-control-lg form-control-solid" type="text" placeholder="ex. Quality Inspection skal være tom.." name="todo" required>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-form-label col-3 text-lg-right text-left">Afdeling</label>
                                <div class="col-9">
                                    <select class="form-control form-control-lg form-control-solid" id="exampleSelect1" name="department" required>
                                        <option value="">Vælg afdeling..</option>
                                        <option value="1">Support Center</option>
                                        <option value="2">Cashier</option>
                                        <option value="3">Aftersales</option>
                                        <option value="10">Fælles Operations</option>
                                    </select>
                                    <span class="form-text text-muted">Angiv hvilken afdeling rutinen er gældende for</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-form-label col-3 text-lg-right text-left">Gentages hver</label>
                                <div class="col-9 col-form-label">
                                    <div class="checkbox-inline">

                                        <label class="checkbox checkbox-outline checkbox-success">
                                            <input type="checkbox" name="Checkboxes15" checked disabled/>
                                            <span></span>
                                            Man
                                        </label>

                                        <label class="checkbox checkbox-outline checkbox-success">
                                            <input type="checkbox" name="Checkboxes15" checked disabled/>
                                            <span></span>
                                            Tirs
                                        </label>

                                        <label class="checkbox checkbox-outline checkbox-success">
                                            <input type="checkbox" name="Checkboxes15" checked disabled/>
                                            <span></span>
                                            Ons
                                        </label>

                                        <label class="checkbox checkbox-outline checkbox-success">
                                            <input type="checkbox" name="Checkboxes15" checked disabled/>
                                            <span></span>
                                            Tors
                                        </label>

                                        <label class="checkbox checkbox-outline checkbox-success">
                                            <input type="checkbox" name="Checkboxes15" checked disabled/>
                                            <span></span>
                                            Fre
                                        </label>

                                        <label class="checkbox checkbox-outline checkbox-success">
                                            <input type="checkbox" name="Checkboxes15" checked disabled/>
                                            <span></span>
                                            Lør
                                        </label>

                                        <label class="checkbox checkbox-outline checkbox-success">
                                            <input type="checkbox" name="Checkboxes15" checked disabled/>
                                            <span></span>
                                            Søn
                                        </label>

                                    </div>
                                    <span class="form-text text-muted">Hvilke dage skal der oprettes To Do for?</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Annuller</button>
                    <button type="submit" class="btn btn-success font-weight-bold">Opret To Do</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END MODAL TODO RECURRING -->