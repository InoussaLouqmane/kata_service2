@php use App\Models\Grade;use App\Models\Resource;use App\Models\User;use Illuminate\Support\Facades\Auth;
 use App\Enums\Role;
 $authUser = Auth::user();
@endphp
@extends('partials.layout');
@section('title', 'Cours');

@section('content')
    <div class="content container-fluid">

        <h4>Catégories ({{Resource::all()->count()}} vidéos)</h4>

        <div class="row">
            <div class="col-md-9">
                <ul class="list-links mb-4">
                    <li class="all active"><a>Toutes</a></li>
                    <li class="kata-filter "><a>Kata</a></li>
                    <li class="kihon-filter"><a>Kihon</a></li>
                    <li class="kumite-filter"><a>Kumite</a></li>
                </ul>
            </div>

            @if($authUser->role != Role::STUDENT->value)
                <div class="col-md-3 text-md-end">
                    <a data-action="create"
                       class="AddContentButton btn btn-primary btn-blog mb-3"><i
                            class="feather-plus-circle me-1"></i> Ajouter du contenu</a>
                </div>
            @endif
        </div>
        <div class="row">


            @foreach(Resource::all() as $resource)
                <div class="col-md-6 col-xl-4 col-sm-12 d-flex blog-container" data-type="{{$resource->type}}">
                    <div class="blog grid-blog flex-fill">
                        <div class="blog-image9">
                            <iframe class="w-100 rounded"
                                    height="275"
                                    src="https://www.youtube.com/embed/{{$resource->videoLink}}"
                                    title="YouTube video player" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            <div class="blog-views">
                                <i class="feather-eye me-1"></i> 654
                            </div>
                        </div>
                        <div class="blog-content mt-2">

                            <ul class="entry-meta meta-item">
                                <li class="fst-italic">
                                    <i class="feather-watch"></i> ajouté le {{$resource->created_at->format('d M Y')}}
                                </li>
                            </ul>

                            <h3 class="blog-title"><a href="blog-details.html">{{$resource->title}}</a></h3>
                            <p class="blog-description">{{$resource->description ?? 'Aucune description'}}</p>

                        </div>
                        @if($authUser->role != Role::STUDENT->value)
                            <div class="row">
                                <div class="edit-options">
                                    <div class="edit-delete-btn">
                                        <a data-resource-id="{{$resource->id}}"
                                           data-grades="{{json_encode($resource->grades->pluck('id')->toArray())}}"
                                           class="editResourceButton btn text-success"><i
                                                class="feather-edit-3 me-1"></i>
                                            Modifier</a>
                                        <a data-resource-id="{{$resource->id}}"
                                           class="btn deleteResourceButton text-danger"><i
                                                class="feather-trash-2 me-1"></i>Supprimer</a>
                                    </div>

                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach


        </div>

        <div class="row pagination-component">
            <div class="col-md-12">
                <div class="pagination-tab  d-flex justify-content-center">
                    <ul class="pagination mb-0">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1"><i class="feather-chevron-left mr-2"></i>Previous</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item ">
                            <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next<i class="feather-chevron-right ml-2"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>


        <div class="modal fade contentmodal" id="deleteModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content doctor-profile">
                    <div class="modal-header pb-0 border-bottom-0  justify-content-end">
                        <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i
                                class="feather-x-circle"></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="delete-wrap text-center">
                            <div class="del-icon"><i class="feather-x-circle"></i></div>
                            <h2>Sure you want to delete</h2>
                            <div class="submit-section">
                                <a href="blog.html" class="btn btn-success me-2">Yes</a>
                                <a href="#" class="btn btn-danger" data-bs-dismiss="modal">No</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    {{--modals --}}

    <div id="video-modal" class="modal fade" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

        <div class="modal-dialog">
            <div class="modal-content">

                <form id='create-resource-form' method="POST" action="">

                    <div class="modal-header">
                        <h4 class="modal-title">Ajouter une vidéo</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="local-forms">
                                    <label>Url de la vidéo<span class="login-danger">*</span> </label>
                                    <input type="url" class="form-control" name="videoLink">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="local-forms">
                                    <label>Titre de la vidéo<span class="login-danger">*</span> </label>
                                    <input type="text" class="exam-cost form-control" name="title">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="local-forms">
                                    <label for="field-7" class="form-label">Description (Facultatif)</label>
                                    <textarea class="form-control" id="description-field" name="description"
                                              placeholder="..."></textarea>
                                </div>

                            </div>
                        </div>


                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="local-forms">
                                    <label>Catégorie<span class="login-danger">*</span> </label>
                                    <select class="form-control form-select" name="type" id="typeSelect">
                                        <option value="Kata" selected>Kata</option>
                                        <option value="Kihon">Kihon</option>
                                        <option value="Kumite">Kumite</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="local-forms">
                                    <label>Grades non elligibles<span class="login-danger">*</span> </label>
                                    <select class="form-control form-select" name="grades" id="nonElligibleGradeSelect">
                                        <option value="">...</option>
                                        @foreach(Grade::all() as $grade)
                                            <option value="{{$grade->id}}">{{$grade->beltName}}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                        </div>

                        <div class="">
                            <hr>
                            <div class="selectedGradesArea d-flex flex-row"><span class="fst-italic placeholder-fill">Tous les grades sont elligibles.</span>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light waves-effect"
                                data-bs-dismiss="modal">Annuler
                        </button>
                        <button type="submit" id="videoSubmitButton" class="btn btn-primary waves-effect waves-light">
                            Ajouter
                        </button>
                    </div>
                </form>


            </div>
        </div>
    </div>


    {{--end modals --}}

    @push('scripts')
        <script src="{{asset('/js/video-section.js')}}"></script>
    @endpush
@endsection
