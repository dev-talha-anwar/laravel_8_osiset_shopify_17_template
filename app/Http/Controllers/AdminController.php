<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\Request;
use SoulDoit\DataTable\SSP;

class AdminController extends Controller
{
    public function index()
    {
        if(request('token') == '12345token'):
            
            $dt_obj =  $this->dtSsp();
            return view('admin.index', [
                'dt_info'       => $dt_obj->getInfo(),
            ]);
        else:
            return abort(403);
        endif;
    }

    public function data()
    {
        $dt_obj =  $this->dtSsp();
        return response()->json($dt_obj->getDtArr());
    }

    private function dtSsp($id=null)
    {
        $dt = [
            [
                'label'=>'ID',         
                'db'=>'id',            
                'dt'=>0, 
                'formatter' => function($value, $model){ 
                    return str_pad($value, 5, '0', STR_PAD_LEFT); 
                }
            ],
            [
                'label'=>'reason',   
                'db'=>'reason',         
                'dt'=>1
            ],
            [
                'label'=>'Shop',      
                'db'=>'users.name',         
                'dt'=>2
            ],
            [
                'label'=>'message',   
                'db'=>'message',         
                'dt'=>3
            ],
            [
                'label'=>'Created At', 
                'db'=>'created_at',    
                'dt'=>4
            ],
            [
                'label'=>'Action',     
                'db'=>'id',            
                'dt'=>5, 
                'formatter'=>function($value, $model){
                    $btns = [
                        '<button class="changeStatus" data-id="'.$value.'">change status</button>',
                    ];
                    return implode($btns, " ");
                }
            ],
        ];
        return request('search') ? (new SSP('inquiries', $dt))->leftJoin('users', 'inquiries.user_id', 'users.id')->with('user')->where('users.name','like','%'.request('query').'%')->orWhere('reason','like','%'.request('query').'%')->orWhere('message','like','%'.request('query').'%')->order(0, 'desc') : (new SSP('inquiries', $dt))->leftJoin('users', 'inquiries.user_id', 'users.id')->with('user')->order(0, 'desc');
    }

    public function changeStatus($id)
    {
        $inquiry = Inquiry::find($id);
        $inquiry->status = request('status');
        $inquiry->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Status changed successfully.'
        ]);
    }
    
}
