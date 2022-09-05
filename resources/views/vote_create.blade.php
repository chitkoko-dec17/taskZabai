@extends('layout')
 
@section('content')
 
	<div class="container">
		<h1>Create Question</h1>

		@if(Session::has('success'))
		    <div class="alert alert-success">
		      {{ Session::get('success') }}
		    </div>
		@endif

		<form action="create-question" method="post">
		@csrf
			<div class="mb-3 mt-3 {{ $errors->has('name') ? 'has-error' : '' }}">
				{!! Form::label('Question:') !!}
				{!! Form::text('name', old('name'), ['class'=>'form-control', 'placeholder'=>'Enter Question']) !!}
				<span class="text-danger">{{ $errors->first('name') }}</span>
			</div>

			<div class="mb-3">
				{!! Form::label('Created By:') !!}
				{!! Form::select('created_by', $data['created_by'], null, ['class' => 'form-control']) !!}
			</div>

			<button class="btn btn-success">Save</button>
		</form>

	</div>
 
@endsection