<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    // get all product
    public function productList(){
        $product = Product::get();

        return response()->json($product, 200);
    }

    // get all category
    public function categoryList(){
        $category = Category::get();

        return response()->json($category, 200);
    }

    // get all user
    public function userList(){

        $user = User::get();

        $data = [
            'user' => $user
        ];

        return response()->json($data, 200);
    }

    // get all order
    public function orderList(){

        $orderList = OrderList::get();

        $data = [
            'orderList' => $orderList
        ];

        return response()->json($data, 200);
    }

    // create category
    public function createCategory(Request $request){
        $data = [
            'name' => $request->name ,
            'created_at' => Carbon::now() ,
            'updated_at' => Carbon::now()
        ];

        $response = Category::create($data);
        return response()->json($response, 200);

    }

    // create contact
    public function createContact(Request $request){
        $data = $this->getContactData($request);
        Contact::create($data);
        $contact = Contact::orderBy('created_at','desc')->get();
        return response()->json($contact, 200);
    }

    // delete category
    public function deleteCategory(Request $request){
        $data = Category::where('id',$request->category_id)->first();
        if(isset($data)){
            Category::where('id',$request->category_id)->delete();
            return response()->json(['status' => true ,'message'=> 'delete success...' , 'deleteData' => $data], 200);
        }
            return response()->json(['status' => false ,'message'=> 'There is no category...'], 200);
    }

    // category detail
    public function categoryDetail($id){
        $data = Category::where('id',$id)->first();
        if(isset($data)){
            return response()->json(['status' => true , 'categoryData' => $data], 200);
        }
            return response()->json(['status' => false ,'message'=> 'There is no category...'], 500);
    }

    // update category
    public function updateCategory(Request $request){
        $categoryId = $request->category_id;

        $dbSource = Category::where('id',$categoryId)->first();

        if(isset($dbSource)){
            $data = $this->getCategoryData($request);
            Category::where('id',$categoryId)->update($data);
            $response = Category::where('id',$categoryId)->first();
            return response()->json(['status' => true ,'message'=> 'update success...' , 'updateData' => $response], 200);
        }
            return response()->json(['status' => false ,'message'=> 'There is no category...'], 500);
    }

    // get contact data
    private function getContactData($request){
        return [
            'name' => $request->name ,
            'email' => $request->email ,
            'message' => $request->message ,
            'created_at' => Carbon::now() ,
            'updated_at' => Carbon::now()
        ];
    }

    // get category data
    private function getCategoryData($request){
        return [
            'name' => $request->category_name ,
            'updated_at' => Carbon::now()
        ];
    }
}


