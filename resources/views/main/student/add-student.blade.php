@php
    use App\Enums\Genre;
    use App\Enums\Role;
    use App\Models\Club;
    use App\Models\Discipline;
    use App\Models\Grade;use App\Models\User;use Illuminate\Support\Facades\Auth;

    $sensei = Auth::user();
    $club = $sensei->clubs()->first();
    $discipline = $club->discipline;
    $ClubGrades = Grade::where(Grade::DISCIPLINE_ID, $discipline->id)->get();

@endphp
@extends('partials.layout');
@section('title', 'Eleve')
@section('content')

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

    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm-12">
                    <div class="page-sub-header">
                        <h3 class="page-title">Ajouter élève</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="students.html">Eleves / Ajouter</a></li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card comman-shadow">
                    <div class="card-body">
                        <form method="POST" action="/api/web-register" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="form-title student-info">Information de l'élève <span><a
                                                href="javascript:;"><i class="feather-more-vertical"></i></a></span>
                                    </h5>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Nom <span class="login-danger">*</span></label>
                                        <input class="form-control" name="firstName" type="text" placeholder="...">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Prénoms<span class="login-danger">*</span></label>
                                        <input class="form-control" name="lastName" type="text" placeholder="...">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Genre <span class="login-danger">*</span></label>

                                        <select class="form-control select" name="genre">
                                            <option value="{{Genre::MALE}}">Homme</option>
                                            <option value="{{Genre::MALE}}">Femme</option>
                                        </select>

                                    </div>
                                </div>
                                {{--  <div class="col-12 col-sm-4">
                                      <div class="form-group local-forms calendar-icon">
                                          <label>Date Of Birth <span class="login-danger">*</span></label>
                                          <input class="form-control datetimepicker" type="text"
                                                 placeholder="DD-MM-YYYY">
                                      </div>
                                  </div>--}}

                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>E-Mail <span class="login-danger">*</span></label>
                                        <input name="email" id="emailField" class="form-control" type="text"
                                               placeholder="...">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Tél </label>
                                        <input name="phone" class="form-control" type="tel" placeholder="...">
                                        <input name="martialArtType" type="hidden"
                                               value="{{$sensei->clubs->first()->martialArtType}}">
                                        <input name="club_id" type="hidden" value="{{$sensei->clubs->first()->id}}">
                                        <input name="role" type="hidden" value="{{Role::STUDENT}}">
                                    </div>
                                </div>


                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Grade <span class="login-danger">*</span></label>
                                        <select name="grade" class="form-control select">
                                            @foreach($ClubGrades as $grade)
                                                <option value="{{$grade->id}}"> {{$grade->beltName}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                {{--
                                                                <div class="col-12 col-sm-4">
                                                                    <div class="form-group local-forms">
                                                                        <label>Class <span class="login-danger">*</span></label>
                                                                        <select class="form-control select">
                                                                            <option>Please Select Class</option>
                                                                            <option>12</option>
                                                                            <option>11</option>
                                                                            <option>10</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-sm-4">
                                                                    <div class="form-group local-forms">
                                                                        <label>Section <span class="login-danger">*</span></label>
                                                                        <select class="form-control select">
                                                                            <option>Please Select Section</option>
                                                                            <option>B</option>
                                                                            <option>A</option>
                                                                            <option>C</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-sm-4">
                                                                    <div class="form-group local-forms">
                                                                        <label>Admission ID </label>
                                                                        <input class="form-control" type="text" placeholder="Enter Admission ID">
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-sm-4">
                                                                    <div class="form-group local-forms">
                                                                        <label>Phone </label>
                                                                        <input class="form-control" type="text" placeholder="Enter Phone Number">
                                                                    </div>
                                                                </div>--}}
                                <div class="col-12 col-sm-4">
                                    <div class="form-group students-up-files">
                                        <label>Ajouter une photo (150px X 150px)</label>
                                        <div class="uplod">
                                            <label class="file-upload image-upbtn mb-0">
                                                Choose File <input id="photoInput" name="photoPath" type="file"
                                                                   accept="image/*">
                                            </label>
                                        </div>
                                        <!-- Ajout d'un élément pour afficher l'aperçu de l'image -->
                                        <div id="photoPreview" style="margin-top: 10px;">
                                            <img id="previewImg" src="#" alt="Selected Image"
                                                 style="display: none; width: 50px; height: 50px;">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="student-submit">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')

        <script src="{{asset('/js/add-userForm.js')}}"></script>

    @endpush
@endsection
