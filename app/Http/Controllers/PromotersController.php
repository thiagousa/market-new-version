<?php

namespace App\Http\Controllers;

use App\ACL;
use Illuminate\Http\Request;

use App\Promoters;

class PromotersController extends Controller
{
    // Create the variables to ACL and all models that we will use in this controller
    protected $ACL;
    protected $promoters;

    /**
     * PromotersController constructor.
     * Basic constructor function of controller
     *
     * @param ACL $ACL
     * @param Promoters $promoters
     */
    public function __construct(ACL $ACL, Promoters $promoters)
    {
        $this->ACL          = $ACL;
        $this->promoters    = $promoters;
    }

    /**
     * PromotersController getIndex
     * Function to list the promoters and send to view
     *
     * @return $this
     */
    public function getIndex()
    {
        // Call function to verify the user permission to access this method
        // If the user does not have permission, he/she will be redirected to last parameter
        $this->ACL->verifyPermission('promoters', ['You do not have permission for access Promoters\' page.'], route('home'));

        // Select on promoters table through the model
        $promoters = $this->promoters->orderBy('name', 'ASC')
            ->addSelect('promotersId')
            ->addSelect('name')
            ->addSelect('email')
            ->get();

        // Call the view passing the query result above
        return view('promoters.index')->with(compact('promoters'));
    }

    /**
     * PromotersController getAdd
     * Function to list the form to add new promoters
     *
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAdd()
    {
        // Call function to verify the user permission to access this method
        // In this case we have to inform the action as 4th parameter (Options: [add, edit, delete, or null])
        // NULL means the user will not be able to access the page in any circumstances
        // If the user does not have permission, he/she will be redirected to last parameter
        $this->ACL->verifyPermission('promoters', ['You do not have permission to add a new promoter.'], route('promoters'), 'add');

        // Call the view
        return view('promoters.add');
    }

    /**
     * PromotersController postAdd
     * Function to get the post, validate the fields, and save new promoters on database
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
        $this->ACL->verifyPermission('promoters', ['You do not have permission to add a new promoter.'], route('promoters'), 'add');

        // Call a back-end validate method
        $this->validate($request, [
            'name'      => 'required|max:100',
            'email'     => 'required|email|max:100|unique:promoters',
            'phone'     => 'required|max:20|unique:promoters',
            'cellphone' => 'max:20',
            'address'   => 'max:255',
            'city'      => 'max:100',
            'state'     => 'max:2',
            'country'   => 'required|max:100',
            'zipcode'   => 'max:10',
            'sponsor'   => 'required|max:100'
        ]);

        // Sets the new promoter as new model object
        // Then sets the values according the columns on database
        $promoter = new Promoters();
        $promoter->name         = $request->name;
        $promoter->email        = $request->email;
        $promoter->phone        = $request->phone;
        $promoter->cellphone    = $request->cellphone;
        $promoter->address      = $request->address;
        $promoter->city         = $request->city;
        $promoter->state        = $request->state;
        $promoter->country      = $request->country;
        $promoter->zipcode      = $request->zipcode;
        $promoter->sponsor      = $request->sponsor;

        // Saving the new user
        $promoter->save();

        // Create a success message variable
        $success = "Promoter created successfully";

        // Call the view passing the success message
        return redirect(route('promoters'))->with(compact('success'));
    }

    /**
     * PromotersController getEdit
     * Function to list the specific promoter data to form
     *
     * @param $promotersId
     * @return $this
     */
    public function getEdit($promotersId)
    {
        // Call function to verify the user permission to access this method
        // In this case we have to inform the action as 4th parameter (Options: [add, edit, delete, or null])
        // NULL means the user will not be able to access the page in any circumstances
        // If the user does not have permission, he/she will be redirected to last parameter
        $this->ACL->verifyPermission('promoters', ['You do not have permission to edit promoters.'], route('promoters'), 'edit');

        // Select the specific promoter according the primary key passed by get
        $promoter = $this->promoters->where('promotersId', '=', $promotersId)->first();

        // Call the view passing the query result above
        return view('promoters.edit')->with(compact('promoter'));
    }

    /**
     * PromotersController putEdit
     * Function to get the post, validate the fields, and save on database the new values of a specific promoter
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
        $this->ACL->verifyPermission('promoters', ['You do not have permission to edit promoters.'], route('promoters'), 'edit');

        // Call a back-end validate method
        $this->validate($request, [
            'name'      => 'required|max:100',
            'email'     => 'required|email|max:100',
            'phone'     => 'required|max:20',
            'cellphone' => 'max:20',
            'address'   => 'max:255',
            'city'      => 'max:100',
            'state'     => 'max:2',
            'country'   => 'required|max:100',
            'zipcode'   => 'max:10',
            'sponsor'   => 'required|max:100'
        ]);

        // Sets the new promoter as new model object
        // Then sets the values according the columns on database
        $promoter = $this->promoters->find($request->promotersId);
        $promoter->name         = $request->name;
        $promoter->email        = $request->email;
        $promoter->phone        = $request->phone;
        $promoter->cellphone    = $request->cellphone;
        $promoter->address      = $request->address;
        $promoter->city         = $request->city;
        $promoter->state        = $request->state;
        $promoter->country      = $request->country;
        $promoter->zipcode      = $request->zipcode;
        $promoter->sponsor      = $request->sponsor;

        // Call the function to consult if this email already exists on database
        $this->promoters->consultExists('email', $request->email, $request->promotersId);

        // Call the function to consult if this phone number already exists on database
        $this->promoters->consultExists('phone', $request->phone, $request->promotersId);

        // Save the promoter with new values above
        $promoter->save();

        // Create a success message variable
        $success = "Promoter updated successfully";

        // Call the view passing the success message
        return redirect(route('promoters'))->with(compact('success'));
    }

    /**
     * PromotersController delete
     * Function to delete a specific promoter
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
        $this->ACL->verifyPermission('promoters', ['You do not have permission to delete promoters.'], route('promoters'), 'delete');

        // Select and DELETE the specific promoter according the primary key passed by get
        $this->promoters->find($request->promotersId)->delete();

        // Create a success message variable
        $success = "Promoter deleted successfully";

        // Call the view passing the success message
        return redirect(route('promoters'))->with(compact('success'));
    }
}