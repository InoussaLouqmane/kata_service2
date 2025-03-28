@extends('partials.layout');
@section("title", 'Modals');
@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Modal</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Components</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Bootstrap Modals</h4>
                        <p>
                            A rendered modal with header, body, and set of actions in the footer.
                        </p>

                        <div id="standard-modal" class="modal fade" tabindex="-1" role="dialog"
                             aria-labelledby="standard-modalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="standard-modalLabel">Modal Heading</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h6>Text in a modal</h6>
                                        <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula.</p>
                                        <hr>
                                        <h6>Overflowing text to show scroll behavior</h6>
                                        <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac
                                            facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac,
                                            vestibulum at eros.</p>
                                        <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus
                                            sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
                                        <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna,
                                            vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper
                                            nulla non metus auctor fringilla.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close
                                        </button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="bs-example-modal-lg" tabindex="-1" role="dialog"
                             aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myLargeModalLabel">Large modal</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        ...
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="bs-example-modal-sm" tabindex="-1" role="dialog"
                             aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="mySmallModalLabel">Small modal</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        ...
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="full-width-modal" class="modal fade" tabindex="-1" role="dialog"
                             aria-labelledby="fullWidthModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-full-width">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="fullWidthModalLabel">Modal Heading</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h6>Text in a modal</h6>
                                        <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula.</p>
                                        <hr>
                                        <h6>Overflowing text to show scroll behavior</h6>
                                        <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac
                                            facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac,
                                            vestibulum at eros.</p>
                                        <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus
                                            sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
                                        <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna,
                                            vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper
                                            nulla non metus auctor fringilla.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close
                                        </button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="scrollable-modal" tabindex="-1" role="dialog"
                             aria-labelledby="scrollableModalTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="scrollableModalTitle">Modal title</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac
                                            facilisis in, egestas
                                            eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                                        <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus
                                            sagittis lacus vel augue
                                            laoreet rutrum faucibus dolor auctor.</p>
                                        <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna,
                                            vel scelerisque nisl
                                            consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor
                                            fringilla.</p>
                                        <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac
                                            facilisis in, egestas
                                            eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                                        <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus
                                            sagittis lacus vel augue
                                            laoreet rutrum faucibus dolor auctor.</p>
                                        <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna,
                                            vel scelerisque nisl
                                            consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor
                                            fringilla.</p>
                                        <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac
                                            facilisis in, egestas
                                            eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                                        <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus
                                            sagittis lacus vel augue
                                            laoreet rutrum faucibus dolor auctor.</p>
                                        <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna,
                                            vel scelerisque nisl
                                            consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor
                                            fringilla.</p>
                                        <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac
                                            facilisis in, egestas
                                            eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                                        <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus
                                            sagittis lacus vel augue
                                            laoreet rutrum faucibus dolor auctor.</p>
                                        <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna,
                                            vel scelerisque nisl
                                            consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor
                                            fringilla.</p>
                                        <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac
                                            facilisis in, egestas
                                            eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                                        <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus
                                            sagittis lacus vel augue
                                            laoreet rutrum faucibus dolor auctor.</p>
                                        <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna,
                                            vel scelerisque nisl
                                            consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor
                                            fringilla.</p>
                                        <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac
                                            facilisis in, egestas
                                            eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                                        <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus
                                            sagittis lacus vel augue
                                            laoreet rutrum faucibus dolor auctor.</p>
                                        <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna,
                                            vel scelerisque nisl
                                            consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor
                                            fringilla.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close
                                        </button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="button-list">

                            <button type="button" class="btn btn-primary mt-1" data-bs-toggle="modal"
                                    data-bs-target="#standard-modal">Standard Modal
                            </button>

                            <button type="button" class="btn btn-info mt-1" data-bs-toggle="modal"
                                    data-bs-target="#bs-example-modal-lg">Large Modal
                            </button>

                            <button type="button" class="btn btn-success mt-1" data-bs-toggle="modal"
                                    data-bs-target="#bs-example-modal-sm">Small Modal
                            </button>

                            <button type="button" class="btn btn-primary mt-1" data-bs-toggle="modal"
                                    data-bs-target="#full-width-modal">Full width Modal
                            </button>

                            <button type="button" class="btn btn-secondary mt-1" data-bs-toggle="modal"
                                    data-bs-target="#scrollable-modal">Scrollable Modal
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Modal with Pages</h4>
                        <p>Examples of custom modals.</p>

                        <div id="signup-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="text-center mt-2 mb-4">
                                            <div class="auth-logo">
                                                <a href="../index.html" class="logo logo-dark">
<span class="logo-lg">
<img src="assets/img/logo.png" alt height="42">
</span>
                                                </a>
                                            </div>
                                        </div>
                                        <form class="px-3" action="#">
                                            <div class="mb-3">
                                                <label for="username" class="form-label">Name</label>
                                                <input class="form-control" type="email" id="username" required
                                                       placeholder="Michael Zenaty">
                                            </div>
                                            <div class="mb-3">
                                                <label for="emailaddress" class="form-label">Email address</label>
                                                <input class="form-control" type="email" id="emailaddress" required
                                                       placeholder="john@deo.com">
                                            </div>
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Password</label>
                                                <input class="form-control" type="password" required id="password"
                                                       placeholder="Enter your password">
                                            </div>
                                            <div class="mb-3">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="customCheck1">
                                                    <label class="form-check-label" for="customCheck1">I accept <a
                                                            href="#">Terms and Conditions</a></label>
                                                </div>
                                            </div>
                                            <div class="mb-3 text-center">
                                                <button class="btn btn-primary" type="submit">Sign Up Free</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="login-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="text-center mt-2 mb-4">
                                            <div class="auth-logo">
                                                <a href="../index.html" class="logo logo-dark">
<span class="logo-lg">
<img src="assets/img/logo.png" alt height="42">
</span>
                                                </a>
                                            </div>
                                        </div>
                                        <form action="#" class="px-3">
                                            <div class="mb-3">
                                                <label for="emailaddress1" class="form-label">Email address</label>
                                                <input class="form-control" type="email" id="emailaddress1" required
                                                       placeholder="john@deo.com">
                                            </div>
                                            <div class="mb-3">
                                                <label for="password1" class="form-label">Password</label>
                                                <input class="form-control" type="password" required id="password1"
                                                       placeholder="Enter your password">
                                            </div>
                                            <div class="mb-3">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="customCheck2">
                                                    <label class="form-check-label" for="customCheck2">Remember
                                                        me</label>
                                                </div>
                                            </div>
                                            <div class="mb-2 text-center">
                                                <button class="btn rounded-pill btn-primary" type="submit">Sign In
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="button-list">

                            <button type="button" class="btn btn-primary mt-1" data-bs-toggle="modal"
                                    data-bs-target="#signup-modal">Sign Up Modal
                            </button>

                            <button type="button" class="btn btn-info mt-1" data-bs-toggle="modal"
                                    data-bs-target="#login-modal">Log In Modal
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Modal Position</h4>
                        <p>Specify the position for the modal. You can display modal at top, bottom, center or right of
                            page by specifying
                            classes <code>modal-top</code>, <code>modal-bottom</code>,
                            <code>modal-dialog-centered</code> and <code>modal-right
                            </code> respectively.</p>

                        <div id="top-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-top">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="topModalLabel">Modal Heading</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h5>Text in a modal</h5>
                                        <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close
                                        </button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="right-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-sm modal-right">
                                <div class="modal-content">
                                    <div class="modal-header border-0">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="text-center">
                                            <h4 class="mt-0">Text in a modal</h4>
                                            <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula.</p>
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">
                                                Close
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="bottom-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-sm modal-bottom">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="bottomModalLabel">Modal Heading</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h5>Text in a modal</h5>
                                        <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close
                                        </button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="centermodal" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myCenterModalLabel">Center modal</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h5>Overflowing text to show scroll behavior</h5>
                                        <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac
                                            facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac,
                                            vestibulum at eros.</p>
                                        <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus
                                            sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="button-list">

                            <button type="button" class="btn btn-secondary mt-1" data-bs-toggle="modal"
                                    data-bs-target="#top-modal">Top Modal
                            </button>

                            <button type="button" class="btn btn-secondary mt-1" data-bs-toggle="modal"
                                    data-bs-target="#bottom-modal">Bottom Modal
                            </button>

                            <button type="button" class="btn btn-secondary mt-1" data-bs-toggle="modal"
                                    data-bs-target="#centermodal">Center modal
                            </button>

                            <button type="button" class="btn btn-secondary mt-1" data-bs-toggle="modal"
                                    data-bs-target="#right-modal">Rightbar Modal
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Modal based Alerts</h4>
                        <p>Show different contexual alert messages using modal component</p>

                        <div id="success-alert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content modal-filled bg-success">
                                    <div class="modal-body p-4">
                                        <div class="text-center">
                                            <i class="dripicons-checkmark h1 text-white"></i>
                                            <h4 class="mt-2 text-white">Well Done!</h4>
                                            <p class="mt-3 text-white">Cras mattis consectetur purus sit amet fermentum.
                                                Cras justo odio, dapibus ac facilisis in, egestas eget quam.</p>
                                            <button type="button" class="btn btn-light my-2" data-bs-dismiss="modal">
                                                Continue
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="info-alert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-body p-4">
                                        <div class="text-center">
                                            <i class="dripicons-information h1 text-info"></i>
                                            <h4 class="mt-2">Heads up!</h4>
                                            <p class="mt-3">Cras mattis consectetur purus sit amet fermentum. Cras justo
                                                odio, dapibus ac facilisis in, egestas eget quam.</p>
                                            <button type="button" class="btn btn-info my-2" data-bs-dismiss="modal">
                                                Continue
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="warning-alert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-body p-4">
                                        <div class="text-center">
                                            <i class="dripicons-warning h1 text-warning"></i>
                                            <h4 class="mt-2">Incorrect Information</h4>
                                            <p class="mt-3">Cras mattis consectetur purus sit amet fermentum. Cras justo
                                                odio, dapibus ac facilisis in, egestas eget quam.</p>
                                            <button type="button" class="btn btn-warning my-2" data-bs-dismiss="modal">
                                                Continue
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="danger-alert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content modal-filled bg-danger">
                                    <div class="modal-body p-4">
                                        <div class="text-center">
                                            <i class="dripicons-wrong h1 text-white"></i>
                                            <h4 class="mt-2 text-white">Oh snap!</h4>
                                            <p class="mt-3 text-white">Cras mattis consectetur purus sit amet fermentum.
                                                Cras justo odio, dapibus ac facilisis in, egestas eget quam.</p>
                                            <button type="button" class="btn btn-light my-2" data-bs-dismiss="modal">
                                                Continue
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="button-list">

                            <button type="button" class="btn btn-success mt-1" data-bs-toggle="modal"
                                    data-bs-target="#success-alert-modal">Success Alert
                            </button>

                            <button type="button" class="btn btn-info mt-1" data-bs-toggle="modal"
                                    data-bs-target="#info-alert-modal">Info Alert
                            </button>

                            <button type="button" class="btn btn-warning mt-1" data-bs-toggle="modal"
                                    data-bs-target="#warning-alert-modal">Warning Alert
                            </button>

                            <button type="button" class="btn btn-danger mt-1" data-bs-toggle="modal"
                                    data-bs-target="#danger-alert-modal">Danger Alert
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Multiple Modal</h4>
                        <p>Display a series of modals one by one to guide your users on multiple aspects or take step
                            wise input.</p>

                        <div class="modal fade" id="exampleModalToggle" aria-hidden="true"
                             aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="exampleModalToggleLabel">Modal 1</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Show a second modal and hide this one with the button below.
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-primary" data-bs-target="#exampleModalToggle2"
                                                data-bs-toggle="modal" data-bs-dismiss="modal">Open second modal
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="exampleModalToggle2" aria-hidden="true"
                             aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="exampleModalToggleLabel2">Modal 2</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Hide this modal and show the first with the button below.
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-primary" data-bs-target="#exampleModalToggle"
                                                data-bs-toggle="modal" data-bs-dismiss="modal">Back to first
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="btn btn-secondary" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Open
                            first modal</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Custom Modals</h4>
                        <p>Examples of custom modals.</p>


                        <div id="accordion-modal" class="modal fade" tabindex="-1" role="dialog"
                             aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog">
                                <div class="modal-content p-0">
                                    <div id="accordion">
                                        <div class="card mb-0">
                                            <div class="card-header" id="headingOne">
                                                <h5 class="m-0">
                                                    <a href="#collapseOne" class="text-dark" data-bs-toggle="collapse"
                                                       aria-expanded="true" aria-controls="collapseOne">
                                                        Collapsible Group Item #1
                                                    </a>
                                                </h5>
                                            </div>
                                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                                 data-bs-parent="#accordion">
                                                <div class="card-body">
                                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus
                                                    terry richardson ad squid. 3 wolf moon officia aute,
                                                    non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
                                                    laborum eiusmod. Brunch 3 wolf moon
                                                    tempor, sunt aliqua put a bird on it squid single-origin coffee
                                                    nulla assumenda shoreditch et. Nihil
                                                    anim keffiyeh helvetica, craft beer labore wes anderson cred
                                                    nesciunt sapiente ea proident. Ad vegan
                                                    excepteur butcher vice lomo. Leggings occaecat craft beer
                                                    farm-to-table, raw denim aesthetic synth nesciunt
                                                    you probably haven't heard of them accusamus labore sustainable VHS.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card mb-0">
                                            <div class="card-header" id="headingTwo">
                                                <h5 class="m-0">
                                                    <a href="#collapseTwo" class="collapsed text-dark"
                                                       data-bs-toggle="collapse" aria-expanded="false"
                                                       aria-controls="collapseTwo">
                                                        Collapsible Group Item #2
                                                    </a>
                                                </h5>
                                            </div>
                                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                                 data-bs-parent="#accordion">
                                                <div class="card-body">
                                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus
                                                    terry richardson ad squid. 3 wolf moon officia aute,
                                                    non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
                                                    laborum eiusmod. Brunch 3 wolf moon
                                                    tempor, sunt aliqua put a bird on it squid single-origin coffee
                                                    nulla assumenda shoreditch et. Nihil
                                                    anim keffiyeh helvetica, craft beer labore wes anderson cred
                                                    nesciunt sapiente ea proident. Ad vegan
                                                    excepteur butcher vice lomo. Leggings occaecat craft beer
                                                    farm-to-table, raw denim aesthetic synth nesciunt
                                                    you probably haven't heard of them accusamus labore sustainable VHS.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card mb-0">
                                            <div class="card-header" id="headingThree">
                                                <h5 class="m-0">
                                                    <a href="#collapseThree" class="collapsed text-dark"
                                                       data-bs-toggle="collapse" aria-expanded="false"
                                                       aria-controls="collapseThree">
                                                        Collapsible Group Item #3
                                                    </a>
                                                </h5>
                                            </div>
                                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                                 data-bs-parent="#accordion">
                                                <div class="card-body">
                                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus
                                                    terry richardson ad squid. 3 wolf moon officia aute,
                                                    non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
                                                    laborum eiusmod. Brunch 3 wolf moon
                                                    tempor, sunt aliqua put a bird on it squid single-origin coffee
                                                    nulla assumenda shoreditch et. Nihil
                                                    anim keffiyeh helvetica, craft beer labore wes anderson cred
                                                    nesciunt sapiente ea proident. Ad vegan
                                                    excepteur butcher vice lomo. Leggings occaecat craft beer
                                                    farm-to-table, raw denim aesthetic synth nesciunt
                                                    you probably haven't heard of them accusamus labore sustainable VHS.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="button-list">

                            <button type="button" class="btn btn-success waves-effect waves-light mt-1"
                                    data-bs-toggle="modal" data-bs-target="#con-close-modal">Responsive Modal
                            </button>

                            <button type="button" class="btn btn-secondary waves-effect waves-light mt-1"
                                    data-bs-toggle="modal" data-bs-target="#accordion-modal">Accordion in Modal
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Static backdrop</h4>
                        <p>
                            When backdrop is set to static, the modal will not close when clicking outside it. Click the
                            button below to try it.
                        </p>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop">
                            Launch static backdrop modal
                        </button>

                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                             tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry
                                        richardson ad squid. 3 wolf moon officia aute,
                                        non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
                                        eiusmod. Brunch 3 wolf moon
                                        tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda
                                        shoreditch et.
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close
                                        </button>
                                        <button type="button" class="btn btn-primary">Understood</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

