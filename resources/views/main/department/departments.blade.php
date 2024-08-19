@php use App\Models\Club;use App\Models\Dojo;use App\Models\User;
@endphp

@extends('partials.layout');
@section('title', 'Clubs');

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
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Clubs</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('main.adminDashboard')}}">Clubs</a></li>
                        <li class="breadcrumb-item active">Clubs</li>
                    </ul>
                </div>
            </div>
        </div>

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
                        <input type="text" class="form-control" placeholder="Search by Year ...">
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
                <div class="card card-table">
                    <div class="card-body">

                        <div class="page-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="page-title">Liste des clubs</h3>
                                </div>
                                <div class="col-auto text-end float-end ms-auto download-grp">
                                    {{-- <a href="#" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i>
                                         Download</a>--}}
                                    <a href="{{route('main.department.add-department')}}" class="btn btn-primary"><i
                                            class="fas fa-plus"></i> Ajouter un club</a>
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

                                <th>Nom du club</th>
                                <th>Discipline</th>
                                <th>Propriétaire</th>
                                <th>Email</th>
                                <th class="text-start">Nbre de dojos</th>
                                <th class="text-start">Effectif</th>
                                <th class="text-end">Action</th>
                            </tr>
                            </thead>
                            <tbody>


                            @foreach(Club::all() as $club)

                                <tr>
                                    <td>
                                        <div class="form-check check-tables">
                                            <input class="form-check-input" type="checkbox" value="something">
                                        </div>
                                    </td>
                                    @php
                                        $owner = User::find($club->RegisteredBy);
                                    @endphp
                                    <td class="text-start">
                                        <h2 class="table-avatar">
                                            <a href="{{route('main.department.department-details',[$club->id])}}"
                                               class="avatar avatar-sm me-2">

                                                @if($club->logoPath)

                                                <img class="avatar-img rounded-circle"
                                                     src="{{asset('/storage/'.$club->logoPath)}}"
                                                     alt="User Image">
                                                @endif

                                            </a>
                                        </h2>
                                        <a href="{{route('main.department.department-details', [$club->id])}}">{{$club->name}}</a></td>
                                    <td class="text-start">{{$club->martialArtType ?? '-' }}</td>
                                    <td class="text-start">
                                        <h2>
                                            @if($owner)
                                                <a href="{{route('main.user.user-details', [$owner->id])}}"> {{$owner->firstName. ' '. $owner->lastName}}</a>
                                            @else
                                            <a>None</a>
                                            @endif
                                        </h2>
                                    </td>

                                    <td class="text-start">{{$club->email}}</td>
                                    <td class="text-start">{{Dojo::where('club_id', $club->id)->count()}}</td>
                                    <td class="text-start">{{$club->users->count()}}</td>
                                    <td class="text-start">
                                        <div class="actions">
                                            <a href="{{route('main.department.department-details', [$club->id])}}" class="btn btn-sm bg-success-light me-2">
                                                <i class="feather-eye"></i>
                                            </a>
                                            <a href="{{route('main.department.edit-department', [$club->id])}}"
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


