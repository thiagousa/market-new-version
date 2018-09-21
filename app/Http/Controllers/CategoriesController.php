<?php

namespace App\Http\Controllers;

use App\ACL;
use Illuminate\Http\Request;

use App\Categories;

class CategoriesController extends Controller
{
    // Create the variables to ACL and all models that we will use in this controller
    protected $ACL;
    protected $categories;

    /**
     * CategoriesController constructor.
     * Basic constructor function of controller
     *
     * @param ACL $ACL
     * @param Categories $categories
     */
    public function __construct(ACL $ACL, Categories $categories)
    {
        $this->ACL          = $ACL;
        $this->categories   = $categories;
    }

    /**
     * CategoriesController getIndex
     * Function to list categories and send to view
     *
     * @return $this
     */
    public function getIndex()
    {
        // Call function to verify the user permission to access this method
        // If the user does not have permission, he/she will be redirected to last parameter
        $this->ACL->verifyPermission('categories', ['You do not have permission for access Categories\' page.'], route('home'));

        // Select on categories table through the model
        $categories = $this->categories->orderBy('name', 'ASC')->get();

        foreach ($categories as $category){
            $category->tax = number_format($category->tax, 2);
        }

        // Call the view passing the query result above
        return view('categories.index')->with(compact('categories'));
    }

    /**
     * CategoriesController getAdd
     * Function to list the form to add new categories
     *
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAdd()
    {
        // Call function to verify the user permission to access this method
        // In this case we have to inform the action as 4th parameter (Options: [add, edit, delete, or null])
        // NULL means the user will not be able to access the page in any circumstances
        // If the user does not have permission, he/she will be redirected to last parameter
        $this->ACL->verifyPermission('categories', ['You do not have permission to add a new category.'], route('categories'), 'add');

        // Call the view
        return view('categories.add');
    }

    /**
     * CategoriesController postAdd
     * Function to get the post, validate the fields, and save new categories on database
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
        $this->ACL->verifyPermission('categories', ['You do not have permission to add a new category.'], route('categories'), 'add');

        // Call a back-end validate method
        $this->validate($request, [
            'name'  => 'required|max:100|unique:categories',
            'tax'   => 'required|max:5|min:4'
        ]);

        // Sets the new category as new model object
        // Then sets the values according the columns on database
        $category = new Categories();
        $category->name = $request->name;
        $category->tax  = $request->tax;

        // Saving the new category
        $category->save();

        // Create a success message variable
        $success = "Category created successfully";

        // Call the view passing the success message
        return redirect(route('categories'))->with(compact('success'));
    }

    /**
     * CategoriesController getEdit
     * Function to list the specific category data to form
     *
     * @param $categoriesId
     * @return $this
     */
    public function getEdit($categoriesId)
    {
        // Call function to verify the user permission to access this method
        // In this case we have to inform the action as 4th parameter (Options: [add, edit, delete, or null])
        // NULL means the user will not be able to access the page in any circumstances
        // If the user does not have permission, he/she will be redirected to last parameter
        $this->ACL->verifyPermission('categories', ['You do not have permission to edit categories.'], route('categories'), 'edit');

        // Select the specific category according the primary key passed by get
        $category = $this->categories->find($categoriesId);

        $category->tax = number_format($category->tax, 2);

        // Call the view passing the query result above
        return view('categories.edit')->with(compact('category'));
    }

    /**
     * CategoriesController putEdit
     * Function to get the post, validate the fields, and save on database the new values of a specific category
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
        $this->ACL->verifyPermission('categories', ['You do not have permission to edit categories.'], route('categories'), 'edit');

        // Call a back-end validate method
        $this->validate($request, [
            'name'  => 'required|max:100|unique:categories,name,'.$request->categoriesId.',categoriesId',
            'tax'   => 'required|max:5|min:4'
        ]);

        // Sets the new category as new model object
        // Then sets the values according the columns on database
        $category = $this->categories->find($request->categoriesId);
        $category->name = $request->name;
        $category->tax  = $request->tax;

        // Save the category with new values above
        $category->save();

        // Create a success message variable
        $success = "Category updated successfully";

        // Call the view passing the success message
        return redirect(route('categories'))->with(compact('success'));
    }

    /**
     * CategoriesController delete
     * Function to delete a specific category
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
        $this->ACL->verifyPermission('categories', ['You do not have permission to delete categories.'], route('categories'), 'delete');

        // Select and DELETE the specific category according the primary key passed by get
        $this->categories->find($request->categoriesId)->delete();

        // Create a success message variable
        $success = "Category deleted successfully";

        // Call the view passing the success message
        return redirect(route('categories'))->with(compact('success'));
    }
}
