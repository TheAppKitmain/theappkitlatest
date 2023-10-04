@include('admin.template.partials.head')
@include('admin.template.partials.header')
@include('admin.template.partials.sidemenu')
<!-- main start-->
<main>
   <div class="main-home">
      <div class="main-wrapper maininnerallpagescontainer">
         <div class="main-container">
            <div class="main-container-inner ">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-md-12">
                        <h2 class="add_title mt-20 main-title-top">Products</h2>
                     </div>

                     @if(count($products) == 0)
                        <h1 class="no_app text-center">No Products here yet</h1>
                     @else

                     @foreach($products as $product)
                     <div class="col-md-4">
                        <div class="product-boxmain">
                        <div class="product-box-image">
                           @if(!empty($product->product_image))
                              <img class="imgsp" src="{{$product->product_image}}" alt="right-mobile">
                           @else
                              <img  class="product-imgmn product_image_screen" src="{{asset('template/images/dummy_product.jpg')}}" alt="right-mobile">
                           @endif 
                           
                           </div>
                           <div class="product-descp">
                              <h4>{{$product->name}}</h4>
                              <h5>product Quality:<span>{{$product->stock_qty}}</span></h5>
                              @if(Auth::user()->country == 'United Kingdom')                                                                 
                              <h6>product Price:<span>&#163;{{$product->product_price}}</span></h6>
                              @else
                              <h6>product Price:<span>${{$product->product_price}}</span></h6>
                              @endif

                              <p>Collection Name:<span>{{$product->get_collection_name->collection_name ?? ""}}</span></p>
                              <div class="button-bottom-products">
                              <a href="{{ route('theme.edit_variants',$product->id)}}" class="btnedit btn btn-success" id="edit_variant" name="edit_variant">Edit Variant</a>
                              <a href="{{ route('theme.products.edit',$product->id)}}" class="btnedit" id="edit" name="edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                              <a onclick="deleteProductData('{{route('theme.products.destroy',$product->id)}}')" class="btndelete" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                              </div>
                        </div>
                        </div>
                     </div>
                     @endforeach

                     @endif
                  <div class="col-md-12 mt-20 pagination-container">
                  
                  {{ $products->links() }}
            
               </div>
                    
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</main>
<!--Product Delete Modal here -->

<div id="myProductModal" class="modal fade">
   <div class="modal-dialog modal-confirm">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Are you sure?</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
         </div>
         <form method="post" action="" id="deleteProductForm">
            @csrf
            {{ method_field('DELETE') }}
            <div class="modal-body">
               <p>Do you really want to delete these records? This process cannot be undone.</p>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
               <button type="submit" class="btn btn-danger">Delete</button>
            </div>
         </form>
      </div>
   </div>
</div>

<!--Product Delete Modal End here -->
<!-- main end -->
@include('admin.template.partials.footer')