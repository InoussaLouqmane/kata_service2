@php use App\Enums\UserStatus;use App\Models\Dojo;use App\Models\User;
@endphp

@extends('partials.layout');
@section('title', 'Clubs');

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

    {{--modals--}}



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

    <div class="content container-fluid">

        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-sub-header">
                        <h3 class="page-title"></h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">Dashboard / Dojos</a></li>

                        </ul>
                    </div>
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
                                    <h3 class="page-title">Liste des Dojos</h3>
                                </div>
                                <div class="col-auto text-end float-end ms-auto download-grp">
                                    {{-- <a href="#" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i>
                                         Download</a>--}}
                                    <a href="{{route('main.dojo.add-dojo')}}" class="btn btn-primary"><i
                                            class="fas fa-plus"></i> Ajouter un Dojo</a>
                                </div>
                            </div>
                        </div>

                        <table
                            id="clubTable"
                            class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                            <thead class="student-thread">

                            <tr>
                                <th>
                                    <div class="form-check check-tables">
                                        <input class="form-check-input" type="checkbox" value="something">
                                    </div>
                                </th>

                                <th>Nom du Dojo</th>
                                <th>Club</th>

                                <th class="text-start">Adresse</th>
                               {{-- <th class="text-start">Status</th>--}}
                                <th class="text-end">Action</th>
                            </tr>
                            </thead>
                            <tbody>


                            @foreach(Dojo::all() as $dojo)

                                <tr>
                                    <td>
                                        <div class="form-check check-tables">
                                            <input class="form-check-input" type="checkbox" value="something">
                                        </div>
                                    </td>
                                    @php

                                        $club = $dojo->club;
                                    @endphp

                                    <td class="text-start">{{$dojo->name}}</td>


                                    <td class="text-start">
                                        <h2 class="table-avatar">
                                            @if($club->logoPath)
                                                <a href="{{route('main.dojo.dojo-details',[$dojo->id])}}"
                                                   class="avatar avatar-sm me-2">


                                                    <img class="avatar-img rounded-circle"
                                                         src="{{asset('/storage/'.$club->logoPath)}}"
                                                         alt="User Image">


                                                </a>
                                            @endif
                                        </h2>
                                        <a href="{{route('main.department.department-details', [$club->id])}}">{{$club->name}}</a>
                                    </td>


                                    <td class="text-start">{{$dojo->address}}</td>
                                    {{--<td class="text-start">

                                        @if($dojo->status === 'Actif')

                                            <span
                                                class="fs-5 badge bg-success">{{$dojo[User::STATUS]}}</span>

                                        @elseif($dojo->status === 'Inactif')
                                            <span
                                                class="fs-5 badge bg-danger">{{$dojo[User::STATUS]}}</span>
                                        @endif

                                    </td>--}}

                                    <td class="text-start">
                                        <div class="actions">
                                            {{--@if($dojo[User::STATUS] === 'Actif')
                                                <a data-bs-toggle="modal" data-bs-target="#reject-modal" class="btn btn-sm bg-success-light me-2">
                                                    <i class="feather-x-circle"></i>
                                                </a>
                                            @else
                                                <a data-bs-toggle="modal" data-bs-target="#reject-modal"
                                                   class="btn btn-sm bg-success-light me-2">
                                                    <i class="feather-check"></i>
                                                </a>
                                            @endif--}}

                                            <a href="{{route('main.dojo.edit-dojo', [$dojo->id])}}"
                                               class="btn btn-sm bg-danger-light">
                                                <i class="feather-edit"></i>
                                            </a>
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
@endsection


