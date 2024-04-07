<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Zens Test</title>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <meta content="{{ csrf_token() }}" name="csrf-token" />
    @vite(['resources/css/reset.css', 'resources/css/style.css'])
</head>
@php
    $isLoged = Auth::check();
    $avatar = $joke->user?->avatar ?? 'images/defaultavt.png';
@endphp

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-red shadow-bottom">
            <div class="container">
                <div class="wrapper w-100 d-flex justify-content-between">

                    <a class="wrap-logo" href="#">
                        <img alt="Logo" height="80" src="{{ url('images/logo.png') }}">
                    </a>

                    <div class="d-flex align-items-center">
                        <div class="wrap-info">
                            <span class="d-block gray-italic">Handicrafted by</span>
                            <span class="d-block float-end" id="author">{{ $joke->user?->name ?? 'John Doe' }}</span>
                        </div><a class="d-block" href="{{ route('user.profile') }} ">
                            <img src="{{ url($avatar) }}" alt="Avatar" class="avatar">
                        </a>

                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <section class="hero">
            <div class="wrap-hero container-fluid">
                <h1 class="title">A joke a day keeps the doctor away </h1>
                <p class="description">If you joke wrong way, your teeth have to pay. (Serious) </p>
            </div>
        </section>
        <section class="main-content">
            <div class="wrap-content container">
                <p class="content">
                    {{ $joke->content }}
                    {{-- A child asked his father, "How were people born?", So his father said, "Adam and Eve
                    make babies, then their babies become adults and make babies, and so on." The child then went to hí
                    mother, asked her the same question and she told him, "We were monkeys the we evolved to become like
                    we are now". The child ran back to his father and said, "You lied to me!" His father replied, "No,
                    your mom was talking about her side of the family" --}}
                </p>
            </div>
            <div class="line"></div>
            <div class="wrap-button">
                <button class="btn btn-primary rounded-0 vote up"
                    data-href="{{ route('voteJoke', ['joke' => $joke->id, 'state' => 'up']) }}">This is
                    Funny!</button>
                <button class="btn rounded-0 vote down"
                    data-href="{{ route('voteJoke', ['joke' => $joke->id, 'state' => 'down']) }}"
                    style="color:white;background-color: #29B363">This
                    is
                    not
                    funny</button>
            </div>
        </section>
    </main>
    <footer>
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
        <div class="wrap-footer">
            <div class="container">
                <div class="footer">
                    <p class="footer-content">
                        This website is created as part of Hlsolution program. The materials contained on this website
                        are
                        provided
                        for general information only and do not constitute any form of advice. HLS assumes no
                        responsibility
                        for
                        the
                        accuracy of any particular statement and accepts no liability for any loss or damage which may
                        arise
                        from
                        reliance on the infomation contained on this site.
                    </p>
                    <p class="copyright"> Copyright 2021 HLS</p>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".vote").on('click', function() {

                $.ajax({
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: $(this).data('href'),
                    processData: false,

                    success: function(res) {
                        $('.toast-body').text(res.text)
                        $("#liveToast").show()
                        $('#author').text(res.author);
                        $('.content').text(res.content);
                        if (res.up && res.down) {
                            $('.up').data('href', res.up)
                            $('.down').data('href', res.down)
                        } else {
                            $('.vote').attr('disabled', 'true')
                        }


                    },
                    error: function(xhr, status, error) {
                        $('.toast-body').text("Error!")
                        $("#liveToast").show()
                    }
                })
            })
        })
    </script>
</body>

</html>
