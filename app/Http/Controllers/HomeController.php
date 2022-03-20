<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Inquiry;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Mail\InquirySubmitted;
use Illuminate\Validation\Rule;
use App\Http\Traits\ShopifyTrait;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    use ShopifyTrait;
    public function index()
    {
        $inquiries = Inquiry::simplePaginate(10);
        return view('welcome',compact('inquiries'));
    }

    public function add()
    {
        $validator = Validator::make(request()->all(), [
            'reason' => [
                'required',
                Rule::in(['App', 'Theme','Payments','Shipping','Other','Sales Channels','Social Media','Increase Sales']),
                'string'
            ],
            'message' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'false',
                'errors' => $validator->errors()
            ]);
        }
        if(Inquiry::create([
            'user_id' => auth()->user()->id,
            'reason' => request('reason'),
            'message' => request('message'),
        ])):
            Mail::to('info@helpify24.com')->send(new InquirySubmitted());
            return response()->json([
                'status' => 'success',
                'message' => 'Your inquiry has been submitted successfully.'
            ]);
        else:
            return response()->json([
                'status' => 'false',
                'message' => 'Something went wrong'
            ]);    
        endif;
    }

    public function check()
    {
        if(auth()->user()->totalInquiries->count() > 0 && auth()->user()->plan_id == null):
            return response()->json([
                'status' => false,
                'message' => 'You have reached the limit of inquiries for your plan.'
            ]);
        else:
            return response()->json([
                'status' => true,
                'message' => 'You can submit another inquiry.'
            ]);
        endif;
    }
}
