<?php

namespace App\Http\Controllers;

use App\ACL;
use Illuminate\Http\Request;

use App\TypeCustomers;

class TypeCustomersController extends Controller
{
    // Create the variables to ACL and all models that we will use in this controller
    protected $ACL;
    protected $typeCustomers;

    /**
     * TypeCustomersController constructor.
     * Basic constructor function of controller
     *
     * @param ACL $ACL
     * @param TypeCustomers $typeCustomers
     */
    public function __construct(ACL $ACL, TypeCustomers $typeCustomers)
    {
        $this->ACL              = $ACL;
        $this->typeCustomers    = $typeCustomers;
    }

    /**
     * TypeCustomersController getIndex
     * Function to list typeCustomers and send to view
     *
     * @return $this
     */
    public function getIndex()
    {
        // Call function to verify the user permission to access this method
        // If the user does not have permission, he/she will be redirected to last parameter
        $this->ACL->verifyPermission('typeCustomers', ['You do not have permission for access TypeCustomers\' page.'], route('home'));

        // Select on typeCustomers table through the model
        $typeCustomers = $this->typeCustomers->orderBy('name', 'ASC')->get();

        foreach ($typeCustomers as $typeCustomer){
            $typeCustomer->tax = number_format($typeCustomer->tax, 2);
        }

        // Call the view passing the query result above
        return view('typeCustomers.index')->with(compact('typeCustomers'));
    }

    /**
     * TypeCustomersController getAdd
     * Function to list the form to add new typeCustomers
     *
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAdd()
    {
        // Call function to verify the user permission to access this method
        // In this case we have to inform the action as 4th parameter (Options: [add, edit, delete, or null])
        // NULL means the user will not be able to access the page in any circumstances
        // If the user does not have permission, he/she will be redirected to last parameter
        $this->ACL->verifyPermission('typeCustomers', ['You do not have permission to add a new typeCustomer.'], route('typeCustomers'), 'add');

        // Call the view
        return view('typeCustomers.add');
    }

    /**
     * TypeCustomersController postAdd
     * Function to get the post, validate the fields, and save new typeCustomers on database
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
        $this->ACL->verifyPermission('typeCustomers', ['You do not have permission to add a new typeCustomer.'], route('typeCustomers'), 'add');

        // Call a back-end validate method
        $this->validate($request, [
            'name'  => 'required|max:100|unique:typeCustomers',
            'tax'   => 'required|max:5|min:4'
        ]);

        // Sets the new typeCustomer as new model object
        // Then sets the values according the columns on database
        $typeCustomer = new TypeCustomers();
        $typeCustomer->name = $request->name;
        $typeCustomer->tax  = $request->tax;

        // Saving the new typeCustomer
        $typeCustomer->save();

        // Create a success message variable
        $success = "TypeCustomer created successfully";

        // Call the view passing the success message
        return redirect(route('typeCustomers'))->with(compact('success'));
    }

    /**
     * TypeCustomersController getEdit
     * Function to list the specific typeCustomer data to form
     *
     * @param $typeCustomersId
     * @return $this
     */
    public function getEdit($typeCustomersId)
    {
        // Call function to verify the user permission to access this method
        // In this case we have to inform the action as 4th parameter (Options: [add, edit, delete, or null])
        // NULL means the user will not be able to access the page in any circumstances
        // If the user does not have permission, he/she will be redirected to last parameter
        $this->ACL->verifyPermission('typeCustomers', ['You do not have permission to edit typeCustomers.'], route('typeCustomers'), 'edit');

        // Select the specific typeCustomer according the primary key passed by get
        $typeCustomer = $this->typeCustomers->find($typeCustomersId);

        $typeCustomer->tax = number_format($typeCustomer->tax, 2);

        // Call the view passing the query result above
        return view('typeCustomers.edit')->with(compact('typeCustomer'));
    }

    /**
     * TypeCustomersController putEdit
     * Function to get the post, validate the fields, and save on database the new values of a specific typeCustomer
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
        $this->ACL->verifyPermission('typeCustomers', ['You do not have permission to edit typeCustomers.'], route('typeCustomers'), 'edit');

        // Call a back-end validate method
        $this->validate($request, [
            'name'  => 'required|max:100|unique:typeCustomers,name,'.$request->typeCustomersId.',typeCustomersId',
            'tax'   => 'required|max:5|min:4'
        ]);

        // Sets the new typeCustomer as new model object
        // Then sets the values according the columns on database
        $typeCustomer = $this->typeCustomers->find($request->typeCustomersId);
        $typeCustomer->name = $request->name;
        $typeCustomer->tax  = $request->tax;

        // Save the typeCustomer with new values above
        $typeCustomer->save();

        // Create a success message variable
        $success = "TypeCustomer updated successfully";

        // Call the view passing the success message
        return redirect(route('typeCustomers'))->with(compact('success'));
    }

    /**
     * TypeCustomersController delete
     * Function to delete a specific typeCustomer
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
        $this->ACL->verifyPermission('typeCustomers', ['You do not have permission to delete typeCustomers.'], route('typeCustomers'), 'delete');

        // Select and DELETE the specific typeCustomer according the primary key passed by get
        $this->typeCustomers->find($request->typeCustomersId)->delete();

        // Create a success message variable
        $success = "TypeCustomer deleted successfully";

        // Call the view passing the success message
        return redirect(route('typeCustomers'))->with(compact('success'));
    }
}
