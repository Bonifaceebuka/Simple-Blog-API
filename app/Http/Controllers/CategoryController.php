<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Controllers\Api\V1\Auth\AuthController;
use Auth;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate();
        return view('categories.index',['categories'=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:45|unique:categories',
            'description' => 'required|string',
        ]);
        $user_id = Auth::user()->id;
        $category = new Category([
            'name'=>$request->name,
            'description'=>$request->description,
        ]);
        if($category->save()){
            $success='Category created successfully.';
            return redirect()->back()->with('success-message', $success);
        }
        else{
            $error ='Category was not successfully created.';
            return redirect()->back()->with('error-message', $error );
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('categories.edit',['category'=>$category]);
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
        $validator =  Validator::make($request->all(), [
            'name' => 'required|string|max:45|unique:categories',
            'description' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                "error" => 'validation_error',
                "message" => $validator->errors(),
            ], 201);
        }
        $user_id = Auth::user()->id;
        $category = Category::find($id);
        $category->name = $request->name;
        $category->description = $request->description;
        if($category->save()){
            $success='Category updated successfully.';
            return redirect()->back()->with('success-message', $success);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
            if($category->delete()){
                $success='category removed successfully';
                return redirect()->back()->with('success-message', $success);
            }else{
                $error='category was not removed successfully';
                return redirect()->back()->with('error-message', $error);
            }
            
    }

    public function already_exists($name){
        if (is_numeric($name)) {
           if(Category::find($name) !=null){
                return true;
                }
                else{
                    return false;
                }
        }
        else{
            if(Category::where('name',$name)->first() !=null){
            return false;
                }
                else{
                    return true;
                }
        }
    
}
}
