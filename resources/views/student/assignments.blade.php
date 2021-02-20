@extends('app')

@section('content')
<div class="container">
    <student-assignments student-id='{{ $studentId }}'></student-assignments>
</div>
@endsection