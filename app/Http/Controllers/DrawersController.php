<?php


namespace App\Http\Controllers;
use App\Exceptions\Money;
use Illuminate\Http\Request;
use App\ACL;
use App\Drawers;


class DrawersController extends Controller
{
    // Create the variables to ACL and all helpers and models that we will use in this controller
    protected $ACL;
    protected $drawers;

    /**
     * DrawersController constructor.
     * Basic constructor function of controller
     *
     **/

    public function __construct(ACL $ACL, Drawers $drawers)
    {
        $this->ACL        = $ACL;
        $this->drawers     = $drawers;

    }

    /**
     * DrawersController getIndex
     * Function to list the drawers and send to view
     *
     * @return $this
     */
    public function getIndex()
    {
        // Call function to verify the user permission to access this method
        // If the user does not have permission, he/she will be redirected to last parameter
        $this->ACL->verifyPermission('drawers', ['You do not have permission for access Drawers\' page.'], route('home'));

        // Select on drawers table through the model


        $drawers = $this->drawers->orderBy('number','desc')->get();


        // Call the view passing the query result above
        return view('drawers.index')->with(compact('drawers'));
    }

    /**
     * DrawersController getAdd
     * Function to list the form to add new drawers
     *
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAdd()
    {
        // Call function to verify the user permission to access this method
        // In this case we have to inform the action as 4th parameter (Options: [add, edit, delete, or null])
        // NULL means the user will not be able to access the page in any circumstances
        // If the user does not have permission, he/she will be redirected to last parameter
        $this->ACL->verifyPermission('drawers', ['You do not have permission to add a new drawer.'], route('drawers'), 'add');

        // Call the view
        return view('drawers.add');
    }

    /**
     * DrawersController postAdd
     * Function to get the post, validate the fields, and save new drawers on database
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
        $this->ACL->verifyPermission('drawers', ['You do not have permission to add a new drawer.'], route('drawers'), 'add');

        $this->validate($request, [
            'number'  => 'required|max:2|unique:drawers,number,'.$request->drawerId.',drawerId',
            'value'   => 'required|max:1000|min:1'
        ]);

        $value = Money::convertViewToDatabase($request->value);



        // Sets the new drawer as new model object
        // Then sets the values according the columns on database
        $drawer = new Drawers();
        $drawer->number = $request->number;
        $drawer->value  = $value;
        $drawer->status  = false;

        // Saving the new drawer
        $drawer->save();

        // Create a success message variable
        $success = "Drawer created successfully";

        // Call the view passing the success message
        return redirect(route('drawers'))->with(compact('success'));
    }

    /**
     * DrawersController getEdit
     * Function to list the specific drawer data to form
     *
     * @param $drawersId
     * @return $this
     */
    public function getEdit($drawerId)
    {


        // Call function to verify the user permission to access this method
        // In this case we have to inform the action as 4th parameter (Options: [add, edit, delete, or null])
        // NULL means the user will not be able to access the page in any circumstances
        // If the user does not have permission, he/she will be redirected to last parameter
        $this->ACL->verifyPermission('drawers', ['You do not have permission to edit drawers.'], route('drawers'), 'edit');

        // Select the specific drawer according the primary key passed by get
        $drawer = $this->drawers->find($drawerId);

        $drawer->value = Money::convertDatabaseToView($drawer->value,'2','.', ',');


        // Call the view passing the query result above
        return view('drawers.edit')->with(compact('drawer'));
    }

    /**
     * DrawersController putEdit
     * Function to get the post, validate the fields, and save on database the new values of a specific drawer
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
        $this->ACL->verifyPermission('drawers', ['You do not have permission to edit drawers.'], route('drawers'), 'edit');

        $value = Money::convertViewToDatabase($request->value);

        // Call a back-end validate method
        $this->validate($request, [
            'number'  => 'required|max:2|unique:drawers,number,'.$request->drawerId.',drawerId',
            'value'   => 'required|max:1000|min:1'
        ]);

        // Sets the new drawer as new model object
        // Then sets the values according the columns on database
        $drawer = $this->drawers->find($request->drawerId);
        $drawer->number = $request->number;
        $drawer->value  = $value;

        // Save the drawer with new values above
        $drawer->save();

        // Create a success message variable
        $success = "Drawer updated successfully";

        // Call the view passing the success message
        return redirect(route('drawers'))->with(compact('success'));
    }

    /**
     * DrawersController delete
     * Function to delete a specific drawer
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
        $this->ACL->verifyPermission('drawers', ['You do not have permission to delete drawers.'], route('drawers'), 'delete');

        // Select and DELETE the specific drawer according the primary key passed by get
        $this->drawers->find($request->drawersId)->delete();

        // Create a success message variable
        $success = "Drawer deleted successfully";

        // Call the view passing the success message
        return redirect(route('drawers'))->with(compact('success'));
    }
}
