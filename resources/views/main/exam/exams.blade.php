@php use App\Enums\ExamStatus;use App\Enums\Role;use App\Models\Exam;use Illuminate\Support\Facades\Auth;
 $authUser = Auth::user();
@endphp
@extends('partials.layout');
@section('title', 'Examens');
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

        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">

                        <div class="page-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="page-title">Liste des examens</h3>
                                </div>

                                @if($authUser->role != Role::STUDENT->value)

                                    <div class="col-auto text-end float-end ms-auto download-grp">
                                        <a href="{{route('main.exam.add-exam')}}" class="btn btn-primary"> <i
                                                class="fas fa-plus"></i> Planifier un examen</a>
                                    </div>

                                @endif
                            </div>
                        </div>


                        <div class="table-responsive">
                            <table
                                class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                <thead class="student-thread">
                                <tr>
                                    <th>Examen</th>
                                    <th class="text-start">Nbre participants</th>
                                    <th>Date</th>
                                    <th>Lieu</th>
                                    <th>Statut</th>
                                    <th class="text-end">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(Exam::all() as $exam)
                                    <tr>
                                        <td>
                                            <h2>
                                                <a>Standard</a>
                                            </h2>
                                        </td>
                                        <td class="text-start">{{$exam->event->examResults()->count()}}</td>
                                        <td>{{$exam->event->getStartDate()}}</td>
                                        <td>{{$exam->event->address}}</td>

                                        <td>
                                            @if($exam->examStatus === ExamStatus::INITIATED->value)

                                                <span
                                                    class="fs-5 badge bg-info">{{ExamStatus::INITIATED->value}}</span>

                                            @elseif($exam->examStatus === ExamStatus::ENDED->value)
                                                <span
                                                    class="fs-5 badge bg-purple">{{ExamStatus::ENDED}}</span>
                                            @elseif($exam->examStatus === ExamStatus::ARCHIEVED->value)
                                                <span
                                                    class="fs-5 badge bg-success">{{ExamStatus::ARCHIEVED}}</span>
                                            @else
                                                <span
                                                    class="fs-5 badge bg-danger">{{ExamStatus::CANCELLED}}</span>
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            <div class="actions">
                                                <a href="{{route("main.exam.exam-details", [$exam->event_id])}}"
                                                   class="btn btn-sm bg-success-light me-2">
                                                    <i class="feather-eye"></i></a>


                                                @if($authUser->role != Role::STUDENT->value)

                                                    @if($exam->examStatus=== 'A venir')
                                                        <a href="{{route("main.exam.edit-exam", [$exam->event_id])}}"
                                                           class="btn btn-sm bg-success-light me-2">
                                                            <i class="feather-edit"></i></a>

                                                        <a href="edit-exam.html" class="btn btn-sm bg-danger-light me-2">
                                                            <i class="feather-x-circle text-danger"></i>
                                                        </a>
                                                    @endif

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
@endsection
