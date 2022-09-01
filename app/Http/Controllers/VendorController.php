<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\VendorContract;
use App\Http\Controllers\BaseController;

class VendorController extends BaseController
{
    /**
     * @var BrandContract
     */
    protected $vendorRepository;

    /**
     * CategoryController constructor.
     * @param BrandContract $brandRepository
     */
    public function __construct(VendorContract $vendorRepository)
    {
        $this->vendorRepository = $vendorRepository;
    }

    public function index()
    {
        $vendors = $this->vendorRepository->listVendors();
    
        $this->setPageTitle('Vendors', 'List of all Vendors');
        return view('vendors.index', compact('vendors'));
    }

    public function create()
    {
    $this->setPageTitle('Vendors', 'Create Vendor');
    return view('vendors.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      =>  'required|max:191',
            'image'     =>  'mimes:jpg,jpeg,png|max:1000'
        ]);
    
        $params = $request->except('_token');
    
        $brand = $this->vendorRepository->createVendor($params);
    
        if (!$brand) {
            return $this->responseRedirectBack('Error occurred while creating vendor.', 'error', true, true);
        }
        //return $this->responseRedirect('vendors.index', 'Vendor added successfully' ,'success',false, false);

        return $this->responseRedirect('vendors.index', 'Vendor added successfully' ,'success',false, false);
    }

    public function edit($id)
    {
        $brand = $this->vendorRepository->findVendorById($id);
    
        $this->setPageTitle('Brands', 'Edit Brand : '.$brand->name);
        return view('vendors.edit', compact('brand'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name'      =>  'required|max:191',
            'image'     =>  'mimes:jpg,jpeg,png|max:1000'
        ]);
    
        $params = $request->except('_token');
    
        $brand = $this->vendorRepository->updateVendor($params);
    
        if (!$brand) {
            return $this->responseRedirectBack('Error occurred while updating brand.', 'error', true, true);
        }
        return $this->responseRedirectBack('Brand updated successfully' ,'success',false, false);
    }
    public function delete($id)
    {
        $vendor = $this->vendorRepository->deleteVendor($id);
    
        if (!$vendor) {
            echo 'not done error !!!';
           // return $this->responseRedirectBack('Error occurred while deleting brand.', 'error', true, true);
        }
        //return $this->responseRedirect('vendors.index', 'Brand deleted successfully' ,'success',false, false);
        return $this->responseRedirect('vendors.index', 'Vendor added successfully' ,'success',false, false);
        //echo 'file not found';
    }
}