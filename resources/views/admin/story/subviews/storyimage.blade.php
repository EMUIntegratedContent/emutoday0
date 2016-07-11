<div class="box">
	{!! Form::model($storyImage,[
		'method' => 'patch',
		'route' => ['admin.storyimages.update', $storyImage->id],
		'files' => true
	]) !!}
        <div class="box-header with-border">
          <h3 class="box-title">{{$storyImage->imgtype->name}}</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
        </div><!-- /.box-header -->
        <div class="box-body">

					@if($storyImage->is_active != 0)
						<div class="form-group">
							<img src="/imagecache/betterthumb/{{$storyImage->filename}}" alt="{{$storyImage->image_name}}">
						</div>
						@endif
							<div class="form-group">
								{{-- {!! Form::label('image_type', 'Image Type:') !!} --}}
								{!! Form::hidden('image_type', $storyImage->image_type, ['class' => 'form-control input-sm', 'readonly' => 'readonly']) !!}
								{{-- {!! Form::label('image_name', 'Name:') !!} --}}
								{!! Form::hidden('image_name', null, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
							</div>
							<div class="form-group">
								<label class="control-label" for="image">Select File</label>
								{!! Form::file('image', null, array('required', 'class'=>'form-control input-sm')) !!}
								<span class="help-block">{{$storyImage->imgtype->helptxt}}</span>
							</div>
								@if($storyImage->imgtype->type == 'small')
							<div class="form-group">
								{!! Form::label('moretext', 'More Text Link') !!}
								{!! Form::text('moretext', null, ['class' => 'form-control input-sm']) !!}
								<span class="help-block">Text used to link to full story</span>
							</div>
						@endif
							<div class="form-group">
								{!! Form::label('caption', 'Caption') !!}
								{!! Form::text('caption', null, ['class' => 'form-control input-sm']) !!}
								<span class="help-block"></span>
							</div>
							@if($storyImage->imgtype->type == 'front')
							<div class="form-group">
								{!! Form::label('teaser', 'Teaser') !!}
								{!! Form::textarea('teaser', null, ['class' => 'form-control input-sm teaser', 'rows'=>'3']) !!}
								<span class="help-block">{{$storyImage->imgtype->infotxt}}</span>
							</div>
						@endif
						</div><!-- /.box-body -->
        		<div class="box-footer">
							<div class="form-inline">
								<div class="form-group">
								{!! Form::submit('Update Image', array('class'=>'btn btn-primary')) !!}
								{!! Form::close() !!}
							</div>
						@if($storyImage->imgtype->is_required == 0)
						{{-- @if($storyImage->image_type == 'imagehero') --}}
							 <div class="form-group">
				       {!! Form::model($storyImage, ['route' => ['admin.storyimages.destroy', $storyImage->id],
				       'method' => 'DELETE',
				       'class' => 'form',
				       'files' => true]
				       ) !!}
							 {!! Form::submit('Delete Image', array('class'=>'btn btn-warning', 'Onclick' => 'return ConfirmDelete();')) !!}
				       {!! Form::close() !!}
							  </div>
				    @endif
						</div>
        </div><!-- /.box-footer-->

</div> <!-- /.box -->

@section('footer')
    @parent
    <script>

        function ConfirmDelete()
        {
            var x = confirm("Are you sure you want to delete?");
            if (x)
                return true;
            else
                return false;
        }

    </script>

@endsection
