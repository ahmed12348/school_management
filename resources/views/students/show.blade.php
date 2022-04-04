@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Product</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Title:</strong>
                {{ $product->title }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>price:</strong>
                {{ $product->price }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Stock:</strong>
                {{ $product->stock }}
            </div>
        </div>
        @can('product-edit')
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">

                @if($product->active == '1')
                                <label class="py-2 px-3 badge btn-danger">Non Active </label>
                            @elseif($product->active == '0')
                                <label class="py-2 px-3 badge btn-primary"> Active</label>
                            @endif
            </div>
        </div>
        @endcan
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <a class="btn btn-dark" href="{{ route('products.not') }}">Add To Cart</a>
		    </div>
    </div>
    <script>

    </script>
@endsection

