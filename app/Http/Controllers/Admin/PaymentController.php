<?php

namespace App\Http\Controllers\Admin;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class PaymentController extends Controller
{
    //show fedd
    public function home(){
        $data= Payment::paginate(3);
        return view('admin.payment.home',compact('data'));
    }

    //payment create
    public function create(Request $request){
        $validator =  $request->validate([
            'type' => 'required',
            'accountName' => 'required',
            'accountNumber' => 'required|numeric'
        ]);
        $data = [
            'type'=> $request->type,
            'account_number' => $request->accountNumber,
            'account_name' => $request->accountName
        ];
        Payment::create($data);
        Alert::success('Success ', 'Payment Method Added Successfully...');
        return to_route('paymentHome');
    }

    // show edit page
    public function editPage($id){
        $payment = Payment::where('id',$id)->first();
        // dd($payment->toArray());
        return view('admin.payment.edit',compact('payment'));
    }
    // paymet update
    public function update(Request $request){
        $validator =  $request->validate([
            'type' => 'required',
            'accountName' => 'required',
            'accountNumber' => 'required|numeric'
        ]);
        $data = [
            'type'=> $request->type,
            'account_number' => $request->accountNumber,
            'account_name' => $request->accountName
        ];
        Payment::where('id',$request->paymentId)->update($data);
        return to_route('paymentHome');
    }
    //delete
    public function delete($id){
        Payment::where('id',$id)->delete();
        Alert::success('Success ', 'Payment Method Delete Successfully...');
        return back();
    }
}
