@extends('layouts.settings', ['active' => 'account'])

@section('subpage')
    <script defer src={{ asset("js/account_settings.js") }}></script>

    <div class="container-fluid">
        <h2 class="my-4">Account</h2>

        <div class="status-messages">
            @if (Session::has('success'))
            <div class="alert alert-success">
                <ul>
                    @foreach(Session::get('success') as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if (Session::has('error'))
            <div class="alert alert-danger">
                <ul>
                    @foreach(Session::get('error') as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>

        <div class="row">
            <div class="container-fluid border rounded-3">
                <form id="account_form" action="{{ route('save_account_changes') }}" enctype="multipart/form-data" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="row mt-2 justify-content-between">
                        <div class="col-lg-8 order-lg-2">
                            <div class="row">
                                <div class="col-4">
                                    <img id="image-preview" class="img-fluid rounded-3"
                                            src={{ Auth::user()->getImage('medium') }}
                                            alt={{ Auth::user()->username . ' profile picture' }}>

                                    <input type="file" class="form-control" id="imageFile" name="image"/>
                                </div>
                                <div class="col-7">
                                    <h3>{{ Auth::user()->name }}</h3>
                                    <h4 class="text-muted">{{ '@' . Auth::user()->username }}</h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 order-lg-1">
                            <div class="mb-3">
                                <label class="form-label" for="name">Name</label>
                                <input class="form-control" autocomplete="off" type="text" id="name" name="name" placeholder="{{ Auth::user()->name }}">
                            </div>

                            <label class="form-label" for="username">Username</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">@</span>
                                <input autocomplete="off" type="text" class="form-control" id="username" name="username" placeholder="{{ Auth::user()->username}}"
                                    aria-label="Username" aria-describedby="basic-addon1">
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="email">Email</label>
                                <input autocomplete="email" class="form-control" type="text" id="email" name="email" placeholder="{{ Auth::user()->email }}">
                                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="my-2 d-grid gap-2 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="container-fluid my-4 border rounded">
                <div class="row bg-light-grey border-rounded border-bottom">
                    <h4>Delete Account</h4>
                </div>
                <div class="row">
                    <span>Deleting your account means you cannot access it again. All your personal information will be lost. Think carefully before doing so.</span>
                </div>
                <div class="row">
                    <div class="my-2 d-grid gap-2 d-flex justify-content-end">
                        <button type="button" class="btn btn-danger">Delete Account</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

