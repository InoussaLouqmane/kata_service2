@php

    use App\Enums\ExamStatus;use App\Enums\UserStatus;use App\Models\AccountRequest;
    use App\Enums\RequestStatus;use App\Models\Dojo;use App\Models\Grade;use App\Models\User;use Illuminate\Support\Facades\Log;

@endphp

@extends('partials.layout');
@section('title', 'Utilisateurs');

@section('content')

    <!--test-->
    <div class="content col-12">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Events</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('main.exam.exams')}}">Examens / Détails </a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="page-content row">
            <div class="card col-6">
                <div class="row align-items-center">
                    <div class="col-md-12 py-3">
                        <div class="about-info d-flex flex-row justify-content-between">
                            <h5>Informations générales

                            </h5>
                            <div class="dropdown">
                                <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span> <i class="feather-more-vertical"></i></span>
                                </button>
                                <ul class="dropdown-menu">

                                    @if($selectedExam->examStatus === 'A venir')
                                        <li class="dropdown-item"><a
                                                href="{{route('main.department.edit-department', [$selectedExam->event_id])}}"
                                                class="d-flex justify-content-around gap-1">
                                                <i class="feather-edit"> </i>
                                                <span>Modifier</span>
                                            </a>
                                        </li>
                                    @endif


                                </ul>
                            </div>
                        </div>
                        <div class="student-profile-head">

                            <div class="row">
                                <div class="col-lg-2 col-md-2 justify-content-center">

                                </div>

                                <div class="d-flex flex-column  align-items-center">
                                    <div class="d-flex flex-column gap-3 p-2 justify-content-center">

                                        <!--Propriétaire-->
                                        <div class="personal-activity">
                                            <div class="personal-icons">
                                                <i class="fas fa-building"></i>
                                            </div>
                                            <div class="views-personal">
                                                <h4 class="">Lieu</h4>

                                                <h5>
                                                    <a>{{$selectedExam->event->getLocation()}}</a>
                                                </h5>


                                            </div>
                                        </div>

                                        {{--Nom du club--}}
                                        <div class="personal-activity">
                                            <div class="personal-icons">
                                                <i class="fas fa-calendar-times"></i>
                                            </div>
                                            <div class="views-personal">
                                                <h4 class="">Date et heure</h4>

                                                <h5>
                                                    <a> {{$selectedExam->event->getStartDate()}}</a>
                                                </h5>

                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="header-title mb-4 d-flex justify-content-between">Participants

                                @if($selectedExam->examStatus == ExamStatus::INITIATED->value)
                                    <a class="btn btn-primary" id="endExamButton"
                                       data-exam-id="{{$selectedExam->event_id}}"> Terminer examen </a>

                                @elseif($selectedExam->examStatus === ExamStatus::ENDED->value)
                                    <a class="btn btn-primary" id="archieveExamButton"
                                       data-exam-id="{{$selectedExam->event_id}}"> Clôturer examen </a>
                                @else
                                    <span
                                        class="badge bg-success">Examen clôturé</span>
                                @endif

                            </h5>

                            <table
                                id="examTable"
                                class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                <thead class="student-thread">

                                <tr>


                                    <th>Nom du participant</th>

                                    <th class="text-start">Grade visé</th>
                                    <th class="text-start">Note Kata</th>
                                    <th class="text-start">Note Kihon</th>
                                    <th class="text-start">Note Kumite</th>
                                    <th class="text-start">Résultat</th>
                                    @if($selectedExam->status == ExamStatus::ENDED->value)
                                        <th class="text-start">Actions {{$selectedExam->status}}</th>
                                    @endif

                                </tr>
                                </thead>
                                <tbody>


                                @foreach($selectedExam->event->examResults as $result)

                                    <tr data-student-id="{{$result->id}}">
                                        <td class="student-name">{{$result->firstName. ' '. $result->lastName}}</td>
                                        <td class="text-start">{{$result->pivot->grade_id}}</td>
                                        <td class="text-start">

                                            @if($selectedExam->examStatus == 'A venir')
                                                <input class="noteKata" value="0" type="number">
                                            @else
                                                {{$result->pivot->noteKata}}
                                            @endif

                                        </td>
                                        <td class="text-start">
                                            @if($selectedExam->examStatus == 'A venir')
                                                <input class="noteKihon" value="0" type="number">
                                            @else
                                                {{$result->pivot->noteKihon}}
                                            @endif

                                        </td>
                                        <td class="text-start">

                                            @if($selectedExam->examStatus == 'A venir')
                                                <input class="noteKumite" value="0" type="number">
                                            @else
                                                {{$result->pivot->noteKumite}}
                                            @endif


                                        </td>
                                        <td class="">

                                            @if($selectedExam->examStatus === 'A venir')
                                                <span
                                                    class="badge bg-primary">A venir</span>
                                            @else
                                                @if($result->pivot->deliberation === 'failure')
                                                    <span
                                                        class="badge bg-danger">Échec</span>

                                                @elseif($result->pivot->deliberation === 'success')
                                                    <span
                                                        class="badge bg-success">Admis</span>
                                                @endif
                                            @endif
                                        </td>
                                        @if($selectedExam->examStatus == ExamStatus::ENDED->value)
                                            <td>


                                                <a
                                                    data-exam-id="{{$selectedExam->event_id}}"
                                                    data-student-id="{{$result->id}}"

                                                    class="modifyNotesButton btn btn-circle btn-sm bg-success-light me-2 ">
                                                    <i class="feather-edit"></i>
                                                </a>

                                            </td>
                                        @endif


                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>
    {{--end test--}}






    {{--modals--}}

     <div id="modifyNote-modal" class="modal fade" tabindex="-1" role="dialog"
          aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

         <div class="modal-dialog">
             <div class="modal-content">

                 <form method="POST" action="">

                     <div class="modal-header">
                         <h4 class="modal-title">Ajouter un participant</h4>
                         <button type="button" class="btn-close" data-bs-dismiss="modal"
                                 aria-label="Close"></button>
                     </div>
                     <div class="modal-body p-4">


                         <div class="row mt-4">
                             <div class="col-md-12">
                                 <div class="local-forms">
                                     <label>Note Kata<span class="login-danger">*</span>
                                     </label>
                                     <input type="number" class="noteKata form-control">
                                 </div>
                             </div>
                         </div>
                         <div class="row mt-4">
                             <div class="col-md-12">
                                 <div class="local-forms">
                                     <label>Note Kihon<span class="login-danger">*</span>
                                     </label>
                                     <input type="number" class="noteKihon form-control">
                                 </div>
                             </div>
                         </div>
                         <div class="row mt-4">
                             <div class="col-md-12">
                                 <div class="local-forms">
                                     <label>Note Kumite<span class="login-danger">*</span>
                                     </label>
                                     <input type="number" class="noteKumite form-control">
                                 </div>
                             </div>
                         </div>



                     </div>
                     <div class="modal-footer">
                         <button type="button" class="btn btn-light waves-effect"
                                 data-bs-dismiss="modal">Close
                         </button>
                         <button type="button" class="btn btn-primary waves-effect waves-light modifyNotesSubmitButton">Modifier
                         </button>
                     </div>
                 </form>




             </div>
         </div>
     </div>


    <div id="confirm-modal" class="modal fade" tabindex="-1" role="dialog"
         aria-labelledby="standard-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="standard-modalLabel">Confirmation</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>Êtes-vous sûrs de vouloir effectuer cette action ?</h6>
                </div>
                <form action="/api/ac-validate" method="POST">

                    @CSRF
                    <div class="modal-footer">
                        <input type="hidden" value="" id="hiddenInputConfirmationModal" name="requestID">
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
                        <h4 class="modal-title">Rejeter la demande</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">

                        <div class="row">
                            <div class="col-md-12">
                                <div class>
                                    <label for="field-7" class="form-label">Raison du rejet</label>
                                    <textarea class="form-control" id="field-7" name="comment"
                                              placeholder="Message..."></textarea>
                                </div>
                                <input type="hidden" id="hiddenInputRejectModal" name="requestID">
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
    <div class="modal fade" id="centermodal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Commentaire</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5>Motif du rejet</h5>
                    <p>{{$selectedExam->comment ?? "Aucune description pour l'instant"}}</p>
                </div>
            </div>
        </div>
    </div>
    {{--Modals--}}

    @push('scripts')
        <script src="{{asset('/js/accountRequestModal.js')}}"></script>
        <script src="{{asset('/js/exam-validation.js')}}"></script>
        <script src="{{asset('/js/exam-datatables.js')}}"></script>
    @endpush
@endsection






