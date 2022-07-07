<!--########## Products - Container ##########-->
@push('scripts')
    <script src="{{asset('js/web/public/products/container.js')}}"></script>
@endpush
@if(!$readOnly)
    <select id="web-public-products-container-products-{{$name}}" class="ht-slc fz-md" style="width: 80%;">
        <option value="">Selecciona un producto</option>
        @foreach($products as $product)
            <option value="{{$product->id}}" data-price="{{$product->price}}">{{$product->name}}</option>
        @endforeach
    </select>
    <input id="web-public-products-container-quantity-{{$name}}" class="fz-md ht-inp" type="number" style="width: 40%;" placeholder="Cantidad">
    &nbsp;&nbsp;&nbsp;
    <a href="#" class="ht-btn ht-btn-sm ht-btn-dgray" onclick="addProductInOrder('{{$name}}')">Agregar</a>
    <br/><br/>
@endif
<div id="web-public-products-container-container-{{$name}}" class="ht-container">
    @if(isset($orderProducts) && !empty($orderProducts))
        @foreach($orderProducts as $product)
            <p class="ht-item fz-sm" id="{{$product->id}}" data-subtotal="{{$product->pivot->subtotal}}" data-quantity="{{$product->pivot->quantity}}">
                {{$product->pivot->quantity}} - {{$product->name}}
                @if(!$readOnly)
                    <i class="fa fa-times fz-md ht-close" onclick="removeProductInOrder('{{$name}}','{{$product->id}}')"></i>
                @endif
            </p>
        @endforeach
    @endif
</div>
<p id="web-public-products-container-total-{{$name}}" class="fz-lg fw-1 ht-txt-title">Total: $0</p>
