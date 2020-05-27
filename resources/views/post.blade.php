<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<title>
		post page
	</title>
</head>
<body>
	<h1 align="center">Create your post</h1></br>
	<div class="container">
		@if ($errors->any())
		    <div class="alert alert-danger">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif
		<form action="" method="POST" enctype="multipart/form-data" class="create-post">
			@csrf
			<div class="form-group">
				<label>Title</label>
				<input type="text" name="title" class="form-control" placeholder="name">
			</div>

			<div class="form-group">
				<label>Your Post</label>
				<input type="text" name="description" class="form-control" placeholder="post">
			</div>

			<label>Image</label>
			<div class="input-group">
				<div class="custom-file">
				<label class="custom-file-label">Choose Image</label>
				<input type="file" name="fimage" class="custom-file-input">
				</div>
			</div>

			<div class="form-group">
			<label class="required">Tag</label>
                                    <span class="styled-select">
                                        <select name="tag_id[]" id="post_tag" multiple>
                                            <option value="">Select..</option>

                                            @forelse($tag_list as $tag)
                                            <option value="{{ $tag->id }}">{{ $tag->post_tag }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </span>
            </div>                        
			
			<button type="submit" name="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>
</body>
</html>

<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script type="text/javascript">
    
    $(document).on('click', '.btn-primary', function(event) {
        event.preventDefault();
        
        $.post('{{ route("store") }}', $('.create-post').serialize(), function(data) {
            if (data.status == 1) {
                toastr.success(data.success_mess);
                location.reload();
            }else{
                $.each(data.error_mess, function(index, val) {
                    toastr.error(val);
                });
            }
        },'json');

    });

    function setType(argument) {
        $('#topic_type').val(argument);
    }
    
</script>