<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
class employeController extends Controller
{
    public function index(Request $request) {
        $users = Employee::latest();
        if (!empty ($request->get('search'))) {
            $users = $users->where('employee_name', 'like', '%' . $request->get('search') . '%');
        }
        $users = $users->paginate(5);
        return view("employe.list", compact('users'));

    }

    public function create() {
        return view("employe.create");
    }
    public function store(Request $request) {
      //  dd($request->all());
            $validator = Validator::make($request->all(),[
                'name' => 'required',
                'email' => ['required', 'email', Rule::unique('employees','employee_email')],
                'image' => 'nullable|mimes:png,jpg,jpeg,webp',
                'department' => 'required',
                'gender' => 'required',
                'dob' => 'required|date',
                'designation' => 'required',
            ]);

            if($validator->passes()) {
                $employ = new Employee;
                $employ->guid = Str::uuid();
                $employ->employee_name = $request->name;
                $employ->employee_email = $request->email;
                $employ->dob = $request->dob;
                $employ->department = $request->department;
                $employ->gender = $request->gender;
                $employ->designation = $request->designation;
                $employ->is_active = (int)$request->is_active;
               
               if ($request->hasFile('image')) {
                    $file = $request->file('image');
                    $ext = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $ext;
                    
                    // Create the directory if it doesn't exist
                    if (!File::exists(public_path('images'))) {
                        File::makeDirectory(public_path('images'), 0755, true, true);
                    }
                    
                    // Move the file using the File facade
                    File::move($file->getPathname(), public_path('images') . '/' . $filename);
             }  else {
                $filename = "";
             }
               $employ->image = $filename;
                $employ->save();


                $request->session()->flash('success','created successfully');
                return response()->json([
                    'status' => true,
                    'message' => 'created successfully',
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'errors' => $validator->errors(),
                ]);
            }
    }

    public function edit( Request $request ,$id ) {
        $user  = Employee::find( $id );

        if(empty($user)) {
            $request->session()->flash('error','No Employee found!');
            return response()->json([
                "status" => false,
                "message"=> "No Employee found."
            ]);
        }
        return view('employe.edit' ,compact('user'));
    }
    public function update(Request $request ,$id) {
        $user = Employee::find($id);
       
        if (empty($user)) {
            $request->session()->flash('error', 'employe not found');
            return response()->json([
                'status' => false,
                'notFound' => true,
                'message' => 'employe not found'
            ]);
        }
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => [
                'required','email',
                Rule::unique('employees','employee_email')->ignore($user->id),
            ],
            'image' => 'nullable|mimes:png,jpg,jpeg,webp',
            'department' => 'required',
            'gender' => 'required',
            'dob' => 'required|date',
            'designation' => 'required',
        ]);
        if($validator->passes()) {
           
            $user->employee_name = $request->name;
                $user->employee_email = $request->email;
                $user->dob = $request->dob;
                $user->department = $request->department;
                $user->gender = $request->gender;
                $user->designation = $request->designation;
                $user->is_active = (int)$request->is_active;

                if ($request->hasFile('image')) {
                    $file = $request->file('image');
                    $ext = $file->getClientOriginalExtension();
                    $filename = time().'.'.$ext;
                    $file->move(public_path('images'), $filename);
        
                    if (!empty($user->image)) {
                        unlink(public_path('images/' . $user->image));
                    }
                    $user->image = $filename;
                }
        
            $user->save();
            $request->session()->flash('success','employe updated successfully');
            return response()->json([
                'status' => true,
                'message'=> 'employe updated successfully'
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors'=> $validator->errors()
            ]);
        }
    }
    public function destroy(Request $request, $id)
    {
        $user = Employee::find($id);
        if (empty($user)) {
            $request->session()->flash('error', 'employee not found');
            return response()->json([
                'status' => false,
                'message' => 'employee not found'
            ]);
        }
        $user->delete();
        $request->session()->flash('success', 'deleted successfully');
        return response()->json([
            'status' => true,
            'message' => 'deleted successfully'
        ]);
    }

}
