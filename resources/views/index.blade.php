@extends('layouts.master')

@section('content')
	@section('infoAlertContent')
		Common Alert!
	@stop
	@include('components.alert.component', [
		'id' => 'infoAlert',
	])

	@section('dangerAlertContent')
		This is an Error Alert!
	@stop
	@include('components.alert.component', [
		'id' => 'dangerAlert',
		'type' => 'alert-danger'
	])
@stop