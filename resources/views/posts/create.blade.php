@extends('layouts.app')
@section('title')
New Post
@endsection
@section('extra-styles')
	<style>
	    #poster{
			opacity: 0;
		}
	</style>
@endsection
@section('content')
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						<h2>New Post </h2>
					</div>
				<a class="btn btn-success pull-right" href="/">See More posts</a>
                </div>
            </div>
            <form action="{{route('posts.store')}}" enctype="multipart/form-data" method ='POST'>
				@csrf
					<div class="modal-body">					
						<div class="form-group">
							@if ($errors->has('title'))
							<span class="helper-text" data-error="wrong" data-success="right">
								<strong>{{ $errors->first('title') }}</strong>
							</span>
							@endif
							<label>Name</label>
							<input type="text" class="form-control"  name="title" required>
						</div>
						<div class="form-group">
							@if ($errors->has('category'))
							<span class="helper-text" data-error="wrong" data-success="right">
								<strong>{{ $errors->first('category') }}</strong>
							</span>
							@endif
							<label>Category</label>
							<select name="category" id="category" class="form-control">
								@foreach($categories as $category)
							<option value="{{$category->id}}">{{$category->name}}</option>
								@endforeach
							</select>							
						</div>
						<div class="form-group">
							@if ($errors->has('description'))
							<span class="helper-text" data-error="wrong" data-success="right">
								<strong>{{ $errors->first('description') }}</strong>
							</span>
							@endif
							<label>Description</label>
							<textarea class="form-control" name="description" required></textarea>
						</div>
						@if ($errors->has('poster'))
							<span class="helper-text" data-error="wrong" data-success="right">
								<strong>{{ $errors->first('poster') }}</strong>
							</span>
							@endif
						<input type="button" id="poster-trigger" class="btn btn-info" value="Add an image">						
						<input type="file" class="btn btn-info" id="poster" name="poster">						
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-info" value="Save">
					</div>
			</form>

    </div>
@endsection
@section('extra-js')
	<script type="text/javascript">
		$('#poster-trigger').on('click', function(){
			$('#poster').click();
		});
	@if(Session::has('success-message'))        
       swal({
            title: "New Entry",
            text: '{{ Session::get('success-message') }}',
            icon: 'success',
            closeOnClickOutside: false,
            value:'o',
		});
	@elseif(Session::has('error-message'))        
       swal({
            title: "New Entry",
            text: '{{ Session::get('error-message') }}',
            icon: 'error',
            closeOnClickOutside: false,
            value:'o',
        });
    @endif
	</script>
@endsection