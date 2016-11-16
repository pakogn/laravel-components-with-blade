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

	<div class="SimpleColumn">
		@section('usersTableHeader')
			<th>Name</th>
			<th>Email</th>
		@stop
		@section('usersTableBody')
			@foreach ($users as $user)
				<tr>
					<td>{{ $user['name'] }}</td>
					<td>{{ $user['email'] }}</td>
				</tr>
			@endforeach
		@stop
		@include('components.dataTable.component', [
			'elements' => 'users',
		])
	</div>
	<div class="SimpleColumn">
		@section('contactsTableHeader')
			<th>Name</th>
			<th>Phone</th>
		@stop
		@section('contactsTableBody')
			@foreach ($contacts as $contact)
				<tr>
					<td>{{ $contact['name'] }}</td>
					<td>{{ $contact['phone'] }}</td>
				</tr>
			@endforeach
		@stop
		@include('components.dataTable.component', [
			'elements' => 'contacts',
		])
	</div>
	<div class="SimpleColumn">
		@section('contactsTableHeader')
			<th>Name</th>
		@stop
		@section('contactsTableBody')
			@foreach ($candidates as $candidate)
				<tr>
					<td>{{ $candidate['name'] }}</td>
				</tr>
			@endforeach
		@stop
		@include('components.dataTable.component', [
			'elements' => 'candidates',
		])
	</div>
@stop