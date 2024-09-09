@php

    use App\Enums\Role;use App\Enums\UserStatus;use App\Models\AccountRequest;
    use App\Enums\RequestStatus;use App\Models\Dojo;use App\Models\User;use Illuminate\Support\Facades\Auth;use Illuminate\Support\Facades\Log;

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
                                <div class="dropdown">
                                    @if($authUser->role != Role::STUDENT->value)
                                        <button class="btn" type="button" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                            <span> <i class="feather-more-vertical"></i></span>
                                        </button>
                                    @endif
                                    <ul class="dropdown-menu">

                                        @if($selectedClub->status === 'Actif')
                                            <li class="dropdown-item" id="activateAccountButton"><a
                                                    href="{{route('desactivateAccount.web', [$selectedClub->id])}}"
                                                    class="d-flex justify-content-around gap-1">
                                                    <i class="feather-x-circle"> </i>
                                                    <span>Désactiver compte</span>
                                                </a>
                                            </li>
                                        @endif
                                        @if($selectedClub->status === 'Inactif')
                                            <li class="dropdown-item"><a
                                                    href="{{route('activateAccount.web', [$selectedClub->id])}}"
                                                    class="d-flex justify-content-around gap-1">
                                                    <i class="feather-x-circle"> </i>
                                                    <span>Activer compte</span>
                                                </a>
                                            </li>
                                        @endif


                                        <li class="dropdown-item"><a
                                                href="{{route('main.department.edit-department', [$selectedClub->id])}}"
                                                class="d-flex justify-content-around gap-1">
                                                <i class="feather-edit"> </i>
                                                <span>Modifier</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </h4>
                        </div>
                        <div class="student-profile-head">

                            <div class="row justify-content-center">
                                <div class="col-lg-2 col-md-2">
                                    <div class="profile-user-box">
                                        <div class="profile-user-img">
                                            @if($selectedClub->logoPath)
                                                <img
                                                    src="{{asset('/storage/'.$selectedClub->logoPath)}}"
                                                    alt="Profile">
                                            @else
                                                <img src="{{asset('/img/profile-user.jpg')}}" alt="Profile">
                                            @endif

                                        </div>

                                    </div>
                                </div>
                                @php
                                    $owner = User::find($selectedClub->RegisteredBy);
                                @endphp
                                <div class="col-lg-8 col-md-8 d-flex align-items-center justify-content-center mx-2">
                                    <div class="follow-group">

                                        <div class="personal-activity">
                                            <div class="personal-icons">
                                                <i class="fas fa-building"></i>
                                            </div>
                                            <div class="views-personal">
                                                <h4 class="">Nom du club</h4>

                                                <h5>
                                                    <a> {{$selectedClub->name}}</a>
                                                </h5>

                                            </div>
                                        </div>

                                        {{--Discipline du club--}}
                                        <div class="personal-activity">
                                            <div class="personal-icons">
                                                <i class="fas feather-activity"></i>
                                            </div>
                                            <div class="views-personal">
                                                <h4 class="">Discipline</h4>

                                                <h5>
                                                    <a> {{$selectedClub->discipline->name}}</a>
                                                </h5>

                                            </div>
                                        </div>

                                        <!--Propriétaire-->
                                        <div class="personal-activity">
                                            <div class="personal-icons">
                                                <i class="feather-user"></i>
                                            </div>
                                            <div class="views-personal">
                                                <h4 class="">Propriétaire</h4>

                                                @if($owner)
                                                    <h5>
                                                        <a href="{{route('main.user.user-details', [$owner->id])}}"> {{$owner->firstName. ' '. $owner->lastName}}</a>
                                                    </h5>
                                                @else
                                                    Non défini
                                                @endif

                                            </div>
                                        </div>




                                        {{--Adresse du club--}}
                                        <div class="personal-activity">
                                            <div class="personal-icons">
                                                <i class="fas fa-location"></i>
                                            </div>
                                            <div class="views-personal">
                                                <h4>Adresse</h4>
                                                <h5>{{$selectedClub->address ?? 'Non défini'}}</h5>
                                            </div>
                                        </div>

                                        <!--Website-->
                                        <div class="personal-activity">
                                            <div class="personal-icons">
                                                <i class="feather-mail"></i>
                                            </div>
                                            <div class="views-personal">
                                                <h4>Email</h4>
                                                <h5>{{$selectedClub->email ?? 'Non défini'}}</h5>
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
                    <p>{{$selectedClub->comment ?? "Aucune description pour l'instant"}}</p>
                </div>
            </div>
        </div>
    </div>
    {{--Modals--}}


    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-4">Autres informations</h4>
                    <ul class="nav nav-tabs nav-bordered">
                        <li class="nav-item">
                            <a href="#home-b1" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                                Dojos affiliés
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#profile-b1" data-bs-toggle="tab" aria-expanded="true" class="nav-link ">
                                Membres
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#messages-b1" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                Emplacement
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="home-b1">

                            {{--dojo datatables--}}

                            <div class="row">
                                <div class="col-sm-12">
                                    <table
                                        id="clubTable"
                                        class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                        <thead class="student-thread">

                                        <tr>


                                            <th>Nom du Dojo</th>

                                            <th class="text-start">Adresse</th>
                                            <th class="text-start">Status</th>
                                            @if($authUser->role != Role::STUDENT->value)
                                                <th class="text-end">Action</th>
                                            @endif
                                        </tr>
                                        </thead>
                                        <tbody>


                                        @foreach(Dojo::all() as $dojo)
                                            @php

                                                $club = $dojo->club;
                                            @endphp

                                            @if($club->name == $selectedClub->name)

                                                <tr>


                                                    <td class="text-start">{{$dojo->name}}</td>


                                                    <td class="text-start">{{$dojo->address}}</td>
                                                    <td class="text-start">

                                                        @if($dojo->status === 'Actif')

                                                            <span
                                                                class="fs-5 badge bg-success">{{$dojo[User::STATUS]}}</span>

                                                        @elseif($dojo->status === 'Inactif')
                                                            <span
                                                                class="fs-5 badge bg-danger">{{$dojo[User::STATUS]}}</span>
                                                        @endif

                                                    </td>

                                                    @if($authUser->role != Role::STUDENT->value)
                                                        <td class="text-start">
                                                            <div class="actions">


                                                                <a href="{{route('main.department.edit-department', [$dojo->id])}}"
                                                                   class="btn btn-sm bg-danger-light">
                                                                    <i class="feather-edit"></i>
                                                                </a>


                                                            </div>
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>

                            {{--end dojo datatables--}}

                        </div>

                        <div class="tab-pane" id="profile-b1">


                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="table-responsive">
                                        <table id="userTable"
                                               class="w-100 table border-0 star-student table-hover table-center mb-0 datatable table table-striped">
                                            <thead class="student-thread">
                                            <tr>
                                                <th>Nom</th>
                                                <th>Adresse email</th>

                                                <th>Genre</th>
                                                <th>Rôle</th>
                                                <th>Status</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach(User::all() as $user)

                                                @if($user->clubs->contains($selectedClub->id))
                                                    <tr>


                                                        <td>
                                                            <h2 class="table-avatar">
                                                                <a href="{{route('main.user.user-details', [$user->id])}}"
                                                                   class="avatar avatar-sm me-2"><img
                                                                        class="avatar-img rounded-circle"
                                                                        src="{{asset('/img/profiles/avatar-01.jpg')}}"
                                                                        alt="User Image"></a>
                                                            </h2>
                                                            <a href="{{route('main.user.user-details', [$user->id])}}">{{$user->firstName}} {{$user->lastName}}</a>
                                                        </td>
                                                        <td>{{$user->email}}</td>
                                                        <td>{{$user->genre ?? '-'}}</td>
                                                        <td>{{$user->role}}</td>
                                                        <td class="">

                                                            @if($user->status === 'Actif')
                                                                <span
                                                                    class="badge bg-success">{{$user->status}}</span>

                                                            @elseif($user->status === 'Inactif')
                                                                <span
                                                                    class="badge bg-danger">{{$user->status}}</span>
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            <div class="actions text-center justify-content-center">

                                                                <div class="actions">

                                                                    <a
                                                                        href="{{route('main.user.user-details', [$user->id])}}"
                                                                        class="d-flex justify-content-around gap-1">
                                                                        <i class="feather-eye"> </i>

                                                                    </a>

                                                                    @if($authUser->role != Role::STUDENT->value)

                                                                        @if($user->status === 'Actif')
                                                                            <a
                                                                                id="activateAccountButton"
                                                                                href="{{route('desactivateAccount.web', [$user->id])}}"
                                                                                class="d-flex justify-content-around gap-1">
                                                                                <i class="feather-x-circle"> </i>

                                                                            </a>
                                                                        @endif
                                                                        @if($user->status === 'Inactif')
                                                                                <a
                                                                                    href="{{route('activateAccount.web', [$user->id])}}"
                                                                                    class="d-flex justify-content-around gap-1">
                                                                                    <i class="feather-x-circle"> </i>

                                                                                </a>
                                                                        @endif

                                                                            <a
                                                                                href="{{route('reinitializePassword.web', [$user->id])}}"
                                                                                class="d-flex justify-content-around gap-1">
                                                                                <i class="feather-lock"> </i>

                                                                            </a>
                                                                    @endif
                                                                </div>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endif

                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="tab-pane" id="messages-b1">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15860.399285257203!2d2.4256748!3d6.3811153!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x102355288ab00b25%3A0x1d8284e70561221a!2sJTEK%20SOLUTIONS!5e0!3m2!1sfr!2sbj!4v1722590950508!5m2!1sfr!2sbj"
                                width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        @push('scripts')
            <script src="{{asset('/js/accountRequestModal.js')}}"></script>
    @endpush
@endsection






