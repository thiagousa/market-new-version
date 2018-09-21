<?php


namespace App\Http\Controllers;

use App\ACL;
use App\Helpers\DataTables;
use Illuminate\Http\Request;

use App\Inventories;
use App\Products;

class InventoriesController extends Controller
{
    // Create the variables to ACL and all helpers and models that we will use in this controller
    protected $ACL;
    protected $dataTables;
    protected $inventories;
    protected $products;


    /**
     * InventoriesController constructor.
     * Basic constructor function of controller
     *
     * @param DataTables $dataTables
     * @param ACL $ACL
     * @param Inventories $inventories
     * @param Products $products
     */
    public function __construct(ACL $ACL, DataTables $dataTables, Inventories $inventories, Products $products)
    {
        $this->ACL        = $ACL;
        $this->dataTables = $dataTables;
        $this->inventories     = $inventories;
        $this->products   = $products;
    }

    /**
     * InventoriesController getIndex
     * Function to list the inventories and send to view
     *
     * @return $this
     */
    public function getIndex()
    {
        // Call function to verify the user permission to access this method
        // If the user does not have permission, he/she will be redirected to last parameter
        $this->ACL->verifyPermission('inventories', ['You do not have permission for access Inventories\' page.'], route('home'));

        // Select on inventories table through the model
        $inventories = $this->inventories->with('product')->get();

        // Call the view passing the query result above
        return view('inventories.index')->with(compact('inventories'));
    }

    /**
     * InventoriesController getAddStepOne
     * Function to call a view when the products list will be called
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAddStepOne()
    {
        // Call function to verify the user permission to access this method
        // In this case we have to inform the action as 4th parameter (Options: [add, edit, delete, or null])
        // NULL means the user will not be able to access the page in any circumstances
        // If the user does not have permission, he/she will be redirected to last parameter
        $this->ACL->verifyPermission('inventories', ['You do not have permission for add new inventories.'], route('home'), 'add');

        // Call the view passing the query result above
        return view('inventories.addStepOne');
    }

    /**
     * InventoriesController postListProducts
     * Function to list products by ajax call
     *
     * @param Request $request
     * @return string
     * @throws \Throwable
     */
    public function postListProducts(Request $request)
    {
        // Call function to verify the user permission to access this method
        // In this case we have to inform the action as 4th parameter (Options: [add, edit, delete, or null])
        // NULL means the user will not be able to access the page in any circumstances
        // If the user does not have permission, he/she will be redirected to last parameter
        $this->ACL->verifyPermission('inventories', ['You do not have permission for add new inventories.'], route('home'), 'add');

        $columns = ['productsId', 'shortName', 'description', 'category', 'salePrice'];

        $search = $request->search['value'];

        $limit = $request->length;
        $offset = $request->start;
        $orderBy = [
            $request->order[0]['column'],
            $request->order[0]['dir']
        ];

        $dataTables = $this->dataTables->getDataTableData($this->products, $columns, $orderBy, $search, $limit, $offset, ['productsId', 'category', 'salePrice'], [['methodName' => 'category', 'columns' => ['name'], 'noSearch' => []]], $request);

        foreach ($dataTables['data'] as $k => &$row)
        {
            $row[1] = !empty($row[1]) ? $row[1] : $row[2];
            $row[2] = $row[3]['name'];
            $row[3] = "$".number_format($row[4], 2);
            $row[4] = "<div class='text-center'>".view('inventories.buttons')->with(compact('row'))->render()."</div>";
        }

        return json_encode($dataTables);
    }

    /**
     * InventoriesController getAddStepTwo
     * Function to call a view when the products list will be called
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAddStepTwo($productsId)
    {
        // Call function to verify the user permission to access this method
        // In this case we have to inform the action as 4th parameter (Options: [add, edit, delete, or null])
        // NULL means the user will not be able to access the page in any circumstances
        // If the user does not have permission, he/she will be redirected to last parameter
        $this->ACL->verifyPermission('inventories', ['You do not have permission for access Inventories\' page.'], route('home'), 'add');

        // Get product information through id passed by get
        $product = $this->products->with('category')->find($productsId);

        // Call the view passing the query result above
        #dd($product);


        return view('inventories.addStepTwo')->with(compact('product', 'types'));
    }

    /**
     * TypeCustomersController postAdd
     * Function to get the post, validate the fields, and save new inventories on database
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
        $this->ACL->verifyPermission('inventories', ['You do not have permission for access Inventories\' page.'], route('home'), 'add');

        // Call a back-end validate method

            $this->validate($request, [
            'productsId'    => 'required',
            'costPrice' => 'required|numeric|min:0',
            'salePrice' => 'required|numeric|min:0',
            'min' => 'required|numeric|min:0',
            'max' => 'required|numeric|min:0',
            'discountMoney' => 'required|numeric|min:0',
            'discount' => 'required|numeric|min:0',
            'finalQuantity' => 'required|numeric|min:0',
            'description'   => 'required|max:200'
        ]);

        // Sets the new inventory as new model object
        // Then sets the values according the columns on database
        $inventories = new $this->inventories();
        $inventories->productsId     = $request->productsId;
        $inventories->costPrice      = $request->costPrice;
        $inventories->salePrice      = $request->salePrice;
        $inventories->min            = $request->min;
        $inventories->max            = $request->max ;
        $inventories->discountMoney  = $request->discountMoney;
        $inventories->discount       = $request->discount;
        $inventories->quantity          = $request->finalQuantity;
        $inventories->costPriceOld      = (!empty($request->costPriceOld)) ? $request->costPriceOld : 0;
        $inventories->salePriceOld      = (!empty($request->salePriceOld)) ? $request->salePriceOld: 0;
        $inventories->quantityOld       =  (!empty($request->quantityOld)) ? $request->quantityOld : 0;
        $inventories->minOld            = (!empty($request->minOld)) ? $request->minOld : 0;
        $inventories->maxOld            = (!empty($request->maxOld)) ? $request->maxOld : 0;
        $inventories->discountMoneyOld  = (!empty($request->discountMoneyOld)) ? $request->discountMoneyOld : 0;
        $inventories->discountOld       = (!empty($request->discountOld)) ? $request->discountOld : 0;
        $inventories->description    = $request->description;

        // Save the inventory with new values above
        $inventories->save();

        // Create a success message variable
        $success = "inventory saved successfully";

        // Call the view passing the success message
        return redirect(route('inventories'))->with(compact('success'));
    }

    public function getView($inventoriesId)
    {
        // Call function to verify the user permission to access this method
        // In this case we have to inform the action as 4th parameter (Options: [add, edit, delete, or null])
        // NULL means the user will not be able to access the page in any circumstances
        // If the user does not have permission, he/she will be redirected to last parameter
        $this->ACL->verifyPermission('inventories', ['You do not have permission for access Inventories\' page.'], route('home'));

        // Select the specific inventory according the primary key passed by get
        $inventories = Inventories::with('product')->find($inventoriesId);
        #dd($inventories);
        return view('inventories.view')->with(compact('inventories'));
    }
}
