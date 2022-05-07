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
                        <div class="card">
                            <div class="card-header">Edit Form</div>
                            <div class="card-body">
                                <form action="{{  url('/service/update/'.$services->id)}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="service_name">Service Name</label><br>
                                        <input type="text" class="form-control" name="service_name" value="{{$services->service_name}}">
                                    </div>
                                    @error('service_name')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                    <br>
                                    <div class="form-group">
                                        <label for="service_image" class="mb-1">Image</label><br>
                                        <input type="file" class="form-control" name="service_image" value="{{ $services->service_image}}">
                                    </div>
                                    @error('service_image')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                    <br>
                                    <div class="form-group">
                                        <img src="{{asset($services->service_image)}}" alt="" width="400px" height="400px">
                                    </div>
                                    <input type="hidden" name="old_image" value="{{ $services->service_image}}"> {{-- เก็บเพื่อไปลบข้อมูลภาพเก่า --}}
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
