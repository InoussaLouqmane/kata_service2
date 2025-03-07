

@extends('partials.layout');
@section('title', 'Discipline')
@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Ajouter discipline</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="subjects.html">Discipline / Modifier</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="/api/discipline-register">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="form-title"><span>Détails de la discipline</span></h5>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Nom de la discipline <span class="login-danger">*</span></label>
                                        <input name="name" value="{{$selectedDiscipline->name}}" type="text" class="form-control">
                                        <input name="id" value="{{$selectedDiscipline->id}}" type="hidden" class="form-control">
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

