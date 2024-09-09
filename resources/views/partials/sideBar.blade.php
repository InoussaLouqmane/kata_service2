@php use App\Enums\Role;use App\Models\User;use Illuminate\Support\Facades\Auth;
 $authUser = Auth::user();
 $user = User::where('id', $authUser->id)->first();

@endphp
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">

            @if($user->role  === 'Admin')
                <ul>
                    <li class="menu-title">
                        <span>Menu principal</span>
                    </li>

                    <li class=""><a href="{{route('main.adminDashboard')}}" class=""><i class="feather-grid"></i><span>Dashboard</span></a>
                    </li>
                    <li><a href="{{route('main.accountRequest.requests')}}"><i class="fas fa-clipboard"></i> <span>Demandes</span></a>
                    </li>

                    <li class="submenu">
                        <a href="#"><i class="fas fa-book-reader"></i> <span> Disciplines</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{route('main.subject.subjects')}}">Liste des disciplines</a></li>
                            <li><a href="{{route('main.subject.add-subject')}}">Ajouter une discipline</a></li>
                        </ul>
                    </li>

                    <li class="submenu">
                        <a href="#"><i class="fas fa-graduation-cap"></i> <span>Utilisateurs</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{route('main.user.users')}}">Liste des utilisateurs</a></li>
                            <li><a href="{{route('main.user.add-user')}}">Ajouter un utilisateur</a></li>
                        </ul>
                    </li>


                    <li class="submenu">
                        <a href="#"><i class="fas fa-building"></i> <span>Clubs</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{route('main.department.departments')}}">Liste des clubs</a></li>
                            <li><a href="{{route('main.department.add-department')}}">Ajouter un club</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="fas fa-building"></i> <span> Dojos</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{route('main.dojo.dojos')}}">Liste des Dojos</a></li>
                            <li><a href="{{route('main.dojo.add-dojo')}}">Ajouter un Dojo</a></li>
                        </ul>
                    </li>



                    <li class="menu-title">
                        <span>Général</span>
                    </li>

                    <li><a href="{{route('main.ui.element.notification')}}"><i class="fas fa-message"></i><span>Notifications</span></a></li>
                    <li>
                        <a href="{{route('main.setting.settings')}}"><i class="fas fa-cog"></i>
                            <span>Paramètres</span></a>
                    </li>
                </ul>


                {{--here is the pactole--}}
                {{--  <ul>
                      <li class="menu-title">
                          <span>Main Menu</span>
                      </li>




                      @if($user->role === Role::ADMIN)
                          <li class=""><a href="{{route('main.adminDashboard')}}" class=""><i class="feather-grid"></i><span> Admin Dashboard</span></a></li>
                      @endif

                      @if($user->role === Role::SENSEI)
                          <li><a href="{{route('main.teacherDashboard')}}" class="active"><i class="feather-grid"> </i><span> Sensei Dashboard</span></a></li>
                      @endif
                      @if($user->role === Role::STUDENT)
                          <li><a href="{{route('main.studentDashboard')}}"><i class="feather-grid"></i><span> Student Dashboard</span></a></li>
                      @endif




                      <li><a href="{{route('main.accountRequest.requests')}}"><i class="fas fa-clipboard"></i> <span>Demandes</span></a></li>
                      --}}{{-- <li><a href="{{route('main.student.student-details')}}">Détails demandes</a></li>--}}{{--
                      @if($user->role !== Role::ADMIN)
                          <li><a href="{{route('main.student.add-student')}}"><i class="fas fa-clipboard"></i> Student Add</a></li>

                      @endif



                      <li class="submenu">
                          <a href="#"><i class="fas fa-graduation-cap"></i> <span> Utilisateurs</span> <span
                                  class="menu-arrow"></span></a>
                          <ul>
                              <li><a href="{{route('main.user.users')}}">Liste des utilisateurs</a></li>
                              --}}{{--<li><a href="{{route('main.student.student-details')}}">Student View</a></li>--}}{{--
                              <li><a href="{{route('main.user.add-user')}}">Ajouter un utilisateur</a></li>
                              --}}{{--<li><a href="{{route('main.student.edit-student')}}">Student Edit</a></li>--}}{{--
                          </ul>
                      </li>

                      --}}{{--<li class="submenu">
                          <a href="#"><i class="fas fa-chalkboard-teacher"></i> <span> Sensei</span> <span
                                  class="menu-arrow"></span></a>
                          <ul>
                              <li><a href="{{route('main.sensei.senseis')}}">Liste des sensei</a></li>
                              <li><a href="{{route('main.sensei.teacher-details')}}">Teacher View</a></li>
                              <li><a href="{{route('main.sensei.add-teacher')}}">Teacher Add</a></li>
                              <li><a href="{{route('main.sensei.edit-teacher')}}">Teacher Edit</a></li>
                          </ul>
                      </li>--}}{{--
                      <li class="submenu">
                          <a href="#"><i class="fas fa-building"></i> <span> Clubs</span> <span
                                  class="menu-arrow"></span></a>
                          <ul>
                              <li><a href="{{route('main.department.departments')}}">Liste des clubs</a></li>
                              <li><a href="{{route('main.department.add-department')}}">Ajouter un club</a></li>
                              --}}{{--<li><a href="{{route('main.department.edit-department')}}">Editer un club</a></li>--}}{{--
                          </ul>
                      </li>
                      <li class="submenu">
                          <a href="#"><i class="fas fa-building"></i> <span> Dojos</span> <span
                                  class="menu-arrow"></span></a>
                          <ul>
                              <li><a href="{{route('main.dojo.dojos')}}">Liste des Dojos</a></li>
                              <li><a href="{{route('main.dojo.add-dojo')}}">Ajouter un Dojo</a></li>
                              --}}{{--<li><a href="{{route('main.department.edit-department')}}">Editer un club</a></li>--}}{{--
                          </ul>
                      </li>
                      <li class="submenu">
                          <a href="#"><i class="fas fa-book-reader"></i> <span> Disciplines</span> <span
                                  class="menu-arrow"></span></a>
                          <ul>
                              <li><a href="{{route('main.subject.subjects')}}">Liste des disciplines</a></li>
                              <li><a href="{{route('main.subject.add-subject')}}">Ajouter une discipline</a></li>
                          </ul>
                      </li>
                      --}}{{--    <li class="submenu">
                              <a href="#"><i class="fas fa-clipboard"></i> <span> Invoices</span> <span
                                      class="menu-arrow"></span></a>
                              <ul>
                                  <li><a href="{{route('main.invoice.invoices')}}">Invoices List</a></li>
                                  <li><a href="{{route('main.invoice.invoice-grid')}}">Invoices Grid</a></li>--}}{{----}}{{--
                                  <li><a href="{{route('main.invoice.add-invoice')}}">Add Invoices</a></li>
                                  <li><a href="{{route('main.invoice.edit-invoice')}}">Edit Invoices</a></li>
                                  <li><a href="{{route('main.invoice.view-invoice')}}">Invoices Details</a></li>
                                  <li><a href="{{route('main.invoice.invoices-settings')}}">Invoices Settings</a></li>--}}{{----}}{{--
                              </ul>
                          </li>--}}{{--
                      --}}{{--               <li class="menu-title">
                                         <span>Management</span>
                                     </li>
                                     <li class="submenu">
                                         <a href="#"><i class="fas fa-file-invoice-dollar"></i> <span> Accounts</span> <span
                                                 class="menu-arrow"></span></a>
                                         <ul>
                                             <li><a href="{{route('main.account.fees-collections')}}">Fees Collection</a></li>
                                             <li><a href="{{route('main.account.expenses')}}">Expenses</a></li>
                                             <li><a href="{{route('main.account.salary')}}">Salary</a></li>
                                             <li><a href="{{route('main.account.add-fees-collection')}}">Add Fees</a></li>
                                             <li><a href="{{route('main.account.add-expenses')}}">Add Expenses</a></li>
                                             <li><a href="{{route('main.account.add-salary')}}">Add Salary</a></li>
                                         </ul>
                                     </li>
                                     <li>
                                         <a href="{{route('main.holiday.holiday')}}"><i class="fas fa-holly-berry"></i> <span>Holiday</span></a>
                                     </li>
                                     <li>
                                         <a href="{{route('main.fee.fees')}}"><i class="fas fa-comment-dollar"></i> <span>Fees</span></a>
                                     </li>
                                     <li>
                                         <a href="{{route('main.exam.exam')}}"><i class="fas fa-clipboard-list"></i>
                                             <span>Exam list</span></a>
                                     </li>
                                     <li>
                                         <a href="{{route('main.event.event')}}"><i class="fas fa-calendar-day"></i> <span>Events</span></a>
                                     </li>
                                     <li>
                                         <a href="{{route('main.timetable.time-table')}}"><i class="fas fa-table"></i>
                                             <span>Time Table</span></a>
                                     </li>
                                     <li>
                                         <a href="{{route('main.library.library')}}"><i class="fas fa-book"></i> <span>Library</span></a>
                                     </li>
                                     <li class="submenu">
                                         <a href="#"><i class="fa fa-newspaper"></i> <span> Blogs</span>
                                             <span class="menu-arrow"></span>
                                         </a>
                                         <ul>
                                             <li><a href="{{route('main.blog.blog')}}">All Blogs</a></li>
                                             <li><a href="{{route('main.blog.add-blog')}}">Add Blog</a></li>
                                             <li><a href="{{route('main.blog.edit-blog')}}">Edit Blog</a></li>
                                         </ul>
                                     </li>
                                     <li>
                                         <a href="{{route('main.setting.settings')}}"><i class="fas fa-cog"></i> <span>Settings</span></a>
                                     </li>
                                     <li class="menu-title">
                                         <span>Pages</span>
                                     </li>
                                     <li class="submenu">
                                         <a href="#"><i class="fas fa-shield-alt"></i> <span> Authentication </span> <span
                                                 class="menu-arrow"></span></a>
                                         <ul>
                                             <li><a href="{{route('authentication.login')}}">Login</a></li>
                                             <li><a href="{{route('authentication.register')}}">Register</a></li>
                                             <li><a href="--}}{{----}}{{--{{route('authentication.forgot-password')}}--}}{{----}}{{--">Forgot Password</a></li>
                                             <li><a href="{{route('authentication.error-404')}}">Error Page</a></li>
                                         </ul>
                                     </li>
                                     <li>
                                         <a href="{{route('main.setting.blank-page')}}"><i class="fas fa-file"></i>
                                             <span>Blank Page</span></a>
                                     </li>
                                     <li class="menu-title">
                                         <span>Others</span>
                                     </li>
                                     <li>
                                         <a href="{{route('main.sport.sports')}}"><i class="fas fa-baseball-ball"></i>
                                             <span>Sports</span></a>
                                     </li>
                                     <li>
                                         <a href="{{route('main.hotel.hostel')}}"><i class="fas fa-hotel"></i> <span>Hostel</span></a>
                                     </li>
                                     <li>
                                         <a href="{{route('main.transport.transport')}}"><i class="fas fa-bus"></i>
                                             <span>Transport</span></a>
                                     </li>
                                     <li class="menu-title">
                                         <span>UI Interface</span>
                                     </li>
                                     <li class="submenu">
                                         <a href="#"><i class="fab fa-get-pocket"></i> <span>Base UI </span> <span
                                                 class="menu-arrow"></span></a>
                                         <ul>
                                             <li><a href="{{route('main.ui.baseUI.alerts')}}">Alerts</a></li>
                                             <li><a href="{{route('main.ui.baseUI.accordions')}}">Accordions</a></li>
                                             <li><a href="{{route('main.ui.baseUI.avatar')}}">Avatar</a></li>
                                             <li><a href="{{route('main.ui.baseUI.badges')}}">Badges</a></li>
                                             <li><a href="{{route('main.ui.baseUI.buttons')}}">Buttons</a></li>
                                             <li><a href="{{route('main.ui.baseUI.buttongroup')}}">Button Group</a></li>
                                             <li><a href="{{route('main.ui.baseUI.breadcrumbs')}}">Breadcrumb</a></li>
                                             <li><a href="{{route('main.ui.baseUI.cards')}}">Cards</a></li>
                                             <li><a href="{{route('main.ui.baseUI.carousel')}}">Carousel</a></li>
                                             <li><a href="{{route('main.ui.baseUI.dropdowns')}}">Dropdowns</a></li>
                                             <li><a href="{{route('main.ui.baseUI.grid')}}">Grid</a></li>
                                             <li><a href="{{route('main.ui.baseUI.images')}}">Images</a></li>
                                             <li><a href="{{route('main.ui.baseUI.lightbox')}}">Lightbox</a></li>
                                             <li><a href="{{route('main.ui.baseUI.media')}}">Media</a></li>
                                             <li><a href="{{route('main.ui.baseUI.modal')}}">Modals</a></li>
                                             <li><a href="{{route('main.ui.baseUI.offcanvas')}}">Offcanvas</a></li>
                                             <li><a href="{{route('main.ui.baseUI.pagination')}}">Pagination</a></li>
                                             <li><a href="{{route('main.ui.baseUI.popover')}}">Popover</a></li>
                                             <li><a href="{{route('main.ui.baseUI.progress')}}">Progress Bars</a></li>
                                             <li><a href="{{route('main.ui.baseUI.placeholders')}}">Placeholders</a></li>
                                             <li><a href="{{route('main.ui.baseUI.rangeslider')}}">Range Slider</a></li>
                                             <li><a href="{{route('main.ui.baseUI.spinners')}}">Spinner</a></li>
                                             <li><a href="{{route('main.ui.baseUI.sweetalerts')}}">Sweet Alerts</a></li>
                                             <li><a href="{{route('main.ui.baseUI.tab')}}">Tabs</a></li>
                                             <li><a href="{{route('main.ui.baseUI.toastr')}}">Toasts</a></li>
                                             <li><a href="{{route('main.ui.baseUI.tooltip')}}">Tooltip</a></li>
                                             <li><a href="{{route('main.ui.baseUI.typography')}}">Typography</a></li>
                                             <li><a href="{{route('main.ui.baseUI.video')}}">Video</a></li>
                                         </ul>
                                     </li>
                                     <li class="submenu">
                                         <a href="#"><i data-feather="box"></i> <span>Elements </span> <span
                                                 class="menu-arrow"></span></a>
                                         <ul>
                                             <li><a href="{{route('main.ui.element.ribbon')}}">Ribbon</a></li>
                                             <li><a href="{{route('main.ui.element.clipboard')}}">Clipboard</a></li>
                                             <li><a href="{{route('main.ui.element.drag-drop')}}">Drag & Drop</a></li>
                                             <li><a href="{{route('main.ui.element.rating')}}">Rating</a></li>
                                             <li><a href="{{route('main.ui.element.text-editor')}}">Text Editor</a></li>
                                             <li><a href="{{route('main.ui.element.counter')}}">Counter</a></li>
                                             <li><a href="{{route('main.ui.element.scrollbar')}}">Scrollbar</a></li>
                                             <li><a href="{{route('main.ui.element.notification')}}">Notification</a></li>
                                             <li><a href="{{route('main.ui.element.stickynote')}}">Sticky Note</a></li>
                                             <li><a href="{{route('main.ui.element.timeline')}}">Timeline</a></li>
                                             <li><a href="{{route('main.ui.element.horizontal-timeline')}}">Horizontal Timeline</a></li>
                                             <li><a href="{{route('main.ui.element.form-wizard')}}">Form Wizard</a></li>
                                         </ul>
                                     </li>
                                     <li class="submenu">
                                         <a href="#"><i data-feather="bar-chart-2"></i> <span> Charts </span> <span
                                                 class="menu-arrow"></span></a>
                                         <ul>
                                             <li><a href="{{route('main.ui.charts.chart-apex')}}">Apex Charts</a></li>
                                             <li><a href="{{route('main.ui.charts.chart-js')}}">Chart Js</a></li>
                                             <li><a href="{{route('main.ui.charts.chart-morris')}}">Morris Charts</a></li>
                                             <li><a href="{{route('main.ui.charts.chart-flot')}}">Flot Charts</a></li>
                                             <li><a href="{{route('main.ui.charts.chart-peity')}}">Peity Charts</a></li>
                                             <li><a href="{{route('main.ui.charts.chart-c3')}}">C3 Charts</a></li>
                                         </ul>
                                     </li>
                                     <li class="submenu">
                                         <a href="#"><i data-feather="award"></i> <span> Icons </span> <span
                                                 class="menu-arrow"></span></a>
                                         <ul>
                                             <li><a href="{{route('main.ui.icons.icon-fontawesome')}}">Fontawesome Icons</a></li>
                                             <li><a href="{{route('main.ui.icons.icon-feather')}}">Feather Icons</a></li>
                                             <li><a href="{{route('main.ui.icons.icon-ionic')}}">Ionic Icons</a></li>
                                             <li><a href="{{route('main.ui.icons.icon-material')}}">Material Icons</a></li>
                                             <li><a href="{{route('main.ui.icons.icon-pe7')}}">Pe7 Icons</a></li>
                                             <li><a href="{{route('main.ui.icons.icon-simpleline')}}">Simpleline Icons</a></li>
                                             <li><a href="{{route('main.ui.icons.icon-themify')}}">Themify Icons</a></li>
                                             <li><a href="{{route('main.ui.icons.icon-weather')}}">Weather Icons</a></li>
                                             <li><a href="{{route('main.ui.icons.icon-typicon')}}">Typicon Icons</a></li>
                                             <li><a href="{{route('main.ui.icons.icon-flag')}}">Flag Icons</a></li>
                                         </ul>
                                     </li>
                                     <li class="submenu">
                                         <a href="#"><i class="fas fa-columns"></i> <span> Forms </span> <span class="menu-arrow"></span></a>
                                         <ul>
                                             <li><a href="{{route('main.ui.forms.form-basic-inputs')}}">Basic Inputs </a></li>
                                             <li><a href="{{route('main.ui.forms.form-input-groups')}}">Input Groups </a></li>
                                             <li><a href="{{route('main.ui.forms.form-horizontal')}}">Horizontal Form </a></li>
                                             <li><a href="{{route('main.ui.forms.form-vertical')}}"> Vertical Form </a></li>
                                             <li><a href="{{route('main.ui.forms.form-mask')}}"> Form Mask </a></li>
                                             <li><a href="{{route('main.ui.forms.form-validation')}}"> Form Validation </a></li>
                                         </ul>
                                     </li>
                                     <li class="submenu">
                                         <a href="#"><i class="fas fa-table"></i> <span> Tables </span> <span class="menu-arrow"></span></a>
                                         <ul>
                                             <li><a href="{{route('main.ui.tables.tables-basic')}}">Basic Tables </a></li>
                                             <li><a href="{{route('main.ui.tables.data-tables')}}">Data Table </a></li>
                                         </ul>
                                     </li>
                                     <li class="submenu">
                                         <a href="javascript:void(0);"><i class="fas fa-code"></i> <span>Multi Level</span> <span
                                                 class="menu-arrow"></span></a>
                                         <ul>
                                             <li class="submenu">
                                                 <a href="javascript:void(0);"> <span>Level 1</span> <span class="menu-arrow"></span></a>
                                                 <ul>
                                                     <li><a href="javascript:void(0);"><span>Level 2</span></a></li>
                                                     <li class="submenu">
                                                         <a href="javascript:void(0);"> <span> Level 2</span> <span
                                                                 class="menu-arrow"></span></a>
                                                         <ul>
                                                             <li><a href="javascript:void(0);">Level 3</a></li>
                                                             <li><a href="javascript:void(0);">Level 3</a></li>
                                                         </ul>
                                                     </li>
                                                     <li><a href="javascript:void(0);"> <span>Level 2</span></a></li>
                                                 </ul>
                                             </li>
                                             <li>
                                                 <a href="javascript:void(0);"> <span>Level 1</span></a>
                                             </li>
                                         </ul>
                                     </li>--}}{{--
                  </ul>--}}
                {{--end of the pactole--}}

            @elseif($user->role  === Role::SENSEI->value)
                <ul>
                    <li class="menu-title">
                        <span>Menu principal</span>
                    </li>

                    <li>
                        <a href="{{route('main.teacherDashboard')}}" class="active"><i class="feather-grid"> </i><span>Dashboard</span></a>
                    </li>


                    <li class="submenu">
                        <a href="#"><i class="fas fa-graduation-cap"></i> <span> Elèves</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{route('main.student.students')}}">Liste des élèves</a></li>
                            <li><a href="{{route('main.student.add-student')}}">Ajouter un élève</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="fas fa-graduation-cap"></i> <span> Grades </span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{route('main.grade.grades')}}">Liste des grades</a></li>
                            <li><a href="{{route('main.grade.add-grade')}}">Ajouter un grade</a></li>
                        </ul>
                    </li>

                    {{--<li class="submenu">
                        <a href="#"><i class="fas fa-chalkboard-teacher"></i> <span> Sensei</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{route('main.sensei.senseis')}}">Liste des sensei</a></li>
                            <li><a href="{{route('main.sensei.teacher-details')}}">Teacher View</a></li>
                            <li><a href="{{route('main.sensei.add-teacher')}}">Teacher Add</a></li>
                            <li><a href="{{route('main.sensei.edit-teacher')}}">Teacher Edit</a></li>
                        </ul>
                    </li>--}}

                    <li class="submenu">
                        <a href="#"><i class="fas fa-building"></i> <span> Club</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li>
                                <a href="{{route('main.department.department-details', [$user->clubs->first()->id])}}">Infos du club</a>
                            </li>
                            <li><a href="{{route('main.dojo.dojos')}}">Liste des Dojos</a></li>
                            <li><a href="{{route('main.dojo.add-dojo')}}">Ajouter un Dojo</a></li>

                        </ul>
                    </li>




                    <!--invoices-->
                    {{-- invoices    <li class="submenu">
                            <a href="#"><i class="fas fa-clipboard"></i> <span> Invoices</span> <span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="{{route('main.invoice.invoices')}}">Invoices List</a></li>
                                <li><a href="{{route('main.invoice.invoice-grid')}}">Invoices Grid</a></li>--}}{{--
                                <li><a href="{{route('main.invoice.add-invoice')}}">Add Invoices</a></li>
                                <li><a href="{{route('main.invoice.edit-invoice')}}">Edit Invoices</a></li>
                                <li><a href="{{route('main.invoice.view-invoice')}}">Invoices Details</a></li>
                                <li><a href="{{route('main.invoice.invoices-settings')}}">Invoices Settings</a></li>--}}{{--
                            </ul>
                        </li>--}}

                    <li class="menu-title">
                        <span>Management</span>
                    </li>
                    {{--<li class="submenu">
                        <a href="#"><i class="fas fa-file-invoice-dollar"></i> <span> Accounts</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{route('main.account.fees-collections')}}">Fees Collection</a></li>
                            <li><a href="{{route('main.account.expenses')}}">Expenses</a></li>
                            <li><a href="{{route('main.account.salary')}}">Salary</a></li>
                            <li><a href="{{route('main.account.add-fees-collection')}}">Add Fees</a></li>
                            <li><a href="{{route('main.account.add-expenses')}}">Add Expenses</a></li>
                            <li><a href="{{route('main.account.add-salary')}}">Add Salary</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{route('main.holiday.holiday')}}"><i class="fas fa-holly-berry"></i> <span>Holiday</span></a>
                    </li>--}}
                    <li>
                        <a href="{{route('main.event.events')}}"><i class="fas fa-calendar-day"></i> <span>Évènements</span></a>
                    </li>

                    <li>
                        <a href="{{route('main.exam.exams')}}"><i class="fas fa-clipboard-list"></i>
                            <span>Examens</span></a>
                    </li>

                    <li>
                        <a href="{{route('main.fee.fees')}}"><i class="fas fa-comment-dollar"></i> <span>Mes frais</span></a>
                    </li>

                    <li>
                        <a href="{{route('main.blog.blog')}}"><i class="fas fa-video"></i> <span>Mes cours</span></a>
                    </li>

                    <li><a href="{{route('main.transfer.transfers')}}"><i class="fas fa-people-arrows-left-right"></i> <span>Transferts</span></a></li>



                    {{--<li>
                        <a href="{{route('main.library.library')}}"><i class="fas fa-book"></i> <span>Library</span></a>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="fa fa-newspaper"></i> <span> Blogs</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul>
                            <li><a href="{{route('main.blog.blog')}}">All Blogs</a></li>
                            <li><a href="{{route('main.blog.add-blog')}}">Add Blog</a></li>
                            <li><a href="{{route('main.blog.edit-blog')}}">Edit Blog</a></li>
                        </ul>
                    </li>--}}

                    <li class="menu-title">
                        <span>Général</span>
                    </li>

                    <li><a href="{{route('main.ui.element.notification')}}"><i class="fas fa-message"></i><span>Notifications</span></a></li>
                    <li>
                        <a href="{{route('main.setting.settings')}}"><i class="fas fa-cog"></i>
                            <span>Paramètres</span></a>
                    </li>




             {{--       <li class="menu-title">
                        <span>Others</span>
                    </li>
                    <li>
                        <a href="{{route('main.sport.sports')}}"><i class="fas fa-baseball-ball"></i>
                            <span>Sports</span></a>
                    </li>--}}
                    {{--<li>
                        <a href="{{route('main.hotel.hostel')}}"><i class="fas fa-hotel"></i> <span>Hostel</span></a>
                    </li>--}}
                    {{--<li>
                        <a href="{{route('main.transport.transport')}}"><i class="fas fa-bus"></i>
                            <span>Transport</span></a>
                    </li>--}}
                   {{-- <li class="menu-title">
                        <span>UI Interface</span>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="fab fa-get-pocket"></i> <span>Base UI </span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{route('main.ui.baseUI.alerts')}}">Alerts</a></li>
                            <li><a href="{{route('main.ui.baseUI.accordions')}}">Accordions</a></li>
                            <li><a href="{{route('main.ui.baseUI.avatar')}}">Avatar</a></li>
                            <li><a href="{{route('main.ui.baseUI.badges')}}">Badges</a></li>
                            <li><a href="{{route('main.ui.baseUI.buttons')}}">Buttons</a></li>
                            <li><a href="{{route('main.ui.baseUI.buttongroup')}}">Button Group</a></li>
                            <li><a href="{{route('main.ui.baseUI.breadcrumbs')}}">Breadcrumb</a></li>
                            <li><a href="{{route('main.ui.baseUI.cards')}}">Cards</a></li>
                            <li><a href="{{route('main.ui.baseUI.carousel')}}">Carousel</a></li>
                            <li><a href="{{route('main.ui.baseUI.dropdowns')}}">Dropdowns</a></li>
                            <li><a href="{{route('main.ui.baseUI.grid')}}">Grid</a></li>
                            <li><a href="{{route('main.ui.baseUI.images')}}">Images</a></li>
                            <li><a href="{{route('main.ui.baseUI.lightbox')}}">Lightbox</a></li>
                            <li><a href="{{route('main.ui.baseUI.media')}}">Media</a></li>
                            <li><a href="{{route('main.ui.baseUI.modal')}}">Modals</a></li>
                            <li><a href="{{route('main.ui.baseUI.offcanvas')}}">Offcanvas</a></li>
                            <li><a href="{{route('main.ui.baseUI.pagination')}}">Pagination</a></li>
                            <li><a href="{{route('main.ui.baseUI.popover')}}">Popover</a></li>
                            <li><a href="{{route('main.ui.baseUI.progress')}}">Progress Bars</a></li>
                            <li><a href="{{route('main.ui.baseUI.placeholders')}}">Placeholders</a></li>
                            <li><a href="{{route('main.ui.baseUI.rangeslider')}}">Range Slider</a></li>
                            <li><a href="{{route('main.ui.baseUI.spinners')}}">Spinner</a></li>
                            <li><a href="{{route('main.ui.baseUI.sweetalerts')}}">Sweet Alerts</a></li>
                            <li><a href="{{route('main.ui.baseUI.tab')}}">Tabs</a></li>
                            <li><a href="{{route('main.ui.baseUI.toastr')}}">Toasts</a></li>
                            <li><a href="{{route('main.ui.baseUI.tooltip')}}">Tooltip</a></li>
                            <li><a href="{{route('main.ui.baseUI.typography')}}">Typography</a></li>
                            <li><a href="{{route('main.ui.baseUI.video')}}">Video</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i data-feather="box"></i> <span>Elements </span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{route('main.ui.element.ribbon')}}">Ribbon</a></li>
                            <li><a href="{{route('main.ui.element.clipboard')}}">Clipboard</a></li>
                            <li><a href="{{route('main.ui.element.drag-drop')}}">Drag & Drop</a></li>
                            <li><a href="{{route('main.ui.element.rating')}}">Rating</a></li>
                            <li><a href="{{route('main.ui.element.text-editor')}}">Text Editor</a></li>
                            <li><a href="{{route('main.ui.element.counter')}}">Counter</a></li>
                            <li><a href="{{route('main.ui.element.scrollbar')}}">Scrollbar</a></li>

                            <li><a href="{{route('main.ui.element.stickynote')}}">Sticky Note</a></li>
                            <li><a href="{{route('main.ui.element.timeline')}}">Timeline</a></li>
                            <li><a href="{{route('main.ui.element.horizontal-timeline')}}">Horizontal Timeline</a></li>
                            <li><a href="{{route('main.ui.element.form-wizard')}}">Form Wizard</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i data-feather="bar-chart-2"></i> <span> Charts </span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{route('main.ui.charts.chart-apex')}}">Apex Charts</a></li>
                            <li><a href="{{route('main.ui.charts.chart-js')}}">Chart Js</a></li>
                            <li><a href="{{route('main.ui.charts.chart-morris')}}">Morris Charts</a></li>
                            <li><a href="{{route('main.ui.charts.chart-flot')}}">Flot Charts</a></li>
                            <li><a href="{{route('main.ui.charts.chart-peity')}}">Peity Charts</a></li>
                            <li><a href="{{route('main.ui.charts.chart-c3')}}">C3 Charts</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i data-feather="award"></i> <span> Icons </span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{route('main.ui.icons.icon-fontawesome')}}">Fontawesome Icons</a></li>
                            <li><a href="{{route('main.ui.icons.icon-feather')}}">Feather Icons</a></li>
                            <li><a href="{{route('main.ui.icons.icon-ionic')}}">Ionic Icons</a></li>
                            <li><a href="{{route('main.ui.icons.icon-material')}}">Material Icons</a></li>
                            <li><a href="{{route('main.ui.icons.icon-pe7')}}">Pe7 Icons</a></li>
                            <li><a href="{{route('main.ui.icons.icon-simpleline')}}">Simpleline Icons</a></li>
                            <li><a href="{{route('main.ui.icons.icon-themify')}}">Themify Icons</a></li>
                            <li><a href="{{route('main.ui.icons.icon-weather')}}">Weather Icons</a></li>
                            <li><a href="{{route('main.ui.icons.icon-typicon')}}">Typicon Icons</a></li>
                            <li><a href="{{route('main.ui.icons.icon-flag')}}">Flag Icons</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="fas fa-columns"></i> <span> Forms </span> <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{route('main.ui.forms.form-basic-inputs')}}">Basic Inputs </a></li>
                            <li><a href="{{route('main.ui.forms.form-input-groups')}}">Input Groups </a></li>
                            <li><a href="{{route('main.ui.forms.form-horizontal')}}">Horizontal Form </a></li>
                            <li><a href="{{route('main.ui.forms.form-vertical')}}"> Vertical Form </a></li>
                            <li><a href="{{route('main.ui.forms.form-mask')}}"> Form Mask </a></li>
                            <li><a href="{{route('main.ui.forms.form-validation')}}"> Form Validation </a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="fas fa-table"></i> <span> Tables </span> <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{route('main.ui.tables.tables-basic')}}">Basic Tables </a></li>
                            <li><a href="{{route('main.ui.tables.data-tables')}}">Data Table </a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="javascript:void(0);"><i class="fas fa-code"></i> <span>Multi Level</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li class="submenu">
                                <a href="javascript:void(0);"> <span>Level 1</span> <span class="menu-arrow"></span></a>
                                <ul>
                                    <li><a href="javascript:void(0);"><span>Level 2</span></a></li>
                                    <li class="submenu">
                                        <a href="javascript:void(0);"> <span> Level 2</span> <span
                                                class="menu-arrow"></span></a>
                                        <ul>
                                            <li><a href="javascript:void(0);">Level 3</a></li>
                                            <li><a href="javascript:void(0);">Level 3</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="javascript:void(0);"> <span>Level 2</span></a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);"> <span>Level 1</span></a>
                            </li>
                        </ul>
                    </li>--}}
                </ul>
            @elseif($user->role  === Role::STUDENT->value)
                <ul>
                    <li class="menu-title">
                        <span>Menu principal</span>
                    </li>

                    <li>
                        <a href="{{route('main.studentDashboard')}}" class="active"><i class="feather-grid"> </i><span>Dashboard</span></a>
                    </li>


                    <li>
                        <a href="{{route('main.department.department-details', [$user->clubs->first()->id])}}"><i class="fas fa-building"></i><span>Mon club</span></a>
                    </li>





                    <!--invoices-->


                    <li class="menu-title">
                        <span>Management</span>
                    </li>

                    <li>
                        <a href="{{route('main.event.events')}}"><i class="fas fa-calendar-day"></i> <span>Évènements</span></a>
                    </li>

                    <li>
                        <a href="{{route('main.exam.exams')}}"><i class="fas fa-clipboard-list"></i>
                            <span>Mes examens</span></a>
                    </li>


                    <li>
                        <a href="{{route('main.fee.student-fees-details')}}"><i class="fas fa-comment-dollar"></i> <span>Mes paiements</span></a>
                    </li>

                    <li>
                        <a href="{{route('main.blog.blog')}}"><i class="fas fa-video"></i> <span>Mes cours</span></a>
                    </li>

                    <li class="menu-title">
                        <span>Général</span>
                    </li>

                    <li><a href="{{route('main.ui.element.notification')}}"><i class="fas fa-message"></i><span>Notifications</span></a></li>
                    <li>
                        <a href="{{route('main.setting.settings')}}"><i class="fas fa-cog"></i>
                            <span>Paramètres</span></a>
                    </li>


                </ul>
            @endif

        </div>
    </div>
</div>
