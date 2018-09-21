<?php
namespace App\Http\Controllers;

use App\ACL;
use Illuminate\Http\Request;

use App\Orders;
use App\Promoters;
use App\Products;

class OrdersController extends Controller
{
    // Create the variables to ACL and all helpers and models that we will use in this controller
    protected $ACL;
    protected $orders;
    protected $promoters;
    protected $products;

    protected $status = ['Requested', 'Done', 'Received', 'Cancelled'];

    /**
     * OrdersController constructor.
     * Basic constructor function of controller
     *
     * @param ACL $ACL
     * @param Orders $orders
     * @param Promoters $promoters
     * @param Products $products
     */
    public function __construct(ACL $ACL, Orders $orders, Promoters $promoters, Products $products)
    {
        $this->ACL        = $ACL;
        $this->orders     = $orders;
        $this->promoters  = $promoters;
        $this->products   = $products;
    }

    /**
     * OrdersController getIndex
     * Function to list the orders and send to view
     *
     * @return $this
     */
    public function getIndex()
    {
        // Call function to verify the user permission to access this method
        // If the user does not have permission, he/she will be redirected to last parameter
        $this->ACL->verifyPermission('orders', ['You do not have permission for access Orders\' page.'], route('home'));

        $orders = $this->orders->with('promoter')->get();

        // Call the view passing the query result above
        return view('orders.index')->with(compact('orders'));
    }
    /**
     * OrdersController getAdd
     * Function to call a view to add new order
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAdd()
    {
        // Call function to verify the user permission to access this method
        // In this case we have to inform the action as 4th parameter (Options: [add, edit, delete, or null])
        // NULL means the user will not be able to access the page in any circumstances
        // If the user does not have permission, he/she will be redirected to last parameter
        $this->ACL->verifyPermission('orders', ['You do not have permission for add new orders.'], route('orders'), 'add');

        $promotersConsult = $this->promoters->orderBy('name', 'asc')->get();
        $promoters = ['' => 'Choose...'];
        foreach ($promotersConsult as $result){
            $promoters[$result->promotersId] = $result->name;
        }

        $productsConsult = $this->products->orderBy('shortName', 'asc')->get();
        $products = ['' => 'Choose...'];
        foreach ($productsConsult as $result){
            $products[$result->productsId] = $result->shortName;
        }

        $statusConsult = Orders::$status;
        $status = ['' => 'Choose...'];
        foreach ($statusConsult as $key => $result){
            $status[$key] = $result;
        }

        // Call the view passing the query result above
        return view('orders.add')->with(compact('promoters', 'products', 'status'));
    }

    /**
     * TypeCustomersController postAdd
     * Function to get the post, validate the fields, and save new orders on database
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
        $this->ACL->verifyPermission('orders', ['You do not have permission for access Orders\' page.'], route('home'), 'add');

        // Call a back-end validate method
        $this->validate($request, [
            'productsId'    => 'required',
            'finalQuantity' => 'required|numeric',
            'status'        => 'required',
            'description'   => 'required|max:200'
        ]);

        // Sets the new order as new model object
        // Then sets the values according the columns on database
        $orders = new $this->orders();
        $orders->productsId     = $request->productsId;
        $orders->quantity       = (!empty($request->quantity)) ? $request->quantity : 0;
        $orders->finalQuantity  = $request->finalQuantity;
        $orders->status         = $request->status;
        $orders->description    = $request->description;

        // Save the order with new values above
        $orders->save();

        // Create a success message variable
        $success = "Loss saved successfully";

        // Call the view passing the success message
        return redirect(route('orders'))->with(compact('success'));
    }

    public function getView($ordersId)
    {
        // Call function to verify the user permission to access this method
        // In this case we have to inform the action as 4th parameter (Options: [add, edit, delete, or null])
        // NULL means the user will not be able to access the page in any circumstances
        // If the user does not have permission, he/she will be redirected to last parameter
        $this->ACL->verifyPermission('orders', ['You do not have permission for access Orders\' page.'], route('home'));

        // Select the specific order according the primary key passed by get
        $order = $this->orders->with(['promoter', 'products', 'products.product'])->find($ordersId);

        // Call the view passing the query result above
        return view('orders.view')->with(compact('order'));
    }
}
