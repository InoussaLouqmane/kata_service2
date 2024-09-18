@php use App\Models\Grade;

 $rank = 1;
@endphp


@extends('partials.layout');
@section('title', 'Discipline')
@section('content')

    <!--modals-->
    <div class="modal fade" id="centermodal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Description</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div><p class="description-content"></p></div>

                </div>
            </div>
        </div>
    </div>
    {{--end modals--}}
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">{{isset($selectedDiscipline) ? 'Modifier ': 'Ajouter ' }} discipline</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="subjects.html">Discipline</a></li>
                        <li class="breadcrumb-item active">Ajouter discipline</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div id="stepper" class="d-flex text-white  pb-5">
                <div class="step-point bg-success me fs-3 fw-bold">1</div>
                <div class="step-separator"></div>
                <div class="step-point bg-success fs-3 fw-bold">2</div>
                <div class="step-separator"></div>
                <div class="step-point bg-success fs-3 fw-bold">3</div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form class="generalDetails">

                            <div class="tab1  row justify-content-center">
                                <div class="col-12">
                                    <h5 class="form-title text-center"><span>Détails de la discipline</span></h5>
                                </div>

                                <div class="col-10">
                                    <div class="form-group local-forms">
                                        <label>Nom de la discipline <span class="login-danger">*</span></label>
                                        <input name="name" id="disciplineName" type="text" class="form-control"
                                               value="{{isset($selectedDiscipline) ? $selectedDiscipline->name : ''}}">
                                    </div>
                                </div>

                                <div class="col-10">
                                    <div class="form-group local-forms">
                                        <label>Description (facultatif)</label>
                                        <textarea class="form-control" id="disciplineDescriptionField" name="description"
                                                  placeholder="..."
                                                  value="{{isset($selectedDiscipline) ? $selectedDiscipline->description : ''}}"
                                        ></textarea>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="tab2 d-none row justify-content-center">
                            <div class="col-12">
                                <h5 class="form-title text-center"><span>Définir les grades (par ordre croissant)</span>
                                </h5>
                            </div>

                            @if(isset($selectedDiscipline))

                                @foreach(Grade::where(Grade::DISCIPLINE_ID, $selectedDiscipline->id)->get() as $discipline)

                                    <div class="gradeComponent row justify-content-center mt-5" data-rank="{{$rank++}}">

                                        <div class="col-10 d-flex justify-content-center">

                                            <div class="col-2 local-forms">
                                                <label>Couleur <span class="login-danger">*</span></label>
                                                <input id="gradeColor" name="beltColor" type="color"
                                                       class="form-control form-control-color" value="{{$discipline->beltColor}}" required>
                                            </div>

                                            <div class="col-10  local-forms">
                                                <label>Intitulé du grade <span class="login-danger">*</span></label>
                                                <input name="beltName" type="text" class="gradeName form-control"
                                                       value="{{$discipline->beltName}}"
                                                       required>
                                            </div>

                                        </div>

                                        <div class="deleteGradeComponentButton col-1 d-flex align-items-center">

                                            <a class="btn btn-danger">
                                                <i class="feather-trash text-white "> </i>
                                            </a>

                                        </div>
                                    </div>



                                @endforeach
                                    <div class="gradeComponent row justify-content-center mt-5" data-rank="{{$rank}}">

                                        <div class="col-10 d-flex justify-content-center">

                                            <div class="col-2 local-forms">
                                                <label>Couleur <span class="login-danger">*</span></label>
                                                <input id="gradeColor" name="beltColor" type="color"
                                                       class="form-control form-control-color" required>
                                            </div>

                                            <div class="col-10  local-forms">
                                                <label>Intitulé du grade <span class="login-danger">*</span></label>
                                                <input name="beltName" type="text" class="gradeName form-control" required>
                                            </div>

                                        </div>

                                        <div class="deleteGradeComponentButton col-1 d-flex align-items-center">

                                            <a class="btn btn-danger">
                                                <i class="feather-trash text-white "> </i>
                                            </a>

                                        </div>
                                    </div>
                            @else
                                <div class="gradeComponent row justify-content-center mt-5" data-rank="1">

                                    <div class="col-10 d-flex justify-content-center">

                                        <div class="col-2 local-forms">
                                            <label>Couleur <span class="login-danger">*</span></label>
                                            <input id="gradeColor" name="beltColor" type="color"
                                                   class="form-control form-control-color" required>
                                        </div>

                                        <div class="col-10  local-forms">
                                            <label>Intitulé du grade <span class="login-danger">*</span></label>
                                            <input name="beltName" type="text" class="gradeName form-control" required>
                                        </div>

                                    </div>

                                    <div class="deleteGradeComponentButton col-1 d-flex align-items-center">

                                        <a class="btn btn-danger">
                                            <i class="feather-trash text-white "> </i>
                                        </a>

                                    </div>
                                </div>
                            @endif


                        </div>


                        <div class="tab3 d-none row justify-content-center">
                            <div class="col-12">
                                <h5 class="form-title text-center"><span>Récapitulatif</span></h5>
                            </div>


                            <div class="d-flex justify-content-center">
                                <div class="follow-group d-flex flex-row justify-content-around">

                                    <div class="d-flex flex-column">
                                        <div class="personal-activity">
                                            <div class="personal-icons">
                                                <i class="feather-bookmark"></i>
                                            </div>
                                            <div class="views-personal">
                                                <h4 class="">Intitulé de la discipline</h4>
                                                <h5 id="disciplineTitle"></h5>
                                            </div>
                                        </div>
                                        <div class="personal-activity">
                                            <div class="personal-icons">
                                                <i class="feather-file-text"></i>
                                            </div>
                                            <div class="views-personal">
                                                <h4>Description</h4>
                                                <a
                                                    class="checkDescriptionButton btn btn-circle btn-sm bg-success-light me-2 ">
                                                    <i class="feather-eye"></i>
                                                </a>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="personal-activity">
                                        <div class="personal-icons">
                                            <i class="feather-sunrise"></i>
                                        </div>
                                        <div class="views-personal">
                                            <h4>Liste des grades</h4>
                                            <h5></h5>
                                            <div id="gradeList" class="pt-3">

                                            </div>
                                        </div>
                                    </div>

                                </div>


                            </div>

                        </div>

                        <div class="row justify-content-center pt-5">
                            <div class="col-10 text-end">
                                <button class="d-none btn btn-light me-2 addDisciplineBackButton">Retour</button>
                                <button
                                    @if(isset($selectedDiscipline))
                                        data-action="update"
                                        data-discipline-id="{{$selectedDiscipline->id}}"
                                    @else
                                        data-action="create"
                                    @endif
                                    type="submit" class="btn btn-primary addDisciplineNextButton">Continuer</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    @push('scripts')
        <script src="{{asset('/js/discipline.js')}}"></script>
    @endpush
@endsection

