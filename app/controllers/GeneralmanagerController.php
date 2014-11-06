<?php

class GeneralmanagerController extends BaseController {

	public function dashboard()
	{
		$data = [];

		$data['total'] = Customer::all()->count();
		$data['prospecto'] = Customer::estado('prospecto')->count();
		$data['asignado'] = Customer::estado('asignado')->count();
		$data['negociacion'] = Customer::estado('negociacion')->count();
		$data['interesado'] = Customer::estado('interesado')->count();
		$data['compro'] = Customer::estado('compro')->count();

		return View::make('backend.dashboard', ['data' => $data]);
	}

	# Avatar Upload
    public function post_avatar()
    {
        $file = Input::file('file');
        $destinationPath = public_path() . '/uploads/avatar/';
        $filename = str_random(16)."_".$file->getClientOriginalName();
        $upload_success = Input::file('file')->move($destinationPath, $filename);

        if ($upload_success) {
            $avatar = '/uploads/avatar/' . $filename;

            Session::put('avatar', $avatar);
            $response = ['avatar' => $avatar, 'success' => 200];

            return Response::json($response);
        } else {
            return Response::json('error', 400);
        }
    }
    # Avatar Crop
    public function post_avatar_crop($id)
    {
        $i = Input::all();
        extract($i);

        $avatar = public_path() . Session::get('avatar');

        $img = Intervention::make($avatar);

        // determine if the image is portrait or landscape
        $scalew = $img->width() / $i; 
        $scaleh = $img->height() / $h;

        $img->resize($i, $img->height()/$scalew);
        $img->crop($h, $w, $x, $y);
        $img->save($avatar);

        $user = User::find($id);
        // delete prevoius avatar
        if($user->profile_picture){
            if(file_exists(public_path() . $user->profile_picture)){                    
                File::delete(public_path() . $user->profile_picture);
            }
        }
        $user->profile_picture = Session::get('avatar');
        $user->save();
        return Response::json(['avatar' => $user->profile_picture]);
    }
    # Get Avatar
    public function get_avatar($id)
    {
        $avatar = (Session::has('avatar')) ? Session::get('avatar') : User::find($id)->getProfilePicture();
        return Response::json(['avatar' => $avatar]);        
    }
    #Avatar Rotate
    public function post_avatar_rotate($id)
    {
        $avatar = public_path() . User::find($id)->profile_picture;
        $img = Intervention::make($avatar);
        //delete previous image and cache
        Croppa::delete(User::find($id)->profile_picture);
        $img->rotate(Input::get('angle'))->save();

        return Response::json(['avatar' => User::find($id)->profile_picture]);
    }

}