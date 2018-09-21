<?php

namespace App\Http\Controllers;

use App\ACL;
use App\Helpers\DataTables;
use Illuminate\Http\Request;

use App\Categories;
use App\Products;

class ProductsController extends Controller
{
    // Create the variables to ACL and all models that we will use in this controller
    protected $ACL;
    protected $dataTables;
    protected $categories;
    protected $products;

    /**
     * productsController constructor.
     * Basic constructor function of controller
     *
     * @param ACL $ACL
     * @param products $products
     */
    public function __construct(ACL $ACL, DataTables $dataTables, Categories $categories, Products $products)
    {
        $this->ACL        = $ACL;
        $this->dataTables = $dataTables;
        $this->categories = $categories;
        $this->products   = $products;
    }

    /**
     * productsController getIndex
     * Function to open index view
     *
     * @return $this
     */
    public function getIndex()
    {
        // Call function to verify the user permission to access this method
        // If the user does not have permission, he/she will be redirected to last parameter
        $this->ACL->verifyPermission('products', ['You do not have permission for access products\' page.'], route('home'));

        // Call the view passing the query result above
        return view('products.index');
    }

    /**
     * productsController postIndex
     * Function to list products by ajax call
     *
     * @param Request $request
     * @return string
     * @throws \Throwable
     */
    public function postIndex(Request $request)
    {
        // Call function to verify the user permission to access this method
        // If the user does not have permission, he/she will be redirected to last parameter
        $this->ACL->verifyPermission('products', ['You do not have permission for access products\' page.'], route('home'));

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
            $row[4] = "<div class='text-center'>".view('products.buttons')->with(compact('row'))->render()."</div>";
        }

        return json_encode($dataTables);
    }

    /**
     * productsController getAdd
     * Function to list the form to add new products
     *
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAdd()
    {
        // Call function to verify the user permission to access this method
        // In this case we have to inform the action as 4th parameter (Options: [add, edit, delete, or null])
        // NULL means the user will not be able to access the page in any circumstances
        // If the user does not have permission, he/she will be redirected to last parameter
        $this->ACL->verifyPermission('products', ['You do not have permission to add a new product.'], route('products'), 'add');

        // Mounting categories array to feed the select on view page
        $categories = ['' => 'Choose...'];
        $categoriesTax = [];
        $categoriesConsult = $this->categories->orderBy('name', 'asc')->get();
        foreach ($categoriesConsult as $typeCustomer) {
            $categories[$typeCustomer['categoriesId']] = $typeCustomer['name'];
            $categoriesTax[$typeCustomer['categoriesId']] = number_format($typeCustomer['tax'], 2);
        }

        $categoriesTax = json_encode($categoriesTax);

        // Call the view
        return view('products.add')->with(compact('categories', 'categoriesTax'));
    }

    /**
     * productsController postAdd
     * Function to get the post, validate the fields, and save new products on database
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
        $this->ACL->verifyPermission('products', ['You do not have permission to add a new product.'], route('products'), 'add');

        // Call a back-end validate method
        $this->validate($request, [
            'description'   => 'required|max:70|unique:products',
            'shortName'     => 'required|max:50|unique:products',
            'code'          => 'required|max:30|unique:products',
            'brand'         => 'required|max:50',
            'categoriesId'  => 'required',
            'costPrice'     => 'required|max:10',
            'salePrice'     => 'required|max:10',
            'codeBalance'   => 'max:12|unique:products',
            'codeBegin'     => 'max:2',
            'codeEnd'       => 'max:2',
            'priceBegin'    => 'max:2',
            'priceEnd'      => 'max:2',
            'min'           => 'required|max:8',
            'max'           => 'required|max:8',
            'discountMoney' => 'required|max:6',
            'discount'      => 'required|max:5'
        ]);

        // Verify if the code balance is null and give the null value
        // to the others related fields
        if($request->codeBalance == ""){
            $request->codeBalance   = null;
            $request->codeBegin     = null;
            $request->codeEnd       = null;
            $request->priceBegin    = null;
            $request->priceEnd      = null;
        }

        // Sets the new product as new model object
        // Then sets the values according the columns on database
        $product = new Products();
        $product->description   = $request->description;
        $product->shortName     = $request->shortName;
        $product->code          = $request->code;
        $product->brand         = $request->brand;
        $product->categoriesId  = $request->categoriesId;
        $product->shortName     = $request->shortName;
        $product->costPrice     = $request->costPrice;
        $product->salePrice     = $request->salePrice;
        $product->quantity      = null;
        $product->codeBalance   = $request->codeBalance;
        $product->codeBegin     = $request->codeBegin;
        $product->codeEnd       = $request->codeEnd;
        $product->priceBegin    = $request->priceBegin;
        $product->priceEnd      = $request->priceEnd;
        $product->min           = $request->min;
        $product->max           = $request->max;
        $product->discountMoney = $request->discountMoney;
        $product->discount      = $request->discount;

        // Saving the new user
        $product->save();

        // Create a success message variable
        $success = "Product created successfully";

        // Call the view passing the success message
        return redirect(route('products'))->with(compact('success'));
    }

    /**
     * productsController getEdit
     * Function to list the specific product data to form
     *
     * @param $productsId
     * @return $this
     */
    public function getEdit($productsId)
    {
        // Call function to verify the user permission to access this method
        // In this case we have to inform the action as 4th parameter (Options: [add, edit, delete, or null])
        // NULL means the user will not be able to access the page in any circumstances
        // If the user does not have permission, he/she will be redirected to last parameter
        $this->ACL->verifyPermission('products', ['You do not have permission to edit products.'], route('products'), 'edit');

        // Select the specific product according the primary key passed by get
        $product = $this->products->where('productsId', '=', $productsId)->first();

        // Applying the number format of currency and percentage fields
        $product->costPrice     = number_format($product->costPrice, 2);
        $product->salePrice     = number_format($product->salePrice, 2);
        $product->discountMoney = number_format($product->discountMoney, 2);
        $product->discount      = number_format($product->discount, 2);

        // Mounting categories array to feed the select on view page
        $categories = ['' => 'Choose...'];
        $categoriesTax = [];
        $categoriesConsult = $this->categories->orderBy('name', 'asc')->get();
        foreach ($categoriesConsult as $categoryConsult) {
            $categories[$categoryConsult['categoriesId']] = $categoryConsult['name'];
            $categoriesTax[$categoryConsult['categoriesId']] = number_format($categoryConsult['tax'], 2);
            // Set the product tax to show on view page
            if($categoryConsult['categoriesId'] == $product->categoriesId){
                $product->tax = number_format($categoryConsult['tax'], 2);
            }
        }

        $categoriesTax = json_encode($categoriesTax);

        // Call the view passing the query result above
        return view('products.edit')->with(compact('product', 'categories', 'categoriesTax'));
    }

    /**
     * productsController putEdit
     * Function to get the post, validate the fields, and save on database the new values of a specific product
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
        $this->ACL->verifyPermission('products', ['You do not have permission to edit products.'], route('products'), 'edit');

        // Call a back-end validate method
        $this->validate($request, [
            'description'   => 'required|max:70|unique:products,description,'.$request->productsId.',productsId',
            'shortName'     => 'required|max:50|unique:products,shortName,'.$request->productsId.',productsId',
            'code'          => 'required|max:30|unique:products,code,'.$request->productsId.',productsId',
            'brand'         => 'required|max:50',
            'categoriesId'  => 'required',
            'costPrice'     => 'required|max:10',
            'salePrice'     => 'required|max:10',
            'codeBalance'   => 'max:12|unique:products,codeBalance,'.$request->productsId.',productsId',
            'codeBegin'     => 'max:2',
            'codeEnd'       => 'max:2',
            'priceBegin'    => 'max:2',
            'priceEnd'      => 'max:2',
            'min'           => 'required|max:8',
            'max'           => 'required|max:8',
            'discountMoney' => 'required|max:6',
            'discount'      => 'required|max:5'
        ]);

        // Verify if the code balance is null and give the null value
        // to the others related fields
        if($request->codeBalance == ""){
            $request->codeBalance   = null;
            $request->codeBegin     = null;
            $request->codeEnd       = null;
            $request->priceBegin    = null;
            $request->priceEnd      = null;
        }

        // Sets the new product as new model object
        // Then sets the values according the columns on database
        $product = $this->products->find($request->productsId);
        $product->description   = $request->description;
        $product->shortName     = $request->shortName;
        $product->code          = $request->code;
        $product->brand         = $request->brand;
        $product->categoriesId  = $request->categoriesId;
        $product->shortName     = $request->shortName;
        $product->costPrice     = $request->costPrice;
        $product->salePrice     = $request->salePrice;
        $product->quantity      = null;
        $product->codeBalance   = $request->codeBalance;
        $product->codeBegin     = $request->codeBegin;
        $product->codeEnd       = $request->codeEnd;
        $product->priceBegin    = $request->priceBegin;
        $product->priceEnd      = $request->priceEnd;
        $product->min           = $request->min;
        $product->max           = $request->max;
        $product->discountMoney = $request->discountMoney;
        $product->discount      = $request->discount;

        // Save the product with new values above
        $product->save();

        // Create a success message variable
        $success = "product updated successfully";

        // Call the view passing the success message
        return redirect(route('products'))->with(compact('success'));
    }

    /**
     * productsController delete
     * Function to delete a specific product
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
        $this->ACL->verifyPermission('products', ['You do not have permission to delete products.'], route('products'), 'delete');

        // Select and DELETE the specific product according the primary key passed by get
        $this->products->find($request->productsId)->delete();

        // Create a success message variable
        $success = "product deleted successfully";

        // Call the view passing the success message
        return redirect(route('products'))->with(compact('success'));
    }
}
