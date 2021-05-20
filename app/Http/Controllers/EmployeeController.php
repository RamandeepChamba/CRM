<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Company;
use App\Traits\DeleteEmployeeTrait;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEmployeeRequest;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    use DeleteEmployeeTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::paginate(3);
        return view('employees.index', ['employees' => $employees]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::select('id', 'name')->get();
        return view('employees.create', ['companies' => $companies]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeRequest $request)
    {
        $data = $request->validated();
        $company = Company::findOrFail($data['company']);
        unset($data['company']);
        unset($data['avatar']);
        $employee = new Employee($data);
        
        if($request->file('avatar')) {
            $employee->avatar = asset('/storage/' . $request->file('avatar')->store('avatars', 'public'));
        }
        
        $employee = $company->employees()->save($employee);
        session()->flash('status', 'Employee saved successfully');
        return redirect()->route('employees.show', ['employee' => $employee->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return view('employees.show', ['employee' => $employee]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $companies = Company::select('id', 'name')->get();
        return view('employees.edit', ['companies' => $companies, 'employee' => $employee]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(StoreEmployeeRequest $request, Employee $employee)
    {
        $data = $request->validated();
        // Check previous avatar
        if(isset($employee->avatar) && isset($data['avatar'])) {
            // Remove previous avatar
            $this->removeAvatar($employee->avatar);
        }
        foreach ($data as $key => $value) {
            $employee->$key = $value;
        }
        if($request->file('avatar')) {
            // Store new avatar
            $employee->avatar = asset('/storage/' . $request->file('avatar')->store('avatars', 'public'));
        }
        $company = Company::findOrFail($employee->company);
        unset($employee->company);
        $company->employees()->save($employee);
        session()->flash('status', 'employee updated successfully');
        return redirect()->route('employees.show', ['employee' => $employee]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $this->deleteEmployee($employee);
        session()->flash('status', 'Employee deleted successfully');
        return redirect()->route('employees.index');
    }

    private function avatarExist($url)
    {
        if(!$url) {
            return 0;
        }
        // http://localhost/storage/logos/DWQYwRyn7M5k3tLm6DprlkI5YS7IoV18m7EXjFg5.jpg"
        $path = explode('/storage/', $url);
        return Storage::disk('public')->exists($path[1] ?? $path[0]);
    }
    private function removeAvatar($url)
    {
        // http://localhost/storage/logos/DWQYwRyn7M5k3tLm6DprlkI5YS7IoV18m7EXjFg5.jpg"
        $path = explode('/storage/', $url);
        Storage::disk('public')->delete($path[1]);
    }
}
