<?php


namespace App\Http\Controllers;

use App\ACL;
use App\Helpers\DataTables;
use Illuminate\Http\Request;

use App\Losses;
use App\Products;

class LossesController extends Controller
{
    // Create the variables to ACL and all helpers and models that we will use in this controller
    protected $ACL;
    protected $dataTables;
    protected $losses;
    protected $products;

    protected $types = ['Loss', 'External Reversal', 'Consumption'];

    /**
     * LossesController constructor.
     * Basic constructor function of controller
     *
     * @param DataTables $dataTables
     * @param ACL $ACL
     * @param Losses $losses
     * @param Products $products
     */
    public function __construct(ACL $ACL, DataTables $dataTables, Losses $losses, Products $products)
    {
        $this->ACL        = $ACL;
        $this->dataTables = $dataTables;
        $this->losses     = $losses;
        $this->products   = $products;
    }

    /**
     * LossesController getIndex
     * Function to list the losses and send to view
     *
     * @return $this
     */
    public function getIndex()
    {
        // Call function to verify the user permission to access this method
        // If the user does not have permission, he/she will be redirected to last parameter
        $this->ACL->verifyPermission('losses', ['You do not have permission for access Losses\' page.'], route('home'));

        // Select on losses table through the model
        $losses = $this->losses->with(['product', 'product.category'])->get();
        // Call the view passing the query result above
        return view('losses.index')->with(compact('losses'));
    }

    /**
     * LossesController getAddStepOne
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
        $this->ACL->verifyPermission('losses', ['You do not have permission for add new losses.'], route('home'), 'add');

        // Call the view passing the query result above
        return view('losses.addStepOne');
    }

    /**
     * LossesController postListProducts
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
        $this->ACL->verifyPermission('losses', ['You do not have permission for add new losses.'], route('home'), 'add');

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
            $row[4] = "<div class='text-center'>".view('losses.buttons')->with(compact('row'))->render()."</div>";
        }

        return json_encode($dataTables);
    }

    /**
     * LossesController getAddStepTwo
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
        $this->ACL->verifyPermission('losses', ['You do not have permission for access Losses\' page.'], route('home'), 'add');

        // Get product information through id passed by get
        $product = $this->products->with('category')->find($productsId);

        $types = ['' => 'Choose...'];
        foreach ($this->types as $type){
            $types[$type] = $type;
        }

        // Call the view passing the query result above
       # dd($product);

        return view('losses.addStepTwo')->with(compact('product', 'types'));
    }

    /**
     * TypeCustomersController postAdd
     * Function to get the post, validate the fields, and save new losses on database
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
        $this->ACL->verifyPermission('losses', ['You do not have permission for access Losses\' page.'], route('home'), 'add');







        // Call a back-end validate method
        $this->validate($request, [
            'productsId'    => 'required',
            'loss' => 'required|numeric|max:0',
            'type'          => 'required',
            'description'   => 'required|max:200'
        ]);


        $finalQuantity = addLosses($request->quantity,$request->loss);



        // Sets the new loss as new model object
        // Then sets the values according the columns on database
        $losses = new $this->losses();
        $losses->productsId     = $request->productsId;
        $losses->quantity       = (!empty($request->quantity)) ? $request->quantity : 0;
        $losses->loss           = $request->loss;
        $losses->finalQuantity  = $finalQuantity;
        $losses->type           = $request->type;
        $losses->description    = $request->description;

        // Save the loss with new values above
        $losses->save();

        // Create a success message variable
        $success = "Loss saved successfully";

        // Call the view passing the success message
        return redirect(route('losses'))->with(compact('success'));
    }

    public function getView($lossesId)
    {
        // Call function to verify the user permission to access this method
        // In this case we have to inform the action as 4th parameter (Options: [add, edit, delete, or null])
        // NULL means the user will not be able to access the page in any circumstances
        // If the user does not have permission, he/she will be redirected to last parameter
        $this->ACL->verifyPermission('losses', ['You do not have permission for access Losses\' page.'], route('home'));

        // Select the specific loss according the primary key passed by get
        $losses = Losses::with('product')->find($lossesId);

        return view('losses.view')->with(compact('losses'));
    }
}
