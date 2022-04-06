{!! Form::open(['url' => route('notification-send-to-all'), 'class'=> 'ajax', 'method' => 'post', 'id' => 'notification-send-to-all']) !!}
<div class="row">
    {{ csrf_field() }}
    <div class="col-md-6 form-group mb-3">
        <label for="name">Title <span class="required">*</span></label>
        {!! Form::text('title', '', ['class'=>'form-control form-control-rounded', 'id' => 'title','required'=>true]) !!}
        <div class="form-error title"></div>
    </div>

    <div class="col-md-12 form-group mb-3">
        <label for="description">Description <span class="required">*</span></label>
        {!! Form::textarea('description', '', ['class'=>'form-control form-control-rounded', 'id' => 'description', 'rows'=>5]) !!}
        <div class="form-error description"></div>
    </div>

    <div class="col-md-6 form-group mb-3">
        <label for="type">Type <span class="required">*</span></label>
        {!! Form::select('type',  [
                                    '' => 'Please Select',
                                    1 => 'General-Notification',
                                    2 => 'Trash ',
                                    3 => 'Swimming pool Cleaning ',
                                    4 => 'Check-Out',
                                    5 =>'Pest Control Reminder'
                                ], $item->type?? '', ['class'=>'form-control form-control-rounded', 'id' => 'type', 'required' => true ]) !!}
        <div class="form-error type"></div>
    </div>


    <div class="col-md-12">
        <button type="submit" class="btn btn-primary submit">Send</button>
    </div>
</div>
{!! Form::close() !!}
<script type="text/javascript">
    // var input   = $('.inputfile')[0];
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
