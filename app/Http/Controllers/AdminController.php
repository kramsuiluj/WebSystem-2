<?php

namespace App\Http\Controllers;

use Validator;
use Carbon\Carbon;

use App\Models\cart;

use App\Models\sale;
use App\Models\User;
use App\Models\Kilos;
use App\Models\Sales;
use App\Models\Staffs;
use App\Models\Content;
use App\Models\Product;
use App\Models\Receipt;
use App\Mail\NotifyMail;

use App\Models\Reservation;

use App\Notifications\Test;
use Illuminate\Support\Str;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;


use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Notification;
use Illuminate\Contracts\Encryption\DecryptException;

class AdminController extends Controller
{
    public function user()
    {
        if(Auth::id()){

        $data=user::all();
        return view("admin.users",compact("data"));
    }

    else{
            return redirect('login');
        }

    }

     public function deleteuser($id){
        $data=user::find($id);
        $data->delete();
        return redirect("/users");
    }

    public function deletemenu($id){
        $usertype= Auth::user()->usertype;    
        if($usertype=='1')
        {
            $data=product::find($id);
    
            $data->kg = 0;
            $data->price = 0;
            $data->store_quantity = 0;
            $data->warehouse_quantity = 0;
            $data->save();
    
            $kilos_tbl = kilos::where('prod_id',$id)->delete();
    
    
            return redirect()->back();
        }return redirect()->back();    
    
        }
    public function deleteReserve(Request $request, $user_id){
    $usertype= Auth::user()->usertype;
    if($usertype=='1')
    {
        $data=reservation::where('user_id', $user_id)
                     ->where('status','pending');

        $data->delete();
        return redirect('/viewreservation');
    }return redirect()->back();    

    }


    public function approveReserve(Request $request){

        $invoiceNo = Str::random(10);
        $products = '';
        $reserved_qty=0;
        $prod_id=0;
        $user_id = $request->user_id;

        $prod_reserved = $request->input('prod_name', []);
        $quantities = $request->input('reserved_qty', []);
        $productid = $request->input('id', []);
        $kg = $request->input('prod_kg', []);

        foreach($productid as $value => $productid){
            if($request->buy_option == 'Deliver'){
                $data = reservation::where('user_id', $user_id)
                    ->where('status','pending')
                    ->update(['date' => $request->date,
                        'time' => $request->time,
                        'status' => 'approved']);
            }else{
                $reserved_products = reservation::where('user_id', $user_id)
                ->where('status','pending')
                ->where('productz', $prod_reserved[$value])
                ->update(['status' => 'approved']);
            }
            $update_prod = kilos::where('prod_name', $prod_reserved[$value])
                ->where('kg', $kg[$value])->first();
		if ($update_prod != null){
			$update_prod->warehouse_quantity -= $quantities[$value];
			$update_prod->save();
		}
            //$update_prod->warehouse_quantity -= $quantities[$value];
            //$update_prod->save();
        }

        $get_kilos  = kilos::select(kilos::raw("group_concat(warehouse_quantity SEPARATOR '.') as warehouse_quantity,
            group_concat(store_quantity SEPARATOR '.') as store_quantity"),'prod_name')
            ->groupBy('prod_name')
            ->get();

        foreach($get_kilos  as $get_kilos ){
            $update_product = product::where('title',$get_kilos->prod_name)
                ->update([
                'warehouse_quantity' => $get_kilos->warehouse_quantity,
                'store_quantity' => $get_kilos->store_quantity,
                ]);
        }



        $notifUser = user::where('id',$user_id)->first();  
        $details = [
            'title' => 'Reservation Approved',
            'body' => 'Dear user, your reservations of RJF products is now approved by the RJF Staff',
            'url' => 'Check it Now '.url('/'),
            'thankyou' => 'Thank you!'
        ];

        Mail::to($notifUser->email)->send(new \App\Mail\NotifyMail($details));
        return redirect('/viewreservation');

    }



    public function updateview($encryption_id){
    $usertype= Auth::user()->usertype;    
    if($usertype=='1')
    { 
        $encrypt_id = Crypt::decrypt($encryption_id);
        $data=product::where('id',$encrypt_id)->first();

        return view("admin.updateview",compact("data"));
    }return redirect()->back(); 
    }


    public function update(Request $request, $id){
    $usertype= Auth::user()->usertype;    
    if($usertype=='1')
    { 
        $data=product::find($id);
        
        $image=$request->image;
        if($image==!null){
        $imagename=time().'.'.$image->getClientOriginalExtension();
            $request->image->move('productimage',$imagename);
            $data->image = $imagename;
        }
               
            $data->title=$request->title;
            $data->price=$request->price;
            $data->kg=$request->kilos;
            $data->store_quantity=$request->store_quantity;
            $data->warehouse_quantity=$request->warehouse_quantity;
            $data->description=$request->description;

            $data->save();
        return  redirect()->back();
    }return redirect()->back(); 
    }




    public function productmenu(){
    $usertype= Auth::user()->usertype;       
     if(Auth::id()){
        if($usertype=='1')
        {  
        $data = product::all();
        // $data= kilos::where('user_id',$encrypt_id)
        //                 ->where('status','pending')
        //                 ->join('products','kilos.prod_name','=', 'products.title')
        //                 ->select('reservations.*', 'products.id as products_id', 'title','price')
        //                 ->get();
        
        return view("admin.productmenu", compact("data"));
        }return redirect()->back(); 
    }else{
        return redirect('login');
    }   
    
    }

    public function upload(Request $request){

        $usertype= Auth::user()->usertype;  

        if($usertype=='1') { 
            $current_date_time = Carbon::now()->toDateTimeString();
            $validator = Validator::make($request->all(),[
                'product'=>'required',
                'description'=>'required',
                'price'=>'required',
                'kilos'=>'required',
                'store'=>'required',
                'warehouse'=>'required',
            ]);
                    if($request->hasFile('image')) {
                        $image=$request->image;
                        $imagename=time().'.'.$image->getClientOriginalExtension();
                    }else{
                        $imagename=0;
                    }

                //create function
                if(!$validator->passes()){
                    return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
                }else{   
                    $values1 = [
                        'title'=>$request->product,
                        'kg'=>$request->kilos,
                        'price'=>$request->price,
                        'store_quantity'=>$request->store,
                        'warehouse_quantity'=>$request->warehouse,
                        'image'=>$imagename,
                        'description'=>$request->description,     
                        'created_at'=>$current_date_time,     
                        'updated_at'=>$current_date_time,                            
                    ];

                    $explode_price = explode('.', $request->price);
                    $explode_kg = explode('.', $request->kilos);
                    $explode_store = explode('.', $request->store);
                    $explode_warehouse = explode('.', $request->warehouse);

                    //validate entry equal to length (price,kg,store,warehouse)
                    if(((count($explode_price) != count($explode_kg)) OR (count($explode_price) != count($explode_store))) OR (count($explode_price) != count($explode_warehouse))  ){
                        return response()->json(['status'=>201,'msg'=>"Please verify input"]);
                    }

                    //validate request if create or update
                    //create
                    if($request->actionRequest==1){
                        
                            $insert = DB::table('products')->insert($values1); 

                            //get laste inserted id for kilos reletion
                            $data=product::latest()
                            ->take(1)
                            ->first();

                            if($data->count()>0){
                                $prod_id=$data->id;
                            }
                            
    
                            for($i=0;$i<count($explode_kg);$i++){
                                $values2= [
                                    'prod_name'=>$request->product,
                                    'kg'=>$explode_kg[$i],
                                    'prod_id'=> $prod_id,
                                    'price'=>$explode_price[$i],
                                    'store_quantity'=>$explode_store[$i],
                                    'warehouse_quantity'=>$explode_warehouse[$i],   
                                    'created_at'=>$current_date_time,     
                                    'updated_at'=>$current_date_time,   
                                ];
                                // $queryID=DB::table('kilos')->insert($values2);

                            $insert2 = DB::table('kilos')->insert($values2);

                            }
                            $imagename=time().'.'.$image->getClientOriginalExtension();
                            $request->image->move('productimage',$imagename);
                            // DB::commit();
                            return response()->json(['status'=>200,'msg'=>"Product created sucessfuly!"]);
                        // } catch (\Exception $e) {
                        //     DB::rollback();
                        //     // return response()->json(['status'=>203,'msg'=>$e ]);
                        //     return response()->json(['status'=>203,'msg'=>'Error saving, rolling back transactions!' ]);
                        // } 

                    //update    
                    }else{
                        $request_id=$request->request_id;
                        if( $imagename==0){
                            //update with no image
                            $values1NI = [
                                'title'=>$request->product,
                                'kg'=>$request->kilos,
                                'price'=>$request->price,
                                'store_quantity'=>$request->store,
                                'warehouse_quantity'=>$request->warehouse,
                                // 'image'=>$imagename,
                                'description'=>$request->description,     
                                'created_at'=>$current_date_time,     
                                'updated_at'=>$current_date_time,                            
                            ];
                            $updateProduct = product::where('id',$request_id)->update($values1NI);
                            $explode_price = explode('.', $request->price);
                            $explode_kg = explode('.', $request->kilos);
                            $explode_store = explode('.', $request->store);
                            $explode_warehouse = explode('.', $request->warehouse);

                            $explode_kgDefault = explode('.', $request->kilosDefault);
                        
                            for($i=0;$i<count($explode_kg);$i++){
                                $values2= [
                                    'prod_id' => $request_id,
                                    'prod_name'=>$request->product,
                                    'kg'=>$explode_kg[$i],
                                    'price'=>$explode_price[$i],
                                    'store_quantity'=>$explode_store[$i],
                                    'warehouse_quantity'=>$explode_warehouse[$i],   
                                    'created_at'=>$current_date_time,     
                                    'updated_at'=>$current_date_time,   
                                ];
                                
                                $updateKilo= kilos::where('prod_id',$request_id)
                                            ->where('kg',$explode_kg[$i])
                                            ->get();
                                if($updateKilo->isEmpty()){
                                    $insert_new = DB::table('kilos')->insert($values2);
                                }else{
                                    $updateKilo= kilos::where('prod_id',$request_id)
                                    ->where('kg',$explode_kgDefault[$i])
                                    ->update($values2);
                                }

                            }
                            return response()->json(['status'=>200,'msg'=>"Product updated sucessfuly!"]);
                        }else{
                            //update with image update
                            $values1WI = [
                                'title'=>$request->product,
                                'kg'=>$request->kilos,
                                'price'=>$request->price,
                                'store_quantity'=>$request->store,
                                'warehouse_quantity'=>$request->warehouse,
                                'image'=>$imagename,
                                'description'=>$request->description,     
                                'created_at'=>$current_date_time,     
                                'updated_at'=>$current_date_time,                            
                            ];
                            
                            $updateProduct = product::where('id',$request_id)->update($values1WI);
                            $explode_price = explode('.', $request->price);
                            $explode_kg = explode('.', $request->kilos);
                            $explode_store = explode('.', $request->store);
                            $explode_warehouse = explode('.', $request->warehouse);

                            $explode_kgDefault = explode('.', $request->kilosDefault);
                        
                            for($i=0;$i<count($explode_kg);$i++){
                                $values2= [
                                    'prod_id' => $request_id,
                                    'prod_name'=>$request->product,
                                    'kg'=>$explode_kg[$i],
                                    'price'=>$explode_price[$i],
                                    'store_quantity'=>$explode_store[$i],
                                    'warehouse_quantity'=>$explode_warehouse[$i],   
                                    'created_at'=>$current_date_time,     
                                    'updated_at'=>$current_date_time,   
                                ];
                                $updateKilo= kilos::where('prod_id',$request_id)
                                            ->where('kg',$explode_kg[$i])
                                            ->get();
                                if($updateKilo->isEmpty()){
                                    $insert_new1 = DB::table('kilos')->insert($values2);
                                }else{
                                    $updateKilo= kilos::where('prod_id',$request_id)
                                    ->where('kg',$explode_kgDefault[$i])
                                    ->update($values2);
                                }

                            }
                            $request->image->move('productimage',$imagename);
                            return response()->json(['status'=>200,'msg'=>"Product updated sucessfuly!"]);

                        }
                       
                    }    
                }
                return redirect()->back(); 

        }     
    }

    public function get_product(Request $request){
        $usertype= Auth::user()->usertype;  
        $request_id=$request->request_id;
        if($usertype=='1') { 
            $data=product::latest()
            ->take(1)
            ->where('id',$request_id)
            ->get();

            return response()->json(['status'=>200,'data'=>$data]);

        }
      
    }
    public function reservation(Request $request){
        if(Auth::id()){
            $user_id=Auth::id();
            $products = '';
            $reserved_qty=0;
            $product_fee=0;
            $prod_id=0;
            $checked_array = $request->input('prod_kilos', []);
            $prod_name = $request->input('product_name', []);
            $quantities = $request->input('prod_qty', []);
            $fees = $request->input('product_fee', []);
            $productid = $request->input('prod_id', []);
            
            $user = user::where('id',$user_id)
                        ->first();
            $update_option = reservation::where('user_id', $user_id)
                           ->where('status', 'pending')
                            ->update(['buy_option' => '',
                                    'date' => '',
                                    'time' => '']);
            
        foreach($checked_array as $value){
            
           if($check_reservation = reservation::where('user_id', $user_id)
                ->where('status', 'pending')
                ->where('kg', $value)
                ->where('prod_id', $productid[$value])
                ->first())
            {
            $new_option = reservation::where('user_id', $user_id)
                                    ->where('status', 'pending')
                                    ->where('kg', $value)
                                    ->where('prod_id', $productid[$value])
                                    ->first();
                $new_option->user_id=$user_id;
                $new_option->name=$user->name;
                $new_option->email=$user->email;
                $new_option->phone=$user->phone;
                $new_option->discount=0;         
                $new_option->kg=$value;         
                $new_option->productz=$request->products="{$prod_name[$value]}";
                $new_option->reserved_qty+=$request->$reserved_qty="{$quantities[$value]}";
                $new_option->product_fee+=$request->$product_fee=$fees[$value]*$quantities[$value];
                $new_option->price="$fees[$value]";
                $new_option->prod_id=$request->$prod_id=$productid[$value];
                $new_option->save();



            }else{
                $data = new reservation;
                $data->user_id=$user_id;
                $data->name=$user->name;
                $data->email=$user->email;
                $data->phone=$user->phone;
                $data->discount=0;
                $data->status='pending';
                $data->kg = "{$value}";
                $data->productz=$request->products="{$prod_name[$value]}";
                $data->reserved_qty=$request->$reserved_qty="{$quantities[$value]}";
                
                $data->product_fee=$request->$product_fee=$fees[$value]*$quantities[$value];
                $data->price=$fees[$value];
                $data->prod_id=$request->$prod_id=$productid[$value];
                $data->save();

                }
            }

            $repeat_discount = reservation::where('user_id', $user_id)
                                        ->where('status', 'pending')
                                        ->where('discount', 1)
                                        ->get();
            foreach($repeat_discount as $repeat_discount){
                $repeat_discount->product_fee = $repeat_discount->price * $repeat_discount->reserved_qty;
                $repeat_discount->discount=0;
                $repeat_discount->save();
                

            }

            Alert::success('Product(s) Added Successfully','We have added your selected product(s) to the Cart');     
            return redirect()->back();
        } return redirect('login');
    }
    public function viewreservation(){
        if(Auth::id()){
            $usertype= Auth::user()->usertype;    
            if($usertype=='1')
            {  
                $user = user::where('id', Auth::user()->id)->first();  

                $data=reservation::where('status','pending')
                    ->where('buy_option','!=','')
                    ->select([reservation::raw("SUM(product_fee) as product_fee, SUM(reserved_qty) as reserved_qty"),'buy_option','email' ,'name','address','phone','refno','user_id'])
                    ->groupby('email')
                    ->get();

                $walkin_data=reservation::where('status','approved')
                    ->where('buy_option', 'Walk in')
                    ->select([reservation::raw("SUM(product_fee) as product_fee, SUM(reserved_qty) as reserved_qty"),'email' ,'name','address','phone','refno','user_id','buy_option'])
                    ->groupby('email')
                    ->get();

                $deliver_data=reservation::where('status','approved')
                    ->where('buy_option', 'Deliver')
                    ->select([reservation::raw("SUM(product_fee) as product_fee, SUM(reserved_qty) as reserved_qty"),'email' ,'name','address','phone','refno','user_id','buy_option'])
                    ->groupby('email')
                    ->get();
                    
                $history=sales::where('status','sold')
                    ->select([sales::raw('date as history_date'),'sales.*'])
                    ->whereMonth('created_at', Carbon::now()->month)
                    ->get(); 

                $countPending = reservation::where('status','pending')
                    ->where('buy_option','!=','')
                    ->distinct('user_id')
                    ->count();
                $countApproved = reservation::where('status','approved')
                    ->distinct('user_id')
                    ->count();                    
                $countHistory = sales::whereMonth('created_at', Carbon::now()->month)
                    ->count();   
                return view("admin.adminreservation",compact('data','walkin_data','deliver_data','history','countPending','countApproved','countHistory','user'));
            }return redirect()->back(); 
        }
    
            else{
                return redirect('login');
            }
        }


    public function viewstaffs(){
    if(Auth::id()){
        $usertype= Auth::user()->usertype;    
        if($usertype=='1')
        {  

        $data=staffs::all();

        return view("admin.adminstaffs",compact("data"));
        }return redirect()->back(); 
    }else{
        return redirect('login');
    }

    }

    public function get_staff(Request $request){
        $usertype= Auth::user()->usertype;  
        $request_id=$request->request_id;
        if($usertype=='1') { 
            $data=staffs::latest()
        
            ->where('id',$request_id)
            ->get();
            return response()->json(['status'=>200,'data'=>$data]);

        }
      
    }
    public function uploadstaffs(Request $request){
        if(Auth::id()){
            $usertype= Auth::user()->usertype;    
            if($usertype=='1'){  
                $current_date_time = Carbon::now()->toDateTimeString();
                $validator = Validator::make($request->all(),[
                    'name'=>'required',
                    'contact'=>'required',
                ]);
                    if($request->hasFile('image')) {
                        $image=$request->image;
                        $imagename=time().'.'.$image->getClientOriginalExtension();
                    }else{
                        $imagename=0;
                    }

                    //create function
                    if(!$validator->passes()){
                        return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
                    }else{
                        $request_id=$request->request_id;

                        if($request->actionRequest==1){
                            $data=new staffs;
                            $request->image->move('staffsimage',$imagename);
                            $data->image = $imagename;
                            $data->name=$request->name;
                            $data->speciality=$request->contact;
                            $data->save();
                            return response()->json(['status'=>200,'msg'=>"Staff created sucessfuly!"]);
                        }else{
                            if( $imagename==0){
                                //without image
                                $data=staffs::find($request_id);
                                $data->name=$request->name;
                                $data->speciality=$request->contact;
                                $data->save();
                                return response()->json(['status'=>200,'msg'=>"Staff Updated sucessfuly!"]);
                            }else{
                                //with image
                                $data=staffs::find($request_id);
                                $request->image->move('staffsimage',$imagename);
                                $data->image = $imagename;
                                $data->name=$request->name;
                                $data->speciality=$request->contact;
                                $data->save();
                                return response()->json(['status'=>200,'msg'=>"Staff Updated sucessfuly!"]);

                            }
                        }  
                    }
        
            }
            return redirect()->back(); 
        }else{
            return redirect('login');
        }
    }

    public function updatestaffs($encryption_id){
    if(Auth::id()){
        $usertype= Auth::user()->usertype;    
        if($usertype=='1')
        {  
        $encrypt_id = Crypt::decrypt($encryption_id);
        $data=staffs::find($encrypt_id);

        return view("admin.updatestaffs",compact("data"));
        }return redirect()->back(); 
    }else{
    return redirect('login');
    }
    }

    public function updatestaff(Request $request, $id){
    if(Auth::id()){
        $usertype= Auth::user()->usertype;    
        if($usertype=='1')
        {  
        $data=staffs::find($id);
        $image=$request->image;

            if ($image){
              $imagename=time().'.'.$image->getClientOriginalExtension();
                $request->image->move('staffsimage',$imagename);
                $data->image = $imagename;
            }
                $data->name=$request->name;
                $data->speciality=$request->speciality;

                $data->save();
                return redirect()->back();

        }return redirect()->back(); 
    }else{
        return redirect('login');
    }
        
    }

    public function deletestaff($id){
    if(Auth::id()){
    $usertype= Auth::user()->usertype;    
        if($usertype=='1')
        {  
     $data=staffs::find($id);

     $data->delete();

     return redirect()->back();
        }return redirect()->back(); 
    }else{
    return redirect('login');
    }
    }



    public function supplyreceipt(){
    if(Auth::id()){
    $usertype= Auth::user()->usertype;    
    $access_level= Auth::user()->access_level;    

        if($usertype=='1' && $access_level=='2')
        {  
        if(Auth::id()){

            $supplierData = receipt::where('receiptfor','supplier')
                ->get();
            $supplierCount = receipt::where('receiptfor','supplier')
                ->count();
            $customerData = receipt::where('receiptfor','customer')
                ->get();
            $customerCount = receipt::where('receiptfor','customer')
                ->count();
            
            return view("admin.supplyreceipt", compact("supplierData", "customerData","supplierCount","customerCount"));
        }
    
        else{
                return redirect('login');
            }
        }return redirect()->back(); 
    }else{
    return redirect('login');
    }

    }
    public function uploadreceipt(Request $request){

        $invoiceNo = Str::random(10);

            $validator = Validator::make($request->all(),[
                'recipient'=>'required',
                'prod_name'=>'required',
                'prod_qty'=>'required',
                'paid_fee'=>'required',
                'total_fee'=>'required',
                'date'=>'required',
                // 'proof'=>'required',
                'proofImg'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'receiptfor'=>'required',
            ]);
            
            
            
            if(!$validator->passes()){
                return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
            }else{

                $image=$request->proofImg;
                $imagename = time().'.'.$image->getClientOriginalExtension();

                $request->proofImg->move(public_path('images'), $imagename);

                $values = [
                    'recipient' => $request->recipient,
                    'receiptfor' => $request->receiptfor,
                    'prod_name' => $request->prod_name,
                    'prod_qty' => $request->prod_qty,
                    'paid_fee' => $request->paid_fee,
                    'total_fee' => $request->total_fee,
                    'date' => $request->date,
                    'proof'=>$imagename,
                    'invoiceNo'=>$invoiceNo,
                ];

                if($request->actionRequest==1){
                    $query = Receipt::create($values);
                    return response()->json(['status'=>200,'msg'=>"Receipt created sucessfuly!"]);
                }
            }return  redirect()->back();

                      
    }

    public function removeReceipt(Request $request){
    if(Auth::id()){
    $usertype= Auth::user()->usertype;    
        if($usertype=='1')
        {  
        $receipt_id = $request->receipt_id;
        receipt::whereIn('id',$receipt_id)->delete();
        return redirect()->back();
        }return redirect()->back(); 
    }else{
    return redirect('login');
    }
    }

    public function manageReserve($user_id){
        if(Auth::id()){
            $usertype= Auth::user()->usertype;    
                if($usertype=='1')
                {  
        $data = reservation::where('user_id',$user_id)
                           ->where('status','pending')
                           ->first();
        // $data = reservation::where('user_id',$user_id)
        //                    ->where('status','pending')
        //                    ->get();
        return view('admin.adminmanagereserve', compact('data'));
                }return redirect()->back(); 
        }else{
        return redirect('/login');
        }
    }

    public function pending($encryption_id){
        if(Auth::id()){
            $usertype= Auth::user()->usertype;    
            if($usertype=='1')
            {  
                $encrypt_id = Crypt::decrypt($encryption_id);
                $count=reservation::where('user_id',$encrypt_id)->count();
                $data = reservation::where('user_id',$encrypt_id)
                ->where('status','pending')
                ->first();
                $reserved_products = reservation::where('user_id',$encrypt_id)
                ->where('status','pending')
                ->get();
                return view('admin.pending',compact('data','count','reserved_products'));
            }return redirect()->back(); 
        }else{
            return redirect('/login');
        }
    }
    public function viewApproved(Request $request, $encryption_id){ 
        $encrypt_id = Crypt::decrypt($encryption_id);
        $data = reservation::where('user_id',$encrypt_id)
                           ->where('status','approved')
                        //    ->where('buy_option', $request->buy_option)
                           ->first();
        $reserved_products = reservation::where('user_id',$encrypt_id)
                            ->where('status','approved')
                            // ->where('buy_option', $request->buy_option)
                            ->get();
        $user_img = user::where('id',$encrypt_id)
                        ->get();
        return view('admin.approvedreservation',compact('data','reserved_products','user_img'));

    }
    
    public function delivered(Request $request){
        $products = '';
        $reserved_qty=0;
        $prod_id=0;
        $fee=0;

        $prod_reserved = $request->input('prod_name', []);
        $quantities = $request->input('reserved_qty', []);
        $productid = $request->input('id', []);
        $fee = $request->input('product_fee', []);
        $price = $request->input('price', []);
        $kg = $request->input('prod_kg', []);


        foreach($productid as $value => $productid){
            $data = new sales;
            $data->user_id=$request->user_id;
            $data->name=$request->name;
            $data->email=$request->email;
            $data->phone=$request->phone;
            $data->address=$request->address;
            $data->date=$request->date;
            $data->time=$request->time;
            $data->buy_option=$request->buy_option;
            $data->status="sold";
            $data->products =$prod_reserved[$value];
            $data->reserved_qty=$quantities[$value];
            $data->kg=$kg[$value];
            $data->refno=$request->refno;
            $data->price=$price[$value];
            $data->product_fee=$fee[$value];
            $data->prod_id=$productid;

            $prods_img = product::where('id',$productid)->first();
            $data->prod_img=$prods_img->image;
            $data->save();

            $products_sold = product::where('id',$productid)->first();
            $products_sold->sold += $quantities[$value];
            $products_sold->save();
            }
    $data=reservation::where('user_id', $request->user_id)
                    ->where('status','approved')
                    ->where('buy_option', $request->buy_option);
                    $data->delete();
    return redirect('/viewreservation');
    }
    
    public function manageuser($encryption_id){
    if(Auth::id()){
        $usertype= Auth::user()->usertype;    
        if($usertype=='1')
        {  
    $encrypt_id = Crypt::decrypt($encryption_id);
    $data = user::where('id',$encrypt_id)
                ->first();
    return view('admin.manageuser',compact('data'));
        }return redirect()->back(); 
    }else{
        return redirect('/login');
    }
    }

    public function updateAccess(Request $request, $id){
    if(Auth::id()){
        $usertype= Auth::user()->usertype;    
        $data = user::where('id', $id)
        ->update(['access_level' => 1,
                'usertype' => 1]);    
        return redirect('/users');
    }return redirect()->back(); 
    }
    public function removeAccess($id){
            $data = user::where('id', $id)
            ->update(['access_level' => 0,
                    'usertype' => 0]);

            return redirect()->back();
    }
    
    public function ins_loc_img(Request $request, $user_id){
    if(Auth::id()){
        $usertype= Auth::user()->usertype;    
        if($usertype=='1')
        {    
            $data = user::find($user_id);
            $image=$request->image;
            if ($image){

                  $imagename=time().'.'.$image->getClientOriginalExtension();
                    $request->image->move('loc_imgs',$imagename);
    
                    $data->loc_img = $imagename;
                    $data->save();
                    return  redirect()->back();
            }
            return redirect()->back();
        }return redirect()->back();
    }else{
        return redirect('/login');
    }
        }
    
        public function sold_from_walkin(Request $request){
            $current_date_time = Carbon::now()->toDateTimeString();
            $checked_array = $request->input('prod_kilos', []);
            $prod_name = $request->input('product_name', []);
            $quantities = $request->input('prod_qty', []);
            $fees = $request->input('paid', []);
            $price = $request->input('product_price', []);
            $productid = $request->input('prod_id', []);
            $define_location = $request->input('define', []);
            
            $arr = [];


        foreach($checked_array as $value){
                if($define_location[$value] == 'store'){
                    $soldFrom ='Store';
                }else{
                    $soldFrom ='Warehouse';
                }
                    $data = product::where('id',$productid[$value])
                                    ->first();
                    $sold_from = new sales;
                    $sold_from->user_id=$productid[$value];
                    $sold_from->name=$soldFrom;
                    $sold_from->email=$soldFrom;
                    $sold_from->phone=$soldFrom;
                    $sold_from->address=$soldFrom;
                    $sold_from->date=$soldFrom;
                    $sold_from->time=$soldFrom;
                    $sold_from->buy_option=$soldFrom;
                    $sold_from->status="sold";
                    $sold_from->products =$data->title;
                    $sold_from->kg=$value;
                    $sold_from->reserved_qty=$quantities[$value];
                    $sold_from->refno=$soldFrom;
                    $sold_from->price=$price[$value];
                    $sold_from->product_fee=$fees[$value];
                    $sold_from->prod_id=$productid[$value];
                    $sold_from->prod_img=$data->image;
                    $sold_from->save();

                    $products_sold = product::where('id',$productid[$value])->first();
                    $products_sold->sold += $quantities[$value];
                    $products_sold->save();

                if($define_location[$value] == 'store'){
                    $update_prod = kilos::where('prod_name', $prod_name[$value])
                                        ->where('kg', $value)->first();
                    $update_prod->store_quantity -= $quantities[$value];
                    $update_prod->save();
                }else{

                    $update_prod = kilos::where('prod_name', $prod_name[$value])
                                        ->where('kg', $value)->first();
                    $update_prod->warehouse_quantity -= $quantities[$value];
                    $update_prod->save();
                }

            }

            $get_kilos  = kilos::select(kilos::raw("group_concat(warehouse_quantity SEPARATOR '.') as warehouse_quantity,
            group_concat(store_quantity SEPARATOR '.') as store_quantity"),'prod_name')
                        ->groupBy('prod_name')
                        ->get();

                        foreach($get_kilos  as $get_kilos ){
                        $update_product = product::where('title',$get_kilos->prod_name)
                                ->update([
                                    'warehouse_quantity' => $get_kilos->warehouse_quantity,
                                    'store_quantity' => $get_kilos->store_quantity,
                                ]);
                        }

        return redirect()->back();
    }
    public function barChart2(){

        $saleData1 = sales::select(DB::raw("sum(product_fee) as product_fee"))
                    ->whereYear('created_at', date('Y'))
                    ->groupBy(DB::raw("Month(created_at)"))
                    ->pluck('product_fee')
                    ->toJson();
        $saleData = array_map('intval', json_decode($saleData1, true));

        return view('admin.bar-chart2', compact('saleData'));
    }

    public function set_discount(Request $request){

        $kg = $request->input('prod_kg', []);
        $prod_reserved = $request->input('prod_name', []);
        $prod_fee = $request->input('set_discount', []);
        $prod_id = $request->input('id', []);
        $arr =[];
        
        foreach($prod_id as $value=>$prod_id){
            $reserved_products = reservation::where('user_id', $request->user_id)
                                ->where('prod_id',$prod_id)
                                ->where('status','pending')
                                ->where('discount','0')
                                ->where('kg', $kg[$value])
                                ->where('productz', $prod_reserved[$value])
                                ->update(['discount' => 1, 
                                'product_fee' => $prod_fee[$value]]);
        }
        
        $notifUser = user::where('id',$request->user_id)
                           ->first();  
        
            $details = [
                'title' => 'Request Approved',
                'body' => 'Dear user, your request for discount of reservations of RJF products is now managed by the RJF Staff',
                'url' => 'Check it Now '.url('/'),
                'thankyou' => 'Thank you!'
            ];
           
            Mail::to($notifUser->email)->send(new \App\Mail\NotifyMail($details));
        return redirect('/viewreservation');

    }
    public function no_discount($user_id){
        $reserved_products = reservation::where('user_id', $user_id)
                                    ->where('status','pending')
                                    ->where('discount','0')
                                    ->update(['discount' => '2']);
        return redirect('/viewreservation');
    }

    public function walkin(){
        if(Auth::id())
        {
        $usertype= Auth::user()->usertype;
            if($usertype==0)
            {return redirect()->back();}
        }

        $data=product::where('warehouse_quantity','!=' ,0)
                    ->where('store_quantity','!=' ,0)
                    ->get();
        return view("admin.walkin",compact('data'));

    }
    
    public function set_qr(Request $request,$id){
        
        $data = user::find($id);

        $image=$request->image;
        if($image==!null){
        $imagename=time().'.'.$image->getClientOriginalExtension();
            $request->image->move('qr_imgs',$imagename);
            $data->qr = $imagename;
        }
        $data->phone = $request->phone;
        $data->save();
        return redirect()->back(); 
        
    }

    public function showDetails(Request $request){
        $id=$request->id;

        $query = Receipt::where('id', $id)->first();

        $image=asset('/images/'.$query->proof);

        return response()->json(['status'=>1,'data'=>$query, 'image'=>$image]);
    }
    
}
