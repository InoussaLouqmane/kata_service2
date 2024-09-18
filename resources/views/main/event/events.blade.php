@php
    use App\Enums\Role;use Illuminate\Support\Facades\Auth;
    $authUser = Auth::user();
@endphp

@extends('partials.layout');
@section('title', 'Évènements');

@section('content')

    <!--modals-->


    <div id="showInformations-modal" class="modal fade" tabindex="-1" role="dialog"
         aria-labelledby="standard-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="standard-modalLabel">Détails de l'évènement</h4>
                    <input type="hidden" id="hiddenIDInput" value="">
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="">
                        <div class="follow-group d-flex flex-column align-items-start">

                            <div class="personal-activity">
                                <div class="personal-icons">
                                    <i class="feather-user"></i>
                                </div>
                                <div class="views-personal">
                                    <h4 class="">Nom de l'évènement</h4>
                                    <h5 id="eventTitleDescription"></h5>
                                </div>
                            </div>

                            <div class="personal-activity">
                                <div class="personal-icons">
                                    <i class="feather-map-pin"></i>
                                </div>
                                <div class="views-personal">
                                    <h4>Lieu de l'évènement</h4>
                                    <h5 id="eventLocationDescription"></h5>
                                </div>
                            </div>


                            <div class="personal-activity">
                                <div class="personal-icons">
                                    <i class="feather-calendar"></i>
                                </div>
                                <div class="views-personal">
                                    <h4>Date</h4>
                                    <h5 id="startDateDescription"></h5>
                                </div>
                            </div>

                            <div class="personal-activity">
                                <div class="personal-icons">
                                    <i class="feather-watch"></i>
                                </div>
                                <div class="views-personal">
                                    <h4>Horaire</h4>
                                    <h5 id="startTimeDescription"></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if($authUser->role != Role::STUDENT->value)
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer
                        </button>
                            <button type="submit" class="btn btn-danger cancelEvent">Annuler l'évènement</button>
                            <button type="submit" class="btn btn-primary modifyEvent">Modifier</button>

                    </div>

                @endif


            </div>
        </div>
    </div>

    <div id="addEvent-modal" class="modal fade" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="">

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
                                        <form class="saveEventForm">
                                            <div class="row">

                                                <div class="col-12 col-sm-12">
                                                    <div class="form-group local-forms">
                                                        <label>Nom de l'évènement <span
                                                                class="login-danger">*</span></label>
                                                        <input type="text" id="eventTitle" name="eventTitle"
                                                               class="form-control" required>
                                                        <input type="hidden" name="id" id="eventID"
                                                               value="{{Str::random(6)}}">
                                                    </div>
                                                </div>

                                                <div class="col-12 col-sm-12">
                                                    <div class="form-group local-forms">
                                                        <label>Lieu<span class="login-danger">*</span></label>
                                                        <input type="text" id="location" name="location"
                                                               class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">

                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group local-forms">
                                                        <label>Date début<span class="login-danger">*</span></label>
                                                        <input type="date" id="start_date" name="start_date"
                                                               class="form-control" disabled required>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group local-forms">
                                                        <label>Date fin <span class="login-danger">*</span></label>
                                                        <input type="date" id="end_date" name="end_date"
                                                               class="form-control" required>
                                                    </div>
                                                </div>

                                            </div>


                                            <div class="row">

                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group local-forms">
                                                        <label>Heure début<span class="login-danger">*</span></label>
                                                        <input type="time" id="start_time" name="start_time"
                                                               class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group local-forms">
                                                        <label>Heure fin <span class="login-danger">*</span></label>
                                                        <input type="time" id="end_time" name="end_time"
                                                               class="form-control" required>
                                                    </div>
                                                </div>

                                            </div>


                                            <div class="col-12 col-sm-12">
                                                <div class="student-submit ">
                                                    <button type="button" id="createEventButton"
                                                            class="w-100 btn btn-primary">Créer
                                                    </button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
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
               @if($authUser->role != Role::STUDENT->value)
                    <div class="col-auto text-end float-end ms-auto">
                        <a href="{{route('main.event.add-event')}}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                    </div>
               @endif
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
                        <button type="button" class="btn btn-danger delete-event submit-btn" data-dismiss="modal">
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    @push('scripts')

        <script src="{{asset('js/eventPlanner.js')}}"></script>
    @endpush
@endsection
