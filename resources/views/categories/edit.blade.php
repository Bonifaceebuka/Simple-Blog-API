@extends('layouts.app')
@section('title')
Edit Category
@endsection

@section('content')
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						<h2>Editing > "{{$category->name}}" </h2>
					</div>
				<a class="btn btn-success pull-right" href="{{route('categories.index')}}">See More categories</a>
                </div>
            </div>
            <form action="{{route('categories.update',$category->id)}}" method ='post'>
				@csrf
				@method('PATCH')
					<div class="modal-body">					
						<div class="form-group">
							@if ($errors->has('name'))
							<span class="helper-text" data-error="wrong" data-success="right">
								<strong>{{ $errors->first('name') }}</strong>
							</span>
							@endif
							<label>Name</label>
							<input type="text" class="form-control"  name="name" required value="{{$category->name}}">
						</div>
						<div class="form-group">
							@if ($errors->has('description'))
							<span class="helper-text" data-error="wrong" data-success="right">
								<strong>{{ $errors->first('description') }}</strong>
							</span>
							@endif
							<label>Description</label>
							<textarea class="form-control" name="description" required>{{$category->description}}</textarea>
						</div>		
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-info" value="Save changes">
					</div>
			</form>

    </div>
@endsection
@section('extra-js')
	<script type="text/javascript">
		$('#categoryer-trigger').on('click', function(){
			$('#categoryer').click();
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