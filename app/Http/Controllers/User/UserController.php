<?php

namespace App\Http\Controllers\User;

use Storage;
use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // user home page
    public function home(){
        $pizza = Product::orderBy('created_at','desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizza','category','cart','history'));
    }

    // change password page
    public function changePage(){
        return view('user.password.change');
    }

    // change password
    public function changePassword(Request $request){

        $this->passwordValidationCheck($request);

        $user = User::where('id',Auth::user()->id)->first();
        $dbHashValue = $user->password;

        if (Hash::check($request->oldPassword, $dbHashValue)){
            $data = [
                'password' => Hash::make($request->newPassword)
            ];
            User::where('id',Auth::user()->id)->update($data);

            return back()->with(['changeSuccess' => 'Password Change Success...']);

        }
        return back()->with(['notMatch' => 'The Old Password Not Match. Try Again!']);
    }

    // user profile page
    public function accountPage(){
        return view('user.profile.account');
    }

    // user profile change
    public function accountChange($id, Request $request){
        $this->accountValidationCheck($request);
        $data = $this->getUserData($request);

        // for image
        if($request->hasFile('image')){
            // old image name | check=>delete | store
            $dbImage = User::where('id',$id)->first();
            $dbImage = $dbImage->image;

            if($dbImage != null){
                Storage::delete('public/'.$dbImage);
            }

            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image'] = $fileName;
        }

        User::where('id',$id)->update($data);
        return back()->with(['updateSuccess'=>'Admin Account Updated...']);
    }

    // user role change
    public function userList(){
        $users = User::get();
        return view('admin.user.list',compact('users'));
    }

    public function changeUserRole(Request $request){
        $userRole = [
            'role' => $request->role
        ];
        User::where('id',$request->userId)->update($userRole);
    }

    // delete user
    public function deleteUser($id){
        User::where('id',$id)->delete();
        return back()->with(['deleteSuccess' => 'User Deleted...']);
    }

    // edit user
    public function editUser($id){
        $user = User::where('id',$id)->first();
        $userList = User::get();
        return view('admin.user.edit',compact('user','userList'));
    }

    // update user
    public function updateUser($id, Request $request){
        $this->userValidationCheck($request,"update");
        $data = $this->requestUserInfo($request);

        if($request->hasFile('image')){
            $oldImageName = User::where('id',$id)->first();
            $oldImageName = $oldImageName->image;

            if($oldImageName != null){
                Storage::delete('public/'.$oldImageName);
            }

            $fileName = uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image'] = $fileName;

            User::where('id',$id)->update($data);
            return back()->with(['updateSuccess'=>'Admin Account Updated...']);

        };
        // dd($data);
    }

    // request user info
    private function requestUserInfo($request){
        return [
            'name' => $request->name ,
            'email' => $request->email ,
            'phone' => $request->phone ,
            'gender' => $request->gender ,
            'address' => $request->address
        ];
    }

    // user validation check
    private function userValidationCheck($request,$action){
        $validationRules = [
            'name' => 'required|min:5' ,
            'phone' => 'required',
            'email' => 'required',
            'gender' => 'required',
            'address' => 'required'
        ];

        $validationRules['image'] = $action == "create" ? 'required|mimes:jpg,jpeg,png,webp|file' : 'mimes:jpg,jpeg,png,webp|file';

        Validator::make($request->all(),$validationRules)->validate();
    }

    // category filter
    public function filter($categoryId){
        $pizza = Product::where('category_id',$categoryId)->orderBy('created_at','desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizza','category','cart','history'));
    }

    // direct pizza detail
    public function pizzaDetails($pizzaId){
        $pizza = Product::where('id',$pizzaId)->first();
        $pizzaList = Product::get();
        return view('user.main.details',compact('pizza','pizzaList'));
    }

    // direct cart list
    public function cartList(){
        $cartList = Cart::select('carts.*','products.name as pizza_name', 'products.price as pizza_price', 'products.image as product_image')
                    ->leftJoin('products','products.id','carts.product_id')
                    ->where('carts.user_id',Auth::user()->id)
                    ->get();

        $totalPrice = 0;

        foreach($cartList as $c){
            $totalPrice += $c->pizza_price * $c->qty ;
        }
        return view('user.main.cart',compact('cartList','totalPrice'));
    }

    // direct history page
    public function history(){
        $order = Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate('5');
        return view('user.main.history',compact('order'));
    }

    // get user data
    private function getUserData($request){
        return [
            'name' => $request->name ,
            'email' => $request->email ,
            'phone' => $request->phone ,
            'gender' => $request->gender ,
            'address' => $request->address,
            'updated_at'=>Carbon::now()
        ];
    }

    // account validation check
    private function accountValidationCheck($request){
        Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'image'=> 'mimes:png,jpg,jpeg,webp',
            'gender'=>'required',
            'address'=>'required'
        ])->validate();
    }

    // password validation check
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword'=>'required|min:6|max:10',
            'newPassword'=>'required|min:6|max:10',
            'confirmPassword'=>'required|min:6|max:10|same:newPassword'
        ])->validate();
    }

}
