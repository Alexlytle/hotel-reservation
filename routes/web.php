<?php

use App\ExtraRoomModel;
use App\Room;
// use App\Reservation;
use App\Reservation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReservationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::resource('/reservations','ReservationController')->middleware('auth');



Route::get('/query', function () {
    // return view('welcome');

    $check_in = '2022-07-29';
    $check_out = '2022-07-31';
    $city_id = 2;
    $room_size = 5;
    $user_id = 1;

    $hotel_id  = [1];


// $result = DB::table('cities')
//         ->leftJoin('countries','cities.id','=','countries.id')
//         ->get();
//         dump($result);
/*
Show all availbale rooms
with type is joining the room type table
where dosen't have reservations finds all available rooms

Give me all reservations where reservations DO NOT HAVE 
                            - checkout is greater than checkin(checkout out after checkin)
                            - checkin is less than check out(checkin before the checkout)
        also load type and hotel
*/



// $result = Room::with(['type','hotel','reservations'])
// ->whereDoesntHave('reservations' , function($q) use ($check_in, $check_out) {
//                 $q->where('check_out', '>', $check_in);
//                 $q->where('check_in', '<', $check_out);
//     })
//     ->limit(1)->get();


/**
 * Show all availbale rooms by City and date  where the amount is greater than zero and room size = 5
*/


$result = ExtraRoomModel::check_in_checkout($check_in,$check_out,$city_id,$room_size)->get()->sortBy('type.price');

dd($result);

//  $result

 /*get all rooms made by a user*/

//  $result = Reservation::with(['rooms.type','rooms.hotel'])
//                         ->find($user_id);
// $result = Reservation::with('rooms.type')
//                         ->get()[0];
//                         return response()->json($result->rooms);



/*Get all reservations belonging to a hotel owner*/
$last_date = '2022-07-29';
$result = Reservation::with(['rooms.type','user'])
                    ->whereHas('rooms.hotel',function($q) use ($hotel_id){
                            $q->whereIn('hotel_id',$hotel_id);
                    })
                     ->where('check_in','>=',$last_date)
                    ->get();



// $user_id = '2022-06-26';


 //get all reservations that have 2022-06-20 or later
// $last_date = '2022-06-20';
//  $result = Reservation::whereHas('rooms.hotel')
//                         ->where('check_in','>=',$last_date)
//                         ->get();
$all_res = Reservation::date($last_date)->get();

$reservation = Reservation::get();






});



Auth::routes();

Route::get('/home', [HomeController::class,'index'])->name('home');


