{!! Form::open(['url' => route('user-status-update', $item['id']), 'class'=> 'ajax', 'method' => 'post', 'id' => 'update-user-status-form']) !!}
<div class="row">
    {{ csrf_field() }}

    <div class="col-md-3 form-group mb-3">
        <label for="status">Status <span class="required">*</span></label><br>
        {!! Form::radio('status', 0, isset($item['status']) ? $item['status'] == 0 ? true : false : true)!!} Block
        {!! Form::radio('status', 1, isset($item['status']) ? $item['status'] == 1 ? true : false : false)!!} unblock
        <div class="form-error status"></div>
    </div>
    <div class="col-md-12">
        <button type="submit" class="btn btn-primary submit">Save</button>
    </div>
</div>
{!! Form::close() !!}
