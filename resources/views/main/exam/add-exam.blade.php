@php use App\Enums\Role;use App\Models\Grade;use App\Models\User;use Illuminate\Support\Facades\Auth;

 $authUser = Auth::user();
 $clubId = $authUser->clubs()->first()->id;

 $clubStudents = User::where('role', Role::STUDENT->value)
        ->get()
        ->filter(function ($user) use ($clubId) {
            return $user->clubs->contains('id', $clubId);
        });

@endphp
@extends('partials.layout');
@section('title', 'Examen');
@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Planifier un examen</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="exam.html">Exam</a></li>
                        <li class="breadcrumb-item active">Add Exam</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">

                <div class="card">
                    <div id="stepper" class="d-flex text-white  pt-3">
                        <div class="step-point bg-success me fs-3 fw-bold">1</div>
                        <div class="step-separator"></div>
                        <div class="step-point bg-success fs-3 fw-bold">2</div>
                        <div class="step-separator"></div>
                        <div class="step-point bg-success fs-3 fw-bold">3</div>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="tab row">
                                <div class="col-12">
                                    <h5 class="form-title"><span>Informations générales</span></h5>
                                </div>

                                {{-- <div class="col-12 col-sm-6">
                                     <div class="form-group">
                                         <label>Class</label>
                                         <select class="form-control select">
                                             <option>Select Class</option>
                                             <option>LKG</option>
                                             <option>UKG</option>
                                             <option>1</option>
                                             <option>2</option>
                                             <option>3</option>
                                             <option>4</option>
                                             <option>5</option>
                                             <option>6</option>
                                             <option>7</option>
                                             <option>8</option>
                                             <option>9</option>
                                             <option>10</option>
                                             <option>11</option>
                                             <option>12</option>
                                         </select>
                                     </div>

                                     <div class="col-12 col-sm-6">
                                     <div class="form-group">
                                         <label>Subject</label>
                                         <input type="text" class="form-control">
                                     </div>
                                 </div>
                                 <div class="col-12 col-sm-6">
                                     <div class="form-group">
                                         <label>Fees</label>
                                         <input type="text" class="form-control">
                                     </div>
                                 </div>

                                 <div class="col-12 col-sm-6">
                                     <div class="form-group">
                                         <label>End Time</label>
                                         <input type="time" class="form-control">
                                     </div>
                                 </div>
                                 </div>--}}

                                <div class="col-12 col-sm-3">
                                    <div class="form-group  local-forms">
                                        <label>Lieu <span class="login-danger">*</span> </label>
                                        <input type="text" class="location form-control">
                                    </div>
                                </div>

                                <div class="col-12 col-sm-3">
                                    <div class="form-group  local-forms">
                                        <label>Date début<span class="login-danger">*</span> </label>
                                        <input type="date" class="startDate form-control">
                                    </div>
                                </div>

                                <div class="col-12 col-sm-3">
                                    <div class="form-group  local-forms">
                                        <label>Heure début <span class="login-danger">*</span> </label>
                                        <input type="time" class="startTime form-control">
                                    </div>
                                </div>


                            </div>
                            <div class="tab row">
                                <div class="col-12 d-flex flex-row justify-content-between">
                                    <h5 class="form-title"><span>Détails de l'examen</span></h5>
                                    <div class="col-auto">
                                        <button type="button" id="add-grade-section" class="btn btn-primary">Ajouter un
                                            grade
                                        </button>
                                    </div>

                                </div>
                                {{-- <div class="col-12 col-sm-6">
                                     <div class="form-group">
                                         <label>Class</label>
                                         <select class="form-control select">
                                             <option>Select Class</option>
                                             <option>LKG</option>
                                             <option>UKG</option>
                                             <option>1</option>
                                             <option>2</option>
                                             <option>3</option>
                                             <option>4</option>
                                             <option>5</option>
                                             <option>6</option>
                                             <option>7</option>
                                             <option>8</option>
                                             <option>9</option>
                                             <option>10</option>
                                             <option>11</option>
                                             <option>12</option>
                                         </select>
                                     </div>

                                     <div class="col-12 col-sm-6">
                                     <div class="form-group">
                                         <label>Subject</label>
                                         <input type="text" class="form-control">
                                     </div>
                                 </div>
                                 <div class="col-12 col-sm-6">
                                     <div class="form-group">
                                         <label>Fees</label>
                                         <input type="text" class="form-control">
                                     </div>
                                 </div>

                                 <div class="col-12 col-sm-6">
                                     <div class="form-group">
                                         <label>End Time</label>
                                         <input type="time" class="form-control">
                                     </div>
                                 </div>
                                 </div>--}}

                                <div class="col-12 d-flex flex-column align-items-center gap-4" id="sections-container">
                                    <div class="block-wrapper col-10 align-items-center grade-section">

                                        <div class="content-wrapper col-12">


                                            <div class="d-flex flex-row justify-content-between">
                                                <a class="btn btn-sm bg-danger-light remove-grade"><i
                                                        class="feather-x-circle text-danger"></i></a>
                                                <div class="col-12 col-sm-4">
                                                    <div class="form-group local-forms">
                                                        <label>Sélectionnez un grade <span class="login-danger">*</span>
                                                        </label>
                                                        <select id="gradeSelect" class="w-100 form-control grade-select"
                                                                name="club_id">
                                                            <option
                                                            @foreach(Grade::all() as $grade)

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

                                                        <select id="userSelect" class="user-select w-100 form-control"
                                                                name="club_id">

                                                            <option
                                                                value="">...
                                                            </option>
                                                            @foreach($clubStudents as $user)

                                                                <option
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
                                </div>


                                <div class="col-12">
                                    <button type="submit" class="examSubmit btn btn-primary">Submit</button>
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
