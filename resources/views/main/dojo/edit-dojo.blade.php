@php use App\Models\Club;use App\Models\Discipline;use App\Models\Dojo;use App\Models\User; @endphp
@extends('partials.layout');
@section('title', 'Clubs');

@section('content')


    <div class="content container-fluid">

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif(session('fail'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('fail') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

            <div class="content container-fluid">

                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="page-sub-header">
                                <h3 class="page-title"></h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="">Dojos / Modifier</a></li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form method='POST' action='/api/dojo-register'>
                            @method('PATCH')
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="form-title"><span>Détails</span></h5>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Nom du dojo <span class="login-danger">*</span></label>
                                        <input name="name" value="{{$selectedDojo->name}}" type="text" class="form-control" required>
                                        <input name="id" value="{{$selectedDojo->id}}" type="hidden" class="form-control" required>
                                    </div>
                                </div>


                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Club<span class="login-danger">*</span></label>

                                        <select id="clubSelect" class="form-control" name="club_id">

                                            @foreach(Club::all() as $club)

                                                <option
                                                    value="{{$club->id}}">{{$club->name}} </option>

                                            @endforeach
                                        </select>

                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Adresse <span class="login-danger">*</span></label>
                                        <input name="address" value="{{$selectedDojo->address}}" type="text" class="form-control"
                                               required>
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
