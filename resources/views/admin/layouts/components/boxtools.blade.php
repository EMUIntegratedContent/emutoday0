<div class="box-tools">
	<div class="btn-toolbar btn-group-sm">
		{{-- <div class="input-group input-group-sm" style="width: 150px;">
			<input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
			<div class="input-group-btn">
				<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
			</div>
		</div> --}}
		<a href="/admin/{{$rte}}" class="btn bg-orange {{ set_active($path,'disabled') }}"><i class="fa fa-list"></i></a>
		@if($rte == 'story')
			@can('super', $cuser)
				<div class="btn-group btn-group-sm" role="group">
	 				<a class="btn bg-orange dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fa fa-plus-square"></i><span class="caret"></span></a>
					 <ul class="dropdown-menu dropdown-menu-justified">
						 <li><a href="{{ route('admin_story_setup', ['stype' => 'storybasic']) }}" class="btn bg-orange btn-sm btn-block">Create News Story</a></li>
						 <li><a href="{{ route('admin_story_setup', ['stype' => 'story']) }}" class="btn bg-orange  btn-sm btn-block">Create Promoted Story</a></li>
						 <li><a href="{{ route('admin_story_setup', ['stype' => 'storyexternal']) }}" class="btn bg-orange  btn-sm btn-block">Create External Story</a></li>
					 </ul>
 			 	</div>
 		@else
			<a href="{{ route('admin_story_setup', ['stype' => 'storybasic']) }}" class="btn bg-orange btn-sm {{ set_active($path.'/create', 'disabled') }}"><i class="fa fa-plus-square"></i></a>
		@endcan
		@else
			<a href="/admin/{{$rte}}/create" class="btn bg-orange {{ set_active($path.'/create', 'disabled') }}"><i class="fa fa-plus-square"></i></a>
		@endif
	</div><!-- /.btn-toolbar -->

</div><!-- /.box-tools -->
