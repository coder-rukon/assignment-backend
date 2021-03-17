<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create new product') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li class="color-red">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="post" class="form" action="{{route('product.create.request')}}" enctype="multipart/form-data" >
                        @csrf
                        <div class="form-group">
                            <label class="w-full py-2 block">Title *</label>
                            <input type="text" class="px-4 py-3 round-full w-full" name="title" placeholder="Title" value="{{old('title')}}"/>
                        </div>
                        
                        <div class="form-group">
                            <label class="w-full py-2 block">Price *</label>
                            <input type="number" class="px-4 py-3 w-full" name="price" placeholder="Price"  value="{{old('price')}}"/>
                        </div>
                        
                        <div class="form-group">
                            <label class="w-full py-2 block">Description *</label>
                            <textarea class="px-4 py-3 w-full" rows="5" name="description" placeholder="Description">{{old('description')}}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="w-full py-2 block">Image *</label>
                            <input type="file" class="px-4 py-3 w-full" name="image" placeholder="Image"/>
                        </div>
                        <button class="rs_btn">Save Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
