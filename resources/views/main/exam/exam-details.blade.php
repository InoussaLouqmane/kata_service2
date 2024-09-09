@php

    use App\Enums\ExamStatus;use App\Enums\UserStatus;use App\Models\AccountRequest;
    use App\Enums\RequestStatus;use App\Models\Discipline;use App\Models\Dojo;use App\Models\Grade;use App\Models\User;use Illuminate\Support\Facades\Auth;use Illuminate\Support\Facades\Log;

    use App\Enums\Role;
    $authUser = Auth::user();

 $clubId = $authUser->clubs()->first()->id;

 $clubStudents = User::where('role', Role::STUDENT->value)
        ->get()
        ->filter(function ($user) use ($clubId) {
            return $user->clubs->contains('id', $clubId);
        });
@endphp

@extends('partials.layout');
@section('title', 'Utilisateurs');

@section('content')

    <!--test-->
    <div class="content col-12">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Détails de l'examen</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="exam.html">Exam</a></li>
                        <li class="breadcrumb-item active">Add Exam</li>
                    </ul>
                </div>
            </div>
            <div class="row py-4">
                <div class="d-flex flex-row gap-3 justify-content-start">

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

        <div class="page-content row">


                <div class="{{($selectedExam->examStatus != ExamStatus::INITIATED->value) ?  'd-none ' : ''}} first-tab col-12">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="header-title mb-4 d-flex justify-content-between">Participants

                                    @if($authUser->role != Role::STUDENT->value)
                                        @if($selectedExam->examStatus == ExamStatus::INITIATED->value)
                                            <div>
                                                <a id="addParticipantButton"
                                                   data-grades="{{json_encode($selectedExam->grades->pluck('id')->toArray())}}"
                                                   class="btn btn-primary me-2"><i
                                                        class="fas fa-plus"></i> Ajouter un participant</a>

                                                <a class="btn btn-primary text-white" id="terminateExamButton"
                                                > Terminer examen </a>
                                            </div>
                                        @endif
                                    @endif



                                    @if($selectedExam->examStatus === ExamStatus::ENDED->value)
                                        <span
                                            class="badge bg-purple">Examen Terminé</span>
                                    @elseif($selectedExam->examStatus === ExamStatus::ARCHIEVED->value)
                                        <span
                                            class="badge bg-success">Examen clôturé</span>
                                    @endif

                                </h5>

                                <table
                                    id="examTable"
                                    class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                    <thead class="student-thread">

                                    <div id="addingSomeone-modal" class="modal fade" tabindex="-1" role="dialog"
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

                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="local-forms">
                                                                    <label>Sélectionnez un grade <span class="login-danger">*</span>
                                                                    </label>
                                                                    <select id="gradeSelect" class="w-100 form-control"
                                                                            name="club_id">
                                                                        <option
                                                                        @foreach(Grade::all() as $grade)

                                                                            <option
                                                                                value="{{$grade->id}}">{{$grade->beltName}} </option>

                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="row mt-4">
                                                            <div class="col-md-12">
                                                                <div class="local-forms">
                                                                    <label>Sélectionnez participants<span
                                                                            class="login-danger">*</span>
                                                                    </label>

                                                                    <select id="userSelect" class="w-100 form-control"
                                                                            name="club_id">

                                                                        @foreach($clubStudents as $user)

                                                                            @if(!$selectedExam->event->examResults->contains('id', $user->id))

                                                                                <option
                                                                                    value="{{$user->id}}">{{$user->firstName.' '.$user->lastName}} </option>
                                                                            @endif

                                                                        @endforeach
                                                                    </select>
                                                                    <input type="hidden" class="exam-id"
                                                                           value="{{$selectedExam->event_id}}">
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="row mt-4 exam-cost-row">
                                                            <div class="col-md-12">
                                                                <div class="local-forms">
                                                                    <label>Frais d'examens <span
                                                                            class="login-danger">*</span> </label>
                                                                    <input type="number" class="exam-cost form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light waves-effect"
                                                                data-bs-dismiss="modal">Fermer
                                                        </button>
                                                        <button type="button" data-exam-id="{{$selectedExam->event->id}}"
                                                                class="addParticipantSubmissionButton btn btn-primary waves-effect waves-light">
                                                            Ajouter
                                                        </button>
                                                    </div>
                                                </form>


                                            </div>
                                        </div>
                                    </div>


                                    <div id="changingGrade-modal" class="modal fade" tabindex="-1" role="dialog"
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

                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="local-forms">
                                                                    <label>Sélectionnez un grade <span class="login-danger">*</span>
                                                                    </label>
                                                                    <select id="gradeSelection" class="w-100 form-control"
                                                                            name="club_id">
                                                                        <option
                                                                        @foreach(Grade::all() as $grade)

                                                                            <option
                                                                                value="{{$grade->id}}">{{$grade->beltName}} </option>

                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-4 exam-cost-row">
                                                            <div class="col-md-12">
                                                                <div class="local-forms">
                                                                    <label>Frais d'examens <span
                                                                            class="login-danger">*</span> </label>
                                                                    <input type="number" class="exam-cost form-control">
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light waves-effect"
                                                                data-bs-dismiss="modal">Fermer
                                                        </button>
                                                        <button type="button"
                                                                class="changingGradeSubmitButton btn btn-primary waves-effect waves-light">
                                                            Confirmer
                                                        </button>
                                                    </div>
                                                </form>


                                            </div>
                                        </div>
                                    </div>
                                    <tr>


                                        <th>Nom du participant</th>

                                        <th class="text-start">Grade visé</th>
                                        @if($selectedExam->examStatus == ExamStatus::ENDED->value)
                                            <th class="text-start">Note Kata</th>
                                            <th class="text-start">Note Kihon</th>
                                            <th class="text-start">Note Kumite</th>
                                        @endif

                                        <th class="text-start">Résultat</th>
                                        @if($selectedExam->examStatus != 'Terminé' && $selectedExam->examStatus != 'Archivé')
                                            <th class="text-center">Action</th>
                                        @endif

                                    </tr>
                                    </thead>
                                    <tbody>


                                    @foreach($selectedExam->event->examResults as $result)
                                        @php
                                            $grade = Grade::find($result->pivot->grade_id)->beltName;
                                        @endphp

                                        <tr>
                                            <td class="student-name">{{$result->firstName.' '. $result->lastName}}</td>
                                            <td class="text-start">{{$grade}}</td>

                                            @if($selectedExam->examStatus == ExamStatus::ENDED->value)
                                                <td class="text-start">{{$result->pivot->noteKata}}</td>
                                                <td class="text-start">{{$result->pivot->noteKihon}}</td>
                                                <td class="text-start">{{$result->pivot->noteKumite}}</td>
                                            @endif


                                            <td class="">

                                                @if($selectedExam->examStatus === 'A venir')
                                                    <span
                                                        class="badge bg-primary">A venir</span>
                                                @else
                                                    @if($result->pivot->deliberation === 'failure')
                                                        <span
                                                            class="badge bg-danger">{{$result->pivot->deliberation}}</span>

                                                    @elseif($result->pivot->deliberation === 'success')
                                                        <span
                                                            class="badge bg-success">{{$result->pivot->deliberation}}</span>
                                                    @endif
                                                @endif
                                            </td>
                                            @if($selectedExam->examStatus != ExamStatus::ENDED->value && $selectedExam->examStatus != ExamStatus::ARCHIEVED->value)
                                                <td class="text-center">
                                                    <div class="actions text-center justify-content-center">
                                                        <a
                                                            data-exam-id="{{$selectedExam->event_id}}"
                                                            data-student-id="{{$result->id}}"
                                                            data-grades="{{json_encode($selectedExam->grades->pluck('id')->toArray())}}"
                                                            class="editGradeButton btn btn-circle btn-sm bg-success-light me-2 ">
                                                            <i class="feather-edit"></i>
                                                        </a>
                                                        <a
                                                            data-exam-id="{{$selectedExam->event_id}}"
                                                            data-student-id="{{$result->id}}"

                                                            class="deleteSomeoneFromExam btn btn-circle btn-sm bg-success-light me-2 ">
                                                            <i class="feather-trash"></i>
                                                        </a>

                                                        @if($selectedExam->examStatus === 'Terminé')
                                                            <a
                                                                data-examID="{{$selectedExam->event_id}}"
                                                                data-studentId="{{$result->id}}"

                                                                class="reject-button btn  btn-circle btn-sm bg-success-light me-2 "
                                                                type="button" data-bs-toggle="modal"
                                                                data-bs-target="#reject-modal">
                                                                <i class="feather-x-circle "></i>
                                                            </a>
                                                            <a data-requestId="{{$selectedExam->event_id}}"
                                                               type="button"
                                                               class="check-button btn  btn-circle btn-sm bg-success-light"
                                                               data-bs-toggle="modal" data-bs-target="#confirm-modal">
                                                                <i class="feather-check"></i>
                                                            </a>
                                                        @endif

                                                    </div>
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


                <div class="{{($selectedExam->examStatus == ExamStatus::INITIATED->value) ?  'd-none ' : ''}}second-tab col-12">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="header-title mb-4 d-flex justify-content-between">Participants

                                    @if($selectedExam->examStatus == ExamStatus::INITIATED->value)
                                        <a class="btn btn-primary" id="endExamButton"
                                           data-exam-id="{{$selectedExam->event_id}}"> Continuer </a>

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
                                    class="w-100 table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                    <thead class="student-thread">

                                    <tr>


                                        <th>Nom du participant</th>

                                        <th class="text-start">Grade visé</th>



                                        <th class="text-start">Note Kata</th>
                                        <th class="text-start">Note Kihon</th>
                                        <th class="text-start">Note Kumite</th>


                                        <th class="text-start">Résultat</th>

                                        @if($selectedExam->examStatus == ExamStatus::ENDED->value)
                                            <th class="text-start">Actions {{$selectedExam->status}}</th>
                                        @endif

                                    </tr>
                                    </thead>
                                    <tbody>


                                    @foreach($selectedExam->event->examResults as $result)

                                        <tr
                                            data-grade-id="{{$result->pivot->grade_id}}"
                                            data-student-id="{{$result->id}}">
                                            <td class="student-name">{{$result->firstName. ' '. $result->lastName}}</td>
                                            <td class="text-start">{{Grade::find($result->pivot->grade_id)->beltName}}</td>
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

    {{-- <div id="addingSomeone-modal" class="modal fade" tabindex="-1" role="dialog"
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

                         <div class="row">
                             <div class="col-md-12">
                                 <div class="local-forms">
                                     <label>Sélectionnez un grade <span class="login-danger">*</span>
                                     </label>
                                     <select id="gradeSelect" class="w-100 form-control"
                                             name="club_id">

                                         @foreach(Grade::all() as $grade)

                                             <option
                                                 value="{{$grade->id}}">{{$grade->beltName}} </option>

                                         @endforeach
                                     </select>
                                 </div>
                             </div>
                         </div>


                         <div class="row mt-4">
                             <div class="col-md-12">
                                 <div class="local-forms">
                                     <label>Sélectionnez participants<span class="login-danger">*</span>
                                     </label>

                                     <select id="userSelect" class="w-100 form-control"
                                             name="club_id">

                                         <option
                                             value="">...
                                         </option>
                                         @foreach(User::all() as $user)

                                             <option
                                                 value="{{$user->id}}">{{$user->firstName.' '.$user->lastName}} </option>

                                         @endforeach
                                     </select>
                                 </div>

                             </div>
                         </div>

                         <div class="row mt-4">
                             <div class="col-md-12">
                                 <div class="local-forms">
                                     <label>Frais d'examens <span class="login-danger">*</span> </label>
                                     <input type="number" class="exam-cost form-control">
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
     </div>--}}


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
    {{--Modals--}}

    @push('scripts')
        <script src="{{asset('/js/accountRequestModal.js')}}"></script>
        <script src="{{asset('/js/exam-details.js')}}"></script>
        <script src="{{asset('/js/exam-datatables.js')}}"></script>
    @endpush
@endsection






