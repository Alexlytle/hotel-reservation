@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">id</th>
                        <th scope="col">Name</th>
                        <th>Check In</th>
                        <th>Check Out</th>
                        <th>Email</th>
                        <th>Price</th>
                        <th>Room Details</th>
                     
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($reservations as $reservation)
                            <tr>
                                        <td>{{$reservation->id}}</td>
                                        <td>{{$reservation->user->name}}</td>  
                                        <td>{{$reservation->check_in}}</td>  
                                        <td>{{$reservation->check_out}}</td>  
                                        <td>{{$reservation->user->email}}</td>  
                                        <td>{{$reservation->price}}</td> 
                                   
                                        @php
                                            $main_index = $loop->index
                                        @endphp
                                        <td>
                                            @foreach ($reservation->rooms as $room)
                                          
                                                    <ul class="list-group main-group">
                                                        <li class="list-group-item bg-light text-white">
                                                            <button type="button"  data-toggle="collapse" data-target="#collapse{{$main_index}}{{$room->id}}" aria-expanded="false" aria-controls="collapseExample">
                                                               Room Name: {{$room->name}}
                                                            </button>
                                                            {{-- <form action="{{ route('posts.destroy', post) }}" method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="text-blue-500">Delete</button>
                                                            </form> --}}
                                                        </li>
                                
                                                      </ul>
                                              
                                                  <div class="collapse" id="collapse{{$main_index}}{{$room->id}}">
                                                            <ul class="list-group ">           
                                                                <li class="list-group-item bg-secondary text-white"> Bedrooms: {{$room->type->size}}</li>
                                                                <li class="list-group-item bg-secondary text-white"> Country: {{$room->hotel->city->country->name}}</li>
                                                                <li class="list-group-item bg-secondary text-white"> City: {{$room->hotel->city->name}}</li>
                                                        
                                                           
                                                        </ul>
                                                  </div>
                                              @endforeach
                                        </td> 
                                       
                                   
                            </tr>
                      @endforeach
                    
                    </tbody>
                    {{ $reservations->links() }}
                  </table>
            </div>
        </div>
    </div>
@endsection
