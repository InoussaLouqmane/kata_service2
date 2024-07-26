@php use App\Models\Club;
 use App\Models\User;

@endphp
@extends('partials.layout');
@section('title', 'Club');

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

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Editer un club</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('main.department.departments')}}">Clubs</a>
                        </li>
                        <li class="breadcrumb-item active">Editer un club</li>
                    </ul>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">

                        <form method="POST" action="/api/club-edit" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-12">
                                    <h5 class="form-title"><span>Détails</span></h5>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">

                                        <label>Nom du club <span class="login-danger">*</span></label>
                                        <input name="clubName" type="text" class="form-control" value="{{$selectedClub->name}}"
                                               required>
                                    </div>
                                </div>

                                {{--<div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Dis <span class="login-danger">*</span></label>
                                        <input type="text" class="form-control" required>
                                    </div>
                                </div>--}}
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">

                                        @php
                                            $owner = User::find($selectedClub->RegisteredBy);
                                            $ownerName = $owner->firstName ?? '';
                                            $ownerName .= ' '. $owner->lastName ?? '';
                                        @endphp
                                        <label>Propriétaire</label>

                                        <select id="ownerSelect" class="form-control" name="user_id">
                                            <option value="{{$owner->id ?? ''}}">{{$ownerName ?? 'Non défini'}}</option>
                                            @foreach(User::all() as $user)
                                                @if($user->id != $owner->id)
                                                    <option
                                                        value="{{$user->id}}">{{$user->firstName}} {{$user->lastName}}</option>
                                                @endif

                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                {{-- <div class="col-12 col-sm-4">
                                     <div class="form-group local-forms">
                                         <label>Propriétaire du club <span class="login-danger">*</span></label>
                                         <input type="hidden" id="ClubResponsible" value="">
                                         <input class="form-control" list="datalistOptions" id="exampleDataList"
                                                placeholder="..." required>
                                         <datalist id="datalistOptions">
                                             @foreach(User::all() as $user)
                                                 <option data-id="{{$user->id}}"
                                                         value="{{$user->firstName}} {{$user->lastName}}">
                                             @endforeach
                                         </datalist>

                                     </div>
                                 </div>--}}


                                {{--<div class="col-12 col-sm-4">
                                    <div class="form-group local-forms calendar-icon">
                                        <label>Department Start Date <span class="login-danger">*</span></label>
                                        <input class="form-control datetimepicker" type="text" placeholder="DD-MM-YYYY">
                                    </div>
                                </div>--}}
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">

                                        <label>Email <span class="login-danger">*</span></label>
                                        <input name="clubEmail" value="{{$selectedClub->email}}" type="text" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Adresse <span class="login-danger">*</span></label>
                                        <input type="hidden" name="id" value="{{$selectedClub->id}}">
                                        <input name="clubAddress" value="{{$selectedClub->address}}" type="text" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Numéro IFU</label>
                                        <input name="ClubIfuNumber" value="{{$selectedClub->ifuNumber}}" type="text" class="form-control">
                                    </div>
                                </div>


                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Site web</label>
                                        <input name="ClubWebsiteUrl" type="url" value="{{$selectedClub->websiteUrl}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                                        <textarea class="form-control" name="clubDescription"
                                                  id="exampleFormControlTextarea1"
                                                  value="{{$selectedClub->description}}"
                                                  rows="3"></textarea>

                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="form-group students-up-files">
                                        @php
                                            if($selectedClub->logoPath){
                                                 $fileName = basename($selectedClub->logoPath);
                                            }
                                        @endphp
                                        <label>Upload Student Photo ( <span id="fileLabelText">1{{$fileName ?? '50px X 150px' }}</span> <i
                                                id="checkIcon" class="fas fa-check-circle"
                                                style="{{$selectedClub->logoPath ?? 'display: none;'}} color: green; background-color: white; border-radius: 50%; margin-left: 10px;"></i>)</label>
                                        <div class="uplod">
                                            <label class="file-upload image-upbtn mb-0">
                                                <span id="">Choose File</span> <input name="clubLogoPath"
                                                                                      id="photoInput"
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

