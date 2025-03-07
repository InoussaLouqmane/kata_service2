@php

    use App\Enums\TransactionStatus;use App\Models\Fees;
    use App\Models\Payment;use App\Models\Transaction;use Illuminate\Support\Facades\Auth;use Kkiapay\Kkiapay;

    $authUser= Auth::user();
    $userClub = $authUser->clubs->first()->id;
    $fees = Fees::where('club_id', $userClub)->get();
    $studentTransactions = Transaction::where(Transaction::PAYER_ID, $authUser->id)->get();



@endphp

@extends('partials.layout');
@section('title', 'Frais');
@section('content')
    <div class="content container-fluid">


        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Events</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('main.fee.fees')}}">Frais / Détails </a></li>
                    </ul>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">

                        <div class="page-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="page-title">Liste des échéances de paiement</h3>
                                </div>

                            </div>
                        </div>


                        <div class="table-responsive">
                            <table
                                class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                <thead class="student-thread">
                                <tr>
                                    <th class="text-center">Désignation</th>
                                    <th class="text-center">Montant</th>
                                    <th class="text-center">Date d'échéance</th>
                                    <th class="text-center">Statut</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($studentTransactions as $transaction)
                                    <tr data-transaction-id="{{$transaction->id}}">

                                        <td class="text-center payment_date">
                                            <h2>
                                                <a>{{$transaction->payment->fee->name}}</a>
                                            </h2>
                                        </td>

                                        <td class="text-center payment_date">
                                            <a>{{$transaction->cost}}</a>

                                        </td>
                                        <td class="text-center amount">
                                            {{$transaction->created_at->format('d M Y à H:m')}}
                                        </td>
                                        <td class="text-center paid">
                                            @if($transaction->transaction_status == TransactionStatus::PAID->value)

                                                <span
                                                    class="fs-5 badge bg-success">{{TransactionStatus::PAID->value}}</span>

                                            @elseif($transaction->transaction_status == TransactionStatus::UNPAID->value)
                                                <span
                                                    class="fs-5 badge bg-danger">{{TransactionStatus::UNPAID}}</span>
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            <div class="actions d-flex justify-content-center">

                                                @if($transaction->transaction_status == TransactionStatus::PAID->value)
                                                    <a href="{{asset($transaction->bill)}}" download class=" btn btn-sm bg-success-light me-2">
                                                        <i class="feather-download"></i>
                                                    </a>
                                                @endif

                                               @if($transaction->transaction_status == TransactionStatus::UNPAID->value)
                                                    <a data-amount="{{$transaction->cost}}"
                                                       class="paybutton btn btn-sm bg-danger-light">
                                                        <i class="feather-check text-success"></i>
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


    {{--modals in use--}}

    <div id="create-fees-modal" class="modal fade" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

        <div class="modal-dialog">
            <div class="modal-content">


                <form id='create-fees-form' method="POST" action="">

                    <div class="modal-header">
                        <h4 class="modal-title">Ajouter un frais</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="local-forms">
                                    <label>Désignation<span class="login-danger">*</span> </label>
                                    <input type="text" class="form-control fees-name" placeholder="...">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="local-forms">

                                    <label>Cost<span class="login-danger">*</span> </label>
                                    <input type="number" class="form-control fees-cost" value="0">

                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="local-forms">
                                    <label>Périodicité<span class="login-danger">*</span> </label>
                                    <select class="form-select fees-frequency"
                                            id="frequencySelect">

                                        <option value="0"> Non récurent</option>

                                        <option value="1"> Mensuellement</option>

                                        <option value="3"> Trimestriellement</option>

                                        <option value="12"> Annuellement</option>
                                    </select>
                                    <input type="hidden" value="{{$userClub}}" id="club_id">
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light waves-effect"
                                data-bs-dismiss="modal">Annuler
                        </button>
                        <button type="submit" id="feesSubmitButton"
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
                    <button type="button" class="transferValidateModalButton btn btn-primary">Valider la demande
                    </button>
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
                    <button type="submit" class="transferRejectModalButton btn btn-danger waves-effect waves-light">
                        Rejeter
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
                    <button type="submit" class="transferCancelModalButton btn btn-danger waves-effect waves-light">
                        Rejeter
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
        <script src="{{asset('/js/kkia.js')}}"></script>
    @endpush
@endsection
