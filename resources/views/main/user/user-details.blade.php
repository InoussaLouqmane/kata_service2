@php

    use App\Enums\Role;use App\Enums\UserStatus;use App\Models\AccountRequest;
    use App\Enums\RequestStatus;use App\Models\User;use Illuminate\Support\Facades\Auth;

    $authUser = Auth::user();
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
                                @if($authUser->role != Role::STUDENT->value)

                                    <div class="dropdown">
                                        <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <span> <i class="feather-more-vertical"></i></span>
                                        </button>
                                        <ul class="dropdown-menu">

                                            @if($selectedUser->status === 'Actif')
                                                <li class="dropdown-item" id="activateAccountButton"><a
                                                        href="{{route('desactivateAccount.web', [$selectedUser->id])}}"
                                                        class="d-flex justify-content-around gap-1">
                                                        <i class="feather-x-circle"> </i>
                                                        <span>Désactiver compte</span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if($selectedUser->status === 'Inactif')
                                                <li class="dropdown-item"><a
                                                        href="{{route('activateAccount.web', [$selectedUser->id])}}"
                                                        class="d-flex justify-content-around gap-1">
                                                        <i class="feather-x-circle"> </i>
                                                        <span>Activer compte</span>
                                                    </a>
                                                </li>
                                            @endif


                                            <li class="dropdown-item"><a
                                                    href="{{route('reinitializePassword.web', [$selectedUser->id])}}"
                                                    class="d-flex justify-content-around gap-1">
                                                    <i class="feather-lock"> </i>
                                                    <span>Réinitialiser mot de passe</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>

                                @endif
                            </h4>
                        </div>
                        <div class="student-profile-head">

                            <div class="row">
                                <div class="col-lg-4 col-md-4">
                                    <div class="profile-user-box">
                                        <div class="profile-user-img">
                                            @if($selectedUser->photoPath)
                                                <img src="{{asset('/storage/'.$selectedUser->photoPath)}}"
                                                     alt="Profile">
                                            @else
                                                <img src="{{asset('/img/profile-user.jpg')}}" alt="Profile">
                                            @endif
                                            {{-- <div class="form-group students-up-files profile-edit-icon mb-0">
                                                 <div class="uplod d-flex">
                                                     <label class="file-upload profile-upbtn mb-0">
                                                         <i class="feather-edit-3"></i><input type="file">
                                                     </label>
                                                 </div>
                                             </div>--}}
                                        </div>
                                        <div class="names-profiles">
                                            <h4>{{$selectedUser->firstName}} {{$selectedUser->lastName}}</h4>
                                            <h5>{{$selectedUser->discipline->name}}</h5>
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
                                                <h4 class="">Role</h4>
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
                                                <h5>{{$selectedUser->licenseId ?? 'Non défini'}}</h5>
                                            </div>
                                        </div>
                                        <div class="personal-activity">
                                            <div class="personal-icons">
                                                <i class="feather-italic"></i>
                                            </div>
                                            <div class="views-personal">
                                                <h4>Grade</h4>
                                                <h5>Ceinture Noire ({{$selectedUser->grade }} Dan)</h5>
                                            </div>
                                        </div>
                                        <div class="personal-activity">
                                            <div class="personal-icons">
                                                <i class="feather-map-pin"></i>
                                            </div>
                                            <div class="views-personal">
                                                <h4>Adresse</h4>
                                                <h5>Non défini</h5>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-4">
                        <div class="student-personals-grp">
                            <div class="card mb-0">
                                <div class="card-body">
                                    <div class="heading-detail">
                                        <h4>A propos</h4>
                                    </div>
                                    <div class="hello-park">
                                        <h5></h5>
                                        <p>{{$selectedUser->bioDescription ?? 'Rien à dire, pour l\'instant'}}</p>
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

    @push('scripts')
        <script src="{{asset('/js/accountRequestModal.js')}}"></script>
    @endpush
@endsection






