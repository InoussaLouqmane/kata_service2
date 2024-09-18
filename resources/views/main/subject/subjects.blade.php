@php use App\Models\Discipline; @endphp
@extends('partials.layout');
@section('title', 'Discipline');


@section('content')



    <!--modals-->

    <div class="modal fade" id="centermodal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Détails</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-center">
                        <div class="follow-group d-flex flex-row justify-content-around">

                            <div class="d-flex flex-column">
                                <div class="personal-activity">
                                    <div class="personal-icons">
                                        <i class="feather-bookmark"></i>
                                    </div>
                                    <div class="views-personal">
                                        <h4 class="">Intitulé de la discipline</h4>
                                        <h5 id="disciplineTitle"></h5>
                                    </div>
                                </div>
                            </div>

                            <div class="personal-activity">
                                <div class="personal-icons">
                                    <i class="feather-sunrise"></i>
                                </div>
                                <div class="views-personal">
                                    <h4>Liste des grades</h4>
                                    <h5></h5>
                                    <div id="gradeList" class="pt-3">

                                    </div>
                                </div>
                            </div>

                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--endmodals-->
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Disciplines</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Subjects</li>
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
                                    <h3 class="page-title">Liste des disciplines</h3>
                                </div>
                                <div class="col-auto text-end float-end ms-auto download-grp">
                                    {{--<a href="#" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i>
                                        Download</a>--}}
                                    <a
                                        href="{{route('main.subject.add-subject')}}"
                                        class="btn btn-primary addDisciplinePlusButton"><i class="fas fa-plus"></i> Ajouter une discipline</a>
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


                                    <th class="text-center">Intitué</th>
                                    <th class="text-center">Description</th>
                                    <th class="text-center">Grades</th>
                                    <th class="text-center">Date de création</th>
                                    <th class="text-center" class="text-end">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(Discipline::all() as $type)
                                <tr>
                                    {{--<td>
                                        <div class="form-check check-tables">
                                            <input class="form-check-input" type="checkbox" value="something">
                                        </div>
                                    </td>--}}


                                    <td class="text-center disciplineName">
                                        <h2>
                                            <a>{{$type->name}}</a>
                                        </h2>
                                    </td>
                                    <td class="text-center">{{$type->description ?? 'Aucune description'}}</td>
                                    <td class="text-center">{{$type->grades()->count()}}</td>


                                    <td class="text-center">{{$type->created_at->format('d-M-y')}}</td>
                                    <td class="text-center">
                                        <div class="actions justify-content-center">
                                            <a
                                                data-discipline-id="{{$type->id}}"
                                                class="seeDisciplineDetailsButton btn btn-sm bg-danger-light me-2">
                                                <i class="feather-eye"></i>
                                            </a>
                                            <a href="{{route('main.subject.edit-subject', [$type->id])}}" class="btn btn-sm bg-danger-light me-2">
                                                <i class="feather-edit"></i>
                                            </a>
                                            <a
                                                data-discipline-id="{{$type->id}}"
                                                class="deleteDiscipline btn btn-sm bg-danger-light">
                                                <i class="feather-trash text-danger"></i>
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
        <script src="{{asset('/js/discipline.js')}}"></script>
    @endpush
@endsection



