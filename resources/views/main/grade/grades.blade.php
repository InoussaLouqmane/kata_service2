@php use App\Models\Discipline;use App\Models\Grade; @endphp
@extends('partials.layout');
@section('title', 'Grade');


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
                <form action="/api/grade" method="POST">

                    @CSRF
                    @method('DELETE')
                    <div class="modal-footer">
                        <input type="hidden" value="" id="hiddenInputConfirmationModal"
                               name="id">
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
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Grades</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Grades</li>
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
                                    <h3 class="page-title">Liste des grades</h3>
                                </div>
                                <div class="col-auto text-end float-end ms-auto download-grp">
                                    {{--<a href="#" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i>
                                        Download</a>--}}
                                    <a href="{{route('main.grade.add-grade')}}" class="btn btn-primary"><i
                                            class="fas fa-plus"></i> Ajouter un grade</a>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table
                                class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                <thead class="student-thread">
                                <tr>
                                    {{--<th>
                                        <div class="form-check check-tables">
                                            <input class="form-check-input" type="checkbox" value="something">
                                        </div>
                                    </th>--}}


                                    <th>Couleur</th>
                                    <th>Nom</th>
                                    <th>Date d'ajout</th>
                                    <th class="text-end">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(Grade::all() as $type)
                                    <tr>
                                        {{--<td>
                                            <div class="form-check check-tables">
                                                <input class="form-check-input" type="checkbox" value="something">
                                            </div>
                                        </td>--}}


                                        <td>
                                            <h2 style="display: flex;">
                                                <div style="background-color: {{$type->beltColor}}; border-radius:50%; height:20px; width:20px;"> </div>
                                                <a class="ms-1">{{$type->beltColor}}</a>
                                            </h2>
                                        </td>

                                        <td>
                                            <h2>
                                                <a>{{$type->beltName}}</a>
                                            </h2>
                                        </td>

                                        <td>{{$type->created_at->format('d-M-y')}}</td>
                                        <td class="text-end">
                                            <div class="actions">


                                                <a href="{{route('main.grade.edit-grade', [$type->id])}}"
                                                   data-requestId="{{$type->id}}"
                                                   id="delete-button"
                                                   data-bs-toggle="modal"
                                                   data-bs-target="#confirm-modal"
                                                   class="delete-button btn btn-sm bg-danger-light">
                                                    <i class="feather-trash"></i>
                                                </a>
                                                <a href="{{route('main.grade.edit-grade', [$type->id])}}"
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
    </div>

    @push('scripts')
        <script src="{{asset('/js/accountRequestModal.js')}}"></script>
    @endpush
@endsection



