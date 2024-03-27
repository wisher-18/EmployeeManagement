@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Employee</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('employe.update' ,$user->id)}}" name="updateForm" id="updateForm" enctype="multipart/form-data">
                          <div class="mb-3">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" value="{{ $user->employee_name}}" name="name">
                            <p></p>
                        </div>
                        </div>  
                        <div class="mb-3">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $user->employee_email}}">
                            <p></p>
                        </div>
                        </div>
                        <div class="mb-3">
                        <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control-file" name="image">
                        <p></p>
                        </div>
                        </div>
                        <div class="mb-3">
                        <div class="form-group">
                            <label for="department">Department</label>
                            <select class="form-control" id="department" name="department">
                                <option value="">select  department...</option>
                                <option value="HR" {{ $user->department == 'HR' ? 'selected' : '' }}>HR</option>
                                <option value="Finance" {{ $user->department == 'Finance' ? 'selected' : '' }}>Finance</option>
                                <option value="IT" {{ $user->department == 'IT' ? 'selected' : '' }}>IT</option>
                                <!-- Add more options as needed -->
                            </select>
                            <p></p>
                        </div>
                        </div>
                        <div class="mb-3">
                        <div class="form-group">
                            <label>Gender</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="female" value="female" {{ $user->gender == 'female' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="female">Female</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="male" value="male" {{ $user->gender == 'male' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="male">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="other" value="other" {{ $user->gender == 'other' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="other">Other</label>
                            </div>
                            @error('gender')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="is_active">Is Active?</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="is_active" id="is_active_yes" value="1" {{ $user->is_active == 1 ? 'checked' : '' }} >
                                    <label class="form-check-label" for="is_active_yes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="is_active" id="is_active_no" value="0" {{ $user->is_active == 0 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active_no">No</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                        <div class="form-group">
                            <label for="dob">Date of Birth</label>
                            <input type="date" class="form-control" id="dob" name="dob" value="{{ $user->dob}}">
                            <p></p>
                        </div>
                        </div>
                        <div class="mb-3">
                        <div class="form-group">
                            <label for="designation">Designation</label>
                            <input type="text" class="form-control" id="designation" name="designation" value="{{ $user->designation}}">
                            <p></p>
                        </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Edit Employee</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('customJs')
<script>
		$('#updateForm').submit(function(event) {
    event.preventDefault();
    let element = $(this);
    let form_data = new FormData(this);
    $('button[type=submit]').prop('disabled',true);
    $.ajax({
         url: "{{route('employe.update',$user->id)}}",
        type:'post',
        data:form_data,
        contentType: false,
        processData: false,
        dataType:'json',
        success:function(response) {
            $('button[type=submit]').prop('disabled', false);

            if(response['status'] == true) {
                const redirectToList = '{{ route("employe.index") }}';
                window.location.href = redirectToList ;
                $('#name').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                $('#email').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                $('#designation').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                $('#department').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                $('#dob').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                

            } else {
            let errors =response['errors'];
            if(errors['name']) {
                $('#name').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['name']);
            } else {
                $('#name').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");

            }
            if(errors['email']) {
                $('#email').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['email']);
            } else {
                $('#email').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");

            }
            if(errors['designation']) {
                $('#designation').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['designation']);
            } else {
                $('#designation').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");

            }
            if(errors['department']) {
                $('#department').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['department']);
            } else {
                $('#department').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");

            }
            if(errors['dob']) {
                $('#dob').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['dob']);
            } else {
                $('#dob').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");

            }
            
        }
        },
        error:function(jqXHR,exception) {
            console.log('something went wrong');
        }
    })
})
</script>
@endsection

