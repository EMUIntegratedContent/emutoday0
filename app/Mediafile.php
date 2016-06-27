<?php

namespace emutoday;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Mediafile extends Model
{
	public function magazines()
	{
		return $this->belongsToMany('emutoday\Magazine');
	}

	public function delete()
	{
		\File::delete([
			$this->path .$this->name.'.'.$this->ext ,
			$this->path . 'thumbnails/' . 'thumb-' . $this->name.'.'.$this->ext
		]);
		parent::delete();
	}
}