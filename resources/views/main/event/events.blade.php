@extends('partials.layout');
@section('title', 'Évènements');

@section('content')

    <!--modals-->

    <div id="confirm-modal" class="modal fade" tabindex="-1" role="dialog"
         aria-labelledby="standard-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="standard-modalLabel">Ajouter un évènement</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>Êtes-vous sûrs de vouloir effectuer cette action ?</h6>
                </div>
                <form action="/api/ac-validate" method="POST">

                    @CSRF
                    <div class="modal-footer">
                        <input type="hidden" value="" id="hiddenInputConfirmationModal"
                               name="requestID">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler
                        </button>
                        <button type="submit" class="btn btn-primary">Valider la demande</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <div id="reject-modal" class="modal fade" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="/api/ac-reject">

                    <div class="modal-header">
                        <h4 class="modal-title">Ajouter un évènement</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <form>
                                            <div class="row">

                                                <div class="col-12 col-sm-4">
                                                    <div class="form-group local-forms">
                                                        <label>Teacher Id <span class="login-danger">*</span></label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-4">
                                                    <div class="form-group local-forms">
                                                        <label>Name <span class="login-danger">*</span></label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-4">
                                                    <div class="form-group local-forms">
                                                        <label>Class <span class="login-danger">*</span></label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-4">
                                                    <div class="form-group local-forms">
                                                        <label>Section <span class="login-danger">*</span></label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-4">
                                                    <div class="form-group local-forms">
                                                        <label>Subject <span class="login-danger">*</span></label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-4">
                                                    <div class="form-group local-forms calendar-icon">
                                                        <label>Date <span class="login-danger">*</span></label>
                                                        <input class="form-control datetimepicker" type="text"
                                                               placeholder="DD-MM-YYYY">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-4">
                                                    <div class="form-group local-forms">
                                                        <label>Start Time <span class="login-danger">*</span></label>
                                                        <input type="time" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-4">
                                                    <div class="form-group local-forms">
                                                        <label>End Time <span class="login-danger">*</span></label>
                                                        <input type="time" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="student-submit">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light waves-effect"
                                data-bs-dismiss="modal">Close
                        </button>
                        <button type="submit" class="btn btn-danger waves-effect waves-light">Rejeter
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{--end modals--}}
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Events</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Events</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col"></div>
                    <div class="col-auto text-end float-end ms-auto">
                        <a href="{{route('main.event.add-event')}}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade none-border" id="my_event">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add Event</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body"></div>
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-success save-event submit-btn">Create event</button>
                            <button type="button" class="btn btn-danger delete-event submit-btn" data-dismiss="modal">Delete</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
        <script src="{{asset('js/eventPlanner.js')}}"></script>
    @endpush
@endsection
