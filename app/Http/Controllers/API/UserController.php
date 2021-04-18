<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\User;
use App\Models\Discount;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    function random_select($numbers){ 
        $total = 0;
        foreach ($numbers as $number => $weight){
            $total += $weight; $distribution[$number] = $total; 
        }
        $rand = mt_rand(0, $total - 1);
            foreach ($distribution as $number => $weights){
                if ($rand < $weights) { return $number; 
                } 
            }
        }

    public function store(Request $request)
    {
        try{

            $validation = Validator::make($request->all(), [
                'email'=>'required|email|unique:users,email',
                'mobile'=>'required|digits:10|unique:users,mobile'
                ]
            ); 
            if($validation->fails()){
                return Response(array('status'=>false, 'errors'=>$validation->errors()->first()),400);
            }
            
            $discount = Discount::select('id','actual_discount_times','remaining_discount_times','discount_value')->where('remaining_discount_times','>',0)
            ->orderBy('discount_value','desc')
            ->get();

            $dis = $this->random_select($discount->pluck('remaining_discount_times','id')->toArray());

            $data = $request->all();
            $data['discount_id'] = $dis;
            $data = User::create($data);
            $discount = Discount::find($dis);
            $message = "Congratulation you got ".$discount->discount_value." Rupees Discount";
            $discount->remaining_discount_times = $discount->remaining_discount_times -1;
            $discount->save();
            //dd($data);
            
            return response(['success' => 1, 'statuscode' => 200, 'msg' => $message], 200);

        }catch (\Exception $e) {
            return response(['success' => 0, 'statuscode' => 500, 'msg' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
