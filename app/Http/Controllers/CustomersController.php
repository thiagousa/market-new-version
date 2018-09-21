<?php


namespace App\Http\Controllers;

use App\ACL;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Customers;
use App\TypeCustomers;

class CustomersController extends Controller
{
    // Create the variables to ACL and all models that we will use in this controller
    protected $ACL;
    protected $customers;
    protected $typeCustomers;

    /**
     * CustomersController constructor.
     * Basic constructor function of controller
     *
     * @param ACL $ACL
     * @param Customers $customers
     */
    public function __construct(ACL $ACL, Customers $customers, TypeCustomers $typeCustomers)
    {
        $this->ACL              = $ACL;
        $this->customers        = $customers;
        $this->typeCustomers    = $typeCustomers;
    }

    /**
     * CustomersController getIndex
     * Function to list the customers and send to view
     *
     * @return $this
     */
    public function getIndex()
    {
        // Call function to verify the user permission to access this method
        // If the user does not have permission, he/she will be redirected to last parameter
        $this->ACL->verifyPermission('customers', ['You do not have permission for access Customers\' page.'], route('home'));

        // Select on customers table through the model
        $customers = $this->customers->orderBy('namecia', 'ASC')->get();

        // Call the view passing the query result above
        return view('customers.index')->with(compact('customers'));
    }

    /**
     * CustomersController getAdd
     * Function to list the form to add new customers
     *
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAdd()
    {
        // Call function to verify the user permission to access this method
        // In this case we have to inform the action as 4th parameter (Options: [add, edit, delete, or null])
        // NULL means the user will not be able to access the page in any circumstances
        // If the user does not have permission, he/she will be redirected to last parameter
        $this->ACL->verifyPermission('customers', ['You do not have permission to add a new customer.'], route('customers'), 'add');

        $typeCustomers = ['' => 'Choose...'];
        $typeCustomersConsult = $this->typeCustomers->orderBy('name', 'asc')->get();
        foreach ($typeCustomersConsult as $typeCustomer) {
            $typeCustomers[$typeCustomer['typeCustomersId']] = $typeCustomer['name'];
        }

        // Call the view
        return view('customers.add')->with(compact('typeCustomers'));
    }

    /**
     * CustomersController postAdd
     * Function to get the post, validate the fields, and save new customers on database
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
        $this->ACL->verifyPermission('customers', ['You do not have permission to add a new customer.'], route('customers'), 'add');

        // Call a back-end validate method
        $this->validate($request, [
            'namecia'           => 'required|max:100|unique:customers',
            'name'              => 'required|max:100',
            'email'             => 'required|email|max:100|unique:customers',
            'phone'             => 'required|max:20|unique:customers',
            'cellphone'         => 'max:20',
            'address'           => 'max:255',
            'city'              => 'max:100',
            'state'             => 'max:2',
            'country'           => 'required|max:100',
            'zipcode'           => 'max:10',
            'typeCustomersId'   => 'required',
        ]);

        // Sets the new customer as new model object
        // Then sets the values according the columns on database
        $customer = new Customers();
        $customer->namecia          = $request->namecia;
        $customer->name             = $request->name;
        $customer->email            = $request->email;
        $customer->phone            = $request->phone;
        $customer->cellphone        = $request->cellphone;
        $customer->address          = $request->address;
        $customer->city             = $request->city;
        $customer->state            = $request->state;
        $customer->country          = $request->country;
        $customer->zipcode          = $request->zipcode;
        $customer->typeCustomersId  = $request->typeCustomersId;

        // Saving the new user
        $customer->save();

        // Create a success message variable
        $success = "Customer created successfully";

        // Call the view passing the success message
        return redirect(route('customers'))->with(compact('success'));
    }

    /**
     * CustomersController getEdit
     * Function to list the specific customer data to form
     *
     * @param $customersId
     * @return $this
     */
    public function getEdit($customersId)
    {
        // Call function to verify the user permission to access this method
        // In this case we have to inform the action as 4th parameter (Options: [add, edit, delete, or null])
        // NULL means the user will not be able to access the page in any circumstances
        // If the user does not have permission, he/she will be redirected to last parameter
        $this->ACL->verifyPermission('customers', ['You do not have permission to edit customers.'], route('customers'), 'edit');

        // Select type customers
        $typeCustomers = ['' => 'Choose...'];
        $typeCustomersConsult = $this->typeCustomers->orderBy('name', 'asc')->get();
        foreach ($typeCustomersConsult as $typeCustomer) {
            $typeCustomers[$typeCustomer['typeCustomersId']] = $typeCustomer['name'];
        }

        // Select the specific customer according the primary key passed by get
        $customer = $this->customers->where('customersId', '=', $customersId)->first();

        // Call the view passing the query result above
        return view('customers.edit')->with(compact('customer', 'typeCustomers'));
    }

    /**
     * CustomersController putEdit
     * Function to get the post, validate the fields, and save on database the new values of a specific customer
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
        $this->ACL->verifyPermission('customers', ['You do not have permission to edit customers.'], route('customers'), 'edit');

        // Call a back-end validate method
        $this->validate($request, [
            'namecia'           => 'required|max:100|unique:customers,namecia,'.$request->customersId.',customersId',
            'name'              => 'required|max:100,'.$request->customersId.',customersId',
            'email'             => 'required|email|max:100|unique:customers,email,'.$request->customersId.',customersId',
            'phone'             => 'required|max:20|unique:customers,phone,'.$request->customersId.',customersId',
            'cellphone'         => 'max:20',
            'address'           => 'max:255',
            'city'              => 'max:100',
            'state'             => 'max:2',
            'country'           => 'required|max:100',
            'zipcode'           => 'max:10',
            'typeCustomersId'   => 'required',
        ]);

        // Sets the new customer as new model object
        // Then sets the values according the columns on database
        $customer = $this->customers->find($request->customersId);
        $customer->namecia          = $request->namecia;
        $customer->name             = $request->name;
        $customer->email            = $request->email;
        $customer->phone            = $request->phone;
        $customer->cellphone        = $request->cellphone;
        $customer->address          = $request->address;
        $customer->city             = $request->city;
        $customer->state            = $request->state;
        $customer->country          = $request->country;
        $customer->zipcode          = $request->zipcode;
        $customer->typeCustomersId  = $request->typeCustomersId;

        $customer->save();

        // Create a success message variable
        $success = "Customer updated successfully";

        // Call the view passing the success message
        return redirect(route('customers'))->with(compact('success'));
    }

    /**
     * CustomersController delete
     * Function to delete a specific customer
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
        $this->ACL->verifyPermission('customers', ['You do not have permission to delete customers.'], route('customers'), 'delete');

        // Select and DELETE the specific customer according the primary key passed by get
        $this->customers->find($request->customersId)->delete();

        // Create a success message variable
        $success = "Customer deleted successfully";

        // Call the view passing the success message
        return redirect(route('customers'))->with(compact('success'));
    }
}
