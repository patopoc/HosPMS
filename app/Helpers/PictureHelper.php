<?php
namespace Hotpms\Helpers;
use Image;
use Illuminate\Database\Eloquent\Model;
use Hotpms\Picture;

class PictureHelper{
	public static function savePictures($pictures, $moduleModel, $type="picture"){
		$pics= array();
		$destinationFolder= '/imgs/prop/';
		foreach ($pictures as $picture){
		
			//Do the Image validation here because the FormRequest is not responding to the rule
			//given the field with array notation e.g. "pictures[]"
		
			$rules= ['file' => 'required | mimes:jpeg,jpg,bmp,png'];
			$validator= \Validator::make(['file' => $picture], $rules);
		
			if($validator->fails()){
				$moduleModel->delete();
				return redirect()->back()
				->withErrors($validator->messages())
				->withInput($request->all());
			}
		
			$imageName= "pic-" . $moduleModel->id . "-" . $picture->getClientOriginalName();
			$image = Image::make($picture->getRealPath());
			if($type == 'logo'){
				$image->resize(50, null, function($constraint){
					$constraint->aspectRatio();
				});
			}
		
			$savePath= $destinationFolder . $imageName;
			//$pictures->move($destinationFolder, $imageName . '.' . $extension );
			//dd($image);
			$image->save(public_path().$savePath);
					
			$pics[] = new Picture([
					'url' => $savePath,
					'id_module' => $moduleModel->id,
					'type' => $type
			]);
		
		}
		
		$moduleModel->pictures()->saveMany($pics);
	}
}