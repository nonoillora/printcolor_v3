<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use App\CompanyShipping;

class CompanyShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('administracion/company_shipping/list_company', ['title' => 'Compañias de transporte', 'empresas' => DB::table('company_shippings')->where('company_is_active',1)->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function saveCompanyShipping(Request $request)
    {
        $dataCompany = array('name_company' => $request->get('name_company'),
            'address' => $request->get('address'),
            'phone' => $request->get('phone'),
            'url_company' => $request->get('url_company'),
            'url_follow_package' => $request->get('url_follow_package'));
        $shipping = new CompanyShipping($dataCompany);
        $status = $shipping->save();
        return response()->json(['status' => $status]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function updateCompanyShipping(Request $request)
    {

        $company = CompanyShipping::find($request->get('idCompany'));
        $company->name_company = $request->get('name_company');
        $company->address = $request->get('address');
        $company->phone = $request->get('phone');
        $company->url_company = $request->get('url_company');
        $company->url_follow_package = $request->get('url_follow_package');
        $status=$company->save();
        return response()->json(['status'=>$status, 'company'=>$company]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function deleteCompany(Request $request)
    {
        $company = CompanyShipping::find($request->get('id'));
        $company->company_shipping_deleted_at = Carbon::now('Europe/Madrid');
        $company->company_is_active = 0;
        $status=$company->save();
        return response()->json(['status'=>$status]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
