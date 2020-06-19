<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Rule;
use App\Usersdata as Data;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\AllUsersController;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $userName)
    {
        $avatar = $request->file('profile_image');

        return Storage::put('public/avatars/'.$userName.'_'.$avatar->getClientOriginalName(),
            file_get_contents($avatar->getRealPath()));

    }

    public function get_avatar($avatar_name = '')
    {
        $avatar = '/storage/avatars/default_avatar.png';
        if ( ! empty($avatar_name)) {
            $exists = Storage::disk('local')->exists('/public/avatars/'.$avatar_name);
            $avatar = $exists ? Storage::url('avatars/'.$avatar_name) : $avatar;
        }

        return $avatar;
    }

    public function delete_avatar($avatar_name = '')
    {
        if ( ! empty($avatar_name)) {
            Storage::disk('local')->delete('/public/avatars/'.$avatar_name);
        }

        return;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id, $message = '')
    {
        $user      = (new User)->select()->where('id', $id)->first();
        $pageName  = 'Просмотр профиля '.$user['name'];
        $user_info = [
            'id'          => $user['id'],
            'name'        => $user['name'],
            'second_name' => $user['second_name'],
            'email'       => $user['email'],
        ];
        $data      = (new Data)->select()->where('id', $id)->first();
        $data      = empty($data) ? '' : $data;
        if ( ! empty($data->contacts)) {
            $contacts      = unserialize($data->contacts);
            $tel           = array_key_exists('tel', $contacts) ? $contacts['tel'] : '';
            $address_array = ['city', 'street', 'build', 'apartment'];
            foreach ($address_array as $value) {
                if (array_key_exists($value, $contacts)) {
                    $address[] = $contacts[$value];
                }
            }
            $address = implode(', ', $address);
        }

        $role   = (new Rule)->select()->where('id', $data->role_taxonomy)->first();
        $avatar = $this->get_avatar($data->profile_image);

        return view('admin_panel/userProfile')->with([
            'pageName'      => $pageName,
            'user_info'     => $user_info,
            'profile_image' => asset($avatar),
            'tel'           => $tel,
            'address'       => $address,
            'series_access' => $data->series_access,
            'role'          => $role->type,
            'status'        => $message,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user      = (new User)->select()->where('id', $id)->first();
        $pageName  = "Редактирование Профиля ".$user['name'];
        $user_info = [
            'id'          => $user['id'],
            'name'        => $user['name'],
            'second_name' => $user['second_name'],
            'email'       => $user['email'],
        ];
        $roles     = (new Rule)->select()->get();
        $data      = (new Data)->select()->where('id', $id)->first();
        $data      = empty($data) ? '' : $data;
        if ( ! empty($data->contacts)) {
            $contacts      = unserialize($data->contacts);
            $tel           = array_key_exists('tel', $contacts) ? $contacts['tel'] : '';
            $address_array = ['city', 'street', 'build', 'apartment'];
            foreach ($address_array as $value) {
                if (array_key_exists($value, $contacts)) {
                    $address[$value] = $contacts[$value];
                }
            }

            $avatar          = $this->get_avatar($data->profile_image);
            $user_data_array = [
                'pageName'      => $pageName,
                'user_info'     => $user_info,
                'user_taxonomy' => $data->role_taxonomy,
                'profile_image' => asset($avatar),
                'tel'           => $tel,
                'address'       => $address,
                'series_access' => $data->series_access,
                'roles'         => $roles,
            ];
        } else {
            $avatar          = $this->get_avatar();
            $user_data_array = [
                'pageName'      => $pageName,
                'user_info'     => $user_info,
                'user_taxonomy' => '4',
                'profile_image' => asset($avatar),
                'roles'         => $roles,
            ];
        }

        return view('admin_panel/userProfileEdit')->with($user_data_array);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'        => 'required|max:255',
            'second_name' => 'required|max:255',
            'email'       => 'required|max:255',
        ]);
        $dataUpdate             = $request->all();
        $userDataUpdate         = array_slice($dataUpdate, 0, 4);
        $userContactsDataUpdate = [
            'contacts'      => serialize(array_slice($dataUpdate, 4, 5)),
            'user_id'       => $id,
            'role_taxonomy' => $dataUpdate['rule'],
            'profile_image' => '',
            'series_access' => 'Not Access Yet',
        ];
        if (array_key_exists('profile_image', $dataUpdate)) {
            $this->store($request, $dataUpdate['name']);
            $userContactsDataUpdate['profile_image'] = $dataUpdate['name'].'_'.$request->file('profile_image')->getClientOriginalName();
        } elseif (array_key_exists('delete_avatar', $dataUpdate) && $dataUpdate['delete_avatar'] !== null) {
            $userContactsDataUpdate['profile_image'] = '';
            $data                                    = (new Data)->select()->where('id', $id)->first();
            $this->delete_avatar($data->profile_image);
            $userDataUpdate                     = array_slice($dataUpdate, 1, 4);
            $userContactsDataUpdate['contacts'] = serialize(array_slice($dataUpdate, 5, 5));
        }

        unset($dataUpdate['_token']);
        (new User)->where('id', $id)->update($userDataUpdate);
        $new_user_data = (new Data)->where('user_id', $id);
        if ($new_user_data->first() !== null) {
            $new_user_data->update($userContactsDataUpdate);
        } else {
            $new_user_data->insert($userContactsDataUpdate);
        }

        return $this->show($id, 'Профиль изменён!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = (new Data)->select()->where('id', $id)->first();
        if ($data) {
            if ($data->profile_image) {
                $this->delete_avatar($data->profile_image);
            }
            (new Data)->where('user_id', $id)->delete();
        }
        (new User)->where('id', $id)->delete();
        $all_users = new AllUsersController();

        return $all_users->allUsers();
    }
}
SELECT * FROM outcomes
WHERE result = 'sunk'


