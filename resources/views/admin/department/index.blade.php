<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Hello, {{ Auth::user()->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if (count($departments)>0)
                        <div class="card">
                        <div class="card-header">Department table</div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">CreateBy</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($departments as $department)
                                    <tr>
                                        <th scope="row">{{ $departments->firstItem() + $loop->index }}</th>
                                        <td>{{ $department->department_name }}</td>
                                        <td>{{ $department->user->name }}</td> {{-- function user ใน model department เเละ fill name ของ table --}}
                                        <td>
                                            <a href="{{ url('/department/edit/' . $department->id) }}"
                                                class="btn btn-warning">Edit</a>
                                            <a href="{{ url('/department/delete/' . $department->id) }}"
                                                class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="m-3">
                            {!! $departments->links('pagination::bootstrap-5') !!}
                        </div>
                    </div>
                    @endif
                    
                    @if (count($trashDepartments) > 0)
                        <div class="card my-2">
                            <div class="card-header">Trash</div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">CreateBy</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($trashDepartments as $trashDepartment)
                                        <tr>
                                            <th scope="row">{{ $trashDepartments->firstItem() + $loop->index }}</th>
                                            <td>{{ $trashDepartment->department_name }}</td>
                                            <td>{{ $trashDepartment->user->name }}</td> {{-- function user ใน model department เเละ fill name ของ table --}}
                                            <td>
                                                <a href="{{ url('/department/recover/' . $trashDepartment->id) }}"
                                                    class="btn btn-warning">Recover</a>
                                                <a href="{{ url('/department/permanentdelete/' . $trashDepartment->id) }}"
                                                    class="btn btn-danger">PermanentDelete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="m-3">
                                {!! $trashDepartments->links('pagination::bootstrap-5') !!}
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Form</div>
                        <div class="card-body">
                            <form action="{{ route('addDepartment') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="department_name">Rank</label><br>
                                    <input type="text" class="form-control" name="department_name">
                                </div>
                                @error('department_name')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                                <br>
                                <input type="submit" value="save" class="btn btn-primary">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
</x-app-layout>
