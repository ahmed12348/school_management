@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Product</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
            </div>
        </div>
    </div>


    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('products.update',$product->id) }}" method="POST">
    	@csrf
        @method('PUT')


         <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Title:</strong>
		            <input type="text" name="title" value="{{ $product->title }}" class="form-control" placeholder="title">
		        </div>
		    </div>
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Price:</strong>
                    <input type="number" name="price"value="{{ $product->price }}"  class="form-control" placeholder="price">
                		        </div>
		    </div>


		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>stock:</strong>
                    <input type="number" name="stock" value="{{ $product->stock }}"class="form-control" placeholder="stock">
                        </div>
		    </div>

                        <div class="form-group">
                        <input type="radio" id="active" name="active" value="0"
                        <?php if ($product['active'] == 0) { echo "checked='checked'"; } ?>>
                        <label for="active"> Active </label><br>

                        <input type="radio" id="active" name="active" value="1"
                        <?php if ($product['active'] == 1) { echo "checked='checked'"; } ?>>
                        <label for="active">  Non Active  </label><br>
                        </div>

		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
		      <button type="submit" class="btn btn-primary">Submit</button>
		    </div>
		</div>


    </form>



@endsection
