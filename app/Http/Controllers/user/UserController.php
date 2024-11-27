<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $data = array(
            "nama" => "user",
            "user_data" => $this->getUser(),
        );
        return view("user/user", $data);
    }
    private function getUser()
    {
        try {
            $user = Auth::user();
            return User::where("id", "!=", $user->id)->get();
        } catch (\Throwable $th) {
            return [];
        }
    }
    private function getSuccessMsg()
    {
        return redirect()->back()->with(['success' => 'Data Berhasil Ditambah!']);
    }
    private function getFailedMsg($msg)
    {
        return redirect()->back()->with(['success' => 'Data Gagal Ditambah! = '.$msg]);
    }
    private function getId($id)
    {
        return User::where("id", "=", $id);
    }
    
    public function tambahUser(Request $request)
    {
        try {
            $data = $request->only(["name", "email", "password"]);
            $data["password"] = Hash::make($data["password"]);
            User::insert($data);
            return $this->getSuccessMsg();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function updateUser(Request $request, $id)
    {
        try {
            $data = $request->only(["name", "email", "password"]);
            User::where("id", "=", $id)->update($data);
            return $this->getSuccessMsg();
        } catch (\Throwable $th) {
            return $this->getFailedMsg($th->getMessage());
        }
    }
    public function deleteUser($id)
    {
        try {
            $this->getId($id)->delete();
            return $this->getSuccessMsg();
        } catch (\Throwable $th) {
            return $this->getFailedMsg($th->getMessage());
        }
    }
}
