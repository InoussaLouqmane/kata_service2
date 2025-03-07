@php use App\Models\Discipline;use App\Models\User; @endphp
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
                                    <li class="breadcrumb-item"><a href="">Dojos / Ajouter</a></li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="/api/club-register-form" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="form-title"><span>Détails</span></h5>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Nom du club <span class="login-danger">*</span></label>
                                        <input name="clubName" type="text" class="form-control" required>
                                    </div>
                                </div>

                                {{-- <div class="col-12 col-sm-4">
                                     <div class="form-group local-forms">
                                         <label>Dis <span class="login-danger">*</span></label>
                                         <input type="text" class="form-control" required>
                                     </div>
                                 </div>
 --}}
                                {{--<div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Propriétaire du club <span class="login-danger">*</span></label>
                                        <input type="hidden" id="ClubResponsible" value="">
                                        <input class="form-control" list="datalistOptions" id="exampleDataList"
                                               placeholder="..." required>
                                        <datalist id="datalistOptions">
                                            @foreach(User::all() as $user)
                                                <option data-id="{{$user->id}}" value="{{$user->firstName}} {{$user->lastName}}">
                                            @endforeach
                                        </datalist>

                                    </div>
                                </div>--}}


                                {{-- <div class="col-12 col-sm-4">
                                     <div class="form-group local-forms calendar-icon">
                                         <label>Department Start Date <span class="login-danger">*</span></label>
                                         <input class="form-control datetimepicker" type="text" placeholder="DD-MM-YYYY">
                                     </div>
                                 </div>--}}
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Email <span class="login-danger">*</span></label>
                                        <input name="clubEmail" type="text" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Discipline<span class="login-danger">*</span></label>

                                        <select id="disciplineSelect" class="form-control" name="martialArtType">
                                            @foreach(Discipline::all() as $discipline)

                                                <option
                                                    value="{{$discipline->id}}">{{$discipline->name}} </option>

                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Adresse <span class="login-danger">*</span></label>
                                        <input name="clubAddress" type="text" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Numéro IFU</label>
                                        <input name="ClubIfuNumber" type="text" class="form-control">
                                    </div>
                                </div>


                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Site web</label>
                                        <input name="ClubWebsiteUrl" type="url" class="form-control">
                                    </div>
                                </div>
                                {{--<div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                                        <textarea class="form-control" name="clubDescription" id="exampleFormControlTextarea1"
                                                  rows="3"></textarea>

                                    </div>
                                </div>--}}

                                <div class="col-12 col-sm-4">
                                    <div class="form-group students-up-files">
                                        <label>Upload Student Photo ( <span id="fileLabelText">150px X 150px</span> <i
                                                id="checkIcon" class="fas fa-check-circle"
                                                style="display: none; color: green; background-color: white; border-radius: 50%; margin-left: 10px;"></i>)</label>
                                        <div class="uplod">
                                            <label class="file-upload image-upbtn mb-0">
                                                <span id="">Choose File</span> <input name="clubLogoPath"
                                                                                      id="photoInput" name="photoPath"
                                                                                      type="file" accept="image/*"
                                                                                      style="display: none;">

                                            </label>
                                        </div>

                                        <!-- Ajout d'un élément pour afficher l'aperçu de l'image -->
                                        <div id="photoPreview" style="margin-top: 10px;">
                                            <img id="previewImg" src="#" alt="Selected Image"
                                                 style="display: none; width: 150px; height: 150px;">
                                        </div>
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
