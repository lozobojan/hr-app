@extends('layouts.admin')

@section('title', 'Organizaciona struktura')

@section('css')
<link rel="stylesheet" href="{{ asset('css/jquery.orgchart.css') }}">
@endsection

@section('js')
<script src="https://unpkg.com/jspdf@latest/dist/jspdf.umd.min.js"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
<script src="{{ asset('js/structure.js') }}"></script>
<script src="{{ asset('js/jquery.orgchart.js') }}"></script>
@endsection

@section('content')
<div class="container">
    <div id="chart-container"></div>
</div>
@endsection
