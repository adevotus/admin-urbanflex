<?php

namespace App\Http\Controllers;

use App\Dto\JsonResponse;
use App\Service\UserService;
use App\Util\LoggerUtil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProfileController extends Controller
{

    protected $authHost;
    public function __construct(UserService $userService, ){
        $this->userService = $userService;
        $this->authHost = config('app.auth_host');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function index(){

        $userData = session('user');
        return view('pages.profile',[
            'user' => $userData
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return array
     */
    public function updatePassword(Request $request){

        $validated = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
            'userNumber' => 'required',
        ]);

        try {

            $response = Http::post($this->authHost.'/api/v1/update-password', [
                'userNumber' => $validated['userNumber'],
                'current_password' => $validated['current_password'],
                'new_password' => $validated['new_password'],
            ]);

            LoggerUtil::info("Password  response: ".json_encode($response->json()));

            if ($response->successful() && isset($response['status']) && $response['status'] == 200) {
                return JsonResponse::get('200',$response['Message'],'');
            }
            return JsonResponse::get('400',$response['Message'] ?? 'Failed to update password','');

        } catch (\Exception $e) {
            LoggerUtil::error("Password update failed: " . $e->getMessage());
            return JsonResponse::get('500',"Server error: " . $e->getMessage(),'');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
