@extends('layouts.app')
@section('title')
List of posts
@endsection
@section('content')
	<div class="table-wrapper">
		<div class="table-title">
			<div class="row">
				<div class="col-sm-6">
					<h2>List of posts</h2>
				</div>
				<div class="col-sm-6">
					<a href="{{route('posts.create')}}" class="btn btn-success"><i class="fa fa-plus"></i> 
						<span>New Post</span></a>
				</div>
			</div>
		</div>
		@if(count($posts)>0)
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>Title</th>
							<th>Poster</th>
							<th>Category</th>
							<th>Author</th>
							<th>Since?</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody id="data_container">
							@foreach($posts as $post)
							<tr>
								<td>{{$post->title}}</td>
							<td>
								<img src="
								@if(Storage::disk('public')->exists('posters/'.$post->poster))
									{{Storage::url('posters/'.$post->poster)}} 
								@else{{asset('assets/images/poster.png')}} 
								@endif" class="img-responsive"></td>
								<td>{{$post->category->name}}</td>
								<td>{{$post->user->name}}</td>
								<td>{{$post->created_at}}</td>
								<td>
								<a href="{{route('posts.edit', $post->id)}}" 
									class="text-info"><i class="fa fa-pencil" title="Edit Post"></i></a>
								<a href="#" id="deletePost" class="delete" onclick="remove_post({{$post->id}})">
									<i class="fa fa-trash-o" title="Delete"></i>
								</a>
								<form action="{{route('posts.destroy', $post->id)}}" 
									method="POST" id="post_delete" style="display:none;">
									@csrf @method('DELETE')</form>
			                    </td>
							</tr>
						@endforeach
					</tbody>
				</table>
				{{$posts->links()}}
				<p>&nbsp;</p>
		@else
					<div class="alert alert-warning">No Posts Found!</div>
		@endif
</div>
@endsection
@section('extra-js')
<script type="text/javascript">
function remove_post(id){
	swal({
            title: "Remove Post",
            text: "Are you sure that you want to remove this post",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
               $('#post_delete').submit();
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