@php

    use App\Enums\UserStatus;use App\Models\AccountRequest;
    use App\Enums\RequestStatus;use App\Models\User;

@endphp

@extends('partials.layout');
@section('title', 'Utilisateurs');

@section('content')


    <!--test-->
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-sub-header">
                        <h3 class="page-title"></h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="students.html">Student</a></li>
                            <li class="breadcrumb-item active">Student Details</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="about-info">
                            <h4>Profil
                                <div class="dropdown">
                                    <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                       <span> <i class="feather-more-vertical"></i></span>
                                    </button>
                                    <ul class="dropdown-menu">

                                        @if($selectedUser->status === 'Actif')
                                            <li class="dropdown-item" id="activateAccountButton"><a href="{{route('desactivateAccount.web', [$selectedUser->id])}}"
                                                                                                    class="d-flex justify-content-around gap-1">
                                                    <i class="feather-x-circle"> </i>
                                                    <span>Désactiver compte</span>
                                                </a>
                                            </li>
                                        @endif
                                        @if($selectedUser->status === 'Inactif')
                                            <li class="dropdown-item"><a href="{{route('activateAccount.web', [$selectedUser->id])}}"
                                                                         class="d-flex justify-content-around gap-1">
                                                    <i class="feather-x-circle"> </i>
                                                    <span>Activer compte</span>
                                                </a>
                                            </li>
                                        @endif



                                        <li class="dropdown-item"><a href="{{route('reinitializePassword.web', [$selectedUser->id])}}"
                                                                     class="d-flex justify-content-around gap-1">
                                                <i class="feather-lock"> </i>
                                                <span>Réinitialiser mot de passe</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </h4>
                        </div>
                        <div class="student-profile-head">

                            <div class="row">
                                <div class="col-lg-4 col-md-4">
                                    <div class="profile-user-box">
                                        <div class="profile-user-img">
                                            <img src="{{asset('/img/profile-user.jpg')}}" alt="Profile">
                                            <div class="form-group students-up-files profile-edit-icon mb-0">
                                                <div class="uplod d-flex">
                                                    <label class="file-upload profile-upbtn mb-0">
                                                        <i class="feather-edit-3"></i><input type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="names-profiles">
                                            <h4>{{$selectedUser->firstName}} {{$selectedUser->lastName}}</h4>
                                            <h5>{{$selectedUser->martialArtType}}</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 d-flex align-items-center">
                                    <div class="follow-group">

                                        <div class="personal-activity">
                                            <div class="personal-icons">
                                                <i class="feather-user"></i>
                                            </div>
                                            <div class="views-personal">
                                                <h4 class="" >Role</h4>
                                                <h5>{{$selectedUser->role ?? 'Non défini'}}</h5>
                                            </div>
                                        </div>

                                        <div class="personal-activity">
                                            <div class="personal-icons">
                                                <i class="feather-user"></i>
                                            </div>
                                            <div class="views-personal">
                                                <h4>Email</h4>
                                                <h5>{{$selectedUser->email ?? 'Non défini'}}</h5>
                                            </div>
                                        </div>



                                        <div class="personal-activity">
                                            <div class="personal-icons">
                                                <i class="feather-calendar"></i>
                                            </div>
                                            <div class="views-personal">
                                                <h4>Membre depuis</h4>
                                                <h5>{{$selectedUser->created_at->format('d-M-Y') ?? 'Non défini'}}</h5>
                                            </div>
                                        </div>



                                        {{--<div class="students-follows">
                                            <h5>Art Martial</h5>
                                            <h4>2850</h4>
                                        </div>
                                        <div class="students-follows">
                                            <h5>Grade</h5>
                                            <h4>2850</h4>
                                        </div>
                                        <div class="students-follows">
                                            <h5>Nom du Club</h5>
                                            <h4>2850</h4>
                                        </div>--}}
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 d-flex align-items-center">
                                    <div class="follow-btn-group me-5">
                                        @if($selectedUser->status === 'Actif')

                                            <span
                                                class="fs-5 badge bg-success">{{$selectedUser[User::STATUS]}}</span>

                                        @elseif($selectedUser->status === 'Inactif')
                                            <span
                                                class="fs-5 badge bg-danger">{{$selectedUser[User::STATUS]}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="student-personals-grp">
                            <div class="card">
                                <div class="card-body">
                                    <div class="heading-detail">
                                        <h4>Personal Details :</h4>
                                    </div>
                                    <div class="d-flex flex-row justify-content-between">
                                        <div class="personal-activity">
                                            <div class="personal-icons">
                                                <i class="feather-user"></i>
                                            </div>
                                            <div class="views-personal">
                                                <h4>Nom</h4>
                                                <h5>{{$selectedUser->firstName}} {{$selectedUser->lastName}}</h5>
                                            </div>
                                        </div>

                                        <div class="personal-activity">
                                            <div class="personal-icons">
                                                <i class="feather-calendar"></i>
                                            </div>
                                            <div class="views-personal">
                                                <h4>Numéro de license</h4>
                                                <h5>{{$selectedUser->licenseId}}</h5>
                                            </div>
                                        </div>
                                        <div class="personal-activity">
                                            <div class="personal-icons">
                                                <i class="feather-italic"></i>
                                            </div>
                                            <div class="views-personal">
                                                <h4>Grade</h4>
                                                <h5>Ceinture Noire ({{$selectedUser->grade}} Dan)</h5>
                                            </div>
                                        </div>
                                        <div class="personal-activity">
                                            <div class="personal-icons">
                                                <i class="feather-map-pin"></i>
                                            </div>
                                            <div class="views-personal">
                                                <h4>Adresse</h4>
                                                <h5>Nothing here</h5>
                                            </div>
                                        </div>
                                    </div>
                                    {{--<div class="personal-activity">
                                        <div class="personal-icons">
                                            <i class="feather-user"></i>
                                        </div>
                                        <div class="views-personal">
                                            <h4>Name</h4>
                                            <h5>Bruce Willis</h5>
                                        </div>
                                    </div>
                                    <div class="personal-activity">
                                        <div class="personal-icons">
                                            <img src="{{asset('/img/icons/buliding-icon.svg')}}" alt>
                                        </div>
                                        <div class="views-personal">
                                            <h4>Department </h4>
                                            <h5>Computer Science</h5>
                                        </div>
                                    </div>
                                    <div class="personal-activity">
                                        <div class="personal-icons">
                                            <i class="feather-phone-call"></i>
                                        </div>
                                        <div class="views-personal">
                                            <h4>Mobile</h4>
                                            <h5>+91 89657 48512</h5>
                                        </div>
                                    </div>
                                    <div class="personal-activity">
                                        <div class="personal-icons">
                                            <i class="feather-mail"></i>
                                        </div>
                                        <div class="views-personal">
                                            <h4>Email</h4>
                                            <h5><a href="../cdn-cgi/l/email-protection.html" class="__cf_email__"
                                                   data-cfemail="5d393c342e241d3a303c3431733e3230">[email&#160;protected]</a>
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="personal-activity">
                                        <div class="personal-icons">
                                            <i class="feather-user"></i>
                                        </div>
                                        <div class="views-personal">
                                            <h4>Gender</h4>
                                            <h5>Male</h5>
                                        </div>
                                    </div>
                                    <div class="personal-activity">
                                        <div class="personal-icons">
                                            <i class="feather-calendar"></i>
                                        </div>
                                        <div class="views-personal">
                                            <h4>Date of Birth</h4>
                                            <h5>22 Apr 1995</h5>
                                        </div>
                                    </div>
                                    <div class="personal-activity">
                                        <div class="personal-icons">
                                            <i class="feather-italic"></i>
                                        </div>
                                        <div class="views-personal">
                                            <h4>Language</h4>
                                            <h5>English, French, Bangla</h5>
                                        </div>
                                    </div>
                                    <div class="personal-activity mb-0">
                                        <div class="personal-icons">
                                            <i class="feather-map-pin"></i>
                                        </div>
                                        <div class="views-personal">
                                            <h4>Address</h4>
                                            <h5>480, Estern Avenue, New York</h5>
                                        </div>
                                    </div>--}}
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-4">
                        <div class="student-personals-grp">
                            <div class="card mb-0">
                                <div class="card-body">
                                    <div class="heading-detail">
                                        <h4>About Me</h4>
                                    </div>
                                    <div class="hello-park">
                                        <h5>Hello I am Daisy Parks</h5>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex commodo
                                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                            cillum dolore eu fugiat nulla pariatur. Excepteur officia deserunt mollit
                                            anim id est laborum.</p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--end test--}}

    {{--modals--}}

    <div id="confirm-modal" class="modal fade" tabindex="-1" role="dialog"
         aria-labelledby="standard-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="standard-modalLabel">Confirmation</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>Êtes-vous sûrs de vouloir effectuer cette action ?</h6>
                </div>
                <form action="/api/ac-validate" method="POST">

                    @CSRF
                    <div class="modal-footer">
                        <input type="hidden" value="" id="hiddenInputConfirmationModal" name="requestID">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler
                        </button>
                        <button type="submit" class="btn btn-primary">Valider la demande</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <div id="reject-modal" class="modal fade" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="/api/ac-reject">

                    <div class="modal-header">
                        <h4 class="modal-title">Rejeter la demande</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">

                        <div class="row">
                            <div class="col-md-12">
                                <div class>
                                    <label for="field-7" class="form-label">Raison du rejet</label>
                                    <textarea class="form-control" id="field-7" name="comment"
                                              placeholder="Message..."></textarea>
                                </div>
                                <input type="hidden" id="hiddenInputRejectModal" name="requestID">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light waves-effect"
                                data-bs-dismiss="modal">Close
                        </button>
                        <button type="submit" class="btn btn-danger waves-effect waves-light">Rejeter
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <div class="modal fade" id="centermodal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Commentaire</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5>Motif du rejet</h5>
                    <p>{{$selectedUser->comment ?? "Aucun commentaire pour l'instant"}}</p>
                </div>
            </div>
        </div>
    </div>
    {{--Modals--}}

    {{--section cutted--}}
    {{--<div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-sub-header">
                        <h3 class="page-title">Détails sur la demande</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="students.blade.php">Student</a></li>
                            <li class="breadcrumb-item active">Student Details</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="about-info d-flex flex-row justify-content-between">
                            <h4>Informations générales<span><a href="javascript:;"></a></span></h4>
                            <div class="col-lg-6 col-md-6 d-flex">


                                <div class="follow-btn-group gap-3 justify-content-end  align-items-center">
                                    <div class="d-flex flex-row justify-content-between align-items-center">

                                        @if($selectedUser->status === 'Actif')

                                            <span
                                                class="fs-5 badge bg-success">{{$selectedUser[User::STATUS]}}</span>

                                        @elseif($selectedUser->status === 'Inactif')
                                            <span
                                                class="fs-5 badge bg-danger">{{$selectedUser[User::STATUS]}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-around">
                    <div class="col-lg-12">
                        <div class="student-personals-grp">
                            <div class="card">
                                <div class="card-body">
                                    <div class="heading-detail">
                                        <h4>Infos du gérant</h4>
                                    </div>

                                    <div class="d-flex flex-row justify-content-between">
                                        <div class="personal-activity">
                                            <div class="personal-icons">
                                                <i class="feather-user"></i>
                                            </div>
                                            <div class="views-personal">
                                                <h4>Nom</h4>
                                                <h5>{{$selectedUser->firstName}} {{$selectedUser->lastName}}</h5>
                                            </div>
                                        </div>
                                        <div class="personal-activity">
                                            <div class="personal-icons">
                                                <img src="{{asset('/img/icons/buliding-icon.svg')}}" alt>
                                            </div>
                                            <div class="views-personal">
                                                <h4>Discipline </h4>
                                                <h5>{{$selectedUser->martialArtType}}</h5>
                                            </div>
                                        </div>
                                        <div class="personal-activity">
                                            <div class="personal-icons">
                                                <i class="feather-phone-call"></i>
                                            </div>
                                            <div class="views-personal">
                                                <h4>Téléphone</h4>
                                                <h5>{{$selectedUser->phone}}</h5>
                                            </div>
                                        </div>
                                        <div class="personal-activity">
                                            <div class="personal-icons">
                                                <i class="feather-mail"></i>
                                            </div>
                                            <div class="views-personal">
                                                <h4>Email</h4>
                                                <h5>
                                                    {{$selectedUser->email}}
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="personal-activity">
                                            <div class="personal-icons">
                                                <i class="feather-user"></i>
                                            </div>
                                            <div class="views-personal">
                                                <h4>Genre</h4>
                                                <h5>{{$selectedUser->genre ?? 'Non défini'}}</h5>
                                            </div>
                                        </div>
                                        <div class="personal-activity">
                                            <div class="personal-icons">
                                                <i class="feather-calendar"></i>
                                            </div>
                                            <div class="views-personal">
                                                <h4>Numéro de license</h4>
                                                <h5>{{$selectedUser->licenseId}}</h5>
                                            </div>
                                        </div>
                                        <div class="personal-activity">
                                            <div class="personal-icons">
                                                <i class="feather-italic"></i>
                                            </div>
                                            <div class="views-personal">
                                                <h4>Grade</h4>
                                                <h5>Ceinture Noire ({{$selectedUser->grade}} Dan)</h5>
                                            </div>
                                        </div>
                                        <div class="personal-activity">
                                            <div class="personal-icons">
                                                <i class="feather-map-pin"></i>
                                            </div>
                                            <div class="views-personal">
                                                <h4>Adresse</h4>
                                                <h5>Nothing here</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-12">
                        <div class="student-personals-grp">
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-3 col-6">
                                        <div class="heading-detail">
                                            <h4>Infos du club</h4>
                                        </div>
                                        <div class="d-flex flex-row justify-content-between gap-2">


                                            <div class="personal-activity">
                                                <div class="personal-icons">
                                                    <i class="feather-user"></i>
                                                </div>
                                                <div class="views-personal">
                                                    <h4>Nom du club</h4>
                                                    <h5>NOthing here now--}}{{--{{$selectedUser->clubName}} {{$selectedUser->lastName}}--}}{{--</h5>
                                                </div>
                                            </div>

                                            <div class="personal-activity">
                                                <div class="personal-icons">
                                                    <img src="{{asset('/img/icons/buliding-icon.svg')}}" alt>
                                                </div>
                                                <div class="views-personal">
                                                    <h4>Adresse</h4>
                                                    <h5>Nothing now--}}{{--{{$selectedUser->address}}--}}{{--</h5>
                                                </div>
                                            </div>


                                            <div class="personal-activity">
                                                <div class="personal-icons">
                                                    <i class="feather-mail"></i>
                                                </div>
                                                <div class="views-personal">
                                                    <h4>Email</h4>
                                                    <h5>
                                                        NOthing here
                                                        --}}{{--{{$selectedUser->email}}--}}{{--
                                                    </h5>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="mb-3 col-6">
                                        <div class="heading-detail">
                                            <h4>Autres informations</h4>
                                        </div>
                                        <div class="row">

                                            <div class="d-flex flex-row justify-content-between gap-2">
                                                <div class="personal-activity">
                                                    <div class="personal-icons">
                                                        <i class="feather-calendar"></i>
                                                    </div>
                                                    <div class="views-personal">
                                                        <h4>Inscrit le :</h4>
                                                        <h5>{{$selectedUser->created_at->format('d M y')}}</h5>
                                                    </div>
                                                </div>
                                                <div class="personal-activity">
                                                    <div class="personal-icons">
                                                        <img src="{{asset('/img/icons/buliding-icon.svg')}}" alt>
                                                    </div>
                                                    <div class="views-personal">
                                                        <h4>Statut</h4>
                                                        <h5>{{($selectedUser->status)}}</h5>
                                                    </div>
                                                </div>

                                                <div class="personal-activity">
                                                    @if($selectedUser->status == UserStatus::INACTIVE)
                                                        <div class="personal-icons">
                                                            <i class="feather-mail"></i>
                                                        </div>
                                                        <div class="views-personal">


                                                            <h4>Commentaire</h4>
                                                            <a data-bs-toggle="modal"
                                                               data-bs-target="#centermodal"
                                                               class="btn btn-circle btn-sm bg-success-light me-2 ">
                                                                Voir <i class="feather-eye"></i>
                                                            </a>

                                                        </div>
                                                    @endif
                                                </div>

                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>--}}
{{--    end of section cutted--}}
    @push('scripts')
        <script src="{{asset('/js/accountRequestModal.js')}}"></script>
    @endpush
@endsection






