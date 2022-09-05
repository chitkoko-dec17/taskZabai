@extends('layout')
 
@section('content')
 
	<div class="container">
		<h1>Voting Page</h1>

		@if(Session::has('success'))
		    <div class="alert alert-success">
		      {{ Session::get('success') }}
		    </div>
		@endif

		@if(Session::has('error'))
		    <div class="alert alert-danger">
		      {{ Session::get('error') }}
		    </div>
		@endif

        <div class="row">
            @if($data['lastest_question'])
            	<form action="vote" id="do-vote" method="post">
            		@csrf
            		<div class="card text-center">

		                <div class="card-body">
		                    <h5 class="card-title">{!! $data['lastest_question']->name !!}</h5>
		                    <input type="hidden" name="question_id" value="{!! $data['lastest_question']->id !!}">
		                    <input type="hidden" name="vote_status" id="vote-status" value="1">
		                    <a href="javascript:void(0)" class="btn btn-outline-primary btn-sm" id="vote">
		                        Vote
		                    </a>
		                    <a href="javascript:void(0)" class="btn btn-outline-secondary btn-sm" id="no-vote">
		                        No Vote
		                    </a>
		                </div>
		            </div>
            	</form>

            	
            @else
	            <div class="card text-center">
	            	<div class="card-body">
	                    <h5 class="card-title">No Question Yet!</h5>
	                </div>
	            </div>
            @endif
        </div>
    </div>
 
 	
@endsection

@push('scripts')
    <script type="text/javascript">

    	//hide alert message after 6 sec 
        setTimeout(function() {
           $('.alert').fadeOut('fast');
        }, 6000);

        //click vote and reset vote_status
		$('#vote').click( function() {
		    $('#vote-status').val(1);
		    $('#do-vote').submit();
		})

		//click no-vote and reset vote_status
		$('#no-vote').click( function() {
		    $('#vote-status').val(0);
		    $('#do-vote').submit();
		})
	</script>
@endpush