<?php

namespace App\Http\Controllers;


use App\Customer;
use App\Product_Keluar;
use App\Exports\ExportCustomers;
use App\Imports\CustomersImport;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Excel;
use PDF;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin,pemilik,manajer');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();
        return view('gudang.customers.index');
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama'      => 'required',
            'alamat'    => 'required',
            'telepon'   => 'required',
        ]);

        $input = $request->all();
        // $input['image'] = null;

        if ($request->hasFile('image')){
            $input['image'] = '/upload/pembeli/'.str_slug($input['nama'], '-').'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('/upload/pembeli/'), $input['image']);
        }

        Customer::create($input);

        return response()->json([
            'success'    => true,
            'message'    => 'Pembeli Ditambah'
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      
        $customer = Customer::find($id);

        $productout = Product_Keluar::orderBy('tanggal','DSC')
            ->where('customer_id', $id)
            ->get();

        return view('gudang.customers.detail', compact('customer','productout'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::find($id);
        return $customer;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama'      => 'required|string',
            'alamat'    => 'required',
            'telepon'   => 'required',
        ]);
        $input = $request->all();
        $customer = Customer::findOrFail($id);

        $input['image'] = $customer->image;

        if ($request->hasFile('image')){
            if (!$customer->image == NULL){
                unlink(public_path($customer->image));
            }
            $input['image'] = '/upload/pembeli/'.str_slug($input['nama'], '-').'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('/upload/pembeli/'), $input['image']);
        }

        $customer->update($input);

        return response()->json([
            'success'    => true,
            'message'    => 'Pembeli Diubah'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);

        if (!$customer->image == NULL){
            unlink(public_path($customer->image));
        }

        Customer::destroy($id);


        return response()->json([
            'success'    => true,
            'message'    => 'Pembeli Dihapus'
        ]);
    }

    public function apiCustomers()
    {
        $id = Auth::id();
        $customer = Customer::all()->where('user_id', $id);

        return Datatables::of($customer)
            ->addColumn('show_photo', function($customer){
                if ($customer->image == NULL){
                    return 'No Image';
                }
                return '<img class="rounded-square" width="50" height="50" src="'. url($customer->image) .'" alt="">';
            })
            ->addColumn('action', function($customer){
                return 
                
                    '<a href="/pembeli/detail/'.$customer->id.'" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i> Detail</a> ' .
                    '<a onclick="editForm('. $customer->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Ubah</a> ' .
                    '<a onclick="deleteData('. $customer->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Hapus</a>';
            })
            ->rawColumns(['show_photo','action'])->make(true);
    }

    public function ImportExcel(Request $request)
    {
        //Validasi
        $this->validate($request, [
            'file' => 'required|mimes:xls,xlsx'
        ]);

        if ($request->hasFile('file')) {
            //UPLOAD FILE
            $file = $request->file('file'); //GET FILE
            Excel::import(new CustomersImport, $file); //IMPORT FILE
            return redirect()->back()->with(['success' => 'Upload file data customers !']);
        }

        return redirect()->back()->with(['error' => 'Please choose file before!']);
    }


    public function exportCustomersAll()
    {
        $customers = Customer::all();
        $pdf = PDF::loadView('customers.CustomersAllPDF',compact('customers'));
        return $pdf->download('customers.pdf');
    }

    public function exportExcel()
    {
        return (new ExportCustomers)->download('customers.xlsx');
    }
}
