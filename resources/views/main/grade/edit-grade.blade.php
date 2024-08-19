

@extends('partials.layout');
@section('title', 'Discipline')
@section('content')
    <div class="content container-fluid">



        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Editer grade</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="subjects.html">Grade</a></li>
                        <li class="breadcrumb-item active">Editer Grade</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="/api/grade">
                            @csrf
                            @method('PATCH')


                            <div class="row">
                                <div class="col-12">
                                    <h5 class="form-title"><span>Détails du grade</span></h5>
                                </div>

                                <div class="col-2 col-sm-1">
                                    <div class="form-group local-forms">
                                        <label>Couleur <span class="login-danger">*</span></label>
                                        <input name="beltColor" value="{{$selectedGrade->color}}" type="color" class="form-control form-control-color" required>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Intitulé du grade <span class="login-danger">*</span></label>
                                        <input name="beltName" value="{{$selectedGrade->beltName}}" type="text" class="form-control" required>
                                        <input name="id" value="{{$selectedGrade->id}}" type="hidden" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="student-submit">
                                        <button type="submit" class="btn btn-primary">Soumettre</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

