@extends('layouts.app')

@section('content')
			<div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-md-10">
                    @include('layouts.message')
                        </div>
                </div>
            </div>		
<div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <form action="" method="get">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="card-title">
                                <button type="button" onclick="window.location.href='{{ route('employe.index')}}'" class="btn btn-default btn-sm">Reset</button>
                            </div>
                            <div class="input-group" style="width: 250px;">
                                <input type="text" value="{{Request::get('search')}}" name="search" class="form-control float-right" placeholder="Search">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <a href="{{ route('employe.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th width="60">ID</th>
                                <th width="60"></th>
                                <th>Name</th>
                                <th>email</th>
                                <th>department</th>
                                <th width="100">Status</th>
                                <th width="100">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(!empty($users))
                        @foreach ( $users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>
                                    @if(!empty( $user->image))
                                    <img src="{{ url('images/'.$user->image) }}" class="img-thumbnail" alt="" width="50">
                                    @endif
                                </td>
                                <td>{{ $user->employee_name }}</td>
                                <td>{{ $user->employee_email }}</td>
                                <td>{{ $user->department }}</td>
                                <td>
                                @if ($user->is_active == 1)
                                    <svg class="text-success-500 h-6 w-6 text-success" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    @else
                                    <svg class="text-danger h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('employe.edit' ,$user->id)}}">
                                        <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                        </svg>
                                    </a>
                                    <a href="#" onclick="deleteUser({{$user->id}})" class="text-danger w-4 h-4 mr-1">
                                        <svg wire:loading.remove.delay="" wire:target="" class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path	ath fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                        @endforeach
                        @endif
                    </table>
                </div>
                <div class="card-footer clearfix">
                {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('customJs')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    function deleteUser(userId) {
        if (confirm('Are you sure you want to delete this Employe?')) {
             const deleteRoute = "{{ route('employe.destroy' ,$user->id)}}";
             const newDeleteRoute = deleteRoute.replace(':userId', userId);
            
            $.ajax({
                url: newDeleteRoute,
                type: 'DELETE',
                headers: {
				'X-CSRF-TOKEN':$('meta[name="csrf-token"').attr('content')
			},
                success: function(response) {
                    window.location.href = "{{ route('employe.index')}}";
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    }
</script>
@endsection
