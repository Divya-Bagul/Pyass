



@foreach($search as $row)
 <tr>
     <td>{{$row->order_id}}</td>

 @foreach($user as $username1)
                    @if($username1->id == $row->user_id )
                             <td>{{$username1->name}} </td>
                     @endif
@endforeach

                             <td><a href="{{url('display_form/'.$row->order_id)}}" class="btn btn-info"><i class="fa fa-eye" aria-hidden="true">  </i></a></td>
        
</tr>
@endforeach
  