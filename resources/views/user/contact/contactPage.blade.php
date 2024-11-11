@extends('user.layouts.master')

@section('content')
    <!-- Cart Start -->
    <div class="container-fluid col-6 offset-3">
        <h2 class="section-title position-relative text-uppercase text-center mb-4"> Contact Us</h2>
        <div class="row px-xl-5">

            @if (session('contactSuccess'))
                            <div class="">
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="zmdi zmdi-close-circle"></i>  {{ session('contactSuccess') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                        @endif

            <div class="col-10 offset-1">
                <div class="contact-form bg-light">
                    <div id="success"></div>
                    <form action="{{ route('user#contactInfo') }}" method="post">
                        @csrf
                            <div class="control-group">
                                <input type="text" class="form-control" name="name" placeholder="Enter Your Name"
                                    required="required"/>
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="control-group">
                                <input type="email" class="form-control" name="email" placeholder="Enter Your Email"
                                    required="required"/>
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="control-group">
                                <textarea class="form-control" rows="8" name="message" placeholder="Enter Message"
                                    required="required"></textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                            <div>
                            <button class="btn bg-primary py-2 px-4 text-white" type="submit" id="sendMessageButton">Send
                                Message</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <!-- Cart End -->
@endsection

{{-- @section('scriptSource')
    <script src="{{ asset('js/cart.js') }}"></script>
    <script>
        $('#orderBtn').click(function(){
            $orderList = [];

            $random = Math.floor(Math.random() * 10000001);
            console.log($random);
            $('#dataTable tbody tr').each(function(index,row){
                $orderList.push({
                    'user_id' : $(row).find('.userId').val() ,
                    'product_id' : $(row).find('.productId').val() ,
                    'qty' : $(row).find('#qty').val() ,
                    'total' : $(row).find('#total').text().replace("Kyats","")*1 ,
                    'order_code' : 'POS'+$random
                });
            });


            $.ajax({
                type : 'get' ,
                url : 'http://127.0.0.1:8000/user/ajax/order' ,
                data : Object.assign({}, $orderList) ,
                dataType : 'json' ,
                success : function(response){
                    if(response.status == 'success'){
                        window.location.href = "http://127.0.0.1:8000/user/homePage" ;
                    }
                }
            })
        });

        // when clear button click
        $('#clearBtn').click(function(){
            $.ajax({
                type : 'get' ,
                url : 'http://127.0.0.1:8000/user/ajax/clear/cart' ,
                dataType : 'json' ,
            })

            $("#dataTable tbody tr").remove();
            $("#subTotalPrice").html("0 Kyats");
            $("#finalPrice").html("5000 Kyats");
        })

        // when x button click
        $('.btnRemove').click(function(){
            $parentNode = $(this).parents("tr");
            $productId = $parentNode.find('.productId').val();

            $.ajax({
                type : 'get' ,
                url : 'http://127.0.0.1:8000/user/ajax/clear/current/product' ,
                data : {'productId' : $productId}
                // dataType : 'json'
            })

            $parentNode.remove();

            $totalPrice = 0;
            $('#dataTable tr').each(function(index,row){
                $totalPrice += Number($(row).find('#total').text().replace("Kyats",""));
            });

            $("#subTotalPrice").html(`${$totalPrice} Kyats`);
            $("#finalPrice").html(`${$totalPrice+5000} Kyats`);
        })


    </script>
@endsection --}}

