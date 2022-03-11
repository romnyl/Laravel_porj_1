<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $employees = Employee::latest()->paginate(5);

        return view('employee.index', compact('employees'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('employee.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
       /*  $request->validate([
             'firstname' => 'required',
            'lastname' => 'required',
            'username' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'image' => 'required',
            'company' => 'required'
        ]);  */
        //$imgname = $request->file('image')->getClientOriginalName(); //getClientOriginalExtension()
        //$imgsize = $request->file('image')->getSize();
        //$name = $request->file('image')->storeAs('public/', $imgname);
        //$photo = new Photo();
        //$photo->name = $imgname;
        //$photo->size = $imgsize;
        //$photo->save();
        //$data = $request->all();
        
        //dd($data);


        //return redirect()->back();

        $data = $request->all();
        
        $image = file_get_contents($request->file('image')->getRealPath());
        //$base64 = base64_encode($img);
        

        DB::table('Employee')->insert([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'username' => $data['username'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'image' => $image,
            'company' => $data['firstname']
        ]);

        //$emp = Employee::create($data);
        
        return redirect()->route('employee.index')
            ->with('success', 'Employee created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
        return view('employee.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
        return view('employee.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        //
        /* $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'username' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'image' => 'required',
            'company' => 'required'
        ]); */

        //$employee->id // it works

        $image = file_get_contents($request->file('image')->getRealPath());
        //$base64 = base64_encode($img);
        DB::table('Employee')
              ->where('id', $employee->id)
              ->update(['firstname' => $request->firstname, 
              'lastname' => $request->lastname,
              'username' => $request->username,
              'email' => $request->email,
              'phone' => $request->phone,
              'image' => $image,
              'company' => $request->company
            ]);


        //$employee->update($request->all());

        return redirect()->route('employee.index')
            ->with('success', 'Employee updated successfully'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
        $employee->delete();

        return redirect()->route('employee.index')
            ->with('success', 'Employee deleted successfully');
    }

    public function search(Request $request)
    {
        $search = $request->get('searchbox');
        

        //dd($request);
        $employees = Employee::query()
        ->where('firstname', 'LIKE', '%'.$search.'%')->paginate(5);
        

        return view('employee.index', compact('employees'))
        ->with('i', (request()->input('page', 1) - 1) * 5);

    }

}
