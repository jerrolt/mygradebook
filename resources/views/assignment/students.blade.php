@extends('app')

@section('content')
<div class="container">
    <assignment-students assignment-id='{{ $assignmentId }}'></assignment-students>
</div>
@endsection