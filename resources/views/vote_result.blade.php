@extends('layout')
 
@section('content')

	<div class="container">
		<h1>Voting Result</h1>
		<div class="row">

			@if($data['lastest_question'])
			<div class="card text-center">
			  	<div class="card-body">
			    	<h5 class="card-title">{!! $data['lastest_question']->name !!}</h5>
			    	<span class="text-info">Total : <span id="total-count">{!! $data['total_count'] !!}</span> <i class="fa fa-user"></i></span><br/>
			    	<span class="text-success">Vote : <span id="vote-count">{!! $data['vote_count'] !!}</span> <i class="fa fa-user"></i></span><br/>
			    	<span class="text-danger">No Vote : <span id="novote-count">{!! $data['novote_count'] !!}</span> <i class="fa fa-user"></i></span>
			  	</div>
			</div>
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
    	var base_url = {!! json_encode(url('/')) !!};
    	function getTotalCounts() {
            $.ajax({
  
                // Our sample url to make request 
                url: base_url + '/vote-count/'+ {!! $data['lastest_question']->id !!},
  
                // Type of Request
                type: "GET",
  
                // Function to call when to
                // request is ok 
                success: function (data) {
                    var result = JSON.parse(data);

                    $('#total-count').html(result['total_count']);
                    $('#vote-count').html(result['vote_count']);
                    $('#novote-count').html(result['novote_count']);
                },
  
                // Error handling 
                error: function (error) {
                    console.log(`Error ${error}`);
                }
            });
        }
        @if($data['lastest_question'])
        	setInterval(getTotalCounts,5000); //that will be run every 5 seconds.
        @endif
    </script>
@endpush