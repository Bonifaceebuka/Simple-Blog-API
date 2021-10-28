@extends('layouts.app')
@section('title')
List of categories
@endsection
@section('content')
	<div class="table-wrapper">
		<div class="table-title">
			<div class="row">
				<div class="col-sm-6">
					<h2>List of categories</h2>
				</div>
				<div class="col-sm-6">
					<a href="{{route('categories.create')}}" class="btn btn-success"><i class="fa fa-plus"></i> 
						<span>New Category</span></a>
				</div>
			</div>
		</div>
		@if(count($categories)>0)
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>Name</th>
							<th>Since?</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody id="data_container">
							@foreach($categories as $category)
							<tr>
								<td>{{$category->name}}</td>
								<td>{{$category->created_at}}</td>
								<td>
								<a href="{{route('categories.edit', $category->id)}}" 
									class="text-info"><i class="fa fa-pencil" title="Edit Category"></i></a>
								<a href="#" id="deleteCategory" class="delete" onclick="remove_category({{$category->id}})">
									<i class="fa fa-trash-o" title="Delete"></i>
								</a>
								<form action="{{route('categories.destroy', $category->id)}}" 
									method="Post" id="category_delete" style="display:none;">
									@csrf @method('DELETE')</form>
			                    </td>
							</tr>
						@endforeach
					</tbody>
				</table>
				{{$categories->links()}}
				<p>&nbsp;</p>
		@else
					<div class="alert alert-warning">No Categcategories Found!</div>
		@endif
</div>
@endsection
@section('extra-js')
<script type="text/javascript">
function remove_category(id){
	swal({
            title: "Remove Category",
            text: "Are you sure that you want to remove this category",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
               $('#category_delete').submit();
            } 
            });
}

@if(Session::has('success-message'))        
       swal({
            title: "Removed record",
            text: '{{ Session::get('success-message') }}',
            icon: 'success',
            closeOnClickOutside: false,
            value:'o',
		});
	@elseif(Session::has('error-message'))        
       swal({
            title: "Removed record",
            text: '{{ Session::get('error-message') }}',
            icon: 'error',
            closeOnClickOutside: false,
            value:'o',
        });
    @endif
</script>
@endsection