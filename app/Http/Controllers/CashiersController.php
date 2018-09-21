<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ACL;
use App\Drawers;
use App\Cashiers;

class CashiersController extends Controller
{

    // Create the variables to ACL and all helpers and models that we will use in this controller
    protected $ACL;
    protected $drawers;
    protected $cashiers;
    /**
     * CashiersController constructor.
     * Basic constructor function of controller
     *
     **/

    public function __construct(ACL $ACL,Cashiers $cashiers ,Drawers $drawers)
    {
        $this->ACL        = $ACL;
        $this->drawers     = $drawers;
        $this->cashiers  = $cashiers;

    }

    /**
     * CashiersController getIndex
     * Function to list the cashiers and send to view
     *
     * @return $this
     */
    public function getIndex()
    {
        // Call function to verify the user permission to access this method
        // If the user does not have permission, he/she will be redirected to last parameter
        $this->ACL->verifyPermission('cashiers', ['You do not have permission for access Cashiers\' page.'], route('home'));

        // Select on cashiers table through the model

        $cashiers = cashiers::with('drawers')->get();




        // Call the view passing the query result above
        return view('cashiers.index')->with(compact('cashiers'));
    }

    public function getAdd()
    {
        // Call function to verify the user permission to access this method
        // In this case we have to inform the action as 4th parameter (Options: [add, edit, delete, or null])
        // NULL means the user will not be able to access the page in any circumstances
        // If the user does not have permission, he/she will be redirected to last parameter
        $this->ACL->verifyPermission('cashiers', ['You do not have permission to add a new cashier.'], route('cashiers'), 'add');

        // Call the view
        return view('cashiers.add');
    }

    /**
     * CashiersController postAdd
     * Function to get the post, validate the fields, and save new cashiers on database
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
        $this->ACL->verifyPermission('cashiers', ['You do not have permission to add a new cashier.'], route('cashiers'), 'add');

        $this->validate($request, [
            'number'  => 'required|max:2|unique:cashiers,number,'.$request->cashierId.',cashierId',
            'value'   => 'required|max:1000|min:1'
        ]);

        $value = Money::convertViewToDatabase($request->value);



        // Sets the new cashier as new model object
        // Then sets the values according the columns on database
        $cashier = new Cashiers();
        $cashier->number = $request->number;
        $cashier->value  = $value;
        $cashier->status  = false;

        // Saving the new cashier
        $cashier->save();

        // Create a success message variable
        $success = "Cashier created successfully";

        // Call the view passing the success message
        return redirect(route('cashiers'))->with(compact('success'));
    }

    /**
     * CashiersController getEdit
     * Function to list the specific cashier data to form
     *
     * @param $cashiersId
     * @return $this
     */
    public function getEdit($cashierId)
    {


        // Call function to verify the user permission to access this method
        // In this case we have to inform the action as 4th parameter (Options: [add, edit, delete, or null])
        // NULL means the user will not be able to access the page in any circumstances
        // If the user does not have permission, he/she will be redirected to last parameter
        $this->ACL->verifyPermission('cashiers', ['You do not have permission to edit cashiers.'], route('cashiers'), 'edit');

        // Select the specific cashier according the primary key passed by get
        $cashier = Cashiers::with('user')->find($cashierId);


        // Call the view passing the query result above
        return view('cashiers.edit')->with(compact('cashier'));
    }

    /**
     * CashiersController putEdit
     * Function to get the post, validate the fields, and save on database the new values of a specific cashier
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
        $this->ACL->verifyPermission('cashiers', ['You do not have permission to edit cashiers.'], route('cashiers'), 'edit');


        $cashier = $this->cashiers->find($request->cashierId);

        $drawer = $this->drawers->find($request->drawerId);

        $cashier->type = 0;
        $cashier->value_final = $request->value_final;
        $drawer->status = 0;
        $drawer->cashierId = 0;

        // Save the cashier with new values above
        $cashier->save();
        $drawer->save();


        // Create a success message variable
        $success = "Cashier updated successfully";

        // Call the view passing the success message
        return redirect(route('cashiers'))->with(compact('success'));
    }

    /**
     * CashiersController delete
     * Function to delete a specific cashier
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
        $this->ACL->verifyPermission('cashiers', ['You do not have permission to delete cashiers.'], route('cashiers'), 'delete');

        // Select and DELETE the specific cashier according the primary key passed by get
        $this->cashiers->find($request->cashiersId)->delete();

        // Create a success message variable
        $success = "Drawer deleted successfully";

        // Call the view passing the success message
        return redirect(route('cashiers'))->with(compact('success'));
    }


}
