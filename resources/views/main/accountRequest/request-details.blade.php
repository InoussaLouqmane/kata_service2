@php

    use App\Models\AccountRequest;
    use App\Enums\RequestStatus;

@endphp

@extends('partials.layout');
@section('title', 'Demandes');

@section('content')



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
                                    <label for="field-7" class="form-label" >Raison du rejet</label>
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
                    <p>{{$selectedRequest->comment ?? "Aucun commentaire pour l'instant"}}</p>
                </div>
            </div>
        </div>
    </div>
    {{--Modals--}}
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-sub-header">
                        <h3 class="page-title">Détails sur la demande</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="students.blade.php">Demandes / Détails</a></li>
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

                                        @if($selectedRequest->status == RequestStatus::APPROVED)
                                            <span
                                                class="fs-5 badge bg-success">{{$selectedRequest[AccountRequest::STATUS]}}</span>

                                        @elseif($selectedRequest->status == RequestStatus::REJECTED)
                                            <span
                                                class="fs-5 badge bg-danger">{{$selectedRequest[AccountRequest::STATUS]}}</span>
                                        @else
                                            <button data-requestId="{{$selectedRequest->id}}" type="submit" class="btn btn-danger me-2" id="reject-button"  data-bs-toggle="modal" data-bs-target="#reject-modal">Rejeter</button>
                                            <button data-requestId="{{$selectedRequest->id}}" type="submit" class="btn btn-primary"     id="check-button"      data-bs-toggle="modal" data-bs-target="#confirm-modal">Valider</button>
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
                                                <h5>{{$selectedRequest->firstName}} {{$selectedRequest->lastName}}</h5>
                                            </div>
                                        </div>
                                        <div class="personal-activity">
                                            <div class="personal-icons">
                                                <img src="{{asset('/img/icons/buliding-icon.svg')}}" alt>
                                            </div>
                                            <div class="views-personal">
                                                <h4>Discipline </h4>
                                                <h5>{{$selectedRequest->martialArtType}}</h5>
                                            </div>
                                        </div>
                                        <div class="personal-activity">
                                            <div class="personal-icons">
                                                <i class="feather-phone-call"></i>
                                            </div>
                                            <div class="views-personal">
                                                <h4>Téléphone</h4>
                                                <h5>{{$selectedRequest->phone}}</h5>
                                            </div>
                                        </div>
                                        <div class="personal-activity">
                                            <div class="personal-icons">
                                                <i class="feather-mail"></i>
                                            </div>
                                            <div class="views-personal">
                                                <h4>Email</h4>
                                                <h5>
                                                    {{$selectedRequest->email}}
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="personal-activity">
                                            <div class="personal-icons">
                                                <i class="feather-user"></i>
                                            </div>
                                            <div class="views-personal">
                                                <h4>Genre</h4>
                                                <h5>{{$selectedRequest->genre ?? 'Non défini'}}</h5>
                                            </div>
                                        </div>
                                        <div class="personal-activity">
                                            <div class="personal-icons">
                                                <i class="feather-calendar"></i>
                                            </div>
                                            <div class="views-personal">
                                                <h4>Numéro de license</h4>
                                                <h5>{{$selectedRequest->licenseId}}</h5>
                                            </div>
                                        </div>
                                        <div class="personal-activity">
                                            <div class="personal-icons">
                                                <i class="feather-italic"></i>
                                            </div>
                                            <div class="views-personal">
                                                <h4>Grade</h4>
                                                <h5>Ceinture Noire ({{$selectedRequest->grade}} Dan)</h5>
                                            </div>
                                        </div>
                                        <div class="personal-activity">
                                            <div class="personal-icons">
                                                <i class="feather-map-pin"></i>
                                            </div>
                                            <div class="views-personal">
                                                <h4>Adresse</h4>
                                                <h5>{{$selectedRequest->clubAddress ?? 'Non Défini'}}</h5>
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
                                                    <h5>{{$selectedRequest->clubName}} {{$selectedRequest->lastName}}</h5>
                                                </div>
                                            </div>

                                            <div class="personal-activity">
                                                <div class="personal-icons">
                                                    <img src="{{asset('/img/icons/buliding-icon.svg')}}" alt>
                                                </div>
                                                <div class="views-personal">
                                                    <h4>Adresse</h4>
                                                    <h5>{{$selectedRequest->clubAddress}}</h5>
                                                </div>
                                            </div>


                                            <div class="personal-activity">
                                                <div class="personal-icons">
                                                    <i class="feather-mail"></i>
                                                </div>
                                                <div class="views-personal">
                                                    <h4>Email</h4>
                                                    <h5>
                                                        {{$selectedRequest->email}}
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
                                                        <h4>Crée le :</h4>
                                                        <h5>{{$selectedRequest->created_at->format('d M y')}}</h5>
                                                    </div>
                                                </div>
                                                <div class="personal-activity">
                                                        <div class="personal-icons">
                                                        <img src="{{asset('/img/icons/buliding-icon.svg')}}" alt>
                                                    </div>
                                                    <div class="views-personal">
                                                        <h4>Statut</h4>
                                                        <h5>{{($selectedRequest->status)}}</h5>
                                                    </div>
                                                </div>

                                                <div class="personal-activity">
                                                    @if($selectedRequest->status == RequestStatus::REJECTED)
                                                    <div class="personal-icons">
                                                        <i class="feather-mail"></i>
                                                    </div>
                                                    <div class="views-personal">


                                                        <h4>Commentaire</h4>
                                                        <a data-bs-toggle="modal"
                                                           data-bs-target="#centermodal"
                                                           class="btn btn-circle btn-sm bg-success-light me-2 ">
                                                            Voir  <i class="feather-eye"></i>
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
    </div>

    @push('scripts')
        <script src="{{asset('/js/accountRequestModal.js')}}"></script>
    @endpush
@endsection






