<div class="ajax-listing">
    <div class="table-responsive">
        <table class="display table table-striped table-bordered" style="width:100%">
            <thead>
            <tr>
                <th>Name</th>
                <th>E-Mail</th>
                <th>Mobile</th>
                <th class="text-center">Is Verified</th>
                <th class="text-center">Is Blocked</th>
                <th class="text-center">Created at</th>
                <th class="text-center" style="min-width: 90px">Action</th>
            </tr>
            </thead>
            <tbody>
            @if($items->count())
                @foreach($items as $item)
                    <tr>
                        <td>{{$item['name']}}</td>
                        <td>{{$item['email'] ?? ''}}</td>
                        <td>{{$item['mobile'] ?? ''}}</td>
                        <td class="text-center">
                            @if($item['is_verified'])
                                <i class="nav-icon i-Checked-User font-weight-bold"></i>
                            @endif
                        </td>
                        <td class="text-center">
                            @if(!$item['status'])
                                <i class="nav-icon i-Checked-User font-weight-bold"></i>
                            @endif
                        </td>
                        <td class="text-center">{{$item->created_at->format('d-m-Y')}}</td>
                        <td class="text-center">
                            <a href="{{url('users/'.$item->id)}}" class="text-success" title="View">
                                <i class="nav-icon i-Eye1 font-weight-bold"></i>
                            </a>

                            <a href="{{url('users/'.$item->id.'/edit')}}" class="text-black-50" title="Edit">
                                <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                            </a>

                            @if(!$item->is_approved)
                                <form id="approve-form-{{$item->id}}" method="post" class="approve-form"
                                      action="{{route('user-approve',$item->id)}}">
                                    {{csrf_field()}}
                                    <button class="text-success submit p-0" type="submit" title="Approve">
                                        <i class="nav-icon i-Yes font-weight-bold"></i>
                                    </button>
                                </form>
                            @endif

                            <form id="delete-form-{{$item->id}}" method="post" class="delete-form"
                                  action="{{route('user-delete',$item->id)}}">
                                {{csrf_field()}}
                                <input type="hidden" name="_method" value="DELETE">
                                <button class="text-danger submit p-0 {{(!$item->is_approved)? 'ml-3' : '' }}" type="submit" title="Delete">
                                    <i class="nav-icon i-Close-Window font-weight-bold"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="9" align="center">
                        <strong class="red-text">Record not found</strong>
                    </td>
                </tr>
            @endif

            </tbody>
        </table>
    </div>
    <div class="pagination-container">
        {{isset($items) ? $items->appends(request()->except('page'))->links() : ''}}
    </div>
</div>
