@php
    use App\Enums\Role;
    use App\Models\Club;
    use App\Models\Grade;use App\Models\User;
    use Illuminate\Database\Query\Builder;use Illuminate\Support\Facades\Auth;

 $authUser = Auth::user();
 $clubId = $authUser->clubs()->first()->id;

 $clubStudents = User::where('role', Role::STUDENT->value)
        ->get()
        ->filter(function ($user) use ($clubId) {
            return $user->clubs->contains('id', $clubId);
        });

 $club = Club::findOrFail($clubId);
 $discipline = $club->discipline;
 $clubGrades = Grade::where(Grade::DISCIPLINE_ID, $discipline->id)->get();

 function fetchElligibleStudents($gradeId, $clubId){


       return $elligibleStudents = User::where('role', Role::STUDENT)
                    ->whereHas('clubs', function ($query) use ($clubId) {
                        $query->where('club_id', $clubId);
                    })
                    ->whereHas('grades', function (Builder $query) use ($gradeId) {
                       $query->whereBetween('grade_id', [$gradeId+1, $gradeId+2]);
                    })
                    ->get(['id', 'firstName', 'lastName']);

 }

@endphp
@extends('partials.layout');
@section('title', 'Examen');
@section('content')
    <div class="content container-fluid">

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

        <div class="row justify-content-center">
            <div id="stepper" data-club-id="{{$clubId}}" class="d-flex text-white  pt-2 pb-4">
                <div class="step-point bg-success me fs-3 fw-bold">1</div>
                <div class="step-separator"></div>
                <div class="step-point bg-success fs-3 fw-bold">2</div>
                <div class="step-separator"></div>
                <div class="step-point bg-success fs-3 fw-bold">3</div>
            </div>
            <div class="col-sm-9">

                <div class="card">

                    <div class="card-body">
                        <form>
                            <div class="tab1 row justify-content-center">
                                <div class="col-12">
                                    <h5 class="form-title text-center"><span>Informations générales</span></h5>
                                </div>


                                <div class="col-4 align-items-center">
                                    <div class="form-group  local-forms">
                                        <label>Lieu <span class="login-danger">*</span> </label>
                                        <input type="text" class="location form-control"
                                               value="{{isset($selectedExam) ? $selectedExam->event->address: '' }}"
                                        >
                                    </div>
                                </div>

                                <div class="col-4 align-items-center">
                                    <div class="form-group  local-forms">
                                        <label>Date début<span class="login-danger">*</span> </label>
                                        <input type="date" class="startDate form-control"
                                               value="{{isset($selectedExam) ? $selectedExam->event->startDate->format('Y-m-d') : '' }}"
                                        >
                                    </div>
                                </div>

                                <div class="col-4 align-items-center">
                                    <div class="form-group  local-forms">
                                        <label>Heure début <span class="login-danger">*</span> </label>
                                        <input type="time" class="startTime form-control"

                                               value="{{isset($selectedExam) ? $selectedExam->event->startDate->format('H:m') : '' }}"
                                        >
                                    </div>
                                </div>


                            </div>
                            <div class="tab2 d-none row">
                                <div class="col-10 d-flex flex-row justify-content-between">
                                    <h5 class="form-title text-center"><span>Détails de l'examen</span></h5>
                                    <div class="col-auto">
                                        <button type="button" id="add-grade-section" class="btn btn-primary">Ajouter un
                                            grade
                                        </button>
                                    </div>

                                </div>


                                <div class="col-12 d-flex flex-column align-items-center gap-4" id="sections-container">
                                    @if(isset($selectedExam))

                                        @foreach($selectedExam->event->grades as $examGrade)
                                            <div class="block-wrapper col-10 align-items-center grade-section">
                                                <div class="content-wrapper col-12">


                                                    <div class="d-flex flex-row justify-content-between">
                                                        <a class="btn btn-sm bg-danger-light remove-grade"><i
                                                                class="feather-x-circle text-danger"></i></a>
                                                        <div class="col-12 col-sm-4">
                                                            <div class="form-group local-forms">
                                                                <label>Sélectionnez un grade <span class="login-danger">*</span>
                                                                </label>
                                                                <select class="w-100 form-control grade-select"
                                                                        name="club_id">
                                                                    <option
                                                                        value="{{$examGrade->id}}">{{$examGrade->beltName}}</option>
                                                                    @foreach($clubGrades as $grade)

                                                                        @if($grade->id != $examGrade->id)
                                                                            <option
                                                                                value="{{$grade->id}}">{{$grade->beltName}} </option>
                                                                        @endif


                                                                    @endforeach
                                                                </select>

                                                            </div>


                                                        </div>

                                                        <div class="col-12 col-sm-4">
                                                            <div class="form-group local-forms">
                                                                <label>Sélectionnez participants<span
                                                                        class="login-danger">*</span> </label>

                                                                <select class="user-select w-100 form-control"
                                                                        name="club_id">

                                                                    <option
                                                                        value="">...
                                                                    </option>


                                                                    @foreach($clubStudents as $user)

                                                                        <option
                                                                            data-grade-name="{{$user->grades()->first()->beltName}}"
                                                                            value="{{$user->id}}">{{$user->firstName.' '.$user->lastName}} </option>

                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-12 col-sm-3">
                                                            <div class="form-group  local-forms exam-fee">
                                                                <label>Frais d'examens <span
                                                                        class="login-danger">*</span>
                                                                </label>
                                                                <input type="number" class="exam-cost form-control"
                                                                       value="{{$examGrade->pivot->cost}}"
                                                                >
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="">
                                                        <label>Liste des participants <span
                                                                class="login-danger">*</span>
                                                        </label>
                                                        <div class="selectedUserArea d-flex flex-row">

                                                            @foreach($selectedExam->event->examResults as $participant)
                                                                <div class="selected-item"
                                                                     data-grade-name="{{$participant->grades()->first()->beltName}}"
                                                                     data-value="{{$participant->id}}">
                                                                    {{$participant->firstName.' '.$participant->lastName}}
                                                                    <a class="btn btn-sm bg-danger-light remove-item"><i
                                                                            class="feather-x-circle text-danger"></i></a>
                                                                </div>
                                                            @endforeach

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    @else

                                        <div class="block-wrapper col-10 align-items-center grade-section">
                                            <div class="content-wrapper col-12">


                                                <div class="d-flex flex-row justify-content-between">
                                                    <a class="btn btn-sm bg-danger-light remove-grade"><i
                                                            class="feather-x-circle text-danger"></i></a>
                                                    <div class="col-12 col-sm-4">
                                                        <div class="form-group local-forms">
                                                            <label>Sélectionnez un grade <span
                                                                    class="login-danger">*</span>
                                                            </label>
                                                            <select class="w-100 form-control grade-select"
                                                                    name="club_id">
                                                                <option value="">...</option>
                                                                @foreach($clubGrades as $grade)

                                                                    <option
                                                                        value="{{$grade->id}}">{{$grade->beltName}} </option>

                                                                @endforeach
                                                            </select>

                                                        </div>


                                                    </div>

                                                    <div class="col-12 col-sm-4">
                                                        <div class="form-group local-forms">
                                                            <label>Sélectionnez participants<span
                                                                    class="login-danger">*</span> </label>

                                                            <select disabled class="user-select w-100 form-control"
                                                                    name="club_id">

                                                                <option
                                                                    value="">...
                                                                </option>
                                                                @foreach($clubStudents as $user)

                                                                    <option
                                                                        data-grade-name="{{$user->grades()->first()->beltName}}"
                                                                        value="{{$user->id}}">{{$user->firstName.' '.$user->lastName}} </option>

                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-sm-3">
                                                        <div class="form-group  local-forms exam-fee">
                                                            <label>Frais d'examens <span class="login-danger">*</span>
                                                            </label>
                                                            <input type="number" class="exam-cost form-control">
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="">
                                                    <label>Liste des participants <span class="login-danger">*</span>
                                                    </label>
                                                    <div class="selectedUserArea d-flex flex-row"><span
                                                            class="fst-italic placeholder-fill">Aucun élève sélectionné</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    @endif
                                </div>


                            </div>


                            <div class="tab3 d-none row justify-content-center">
                                <div class="col-12 d-flex flex-row justify-content-between">
                                    <h5 class="form-title text-center"><span>Récapitulatif</span></h5>
                                </div>

                                <div class="col-10 py-4">
                                    <div class="d-flex flex-row gap-3 justify-content-end">

                                        <!--Propriétaire-->
                                        <div class="personal-activity">
                                            <div class="personal-icons">
                                                <i class="fas fa-building"></i>
                                            </div>
                                            <div class="views-personal">
                                                <h4 class="">Lieu</h4>

                                                <h5>
                                                    <a class="recapExamLocation">dd</a>
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
                                                    <a class="recapExamDateTime"></a>
                                                </h5>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-10 d-flex justify-content-center">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nom et prénoms</th>
                                            <th scope="col">Grade visé</th>
                                            <th scope="col">Montant</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>INOUSSA Louqmane</td>
                                            <td>Ceinture Jaune</td>
                                            <td>4500 FCFA</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                            <div class="row d-flex flex-row justify-content-center pt-5">
                                <div class="col-10 text-end">
                                    <button class="d-none btn btn-light me-2 addExamBackButton">Retour</button>
                                    {{--<button type="submit" class="examSubmit addExamNextButton btn btn-primary">Continuer</button>--}}
                                    <button data-event-id="{{isset($selectedExam) ? $selectedExam->event_id : ''}}" data-action={{isset($selectedExam) ? "update" : "create"}} class=" addExamNextButton btn btn-primary">Continuer</button>
                                </div>
                            </div>

                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{asset('/js/exam.js')}}"></script>
    @endpush
@endsection
