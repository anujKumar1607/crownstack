<?php

use Illuminate\Database\Seeder;
use App\Models\Discount;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
        	[
        		'actual_discount_times'=>15,
        		'remaining_discount_times'=>15,
        		'discount_value'=>50
        	],[
        		'actual_discount_times'=>12,
        		'remaining_discount_times'=>12,
        		'discount_value'=>100
        	],[
        		'actual_discount_times'=>10,
        		'remaining_discount_times'=>10,
        		'discount_value'=>200
        	],[
        		'actual_discount_times'=>8,
        		'remaining_discount_times'=>8,
        		'discount_value'=>500
        	],[
        		'actual_discount_times'=>5,
        		'remaining_discount_times'=>5,
        		'discount_value'=>1000
        	],[
        		'actual_discount_times'=>4,
        		'remaining_discount_times'=>4,
        		'discount_value'=>2000
        	],[
        		'actual_discount_times'=>2,
        		'remaining_discount_times'=>2,
        		'discount_value'=>5000
        	],[
        		'actual_discount_times'=>1,
        		'remaining_discount_times'=>1,
        		'discount_value'=>10000
        	]
        ];

        Discount::truncate();
        foreach($data as $key=>$value){
        	Discount::create($value);
        }
    }
}
