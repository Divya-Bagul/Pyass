@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="card col-12">
            <div class="card-header bg-success">
                Show Form
              
            
            </div>
            <div class="card-body">

               
                   
                
                <div class="float-right"> 
                    
                    <input type="text" name="search" id="search" placeholder="Search"  />
                    <button type="button" name="submit" id="close" class="  btn btn-sm bg-danger"><i class="fa fa-close" aria-hidden="true"></i></button>
                   
                   
                </div>
                <table class="table text-center table-striped">


                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>User</th>
                            <th>show</th>
                        </tr>
                    </thead>
                    <tbody  id="tbody">  
                          
                           
                    @foreach($order as $orderdata)
                 
                        
                
                        <tr>
                          
                            <td>{{$orderdata['order_id']}}</td>
                            <td>  @foreach($user as $username)
                                     @if($username['id'] == $orderdata['user_id'] )
                                        {{$username['name']}} 
                                    @endif
                                @endforeach
                        
                           </td>
                             <td><a href="{{url('display_form/'.$orderdata['order_id'])}}" class="btn btn-info"><i class="fa fa-eye" aria-hidden="true">  </i></a></td>
                          
                        </tr>
                        @endforeach  
                        <td colspan="9" rowspan="5" id="paginate"> {{$order->links()}}</td>                     
                    </tbody>

                    <tr>

                        
                </table>
                
               
            </div>
        </div>
    </div>

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
$(document).ready(function(){
        $('#close').hide();
    $('#search').keyup(function(){

        $('#close').show();  

        var data = $('#search').val();
        

        $.ajax({


            type:'get',
            
            url:"{{url('/search')}}",
            data: {
                // "_token": "{{ csrf_token() }}",
                    "search": data,
                },
            success:function(data){
                console.log(data);
                $('#tbody').html(data);
                
            }, 

        });    


    });
    
    $('#close').click(function(e){

        e.preventDefault(); // cancel click
        window.location.reload();
                    
            });
    


});
</script>




    @endsection