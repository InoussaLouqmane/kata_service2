@php use App\Enums\Genre;use App\Enums\Role; @endphp
@extends('partials.layout');
@section('title', 'Ajouter un utilisateur')

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
                        <h3 class="page-title">Add Students</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="students.html">Student</a></li>
                            <li class="breadcrumb-item active">Add Students</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card comman-shadow">
                    <div class="card-body">
                        <form method="POST" action="/api/web-register">
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="form-title student-info">Student Information <span><a
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
                                        <label>Prénoms <span class="login-danger">*</span></label>
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
                                        <input name="email" class="form-control" type="text" placeholder="...">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Tél </label>
                                        <input name="phone" class="form-control" type="tel" placeholder="...">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>ID License</label>
                                        <input name="licenseId" class="form-control" type="tel" placeholder="...">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Rôle <span class="login-danger">*</span></label>
                                        <select name="role" class="form-control select">
                                            <option value="{{Role::SENSEI}}">Sensei</option>
                                            <option value="{{Role::ADMIN}}">Admin</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Grade <span class="login-danger">*</span></label>
                                        <select name="grade" class="form-control select">
                                            <option value="1">1 Dan</option>
                                            <option value="2">2 Dan</option>
                                            <option value="3">3 Dan</option>
                                            <option value="4">4 Dan</option>
                                            <option value="5">5 Dan</option>
                                            <option value="6">6 Dan</option>
                                            <option value="7">7 Dan</option>
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
                                        <label>Upload Student Photo (150px X 150px)</label>
                                        <div class="uplod">
                                            <label class="file-upload image-upbtn mb-0">
                                                Choose File <input name="photoPath" type="file">
                                            </label>
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
@endsection
