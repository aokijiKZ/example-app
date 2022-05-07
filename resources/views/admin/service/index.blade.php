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
                    <div class="card overflow-hidden shadow-xl sm:rounded-lg">
                        <div class="card-header">Service table</div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">CreateAt</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($services as $service)
                                    <tr>
                                        <th scope="row">{{ $services->firstItem() + $loop->index }}</th>
                                        <td><img src="{{asset($service->service_image)}}" alt="" width="100px" height="100px"></td>
                                        <td>{{ $service->service_name }}</td> {{-- function user ใน model department เเละ fill name ของ table --}}
                                        <td>{{ $service->created_at->diffForHumans() }}</td>
                                        <td>
                                            <a href="{{ url('/service/edit/'.$service->id) }}"
                                                class="btn btn-primary">Edit</a>
                                            <a href="{{ url('/service/delete/'.$service->id) }}"
                                                class="btn btn-danger" onclick="return confirm('Do you want to delete service data?')">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="m-3">
                            {!! $services->links('pagination::bootstrap-5') !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card overflow-hidden shadow-xl sm:rounded-lg">
                        <div class="card-header">Form</div>
                        <div class="card-body">
                            <form action="{{ route('addService')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="service_name" class="mb-1">Service</label><br>
                                    <input type="text" class="form-control" name="service_name">
                                </div>
                                @error('service_name')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                                <br>
                                <div class="form-group">
                                    <label for="service_image" class="mb-1">Image</label><br>
                                    <input type="file" class="form-control" name="service_image">
                                </div>
                                @error('service_image')
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
