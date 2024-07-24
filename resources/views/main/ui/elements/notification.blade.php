@extends('partials.layout');
@section('title', 'Notifications');

@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Notification</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Components</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Alert</div>
                    </div>
                    <div class="card-body">
                        <a href="javascript: void(0);" id="alert" class="btn btn-primary waves-effect waves-light">Click me</a>
                    </div>
                </div>
            </div>


            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Confirm</div>
                    </div>
                    <div class="card-body">
                        <a href="javascript: void(0);" id="alert-confirm" class="btn btn-primary waves-effect waves-light">Click me</a>
                    </div>
                </div>
            </div>


            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Prompt</div>
                    </div>
                    <div class="card-body">
                        <a href="javascript: void(0);" id="alert-prompt" class="btn btn-primary waves-effect waves-light">Click me</a>
                    </div>
                </div>
            </div>


            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Success Alert</div>
                    </div>
                    <div class="card-body">
                        <a href="javascript: void(0);" id="alert-success" class="btn btn-primary btn-sm waves-effect waves-light">Click me</a>
                    </div>
                </div>
            </div>


            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Error Alert</div>
                    </div>
                    <div class="card-body">
                        <a href="javascript: void(0);" id="alert-error" class="btn btn-primary btn-sm waves-effect waves-light">Click me</a>
                    </div>
                </div>
            </div>


            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Warnng Alert</div>
                    </div>
                    <div class="card-body">
                        <a href="javascript: void(0);" id="alert-warning" class="btn btn-primary btn-sm waves-effect waves-light">Click me</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

