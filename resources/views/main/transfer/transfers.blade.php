@php

    use App\Enums\Role;use App\Enums\TransferStatus;use App\Enums\UserStatus;use App\Models\AccountRequest;
    use App\Enums\RequestStatus;use App\Models\Club;use App\Models\Dojo;use App\Models\Transfer;use App\Models\User;use Illuminate\Support\Facades\Auth;use Illuminate\Support\Facades\Log;

@endphp

@extends('partials.layout');
@section('title', 'Transferts');

@section('content')

    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Examens</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Examens</li>
                    </ul>
                </div>
            </div>
        </div>

    </div>

    @php
        $authenticatedUser =  Auth::user();
        $authUser = User::findOrFail($authenticatedUser->id);

        $authUser = auth()->user();
        $studentsInSameClub = User::where('role', Role::STUDENT->value)
        ->get()
        ->filter(function ($user) use ($authUser) {
            return $user->clubs->contains('id', $authUser->clubs->first()->id);
        });

    @endphp

    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table">
                <div class="card-body">

                    <div class="page-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="page-title">Liste des transferts</h3>
                            </div>
                            <div class="col-auto text-end float-end ms-auto download-grp">

                                <a id="initiateTransferButton" class="btn btn-primary"> <i
                                        class="fas fa-plus"></i> Nouvelle demande </a>
                            </div>
                        </div>
                    </div>

                    <ul class="nav nav-tabs nav-bordered">
                        <li class="nav-item">
                            <a href="#home-b1" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                                Demandes reçues
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#profile-b1" data-bs-toggle="tab" aria-expanded="true" class="nav-link ">
                                Demandes inititiées
                            </a>
                        </li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="home-b1">


                            {{--Demandes Reçues datatables--}}

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class=" table-responsive">
                                        <table
                                            id="clubTable"
                                            class="w-100 table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                            <thead class="student-thread">

                                            <tr>


                                                <th class="text-center">Date d'émission</th>

                                                <th class="text-center">Élève</th>
                                                <th class="text-center">Club de provenance</th>
                                                <th class="text-center">Statut</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach(Transfer::where('InitiatingSensei_id', '!=', $authUser->id)->get() as $transfer)

                                                <tr>


                                                    <td class="text-center">{{$transfer->created_at->format('d M Y')}}</td>

                                                    <td>
                                                        <a href="{{route('main.user.user-details', [$transfer->Student->id])}}">
                                                            {{$transfer->Student->firstName.' '.$transfer->Student->lastName}}
                                                        </a>
                                                    </td>

                                                    <td class="text-center">
                                                        <a href="{{route('main.department.department-details', [$transfer->Student->clubs->first()->id])}}">
                                                            {{$transfer->Student->clubs->first()->name}}
                                                        </a>
                                                    </td>


                                                    <td class="text-center">

                                                        @if($transfer->transferStatus === TransferStatus::APPROVED->value)

                                                            <span
                                                                class="fs-5 badge bg-success">{{$transfer->transferStatus}}</span>

                                                        @elseif($transfer->transferStatus === TransferStatus::REJECTED->value)
                                                            <span
                                                                class="fs-5 badge bg-danger">{{$transfer->transferStatus}}</span>
                                                        @else
                                                            <span
                                                                class="fs-5 badge bg-primary">{{$transfer->transferStatus}}</span>
                                                        @endif

                                                    </td>

                                                    <td class="text-center">
                                                        <a
                                                            data-comment="{{$transfer->comment}}"
                                                            class="motifPopUpButton btn btn-sm bg-success-light me-2">
                                                            <i class=" feather-eye"></i>
                                                        </a>
                                                        @if($transfer->transferStatus == TransferStatus::PENDING->value)
                                                            <div class="actions">

                                                                <a
                                                                    data-transfer-id="{{$transfer->id}}"
                                                                    class="transferCancelButton btn btn-sm bg-success-light me-2">
                                                                    <i class=" feather-x-circle  text-danger"></i>
                                                                </a>
                                                            </div>

                                                        @endif
                                                    </td>
                                                </tr>

                                            @endforeach

                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>

                            {{--Demandes Reçues datatables--}}

                        </div>

                        <div class="tab-pane" id="profile-b1">



                            {{--Demandes Initiées datatables--}}

                            <div class="row">
                                <div class="table-responsive">
                                    <table
                                        id="clubTable"
                                        class="w-100 table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                        <thead class="student-thread">

                                        <tr>


                                            <th>Date d'émission</th>

                                            <th class="text-center">Élève</th>
                                            <th class="text-center">Club ciblé</th>
                                            <th class="text-center">Statut</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach(Transfer::where('InitiatingSensei_id', $authUser->id)->get() as $transfer)

                                            <tr>


                                                <td class="text-start">{{$transfer->created_at->format('d M Y')}}</td>

                                                <td class="text-center">
                                                    <a href="{{route('main.user.user-details', [$transfer->Student->id])}}">
                                                        {{$transfer->Student->firstName.' '.$transfer->Student->lastName}}
                                                    </a>
                                                </td>

                                                <td class="text-center">
                                                    <a href="{{route('main.department.department-details', [$transfer->ApprovingSensei->clubs->first()->id])}}">
                                                        {{$transfer->ApprovingSensei->clubs->first()->name}}
                                                    </a>
                                                </td>

                                                <td class="text-center">

                                                    @if($transfer->transferStatus === TransferStatus::APPROVED->value)

                                                        <span
                                                            class="fs-5 badge bg-success">{{$transfer->transferStatus}}</span>

                                                    @elseif($transfer->transferStatus === TransferStatus::REJECTED->value)
                                                        <span
                                                            class="fs-5 badge bg-danger">{{$transfer->transferStatus}}</span>
                                                    @elseif($transfer->transferStatus === TransferStatus::CANCELLED->value)
                                                        <span
                                                            class="fs-5 badge bg-purple">{{$transfer->transferStatus}}</span>
                                                    @else
                                                        <span
                                                            class="fs-5 badge bg-primary">{{$transfer->transferStatus}}</span>
                                                    @endif

                                                </td>




                                                <td class="text-center">
                                                    <a
                                                        data-comment="{{$transfer->comment}}"
                                                        class="motifPopUpButton btn btn-sm bg-success-light me-2">
                                                        <i class=" feather-eye"></i>
                                                    </a>
                                                    @if($transfer->transferStatus == TransferStatus::PENDING->value)
                                                        <div class="actions">

                                                            <a
                                                                data-transfer-id="{{$transfer->id}}"
                                                                class="transferCancelButton btn btn-sm bg-success-light me-2">
                                                                <i class=" feather-x-circle  text-danger"></i>
                                                            </a>
                                                        </div>

                                                    @endif
                                                </td>
                                            </tr>

                                        @endforeach

                                        </tbody>

                                    </table>
                                </div>
                            </div>

                            {{--end dojo datatables--}}
                        </div>


                    </div>
                </div>
            </div>

        </div>
    </div>












    {{--modals in use--}}

    <div id="create-transfer-modal" class="modal fade" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

        <div class="modal-dialog">
            <div class="modal-content">


                <form id='create-transfer-form' method="POST" action="">

                    <div class="modal-header">
                        <h4 class="modal-title">Inititier un transfert</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="local-forms">
                                    <label>Sélectionnez l'élève<span class="login-danger">*</span> </label>
                                    <select class="form-control form-select" name="student_id"
                                            id="selectedStudentSelect">
                                        @foreach($studentsInSameClub as $student)

                                            <option value="{{$student->id}}"
                                                    selected>{{$student->firstName.' '.$student->lastName }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="local-forms">
                                    <label>Sélectionnez le club<span class="login-danger">*</span> </label>
                                    <select class="form-control form-select" name="approving_sensei_id"
                                            id="targetClubSelect">
                                        @foreach(Club::all() as $club)

                                            @if(($club->id != $authUser->clubs->first()->id) && $club->RegisteredBy )
                                                <option value="{{$club->RegisteredBy}}"
                                                        selected>{{$club->name}}</option>
                                            @endif

                                        @endforeach
                                    </select>
                                    <input type="hidden" value="{{$authUser->id}}" id="initiating_sensei_id">
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light waves-effect"
                                data-bs-dismiss="modal">Annuler
                        </button>
                        <button type="submit" id="transferSubmitButton"
                                class="btn btn-primary waves-effect waves-light">
                            Confirmer
                        </button>
                    </div>
                </form>


            </div>
        </div>
    </div>


    {{--modals templates--}}

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
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler
                    </button>
                    <button type="button" class="transferValidateModalButton btn btn-primary">Valider la demande</button>
                </div>
            </div>
        </div>
    </div>

    <div id="reject-modal" class="modal fade" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Rejeter la demande</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">

                    <div class="row">
                        <div class="col-md-12">
                            <div class>
                                <label for="field-7" class="form-label">Motif du rejet</label>
                                <textarea class="form-control" id="refusal-comment" name="comment"
                                          placeholder="Message..."></textarea>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light waves-effect"
                            data-bs-dismiss="modal">Close
                    </button>
                    <button type="submit" class="transferRejectModalButton btn btn-danger waves-effect waves-light">Rejeter
                    </button>
                </div>
            </div>
        </div>
    </div>


    <div id="cancel-modal" class="modal fade" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Annuler la demande</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">

                    <div class="row">
                        <div class="col-md-12">
                            <div class>
                                <label for="field-7" class="form-label">Motif du rejet</label>
                                <textarea class="form-control" id="cancel-comment" name="comment"
                                          placeholder="Message..."></textarea>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light waves-effect"
                            data-bs-dismiss="modal">Close
                    </button>
                    <button type="submit" class="transferCancelModalButton btn btn-danger waves-effect waves-light">Rejeter
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Commentaire</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  {{--  <h5>Motif du rejet</h5>--}}
                    <p class="comment-content"></p>
                </div>
            </div>
        </div>
    </div>
    {{--Modals--}}
    @push('scripts')
        <script src="{{asset('/js/transfer.js')}}"></script>
    @endpush
@endsection






