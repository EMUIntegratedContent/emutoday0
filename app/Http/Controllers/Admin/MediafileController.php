<?php

namespace emutoday\Http\Controllers\Admin;

use Illuminate\Http\Request;

use emutoday\Http\Requests;
use emutoday\Http\Controllers\Controller;

// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;

class MediafileController extends Controller
{
      protected $mediafile;

			public function __construct(Mediafile $mediafile)
			{
					$this->mediafile = $mediafile;
					parent::__construct();
			}

			public function index()
    {
        $mediafiles = $this->mediafile->paginate(10);
        return view('admin.mediafile.index', compact('mediafiles'));
    }

    public function create(Mediafile $mediafile)
    {
        return view('admin.mediafile.form', compact('mediafile'));
    }

    public function store(Request $request)
    {

        //return redirect(route('backend.users.index'))->with('status', 'User has been created.');
    }


    public function update($id, Request $request)
    {
       //create new instance of model to save from form
       $mediafile = $this->mediafile->findOrFail($id);
       $mediafile->is_active = $request->get('is_active');
       $this->formatCheckboxValue($mediafile);
       $mediafile->caption = $request->get('caption');
       $mediafile->teaser = $request->get('teaser');
       $mediafile->moretext = $request->get('moretext');
       $mediafile->image_type = $request->get('image_type');

/*
       $mediafile = new generalImage([
           'image_name'        => $request->get('image_name'),
           'image_extension'   => $request->file('image')->getClientOriginalExtension(),
           'is_active'         => $request->get('is_active'),
           'is_featured'       => $request->get('is_featured'),
           'caption'           => $request->get('caption'),
           'teaser'            => $request->get('teaser'),
           'moretext'          => $request->get('moretext')

       ]);
*/
       //define the image paths

       $destinationFolder = '/imgs/story/';


       //assign the image paths to new model, so we can save them to DB

       $mediafile->image_path = $destinationFolder;


       // format checkbox values and save model

       $this->formatCheckboxValue($mediafile);


       //parts of the image we will need
       if ( ! empty(Input::file('image'))){

       $imgFile = Input::file('image');
       $imgFilePath = $imgFile->getRealPath();
       $imgFileOriginalExtension = strtolower($imgFile->getClientOriginalExtension());


       switch ($imgFileOriginalExtension) {
           case 'jpg':
           case 'jpeg':
            $imgFileExtension = 'jpg';
            break;
            default:
            $imgFileExtension = $imgFileOriginalExtension;

       }
       $mediafile->image_extension = $imgFileExtension;


       $imgFileName = $mediafile->image_name . '.' . $mediafile->image_extension;


       $image = Image::make($imgFilePath)
        ->save(public_path() . $destinationFolder . $imgFileName)
        ->fit(100)
        ->save(public_path() . $destinationFolder . 'thumbnails/' . 'thumb-' . $imgFileName);

    }
     $mediafile->is_active = 1;
        $mediafile->save();

      $story = $mediafile->story;
     flash()->success('Story Image has been created.');
      return redirect(route('admin.story.edit', $story->id ));//->with('status', 'Story Image has been created.');
      // return redirect()->route('backend/generalImages.show', [$mediafile]);
    }

    public function edit($id)
    {
        $mediafile = $this->generalImages->findOrFail($id);
        return view('admin.generalImages.edit', compact('generalImage'));
    }


    public function show($id)
    {
        $mediafile = $this->generalImages->findOrFail($id);
      // $marketingImage = Marketingimage::findOrFail($id);

       return view('admin.generalImages.show', compact('generalImage'));
    }
    public function confirm($id)
    {
        $mediafile = $this->generalImages->findOrFail($id);

        return view('admin.generalImages.confirm', compact('generalImage'));
    }

    public function destroy($id)
    {
        $mediafile = $this->generalImages->findOrFail($id);

        $pathToImageForDelete = public_path() . $mediafile->image_path . $mediafile->image_name . '.' . $mediafile->image_extension;
        File::delete($pathToImageForDelete);

        $pathToImageThumbForDelete = public_path() . $mediafile->image_path . 'thumbnails/' . 'thumb-' . $mediafile->image_name . '.' . $mediafile->image_extension;
        File::delete($pathToImageThumbForDelete);
        /*

        $destinationFolder = '/imgs/story/';
        $thumbPath = $destinationFolder .'thumbnails/';
        Storage::disk('public')->delete(url($destinationFolder .  $mediafile->image_name . '.' . $mediafile->image_extension));

        Storage::disk('public')->delete(url($thumbPath . 'thumb-' .  $mediafile->image_name . '.' . $mediafile->image_extension));
*/
        //File::delete(public_path($mediafile->image_path) . $mediafile->image_name . '.' . $mediafile->image_extension);
        //Storage::delete(public_path($thumbPath). 'thumb-' . $mediafile->image_name . '.' . $mediafile->image_extension);
        $mediafile->delete();
        flash()->warning('Record has been deleted');

        return redirect(route('admin.generalImages.index'));//->with('status', 'Record has been deleted.');
    }
    public function formatCheckboxValue($mediafile)
    {

       $mediafile->is_active = ($mediafile->is_active == null) ? 0 : 1;

    }


}