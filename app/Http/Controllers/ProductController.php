<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\CategoryContract;
use App\Contracts\VendorContract;
use App\Contracts\ProductContract;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Storage;
//use App\Http\Requests\StoreProductFormRequest;

class ProductController extends BaseController
{
    protected $vendorRepository;

    protected $categoryRepository;

    protected $productRepository;

    public function __construct(
        VendorContract $vendorRepository,
        CategoryContract $categoryRepository,
        ProductContract $productRepository
    )
    {
        $this->vendorRepository = $vendorRepository;
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
    }

    public function index()
    {
    $path = Storage::path('OLfhVlnSZd9jyaCbX70W88j2X.jpg');
    $products = $this->productRepository->listProducts();

    $this->setPageTitle('Products', 'Products List');
    return view('products.index', compact('products', 'path'));
    }

    public function create()
    {
    $vendors = $this->vendorRepository->listVendors('name', 'asc');
    $categories = $this->categoryRepository->listCategories('name', 'asc');

    $this->setPageTitle('Products', 'Create Product');
    return view('products.create', compact('categories', 'vendors'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      =>  'required|max:191',
            'vendor_id' =>  'required|not_in:0',
            'image'     =>  'mimes:jpg,jpeg,png|max:1000',
            'sku'       =>  'required|max:191'
        ]);

    $params = $request->except('_token');

    $product = $this->productRepository->createProduct($params);

   // return $product;

    if (!$product) {
        return $this->responseRedirectBack('Error occurred while creating product.', 'error', true, true);
    }
    return $this->responseRedirect('products.index', 'Product added successfully' ,'success',false, false);
   }

   public function edit($id)
    {
    $product = $this->productRepository->findProductById($id);
    $vendors = $this->vendorRepository->listVendors('name', 'asc');
    $categories = $this->categoryRepository->listCategories('name', 'asc');

    $this->setPageTitle('Products', 'Edit Product');
    return view('products.edit', compact('categories', 'vendors', 'product'));
    }

    public function update(Request $request)
{
    $params = $request->except('_token');

    $product = $this->productRepository->updateProduct($params);

    if (!$product) {
        return $this->responseRedirectBack('Error occurred while updating product.', 'error', true, true);
    }
    return $this->responseRedirect('products.index', 'Product updated successfully' ,'success',false, false);
}
}
