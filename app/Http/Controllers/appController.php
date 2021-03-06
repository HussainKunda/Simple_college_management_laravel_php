<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

//extension_loaded('php_fileinfo.dll');

class appController extends Controller
{
    protected  $webPageName=[];
    //set default name of web page
    function __construct()
    {
        $this->webPageName['title']="College MS";
    }

    function details(){
        $studentData= (new \App\Student)->orderBy('id', 'desc')->paginate(3);
        $this->webPageName['title']='details';
        //$studentData = Student::all();
        return view('details', compact('studentData'), $this->webPageName);
    }

    function home(){
        $this->webPageName['title']='Home';
        return view('home', $this->webPageName);
    }

    function aboutUs(){
        $this->webPageName['title']='About Us';
        return view('aboutUs', $this->webPageName);
    }

    function enroll(){
        $this->webPageName['title']='enroll';
        //$studentData=Student::all();
       // $studentData=Student::orderBy('id', 'desc')->get();
        $studentData=Student::orderBy('id', 'desc')->paginate(3);
        return view('enroll', compact('studentData'), $this->webPageName);
    }

    function addUser(Request $request){
        $this->validate(
            $request, [
                'name'=>'required|min:3',
                'email'=>'email',
                'password'=>'required|confirmed|min:8',
                'image'=>'required|mimes:jpeg,jpg,png,gig'
               ]
        );
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['password']=$request->password;
        $data['password_confirmation']=$request->password_confirmation;
        //dd($data);//display data
        if($request->hasFile('image')){
            $image= $request->file('image');
            $ext=$image->getClientOriginalExtension();
            $imageName=Str::random(18).'.'.$ext;
            $uploadPath = public_path('lib/images/');
            $image->move($uploadPath, $imageName);
            $data['image']=$imageName;
        }
        if((new \App\Student)->create($data)){
            return redirect()->route('renroll')->with('success', 'New User Registration Successful');
        }
    }

    function deleteUser(Request $request){
        //echo 'method to delete user'.$request->user_id;
        //get and set user if from routes
        $userId = $request->user_id;
        try {
            if ($this->_deleteImage($userId) && (new \App\Student)->findOrFail($userId)->delete()) {
                //echo "user deleted";
                return redirect()->route('enroll')->with('success', 'User Deleted Successfully !!!');
            }
        } catch (\Exception $e) {
            echo $e;
        }
    }

    //method to delete image
    function _deleteImage($id){
        //fetch data of user according to user id first
        $userData = (new \App\Student)->findOrFail($id);
        //fetch and set user image name from userData
        $imageName = $userData->image;
        //get image path
        $imagePath = public_path('lib/images/'.$imageName);
        //check whether image exists or not
        if(file_exists($imagePath)){
            return unlink($imagePath);
        }
        return true;
    }

    //method to edit user detail
    function editUser(Request $request){
        //new web page name
        $this->webPageName['title']='Edit Student Details';
        //get user id from http request
        $userId = $request->userId;
        //fetch users data according to user id
        $userData = (new \App\Student)->findOrFail($userId);
        return view('editStudent', compact('userData'), $this->webPageName);
    }

    //method to update user edited data
    function  editUserAction(Request $request){
        $this-> validate(
            $request, [
                'name'=>'required|min:3',
                'email'=>'email',
                'image'=>'mimes:jpeg,jpg,png,gig'
            ], ['name.required'=>'Fill your name first.']
        );
        $data['name']=$request->name;
        $data['email']=$request->email;
        //get id
        $id = $request->id;
        //dd($data);//display data
        if($request->hasFile('image')){
            $image= $request->file('image');
            $ext=$image->getClientOriginalExtension();
            $imageName=Str::random(18).'.'.$ext;
            $uploadPath = public_path('lib/images/');
            //delete old image first & upload new image
            if($this->_deleteImage($id) && $image->move($uploadPath, $imageName)){
                $data['image']=$imageName;
            }
        }
        if((new \App\Student)->where('id', $id)->update($data)){
            //--->echo "users data updated";
            return redirect()->route('enroll')->with('success', 'Users Data Updated Successfully !!!');
        }
    }

}
