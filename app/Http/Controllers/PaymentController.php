<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Models\User;

class PaymentController extends Controller
{
    public function user_data()
    {
        $user_data = User::where('id', '=', session('LogedUser'))->first();
        return $user_data;
    }


    public function index()
    {
        $data = ['LogedUserInfo' => $this->user_data()];
        $payment = Payment::orderby('id', 'DESC')->paginate(20);
        return view('admin.payment.payment', $data)->with('paymentlist', $payment);
    }
    public function fetch_payment_details()
    {
        $payment = Payment::orderby('id', 'DESC')->paginate(20);
        return view('admin.payment.payment')->with('paymentlist', $payment);
    }
    public function payment_delete($id)
    {
        $delete_payment = Payment::find($id);
        $confirm_delete = $delete_payment->delete();
        if ($confirm_delete) {

            return response()->json([
                'massage' => 'Data Deleted Successfully',
                'status' => 200
            ]);
        }
    }
}
