@extends('layouts.app')

@section('content')
    <section class="vh-100" style="background-color: #9de2ff;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-md-9 col-lg-7 col-xl-5">
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body p-4">
                            <div class="d-flex text-black">
                                <div class="flex-shrink-0">
                                    <img src="{{ Auth::user()->avatar ?? 'images/defaultavt.png' }}"
                                        alt="Generic placeholder image" class="img-fluid"
                                        style="width: 180px; border-radius: 10px;">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="mb-1">{{ Auth::user()->name }}</h5>
                                    <p class="mb-2 pb-1" style="color: #2b2a2a;">{{ Auth::user()->email }}</p>
                                    <div class="d-flex justify-content-start rounded-3 p-2 mb-2"
                                        style="background-color: #efefef;">
                                        <div>
                                            <p class="small text-muted mb-1">Age</p>
                                            <p class="mb-0">41</p>
                                        </div>
                                        <div class="px-3">
                                            <p class="small text-muted mb-1">Height</p>
                                            <p class="mb-0">180</p>
                                        </div>
                                        <div>
                                            <p class="small text-muted mb-1">Weight</p>
                                            <p class="mb-0">85</p>
                                        </div>
                                    </div>
                                    <div class="d-flex pt-1">
                                        <button type="button" class="btn btn-outline-primary me-1 flex-grow-1">Change
                                            Avatar</button>
                                        <button type="button"type="button" data-bs-toggle="modal"
                                            data-bs-target="#jokemodal" class="btn btn-primary me-1 flex-grow-1">Share
                                            Your
                                            Joke</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="jokemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Share your joke</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('saveJoke') }}" method="post" id="jokeForm">
                        @csrf
                        <textarea name="content" id="" class="form-control" cols="30" rows="10"
                            placeholder="This morning, I just..."></textarea>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="saveJoke" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">

                <strong class="me-auto">Zens</strong>
                <small>Just Now</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Hello, world! This is a toast message.
            </div>
        </div>
    </div>
@endsection
@section('custom-script')
    <script>
        $(document).ready(function() {
            $("#saveJoke").on('click', function() {

                var formData = new FormData($('#jokeForm')[0])
                $("#jokemodal .close").trigger('click')
                $.ajax({
                    method: 'POST',
                    url: $('#jokeForm').attr('action'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        $('.toast-body').text(res.text)
                        $("#liveToast").show()
                    },
                    error: function(xhr, status, error) {
                        $('.toast-body').text("Error!")
                        $("#liveToast").show()
                    }
                })

            })
        })
    </script>
@endsection
