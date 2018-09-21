<?php

namespace App\Http\Controllers;

use App\ACL;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Employees;

class EmployeesController extends Controller
{
    // Create the variables to ACL and all models that we will use in this controller
    protected $ACL;
    protected $employees;

    /**
     * EmployeesController constructor.
     * Basic constructor function of controller
     *
     * @param ACL $ACL
     * @param Employees $employees
     */
    public function __construct(ACL $ACL, Employees $employees)
    {
        $this->ACL          = $ACL;
        $this->employees    = $employees;
    }

    /**
     * EmployeesController getIndex
     * Function to list the employees and send to view
     *
     * @return $this
     */
    public function getIndex()
    {
        // Call function to verify the user permission to access this method
        // If the user does not have permission, he/she will be redirected to last parameter
        $this->ACL->verifyPermission('employees', ['You do not have permission for access Employees\' page.'], route('home'));

        // Select on employees table through the model
        $employees = $this->employees->orderBy('name', 'ASC')
            ->addSelect('employeesId')
            ->addSelect('name')
            ->addSelect('email')
            ->addSelect('phone')
            ->get();

        // Call the view passing the query result above
        return view('employees.index')->with(compact('employees'));
    }

    /**
     * EmployeesController getAdd
     * Function to list the form to add new employees
     *
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAdd()
    {
        // Call function to verify the user permission to access this method
        // In this case we have to inform the action as 4th parameter (Options: [add, edit, delete, or null])
        // NULL means the user will not be able to access the page in any circumstances
        // If the user does not have permission, he/she will be redirected to last parameter
        $this->ACL->verifyPermission('employees', ['You do not have permission to add a new employee.'], route('employees'), 'add');

        // Call the view
        return view('employees.add');
    }

    /**
     * EmployeesController postAdd
     * Function to get the post, validate the fields, and save new employees on database
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postAdd(Request $request)
    {
        // Call function to verify the user permission to access this method
        // In this case we have to inform the action as 4th parameter (Options: [add, edit, delete, or null])
        // NULL means the user will not be able to access the page in any circumstances
        // If the user does not have permission, he/she will be redirected to last parameter
        $this->ACL->verifyPermission('employees', ['You do not have permission to add a new employee.'], route('employees'), 'add');

        // Call a back-end validate method
        $this->validate($request, [
            'name'      => 'required|max:100',
            'email'     => 'required|email|max:100|unique:employees',
            'phone'     => 'required|max:20|unique:employees',
            'cellphone' => 'max:20',
            'address'   => 'max:255',
            'city'      => 'max:100',
            'state'     => 'max:2',
            'country'   => 'required|max:100',
            'zipcode'   => 'max:10',
            'dateBegin' => 'required|max:10',
            'dateEnd'   => 'max:10',
            'function'  => 'required|max:45'
        ]);

        // Sets the new employee as new model object
        // Then sets the values according the columns on database
        $employee = new Employees();
        $employee->name         = $request->name;
        $employee->email        = $request->email;
        $employee->phone        = $request->phone;
        $employee->cellphone    = $request->cellphone;
        $employee->address      = $request->address;
        $employee->city         = $request->city;
        $employee->state        = $request->state;
        $employee->country      = $request->country;
        $employee->zipcode      = $request->zipcode;
        $employee->dateBegin    = Carbon::createFromFormat('m/d/Y',$request->dateBegin)->format('Y-m-d');
        if($request->dateEnd != null){
            $employee->dateEnd  = Carbon::createFromFormat('m/d/Y',$request->dateEnd)->format('Y-m-d');
        }
        $employee->function     = $request->function;

        // Saving the new user
        $employee->save();

        // Create a success message variable
        $success = "Employee created successfully";

        // Call the view passing the success message
        return redirect(route('employees'))->with(compact('success'));
    }

    /**
     * EmployeesController getEdit
     * Function to list the specific employee data to form
     *
     * @param $employeesId
     * @return $this
     */
    public function getEdit($employeesId)
    {
        // Call function to verify the user permission to access this method
        // In this case we have to inform the action as 4th parameter (Options: [add, edit, delete, or null])
        // NULL means the user will not be able to access the page in any circumstances
        // If the user does not have permission, he/she will be redirected to last parameter
        $this->ACL->verifyPermission('employees', ['You do not have permission to edit employees.'], route('employees'), 'edit');

        // Select the specific employee according the primary key passed by get
        $employee = $this->employees->where('employeesId', '=', $employeesId)->first();

        // Changed the date format
        $employee->dateBegin = Carbon::createFromFormat('Y-m-d', $employee->dateBegin)->format('m/d/Y');
        if($employee->dateEnd != null) {
            $employee->dateEnd = Carbon::createFromFormat('Y-m-d', $employee->dateEnd)->format('m/d/Y');
        }

        // Call the view passing the query result above
        return view('employees.edit')->with(compact('employee'));
    }

    /**
     * EmployeesController putEdit
     * Function to get the post, validate the fields, and save on database the new values of a specific employee
     *
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function putEdit(Request $request)
    {
        // Call function to verify the user permission to access this method
        // In this case we have to inform the action as 4th parameter (Options: [add, edit, delete, or null])
        // NULL means the user will not be able to access the page in any circumstances
        // If the user does not have permission, he/she will be redirected to last parameter
        $this->ACL->verifyPermission('employees', ['You do not have permission to edit employees.'], route('employees'), 'edit');

        // Call a back-end validate method
        $this->validate($request, [
            'name'      => 'required|max:100',
            'email'     => 'required|email|max:100|unique:employees,email,'.$request->employeesId.',employeesId',
            'phone'     => 'required|max:20|unique:employees,phone,'.$request->employeesId.',employeesId',
            'cellphone' => 'max:20',
            'address'   => 'max:255',
            'city'      => 'max:100',
            'state'     => 'max:2',
            'country'   => 'required|max:100',
            'zipcode'   => 'max:10',
            'dateBegin' => 'required|max:10',
            'dateEnd'   => 'max:10',
            'function'  => 'required|max:45'
        ]);

        // Sets the new employee as new model object
        // Then sets the values according the columns on database
        $employee = $this->employees->find($request->employeesId);
        $employee->name         = $request->name;
        $employee->email        = $request->email;
        $employee->phone        = $request->phone;
        $employee->cellphone    = $request->cellphone;
        $employee->address      = $request->address;
        $employee->city         = $request->city;
        $employee->state        = $request->state;
        $employee->country      = $request->country;
        $employee->zipcode      = $request->zipcode;
        $employee->dateBegin    = Carbon::createFromFormat('m/d/Y',$request->dateBegin)->format('Y-m-d');
        if($request->dateEnd != null){
            $employee->dateEnd  = Carbon::createFromFormat('m/d/Y',$request->dateEnd)->format('Y-m-d');
        }
        $employee->function     = $request->function;
        // Save the employee with new values above
        $employee->save();

        // Create a success message variable
        $success = "Employee updated successfully";

        // Call the view passing the success message
        return redirect(route('employees'))->with(compact('success'));
    }

    /**
     * EmployeesController delete
     * Function to delete a specific employee
     *
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function delete(Request $request)
    {
        // Call function to verify the user permission to access this method
        // In this case we have to inform the action as 4th parameter (Options: [add, edit, delete, or null])
        // NULL means the user will not be able to access the page in any circumstances
        // If the user does not have permission, he/she will be redirected to last parameter
        $this->ACL->verifyPermission('employees', ['You do not have permission to delete employees.'], route('employees'), 'delete');

        // Select and DELETE the specific employee according the primary key passed by get
        $this->employees->find($request->employeesId)->delete();

        // Create a success message variable
        $success = "Employee deleted successfully";

        // Call the view passing the success message
        return redirect(route('employees'))->with(compact('success'));
    }
}
