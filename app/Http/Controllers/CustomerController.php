<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\FamilyList;
use App\Models\Nationality;
use DataTables;

class CustomerController extends Controller
{
    public function index(Request $request) {
        if ($request->ajax()) {
            $customers = Customer::all();

            return DataTables::of($customers)
                ->addColumn('action', function($row) {
                    $btns = '<a href="#" data-id="' . $row->cst_id . '" data-bs-toggle="modal" data-bs-target="#viewModal" data-original-title="View" class="btn btn-warning btn-sm viewCustomer"><i class="bi bi-eye"></i></i></a>';
                    $btns .= ' <a href="#" data-id="' . $row->cst_id . '" data-bs-toggle="modal" data-bs-target="#editModal"  data-original-title="Edit" class="btn btn-primary btn-sm editCustomer"><i class="bi bi-pencil-square"></i></i></a>';
                    // $btns = '<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#editProdukModal" data-id="' . $row->kode_produk . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct"><i class="fas fa-edit"></i></a>';
                    $btns .= ' <a href="javascript:void(0)" data-id="' . $row->cst_id . '" data-name="' . $row->cst_name . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteCustomer"><i class="bi bi-trash"></i></a>';

                    return $btns;
                })
                ->addColumn('nationality', function($row) {
                    return $row->nationality->nationality_name . ' (' . $row->nationality->nationality_code . ')';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $nationalities = Nationality::all();
        return view('customers', [
            'nationalities' => $nationalities
        ]);
    }

    public function view($id) {
        $customer = Customer::find($id);

        if (empty($customer)) {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }

        $customer['cst_nat'] = $customer->nationality->nationality_name . ' (' . $customer->nationality->nationality_code . ')';
        $customer['cst_fl'] = FamilyList::where('cst_id', $customer->cst_id)->get();

        return response()->json([
            'message' => 'data found',
            'data' => $customer
        ]);
    }

    public function update(Request $request, $id) {
        $customer = Customer::find($id);

        if (empty($customer)) {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }

        $customer->cst_name = $request->cst_name;
        $customer->cst_dob = $request->cst_dob;
        $customer->cst_phoneNum = $request->cst_phoneNum;
        $customer->cst_email = $request->cst_email;
        $customer->nationality_id = $request->nationality_id;

        $customer->save();

        if ($request->exists('deleted_fl_id')) {
            foreach($request->deleted_fl_id as $fl_id) {
                FamilyList::destroy($fl_id);
            }
        }

        if ($request->exists('family_list')) {
            foreach($request->family_list as $family_item) {
                if (array_key_exists('fl_id', $family_item)) {
                    $family = FamilyList::find($family_item['fl_id']);

                    if (!empty($family)) {
                        $family->fl_name = $family_item['fl_name'];
                        $family->fl_dob = $family_item['fl_dob'];
                        $family->fl_relation = $family_item['fl_relation'];

                        $family->save();
                    }
                } else {
                    FamilyList::create([
                        'fl_name' => $family_item['fl_name'],
                        'fl_dob' => $family_item['fl_dob'],
                        'fl_relation' => $family_item['fl_relation'],
                        'cst_id' => $id
                    ]);
                }
            }
        }


        return response()->json([
            'message' => 'update success'
        ], 200);
    }

    public function destroy($id) {
        FamilyList::where('cst_id', $id)->delete();
        Customer::find($id)->delete();

        return response()->json([
            'message' => 'delete success'
        ], 200);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'cst_name' => 'required',
            'cst_dob' => 'required',
            'cst_phoneNum' => 'required',
            'cst_email' => 'required',
            'nationality_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator, 400);
        }

        $customer = new Customer;

        $customer->cst_name = $request->cst_name;
        $customer->cst_dob = $request->cst_dob;
        $customer->cst_phoneNum = $request->cst_phoneNum;
        $customer->cst_email = $request->cst_email;
        $customer->nationality_id = $request->nationality_id;

        $customer->save();

        if ($request->exists('family_list')) {
            foreach($request->family_list as $family_item) {
                FamilyList::create([
                    'fl_name' => $family_item['fl_name'],
                    'fl_dob' => $family_item['fl_dob'],
                    'fl_relation' => $family_item['fl_relation'],
                    'cst_id' => $customer->cst_id
                ]);
            }
        }

        return response()->json([
            'message' => 'save success'
        ], 200);
    }
}
