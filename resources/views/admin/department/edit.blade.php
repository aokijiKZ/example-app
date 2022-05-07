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
                        <div class="alert alert-success">{{session('success')}}</div>
                    @endif
                    <div class="col-md-8">
                        <div class="card verflow-hidden shadow-xl sm:rounded-lg">
                            <div class="card-header">Edit Form</div>
                            <div class="card-body">
                                <form action="{{ url('/department/update/'.$department->id)}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="department_name">Rank</label><br>
                                        <input type="text" class="form-control" name="department_name" value="{{$department->department_name}}">
                                    </div>
                                    @error('department_name')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                    <br>
                                    <input type="submit" value="Update" class="btn btn-primary">
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
    </div>
</x-app-layout>
