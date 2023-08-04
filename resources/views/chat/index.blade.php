@extends('layouts.app')

@section('content')
    <section style="background-color: #eee;">
        <div class="container py-5">

            <div class="row">

                <div class="col-md-6 col-lg-5 col-xl-4 mb-4 mb-md-0">

                    <h5 class="font-weight-bold mb-3 text-center text-lg-start">Member</h5>

                    <div class="card">
                        <div class="card-body">

                            <ul class="list-unstyled mb-0">
                                @foreach($listUser as $userInfo)
                                    <li class="p-2 border-bottom" style="background-color: #eee;">
                                        <a href="#" class="d-flex justify-content-between">
                                            <div class="d-flex flex-row">
                                                <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-8.webp"
                                                     alt="avatar"
                                                     class="rounded-circle d-flex align-self-center me-3 shadow-1-strong"
                                                     width="60">
                                                <div class="pt-1">
                                                    <p class="fw-bold mb-0"> {{ $userInfo->name }}</p>
                                                    <p class="small text-muted">{{ Carbon\Carbon::parse($userInfo->email_verified_at)->format('Y-m-d') }}</p>
                                                </div>
                                            </div>
                                            <div class="pt-1">
                                                <p class="small text-muted mb-1">Just now</p>
                                                <span class="badge bg-danger float-end">1</span>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>

                        </div>
                    </div>

                </div>

                <div class="col-md-6 col-lg-7 col-xl-8">

                    <ul class="list-unstyled">
                        <li class="d-flex justify-content-between mb-4">
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-6.webp" alt="avatar"
                                 class="rounded-circle d-flex align-self-start me-3 shadow-1-strong" width="60">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between p-3">
                                    <p class="fw-bold mb-0">Brad Pitt</p>
                                    <p class="text-muted small mb-0"><i class="far fa-clock"></i> 12 mins ago</p>
                                </div>
                                <div class="card-body">
                                    <p class="mb-0">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                        incididunt ut
                                        labore et dolore magna aliqua.
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex justify-content-between mb-4">
                            <div class="card w-100">
                                <div class="card-header d-flex justify-content-between p-3">
                                    <p class="fw-bold mb-0">Lara Croft</p>
                                    <p class="text-muted small mb-0"><i class="far fa-clock"></i> 13 mins ago</p>
                                </div>
                                <div class="card-body">
                                    <p class="mb-0">
                                        Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
                                        doloremque
                                        laudantium.
                                    </p>
                                </div>
                            </div>
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-5.webp" alt="avatar"
                                 class="rounded-circle d-flex align-self-start ms-3 shadow-1-strong" width="60">
                        </li>
                        <li class="d-flex justify-content-between mb-4">
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-6.webp" alt="avatar"
                                 class="rounded-circle d-flex align-self-start me-3 shadow-1-strong" width="60">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between p-3">
                                    <p class="fw-bold mb-0">Brad Pitt</p>
                                    <p class="text-muted small mb-0"><i class="far fa-clock"></i> 10 mins ago</p>
                                </div>
                                <div class="card-body">
                                    <p class="mb-0">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                        incididunt ut
                                        labore et dolore magna aliqua.
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li class="bg-white mb-3">
                            <div class="form-outline">
                                <textarea class="form-control" id="message" rows="4"></textarea>
                                <label class="form-label" for="message">Message</label>
                            </div>
                        </li>
                        <button type="button" class="btn btn-info btn-rounded float-end" id="send-message">Send</button>
                    </ul>

                </div>

            </div>

        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let filedMessage = document.getElementById('message');
            let sendButton = document.getElementById('send-message');
            sendButton.addEventListener('click', function () {
                let message = filedMessage.value;
                filedMessage.value = '';
                $.ajax({
                    url: '{{ route('chat.send', 1) }}',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        message: message
                    },
                    success: function (response) {
                    }
                })
            })
            Echo.join('chat')
                .here((users) => {
                    users.forEach((user, index) => {
                        console.log('Here user: ', user)
                    });
                })
                .joining((user) => {
                    console.log('user joined', user)
                })
                .leaving((user) => {
                    console.log('user leaving', user)
                })
                .listen('SendMessageToUserEvent', (e) => {
                    console.log('user leaving', e)
                });
        })
    </script>
@endpush
