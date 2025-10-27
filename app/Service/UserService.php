<?php

namespace App\Service;

use App\Dto\JsonResponse;
use App\Models\User;
use App\Util\LoggerUtil;
use Illuminate\Http\Request;


class UserService {

    public function createUser($userData)
    {
        try {
            // Check if user exists by userNumber
            $existingUser = User::where('userNumber', $userData['userNumber'])->first();

            if ($existingUser) {
                LoggerUtil::info("User already exists with userNumber: " . $userData['userNumber']);
                $existingUser->update(['last_login' => now()]);
                return $existingUser;
            }

            // Map the received user data to your database fields
            $newUser = User::create([
                'name'        => $userData['name'] ?? null,
                'first_name'  => $userData['first_name'] ?? null,
                'last_name'   => $userData['last_name'] ?? null,
                'email'       => $userData['email'] ?? null,
                'phone'       => $userData['phone'] ?? null,
                'address'     => $userData['address'] ?? null,
                'userNumber'  => $userData['userNumber'] ?? null,
                'status'      => $userData['status'] ?? 'ACTIVE',
                'last_login' => now(),
            ]);

            LoggerUtil::info("New user created successfully: " . json_encode($newUser));

            return $newUser;

        } catch (\Exception $exception) {
            LoggerUtil::info("User creation failed: " . $exception->getMessage());
            return null; // or handle as needed
        }
    }


    /**
     *
     * for the student update details
     *
     */

    public function updateStudent(Request $request, $userNumber){

        if($userNumber){
            $userDetails = $this->getUserDetailsByUserNumber($userNumber);

            if($userDetails){
                $data = array_filter($request->only(['firstName','lastName','email','address','organisation','country','contact' ]), fn($value) => !is_null($value));
                if (empty($data)) {
                    $userDetails->touch();
                } else {
                    $data['updated_at'] = now();
                    $userDetails->fill($data);
                    $userDetails->save();
                }
                LoggerUtil::info("The User has been updated, $userDetails");

                // create the notification  for edit student details that will display to the header

                return JsonResponse::get('200', "The User has been updated", $userDetails);
            }else{
                LoggerUtil::info("The User not found, $userDetails");
                return JsonResponse::get('404', "The User not found", $userDetails);
            }
        }
        return JsonResponse::get('400', "Unable to create student", $userNumber);

    }


    /**
     * Trigger notification for a newly created student.
     *
     * @param  $student
     * @return array
     */

    public function getUserDetailsByUserNumber($userNumber)
    {
        $details = User::where('userNumber', $userNumber)->first();

        if (! $details) {
            LoggerUtil::info("User details not found, Number: $userNumber");
            return JsonResponse::get('404', "User not found with Number: $userNumber", "");
        }

        LoggerUtil::info("User details found, Number: $userNumber");
        return JsonResponse::get('200', "User details have been found", $details);
    }


}
