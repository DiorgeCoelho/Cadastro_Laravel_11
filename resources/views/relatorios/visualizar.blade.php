@extends('welcome')
@section('content')
<style>
    /* body {
        margin: 0;
        padding: 0;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    } */
    iframe {
        width: 100%;
        height: 700px;
        border: none;
    }
</style>

<
</head>

<div class="content-wrapper">
<section class="content">
<div style="height: 700px; width: 100%;">
        <iframe src="{{ route('gerar.pdf') }}" type="application/pdf" allowfullscreen webkitallowfullscreen></iframe>
</div>
</section>
</div>
@endsection
