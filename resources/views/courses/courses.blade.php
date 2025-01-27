@extends("layouts.app")

@section('styles')

<link rel="stylesheet" type="text/css" href="/css/courses_qa_courses.css">
<link rel="stylesheet" type="text/css" href="/css/courses_reg.css">

@endsection

@section('content')

@include('courses.courses_banner')

@include('courses.qa_courses')

@include('courses.courses_reg')


@endsection

@section('scripts')

<script src="js/courses/courses_reg.js"></script>
<script src="js/courses/courses_validation.js"></script>
<script>
@if(Session::has('success'))
    $('#myModal').modal('show');
@endif
</script>


@endsection
