@php use App\Enums\RequestStatus;use App\Models\AccountRequest;use Illuminate\Support\Facades\Log;

@endphp

@extends('partials.layout');
@section('title', 'Demandes');

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
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-sub-header">
                        <h3 class="page-title">Demandes</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('main.adminDashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Liste</li>
                        </ul>
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
                                    <h3 class="page-title">Liste des demandes</h3>
                                </div>
                                <div
                                    class="col-3 text-center float-end ms-auto download-grp d-flex flex-row justify-content-end">


                                    <div class="col-8 d-flex flex-row align-items-center">

                                        <div class="col-4">Trier par :</div>
                                        <select class="form-select" id="requestFilter"
                                                aria-label="Default select example">
                                            <option selected value="Pending">Pending</option>
                                            <option value="Approuvé">Approuvées</option>
                                            <option value="Rejeté">Rejetées</option>
                                            <option value="All">Toutes</option>
                                        </select>
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

                        {{--modals--}}

                        <div class="table-responsive">
                            <table id="requestTable"
                                   class="table border-0 star-student table-hover table-center mb-0 datatable table table-striped">
                                <thead class="student-thread">
                                <tr>

                                    <th>Nom et prénoms</th>
                                    <th>Adresse mail</th>
                                    <th>Nom du club</th>
                                    <th>Art Martial</th>
                                    <th>Téléphone</th>
                                    <th>LicenseId</th>
                                    <th>Status</th>


                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(AccountRequest::all() as $accountRequest)
                                    <tr>


                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="{{route('main.accountRequest.request-details',[$accountRequest->id])}}"
                                                   class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle"
                                                                                      src="{{asset('/img/profiles/avatar-01.jpg')}}"
                                                                                      alt="User Image"></a>
                                            </h2>
                                            <a href="{{route('main.accountRequest.request-details', [$accountRequest->id])}}">{{$accountRequest->firstName. ' '.$accountRequest->lastName}}</a>
                                        </td>
                                        <td>{{$accountRequest->email}}</td>
                                        <td>{{$accountRequest->clubName}}</td>
                                        <td>{{$accountRequest->discipline()}}</td>
                                        <td>{{$accountRequest->phone}}</td>
                                        <td>{{$accountRequest->licenseId}}</td>
                                        <td class="">
                                            @if($accountRequest->status == RequestStatus::PENDING->value)
                                                <span
                                                    class="badge bg-primary">{{$accountRequest->status}}</span>

                                            @elseif($accountRequest->status == RequestStatus::APPROVED->value)
                                                <span
                                                    class="badge bg-success">{{$accountRequest->status}}</span>

                                            @elseif($accountRequest->status == RequestStatus::REJECTED->value)
                                                <span
                                                    class="badge bg-danger">{{$accountRequest->status}}</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="actions text-center justify-content-center">
                                                <a href="{{route('main.accountRequest.request-details', [$accountRequest->id])}}"
                                                   class="btn btn-circle btn-sm bg-success-light me-2 ">
                                                    <i class="feather-eye text-dark"></i>
                                                </a>

                                                @if($accountRequest[AccountRequest::STATUS] == RequestStatus::PENDING->value)
                                                    <a
                                                        data-requestId="{{$accountRequest->id}}"

                                                        class="reject-button btn  btn-circle btn-sm bg-success-light me-2 "
                                                        type="button" data-bs-toggle="modal"
                                                        data-bs-target="#reject-modal">
                                                        <i class="feather-x-circle text-danger"></i>
                                                    </a>
                                                    <a data-requestId="{{$accountRequest->id}}"
                                                       type="button"
                                                       class="check-button btn  btn-circle btn-sm bg-success-light"
                                                       data-bs-toggle="modal" data-bs-target="#confirm-modal">
                                                        <i class="feather-check-circle text-success"></i>
                                                    </a>
                                                @endif

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
        <script src="{{asset('/js/accountRequestModal.js')}}"></script>
        <script src="{{asset('/js/searchDatatable.js')}}"></script>
    @endpush

@endsection


