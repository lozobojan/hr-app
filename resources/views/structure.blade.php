@extends('layouts.admin')

@section('title', 'Organizaciona struktura')

@section('css')
<link rel="stylesheet" href="{{ asset('css/Treant.css') }}">
@endsection

@section('js')
<script src="{{ asset('js/structure.js') }}"></script>

<script src="{{ asset('js/raphael.js') }}"></script>
<script src="{{ asset('js/Treant.js') }}"></script>
@endsection

@section('content')
<div class="container">
    <div id="chart-container"></div>
</div>
@endsection
