@extends('layouts.app')
@section('title')
Daily Report
@endsection
@section('content')
<main>
    <div class="container-fluid">
        <div class="ticket-details row">
            <div class="col-md-5 col-lg-4 col-xxl-3">
                <!-- 1 -->
                <div class="card" id="printFrame">
                    <div class="card-body ">

                        <form method="post">
                     
                            <input type="text" name="FieldData" class="work_reason" id="work_reason">
                            <input type="text" name="report_id" value="12">

                            <input type="submit" name="submit" value="OK">
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
            

@endsection
@push('item-scripts')
<script>

    // this work reason edit function
    // $(".work_reason").focusin(function(){
        
    // });
    $(".work_reason").focusout(function(){
        
        const id = $('#report_id').val();
        const formValue = $('#work_reason').val();
        const url = `/reports/update/${id}`;
        const method = 'PUT';
        const DBField= 'work_reason';

        
        $.ajax({
            url: url,
            method: method,
            processData: false,
            contentType: false,
            data: {
                FieldData: formValue,
                SetField: DBField,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                pemberitahuan("success","berhasil mengupdate" +);
                setTimeout(function(){
                        location.reload();
                    }, 2000);
            }
            error: function(xhr) {
                console.error(xhr.responseText);
                pesan('error',response.responseJSON.message, "error");
            }
        });
    });
</script>

@endpush