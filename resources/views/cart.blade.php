<x-site-layout>
    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="w-full">
                    <div class=" h-screen py-8">
                        <div class="container mx-auto px-4">
                            <h1 class="text-2xl font-semibold mb-4">Shopping Cart</h1>
                            <div class="flex flex-col md:flex-row gap-4">
                                <div class="md:w-3/4">
                                    <div class="bg-white rounded-lg shadow-md p-6 mb-4">
                                        <table class="w-full">
                                            <thead>
                                                <tr>
                                                    <th class="text-left font-semibold">Product</th>
                                                    <th class="text-left font-semibold">Price</th>
                                                    <th class="text-left font-semibold">Quantity</th>
                                                    <th class="text-left font-semibold">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                              @php
                                                  $total=0;
                                              @endphp

                                              @forelse ($cart as $cartItem)

                                              @php
                                                  $total += $cartItem['product']->price * $cartItem['qty'];
                                              @endphp
                                              <tr>
                                                <td class="py-4">
                                                    <div class="flex items-center">
                                                        <img class="h-16 w-16 mr-4"
                                                            src={{ $cartItem['product']->image() }}
                                                            alt="Product image">
                                                        <span class="font-semibold">{{$cartItem['product']->name}}</span>
                                                    </div>
                                                </td>
                                                <td class="py-4">{{  number_format($cartItem['product']->price)  }}</td>
                                                <td class="py-4">
                                                    <div class="flex items-center">
                                                        <button class="border rounded-md py-2 px-4 mr-2">-</button>
                                                        <span class="text-center w-8">{{$cartItem['qty']}}</span>
                                                        <button class="border rounded-md py-2 px-4 ml-2 add_item" data-id="{{$cartItem['product']->id}}">+</button>
                                                        
                                                    </div>
                                                </td>
                                                <td class="py-4">{{  number_format($cartItem['product']->price * $cartItem['qty'] , 2) }}</td>
                                            </tr>
                                              @empty
                                                <tr>Cart is empty</tr>
                                              @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="md:w-1/4">
                                    <div class="bg-white rounded-lg shadow-md p-6">
                                        <h2 class="text-lg font-semibold mb-4">Summary</h2>
                                        <div class="flex justify-between mb-2">
                                            <span>Subtotal</span>
                                            <span>{{$total}}</span>
                                        </div>

                                        <div class="flex justify-between mb-2">
                                            <span>Shipping</span>
                                            <span>0.00</span>
                                        </div>
                                        <hr class="my-2">
                                        <div class="flex justify-between mb-2">
                                            <span class="font-semibold">Total</span>
                                            <span class="font-semibold">{{$total}}</span>
                                        </div>
                                        <button
                                            class="bg-blue-500 text-white py-2 px-4 rounded-lg mt-4 w-full">Checkout</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-site-layout>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
     $(document).ready(function () {
        $('.add_item').on('click', function(){
            var  productId = $(this).data('id'); 
            console.log(productId);
            $.ajax({
                url: "{{ url('/add_to_cart') }}/" +productId, // Replace with your actual route
                type: "GET",
                data: {
                    _token: "{{ csrf_token() }}", // CSRF token for security
                    product_id: productId
                },
                success: function (response) {
                    alert('Item added to cart successfully');
                  
                },
                error: function (xhr) {
                    alert('Error adding item to cart');
                    console.error(xhr.responseText);
                }
            });
});
});
</script>