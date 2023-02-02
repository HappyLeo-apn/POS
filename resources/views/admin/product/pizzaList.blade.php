@extends('admin.layouts.master')
@section('title', 'category list page')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Product List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{route('product#createPage')}}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add pizza
                                </button>  
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>  
                        </div>
                        
                    </div>
                    <div class="col-4 offset-8">
                       
                        @if (session('deleteSuccess'))
                        <div class="alert alert-danger alert-dismissible fade show " role="alert">
                            <i class="fa-solid fa-circle-xmark"></i><strong> {{ session('deleteSuccess')}}</strong> 
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                            
                        @endif
                       
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <h4 class="text-secondary">Search Key: <span class="text-danger">{{request('key')}}</span></h4>
                        </div>
                        <div class="col-3 offset-6">
                            <form action="" method="get">
                                @csrf
                                <div class="d-flex">
                                    <input type="text" name="key" class="form-control" placeholder="search" value="{{ request('key')}}">
                                <button class="btn btn-dark" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-1 offset-10 py-3 bg-light text-center shadow-sm">
                            <h4><i class="fa-solid fa-database me-2"></i>  {{$pizzas->total()}}</h4>
                        </div>
                    </div>
                    
                    <div class="table-responsive table-responsive-data2">
                        
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>View Count</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pizzas as $p)
                               <tr class="tr-shadow ">
                                <td class="col-2"><img src="{{asset('storage/' . $p->image)}}" class="image-thumbnail shadow-sm"></td>
                                <td class="col-3">{{$p->name}}</td>
                                <td class="col-2">{{$p->category_id}}</td>
                                <td class="col-2">{{$p->price}}</td>
                                <td class="col-2"><i class="fa-solid fa-eye"></i> {{$p->view_count}}</td>
                                <td class="col-2">
                                    <div class="table-data-feature">
                                        
                                        <a href="">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="zmdi zmdi-edit"></i>
                                            </button></a>
                                       <a href="">
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i class="zmdi zmdi-delete"></i>
                                        </button>
                                        
                                       </a>
                                    </div>
                                </td>
                                
                            </tr>
                               @endforeach
                                
                                
                                
                                
                            </tbody>
                        </table>
                        <div class="mt-3">
                           
                        </div>
                        
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection