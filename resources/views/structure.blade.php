@extends('layouts.admin')

@section('title', 'Organizaciona struktura')

@section('css')
<link rel="stylesheet" href="{{ asset('css/structure.css') }}">
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://balkangraph.com/js/latest/OrgChart.js"></script>
<script src="{{ asset('js/structure.js') }}"></script>
@endsection

@section('content')
<div class="container">
    <div id="tree"></div>
</div>
@endsection
