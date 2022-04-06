@if(isset($item))
    {!! Form::open(['url' => route('place-update', $item['id']), 'class'=> 'ajax', 'method' => 'post', 'id' => 'update-place-form']) !!}
@else
    {!! Form::open(['url' => route('place-store'), 'class'=> 'ajax', 'method' => 'post', 'id' => 'create-place-form']) !!}
@endif
<div class="row">
    {{ csrf_field() }}
    <div class="col-md-6 form-group mb-3">
        <label for="name">Name <span class="required">*</span></label>
        {!! Form::text('name', $item->name ?? '', ['class'=>'form-control form-control-rounded', 'id' => 'name']) !!}
        <div class="form-error name"></div>
    </div>
    <div class="col-md-6 form-group mb-3">
        <label for="address">Address <span class="required">*</span></label>
        {!! Form::text('address', $item->address ?? '', ['class'=>'form-control form-control-rounded', 'id' => 'address']) !!}
        <div class="form-error name"></div>
    </div>

    <div class="col-md-6 form-group mb-3">
        <label for="category_id"> Category <span class="required">*</span></label>
        {!! Form::select('category_id', \App\Services\PlacesService::allWithIdAndName(), $item->category_id ?? '', ['class'=>'form-control form-control-rounded', 'id' => 'category_id', 'placeholder' => 'Select Category']) !!}
        <div class="form-error category_id"></div>
    </div>


    <div class="col-md-6 form-group mb-3">
        <label for="district_id"> District <span class="required">*</span></label>
        {!! Form::select('district_id', \App\Services\PlacesService::allIdAndName(), $item->district_id ?? '', ['class'=>'form-control form-control-rounded', 'id' => 'district_id', 'placeholder' => 'Select District']) !!}
        <div class="form-error category_id"></div>
    </div>
    <div class="col-md-6 form-group mb-3">
        <label for="description">Description <span class="required">*</span></label>
        {!! Form::textarea('description', $item->description ?? '', ['class'=>'form-control form-control-rounded', 'id' => 'description']) !!}
        <div class="form-error description"></div>
    </div>
    <div class="col-md-6 form-group mb-3">
        <label for="logo" class="col-md-12">Image</label>
        {!! Form::file('image_url', ['class'=>'inputfile', 'id' => 'image_url',  'data-preview-file-type' => 'text']) !!}
        <label for="image_url" class="inputfilelabel"><strong>Choose a file</strong></label>
        <div class="form-error image_url"></div>
        <div id="target" class="mt-4">
            @if(isset($item))
                @if($item['image_url'])
                    <img class="office-logo rounded img-thumbnail" src="{{ asset('public/'.$item->image_url) }}"
                         alt="">
                @endif
            @endif
        </div>
    </div>

    <div class="col-md-12">
        {!! Form::hidden('old_image_url', $item->image_url ?? null) !!}
        <button type="submit" class="btn btn-primary submit">Save</button>
    </div>
</div>

{!! Form::close() !!}
<script type="text/javascript">
    // var input   = $('\inputfile')[0];
    let label = $('.inputfilelabel')[0];
    labelVal = label.innerHTML;

    $('input[type=file]').on('change', function (e) {
        let file = e.target.files[0];
        let filename = file.name;
        if (filename) {
            let reader = new FileReader();
            reader.onload = function (e2) {
                $('#target').html('<img class="office-logo rounded img-thumbnail" src="' + e2.target.result + '" alt="">');
            };
            reader.readAsDataURL(file);
            label.innerHTML = filename;
        } else {
            label.innerHTML = labelVal;
        }
    });
</script>
