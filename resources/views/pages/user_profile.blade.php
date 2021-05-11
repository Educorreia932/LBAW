@extends('layouts.app')

@section('content')
    <script defer src="{{ asset("js/contact_user.js") }}"></script>

    <div class="row m-2">
        {{-- Breadcrumbs --}}
    </div>

    {{-- User Information --}}
    <section class="container">
        <div class="row justify-content-center">
            <div class="d-flex flex-column flex-md-row border border-4">
                <div
                    class="col-12 col-md-8 user-details d-flex flex-column flex-md-row align-items-center align-items-md-start">
                    <div class="profile-avatar m-0 m-md-3">
                        <img width="200" height="200"
                             src={{ $user->getImage('medium') }}
                                 alt={{ $user->username . " profile picture" }}>
                    </div>

                    <div class="col-12 col-md-4 d-flex flex-column mt-md-5 ps-2 me-2">
                        <h2 class="fw-bold">{{ $user->name }}</h2>

                        <span class="fst-italic mb-2">{{ '@' . $user->username }}</span>

                        @if (Auth::check() && Auth::id() != $user->id )
                            <script defer src={{ asset("js/follow_users.js") }}></script>

                            @if (Auth::user()->followsMember($user->id))
                                <button type="button" class="follow btn btn-danger w-100"
                                        member_username="{{ $user->username }}">
                                    <i class="bi bi-heart-fill"></i>
                                    <span>Following</span>
                                </button>
                            @else
                                <button type="button" class="follow btn btn-outline-danger w-100"
                                        member_username="{{ $user->username }}">
                                    <i class="bi bi-heart"></i>
                                    <span>Follow</span>
                                </button>
                            @endif
                        @endif
                    </div>
                </div>

                <section class="user-details-side d-flex flex-column align-items-md-end ms-2 w-100">
                    <section class="user-actions d-flex flex-row flex-md-column flex-lg-row align-items-end mt-1 mb-2">
                        <a class="p-0 link-dark text-decoration-none hover-scale" href="search_results.php">
                            <i class="bi bi-shop"></i>
                            <span>Open Auctions</span>
                        </a>

                        @auth
                            @if (Auth::id() != $user->id )
                                {{-- Others' Profile --}}

                                {{-- Contact --}}
                                <button type="button" data-bs-toggle="modal" data-bs-target="#send-message-modal"
                                        class="btn ms-2 p-0 hover-scale">
                                    <i class="bi bi-envelope"></i>
                                    <span>Contact</span>
                                </button>

                                {{-- Report users --}}
                                <button type="button" data-bs-toggle="modal" data-bs-target="#report-user-modal"
                                        class="btn ms-2 p-0 hover-scale">
                                    <i class="bi bi-flag-fill text-danger"></i>
                                    <span>Report user</span>
                                </button>
                            @else
                                {{-- Own profile --}}
                                <a class="p-0 ms-2 link-dark text-decoration-none hover-scale"
                                   href={{ route('settings_account') }}>
                                    <i class="bi bi-gear"></i>
                                    <span>Edit Profile</span>
                                </a>
                            @endif
                        @endauth
                    </section>

                    <section class="user-description d-flex flex-column-reverse w-100">
                        <a role="button" class="collapsed description-toggler" data-bs-toggle="collapse"
                           href="#user-description" aria-expanded="false" aria-controls="user-description"></a>
                        <p class="collapse mb-1" id="user-description">
                            {{ $user->bio }}
                        </p>
                    </section>
                </section>
            </div>
        </div>
    </section>

    <div class="container mt-4">
        <div class="row">
            {{-- Feedback --}}
            <section class="col-12 col-md-6">
                <h2 class="fs-bold">Feedback</h2>
                <table id="bid-history" class="table">
                    <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Total</th>
                        <th scope="col">6 months</th>
                        <th scope="col">Last month</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-plus-circle text-success" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path
                                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                            </svg>
                        </td>
                        <td>23</td>
                        <td>19</td>
                        <td>3</td>
                    </tr>
                    <tr>
                        <td>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-dash-circle text-danger" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                            </svg>
                        </td>
                        <td>6</td>
                        <td>1</td>
                        <td>1</td>
                    </tr>
                    </tbody>
                </table>
            </section>

            {{-- Insights --}}
            <section class="col col-md-6 d-flex flex-column justify-content-center">
                <h2 class="fs-bold">Insights</h2>

                <div class="container border border-3 p-0">
                    <div class="row p-2 m-0 align-items-center justify-content-center w-100 h-100">
                        <div class="col text-center">
                            <small>Joined</small>
                            <h4>{{ $user->joined->toFormattedDateString() }}</h4>
                        </div>
                        <div class="col text-center">
                            <small>Auctions Created</small>
                            <h4>{{ $user->createdAuctions()->count() }}</h4>
                        </div>
                        <div class="col text-center">
                            <small>Followers</small>
                            <h4>{{ $user->followedBy()->count() }}</h4>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    {{-- Created Auctions --}}
    @if ($user->has_auctions)
        <section class="container my-4">
            <h2 class="fs-bold">Created Auctions</h2>
            <div class="d-flex flex-wrap justify-content-center justify-content-sm-start">
                @each("partials.auction_card", $user->createdAuctions()->orderBy('end_date', 'desc')->limit(8)->get(), "auction")
            </div>
        </section>
    @endif

    {{-- Modals --}}
    @auth
        @if (Auth::id() != $user->id )
            {{-- Contact modal --}}
            <section class="modal fade" id="send-message-modal" tabindex="-1" aria-labelledby="send-message-modal-title"
                     aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="send-message-modal-title">
                                Contact {{ $user->name }}
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form id="contact-user-form" method="post" action="/messages">
                            @csrf

                            <input hidden name="user_id" value="{{ $user->id }}">

                            <div class="modal-body">
                                <p class="fw-bold my-0">Destination</p>

                                <div class="mb-3 d-flex flex-column" id="destination-div">
                                    <label class="form-check-label my-1">
                                        <input type="radio" id="create-thread-radio" name="destination"
                                               class="form-check-input" value="create-thread" checked>
                                        Create new thread
                                    </label>

                                    <label class="form-check-label my-1">
                                        <input type="radio" id="add-to-thread-radio" name="destination"
                                               class="form-check-input" value="add-to-thread">
                                        Add to existing thread
                                    </label>

                                    <select id="thread-select" class="form-select my-1" name="thread_id" disabled>
                                        @foreach(Auth::user()->messageThreads as $message_thread)
                                            <option value="{{ $message_thread->id }}">
                                                {{ $message_thread->title() }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Confirm</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>

            {{-- Report user modal --}}
            <section class="modal fade" id="report-user-modal" tabindex="-1" aria-labelledby="report-user-modal-title"
                     aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="report-user-modal-title">Report {{ $user->name }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form>
                            <div class="modal-body">
                                <label for="inputCategory" class="fw-bold">Reason</label>
                                <div class="mb-3">
                                    <select class="form-select" id="inputCategory">
                                        <option selected>Choose...</option>
                                        <option value="1">Fraud</option>
                                        <option value="2">Improper profile image</option>
                                        <option value="3">Improper username</option>
                                        <option value="4">Other</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="report-reason" class="form-label fw-bold">Description</label>
                                    <textarea class="form-control" id="report-reason" rows="6"></textarea>
                                    <span class="input-group-text text-wrap">Elaborate the reason to report this user, so we can analyze the case better.</span>

                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-danger">Report</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        @endif
    @endauth

@endsection
