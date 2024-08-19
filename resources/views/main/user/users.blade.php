@php use App\Enums\RequestStatus;
 use App\Enums\UserStatus;use App\Models\AccountRequest;use App\Models\User;

@endphp

@extends('partials.layout');
@section('title', 'Utilisateurs');

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




        <div class="student-group-form">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search by ID ...">
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search by Name ...">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search by Phone ...">
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="search-student-btn">
                        <button type="btn" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table comman-shadow">
                    <div class="card-body">

                        <div class="page-header">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-4">
                                    <h3 class="page-title">Liste des utilisateurs</h3>
                                </div>
                                <div
                                    class="col-3 text-center float-end ms-auto download-grp d-flex flex-row justify-content-end">



                                    <div class="col-auto text-end float-end ms-auto download-grp">
                                        {{-- <a href="#" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i>
                                             Download</a>--}}
                                        <a href="{{route('main.user.add-user')}}" class="btn btn-primary"><i
                                                class="fas fa-plus"></i> Ajouter un utilisateur</a>
                                    </div>

                                </div>
                            </div>
                        </div>

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
                                            <input type="hidden" value="" id="hiddenInputConfirmationModal"
                                                   name="requestID">
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
                                            <button type="submit" class="btn btn-danger waves-effect waves-light">
                                                Rejeter
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- end modals--}}

                        <div class="table-responsive">
                            <table id="userTable"
                                   class="table border-0 star-student table-hover table-center mb-0 datatable table table-striped">
                                <thead class="student-thread">
                                <tr>
                                    <th>
                                        <div class="form-check check-tables">
                                            <input class="form-check-input" type="checkbox" value="something">
                                        </div>
                                    </th>
                                    <th>Nom</th>
                                    <th>Adresse email</th>
                                    <th>Téléphone</th>
                                    <th>Genre</th>
                                    <th>Rôle</th>
                                    <th>Art martial</th>
                                    <th>Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(User::all() as $user)
                                    <tr>
                                        <td>
                                            <div class="form-check check-tables">
                                                <input class="form-check-input" type="checkbox" value="something">
                                            </div>
                                        </td>

                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="{{route('main.user.user-details', [$user->id])}}"
                                                   class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle"
                                                                                      src="{{asset('/img/profiles/avatar-01.jpg')}}"
                                                                                      alt="User Image"></a>
                                            </h2>
                                            <a href="{{route('main.user.user-details', [$user->id])}}">{{$user->firstName}} {{$user->lastName}}</a>
                                        </td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->phone ?? '-'}}</td>
                                        <td>{{$user->genre ?? '-'}}</td>
                                        <td>{{$user->role}}</td>
                                        <td>{{$user->martialArtType}}</td>
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

                                                <div class="dropdown">
                                                    <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="feather-more-vertical"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                            <li class="dropdown-item"><a href="{{route('main.user.user-details', [$user->id])}}"
                                                                   class="d-flex justify-content-around gap-1">
                                                                    <i class="feather-eye"> </i>
                                                                    <span>Voir détails</span>
                                                                </a>
                                                            </li>

                                                        @if($user->status === 'Actif')
                                                            <li class="dropdown-item" id="activateAccountButton"><a href="{{route('desactivateAccount.web', [$user->id])}}"
                                                                                         class="d-flex justify-content-around gap-1">
                                                                    <i class="feather-x-circle"> </i>
                                                                    <span>Désactiver compte</span>
                                                                </a>
                                                            </li>
                                                        @endif
                                                        @if($user->status === 'Inactif')
                                                            <li class="dropdown-item"><a href="{{route('activateAccount.web', [$user->id])}}"
                                                                                         class="d-flex justify-content-around gap-1">
                                                                    <i class="feather-x-circle"> </i>
                                                                    <span>Activer compte</span>
                                                                </a>
                                                            </li>
                                                        @endif



                                                        <li class="dropdown-item"><a href="{{route('reinitializePassword.web', [$user->id])}}"
                                                                                     class="d-flex justify-content-around gap-1">
                                                                <i class="feather-lock"> </i>
                                                                <span>Réinitialiser mot de passe</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{asset('/js/searchDatatable.js')}}"></script>
        <script src="{{asset('/js/accountRequestModal.js')}}"></script>
    @endpush

@endsection


