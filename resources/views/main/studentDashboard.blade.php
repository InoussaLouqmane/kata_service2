@php
    use App\Enums\RequestStatus;use App\Models\AccountRequest;use App\Models\Club;use App\Models\Discipline;use App\Models\Dojo;
    use App\Models\Exam;use App\Models\Fees;use App\Models\Payment;use App\Models\User;use Illuminate\Support\Facades\Auth;



 $sensei = User::find(Auth::user()->id);
 $club = $sensei->clubs()->first();

 $nombreEleves = User::where('role', 'Elève')
                    ->whereHas('clubs', function($query) use ($club) {
                        $query->where('id', $club->id);
                    })
                    ->count();




@endphp
@extends('partials.layout')
@section('title', 'Dashboard')


@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-sub-header">

                        @auth
                            <h3 class="page-title">Welcome {{Auth::user()->firstName}}!</h3>
                        @endauth
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('main.adminDashboard')}}">Dashboard</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">



            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                <a href="{{route('main.department.departments')}}" class="container-fluid">

                    <div class="card bg-comman w-100">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6>Examens à venir</h6>
                                    <h3>{{Exam::count()}}</h3>
                                </div>
                                <div class="db-icon">
                                    <img src="{{asset('/img/icons/dash-icon-02.svg')}}" alt="Dashboard Icon">
                                </div>
                            </div>
                        </div>
                    </div>

                </a>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                <div class="card bg-comman w-100">
                    <a href="{{route('main.subject.subjects')}}">

                        <div class="card-body">

                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6>Vidéos</h6>
                                    <h3>{{Fees::count()}}</h3>
                                </div>
                                <div class="db-icon">
                                    <img src="{{asset('/img/icons/teacher-icon-01.svg')}}" alt="Dashboard Icon">
                                </div>
                            </div>
                        </div>

                    </a>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                <div class="card bg-comman w-100">
                    <a href="{{route('main.user.users')}}">

                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6>Paiements en retard</h6>
                                    <h3>{{Payment::count()}}</h3>
                                </div>
                                <div class="db-icon">
                                    <img src="{{asset('/img/icons/dash-icon-04.svg')}}" alt="Dashboard Icon">
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>


        </div>

        <div class="row">
            <div class="col-md-12 col-lg-6">

                {{--   <div class="card card-chart">
                       <div class="card-header">
                           <div class="row align-items-center">
                               <div class="col-6">
                                   <h5 class="card-title">Overview</h5>
                               </div>
                               <div class="col-6">
                                   <ul class="chart-list-out">
                                       <li><span class="circle-blue"></span>Teacher</li>
                                       <li><span class="circle-green"></span>Student</li>
                                       <li class="star-menus"><a href="javascript:;"><i class="fas fa-ellipsis-v"></i></a>
                                       </li>
                                   </ul>
                               </div>
                           </div>
                       </div>
                       <div class="card-body">
                           <div id="apexcharts-area"></div>
                       </div>
                   </div>--}}

            </div>
            <div class="col-md-12 col-lg-6">

                {{-- <div class="card card-chart">
                     <div class="card-header">
                         <div class="row align-items-center">
                             <div class="col-6">
                                 <h5 class="card-title">Number of Students</h5>
                             </div>
                             <div class="col-6">
                                 <ul class="chart-list-out">
                                     <li><span class="circle-blue"></span>Girls</li>
                                     <li><span class="circle-green"></span>Boys</li>
                                     <li class="star-menus"><a href="javascript:;"><i class="fas fa-ellipsis-v"></i></a>
                                     </li>
                                 </ul>
                             </div>
                         </div>
                     </div>
                     <div class="card-body">
                         <div id="bar"></div>
                     </div>
                 </div>--}}

            </div>
        </div>
        <div class="row">
            <div class="col-xl-6 d-flex">

                {{-- <div class="card flex-fill student-space comman-shadow">
                     <div class="card-header d-flex align-items-center">
                         <h5 class="card-title">Star Students</h5>
                         <ul class="chart-list-out student-ellips">
                             <li class="star-menus"><a href="javascript:;"><i class="fas fa-ellipsis-v"></i></a></li>
                         </ul>
                     </div>
                     <div class="card-body">
                         <div class="table-responsive">
                             <table
                                 class="table star-student table-hover table-center table-borderless table-striped">
                                 <thead class="thead-light">
                                 <tr>
                                     <th>ID</th>
                                     <th>Name</th>
                                     <th class="text-center">Marks</th>
                                     <th class="text-center">Percentage</th>
                                     <th class="text-end">Year</th>
                                 </tr>
                                 </thead>
                                 <tbody>
                                 <tr>
                                     <td class="text-nowrap">
                                         <div>PRE2209</div>
                                     </td>
                                     <td class="text-nowrap">
                                         <a href="template/profile.html">
                                             <img class="rounded-circle" src="{{asset('/img/profiles/avatar-02.jpg')}}"
                                                  width="25" alt="Star Students">
                                             John Smith
                                         </a>
                                     </td>
                                     <td class="text-center">1185</td>
                                     <td class="text-center">98%</td>
                                     <td class="text-end">
                                         <div>2019</div>
                                     </td>
                                 </tr>
                                 <tr>
                                     <td class="text-nowrap">
                                         <div>PRE1245</div>
                                     </td>
                                     <td class="text-nowrap">
                                         <a href="template/profile.html">
                                             <img class="rounded-circle"
                                                  src="{{asset('/img/profiles/avatar-01.jpg')}}" width="25"
                                                  alt="Star Students">
                                             Jolie Hoskins
                                         </a>
                                     </td>
                                     <td class="text-center">1195</td>
                                     <td class="text-center">99.5%</td>
                                     <td class="text-end">
                                         <div>2018</div>
                                     </td>
                                 </tr>
                                 <tr>
                                     <td class="text-nowrap">
                                         <div>PRE1625</div>
                                     </td>
                                     <td class="text-nowrap">
                                         <a href="template/profile.html">
                                             <img class="rounded-circle" src="{{asset('/img/profiles/avatar-03.jpg')}}"
                                                  width="25" alt="Star Students">
                                             Pennington Joy
                                         </a>
                                     </td>
                                     <td class="text-center">1196</td>
                                     <td class="text-center">99.6%</td>
                                     <td class="text-end">
                                         <div>2017</div>
                                     </td>
                                 </tr>
                                 <tr>
                                     <td class="text-nowrap">
                                         <div>PRE2516</div>
                                     </td>
                                     <td class="text-nowrap">
                                         <a href="template/profile.html">
                                             <img class="rounded-circle" src="{{asset('/img/profiles/avatar-04.jpg')}}"
                                                  width="25" alt="Star Students">
                                             Millie Marsden
                                         </a>
                                     </td>
                                     <td class="text-center">1187</td>
                                     <td class="text-center">98.2%</td>
                                     <td class="text-end">
                                         <div>2016</div>
                                     </td>
                                 </tr>
                                 <tr>
                                     <td class="text-nowrap">
                                         <div>PRE2209</div>
                                     </td>
                                     <td class="text-nowrap">
                                         <a href="template/profile.html">
                                             <img class="rounded-circle" src="{{asset('/img/profiles/avatar-05.jpg')}}"
                                                  width="25" alt="Star Students">
                                             John Smith
                                         </a>
                                     </td>
                                     <td class="text-center">1185</td>
                                     <td class="text-center">98%</td>
                                     <td class="text-end">
                                         <div>2015</div>
                                     </td>
                                 </tr>
                                 </tbody>
                             </table>
                         </div>
                     </div>
                 </div>--}}

            </div>
            {{-- <div class="col-xl-6 d-flex">

                 <div class="card flex-fill comman-shadow">
                     <div class="card-header d-flex align-items-center">
                         <h5 class="card-title ">Student Activity </h5>
                         <ul class="chart-list-out student-ellips">
                             <li class="star-menus"><a href="javascript:;"><i class="fas fa-ellipsis-v"></i></a></li>
                         </ul>
                     </div>
                     <div class="card-body">
                         <div class="activity-groups">
                             <div class="activity-awards">
                                 <div class="award-boxs">
                                     <img src="{{asset('/img/icons/award-icon-01.svg')}}" alt="Award">
                                 </div>
                                 <div class="award-list-outs">
                                     <h4>1st place in "Chess”</h4>
                                     <h5>John Doe won 1st place in "Chess"</h5>
                                 </div>
                                 <div class="award-time-list">
                                     <span>1 Day ago</span>
                                 </div>
                             </div>
                             <div class="activity-awards">
                                 <div class="award-boxs">
                                     <img src="{{asset('/img/icons/award-icon-02.svg')}}" alt="Award">
                                 </div>
                                 <div class="award-list-outs">
                                     <h4>Participated in "Carrom"</h4>
                                     <h5>Justin Lee participated in "Carrom"</h5>
                                 </div>
                                 <div class="award-time-list">
                                     <span>2 hours ago</span>
                                 </div>
                             </div>
                             <div class="activity-awards">
                                 <div class="award-boxs">
                                     <img src="{{asset('/img/icons/award-icon-03.svg')}}" alt="Award">
                                 </div>
                                 <div class="award-list-outs">
                                     <h4>Internation conference in "St.John School"</h4>
                                     <h5>Justin Leeattended internation conference in "St.John School"</h5>
                                 </div>
                                 <div class="award-time-list">
                                     <span>2 Week ago</span>
                                 </div>
                             </div>
                             <div class="activity-awards mb-0">
                                 <div class="award-boxs">
                                     <img src="{{asset('/img/icons/award-icon-04.svg')}}" alt="Award">
                                 </div>
                                 <div class="award-list-outs">
                                     <h4>Won 1st place in "Chess"</h4>
                                     <h5>John Doe won 1st place in "Chess"</h5>
                                 </div>
                                 <div class="award-time-list">
                                     <span>3 Day ago</span>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>

             </div>--}}
        </div>


    </div>
@endsection

