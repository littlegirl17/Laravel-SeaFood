@extends('admin.layout.layoutAdmin')
@Section('title', 'Admin | Sửa danh mục')
@Section('content')
    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center ">
            <h2 class="title-page ">
                Chỉnh sửa đơn hàng
            </h2>
            <a class="text-decoration-none text-light bg-31629e py-2 px-2" href="{{ route('admin.order') }}">Quay lại</a>
        </div>

        <form action="{{ route('admin.orderUpdate', $order->id) }}" method="post" class="mt-5" enctype="multipart/form-data">
            @csrf
            <button class="btnFormAdd ">
                Lưu
            </button>
            @method('PUT')
            <div class="row">
                <div class="col-md-10">
                    <div class="row orderAdminTable">
                        <h4>Thông tin khách hàng</h4>
                        <div class="col-md-6 ">
                            <div class="form-group mt-3">
                                <label for="title" class="form-label">Tên khách hàng</label>
                                <input type="text" class="form-control" name="name" value="{{ $order->name }}">
                            </div>
                            <div class="form-group mt-3">
                                <label for="title" class="form-label">Email</label>
                                <input type="text" class="form-control" name="email" value="{{ $order->email }}">
                            </div>
                            <div class="form-group mt-3">
                                <label for="title" class="form-label">Số điện thoại</label>
                                <input type="text" class="form-control" name="phone" value="{{ $order->phone }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mt-3">
                                <label for="title" class="form-label">Tỉnh/Thành phố</label>
                                <select class="form-select" aria-label="Default select example" name="province"
                                    id="province">
                                    @if ($order->province)
                                        <option selected value="{{ $order->province }}">{{ $order->province }}</option>
                                    @else
                                        <option selected disabled>Tỉnh/Thành phố</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group mt-3">
                                <label for="title" class="form-label">Quận/Huyện</label>
                                <select class="form-select" aria-label="Default select example" name="district"
                                    id="district">
                                    @if ($order->district)
                                        <option selected value="{{ $order->district }}">{{ $order->district }}</option>
                                    @else
                                        <option selected disabled>Quận/Huyện</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group mt-3">
                                <label for="title" class="form-label">Phường/Xã</label>
                                <select class="form-select" aria-label="Default select example" name="ward"
                                    id="ward">
                                    @if ($order->ward)
                                        <option selected value="{{ $order->ward }}">{{ $order->ward }}</option>
                                    @else
                                        <option selected disabled>Phường/Xã</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="col-md-2">

                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12 orderAdminTable">
                    <table class="table table-bordered ">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Hình</th>
                                <th>Sản phẩm</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                                <th>Tổng cộng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total = 0;
                            @endphp
                            @foreach ($productByOrderEdit as $item)
                                @php
                                    $unitPrice = $item->discount_price ?? $item->price;
                                    $thanhTien = $unitPrice * $item->quantity;
                                    $total += $thanhTien;
                                @endphp
                                <tr class="trProduct">
                                    <input type="hidden" name="productByOrderEdit[{{ $loop->index }}][product_id]"
                                        value="{{ $item->product_id }}" data-product-id="{{ $item->product_id }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="d-flex justify-content-center border-0">
                                        <img src="{{ asset('uploads/' . $item->product->image) }}" alt=""
                                            style="width: 60px; height: 60px; object-fit: cover;">
                                    </td>
                                    <td>
                                        {{ $item->name }}
                                    </td>
                                    <td class="unit-price">
                                        {{ number_format($unitPrice, 0, ',', ',') }}đ
                                    </td>
                                    <td>
                                        <input type="number" class="form-control quantity"
                                            name="productByOrderEdit[{{ $loop->index }}][newQuantity]"
                                            value="{{ $item->quantity }}" min="1">
                                    </td>
                                    <td class="thanh-tien">{{ number_format($thanhTien, 0, ',', ',') }}đ</td>
                                    <td class="total-orderProduct">{{ number_format($thanhTien, 0, ',', ',') }}đ</td>
                                    <input type="hidden"
                                        name="productByOrderEdit[{{ $loop->index }}][newTotalOrderProduct]"
                                        value="{{ $thanhTien }}">
                                </tr>
                            @endforeach

                            <tr class="trOrder">
                                <td colspan="4">
                                    <div class="form-group mt-3">
                                        <label for="title" class="form-label">Phương thức thanh toán</label>
                                        <select class="form-select" aria-label="Default select example" name="payment"
                                            id="">
                                            @foreach ($paymentMethod as $key => $value)
                                                <option value="{{ $key }}"
                                                    {{ $order->payment === $key ? 'selected' : '' }}>{{ $value }}
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="title" class="form-label">Trạng thái đơn hàng</label>
                                        <select class="form-select" aria-label="Default select example" name="status_id"
                                            id="">

                                            @foreach ($orderStatuses as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $item->id == $order->status_id ? 'selected' : 0 }}>
                                                    {{ $item->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </td>
                                <td colspan="1"></td>
                                <td colspan="2" class="total-order">
                                    {{-- <div class="form-group mt-3">
                                        <label for="title" class="form-label">Tạm tính</label>
                                        <input type="text" class="form-control" name="" value="">
                                    </div> --}}
                                    <div class="form-group mt-3">
                                        <label for="title" class="form-label">Tổng tiền</label>

                                        <p id="displayedTotalOrder">{{ number_format($total, 0, ',', ',') }}</p>

                                        <input type="hidden" class="form-control" name="total"
                                            value="{{ $total }}">
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </div>


    <script>
        // Kích hoạt khi trang web đã được tải hoàn toàn
        document.addEventListener('DOMContentLoaded', function() {
            function formatCurrency(amount) {
                // Định dạng lại thành chuẩn tiền tệ VN
                return new Intl.NumberFormat('vi-VN', {
                    style: 'currency',
                    currency: 'VND',
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0
                }).format(amount);
            }

            // Lấy ra phần tử có class quantity
            const quantityInputs = document.querySelectorAll('.quantity');

            // Duyệt qua từng phần tử trong danh sách các phần tử quantity: một sự kiện input được gắn vào, nghĩa là khi người dùng nhập vào ô này, một hành động sẽ được thực hiện
            quantityInputs.forEach(function(quantityInput) {
                // Event Listener cho sự kiện input:
                quantityInput.addEventListener('input', function() {
                    // Khi giá trị trong ô nhập thay đổi, sự kiện này được kích hoạt.

                    // Đầu tiên, nó tìm phần tử cha gần nhất có lớp là trProduct. Điều này giúp xác định sản phẩm tương ứng với ô nhập số lượng. | closest tìm phần tử cha gần nhất
                    const trProduct = this.closest('.trProduct');

                    // Lấy phần tử hiển thị giá tiền của sản phẩm bằng cách sử dụng querySelector() với lớp .unit-price
                    const unitPriceElement = trProduct.querySelector('.unit-price');

                    // Dòng thứ hai lấy giá trị của phần tử đó, sau đó chuyển đổi nó từ chuỗi sang số dạng float.
                    const unitPrice = parseFloat(unitPriceElement.innerText.replace(/[^\d]+/g, ''));
                    // Một số xử lý chuỗi được thực hiện trước đó để loại bỏ ký tự không phải số.

                    // Lấy số lượng mới của sản phẩm
                    const newQuantity = parseInt(this.value);
                    // Lấy giá trị mới của ô nhập số lượng (this là ô nhập đang được thao tác) và chuyển đổi nó thành số nguyên bằng cách sử dụng parseInt().

                    // Tính toán tổng giá trị mới của sản phẩm:
                    const thanhTienElement = trProduct.querySelector('.thanh-tien');
                    const totalOrderProductElement = trProduct.querySelector('.total-orderProduct');

                    // Tính toán tổng giá trị mới của sản phẩm
                    const newThanhTien = unitPrice * newQuantity;

                    // Cập nhật hiển thị tổng giá trị của sản phẩm
                    thanhTienElement.innerText = formatCurrency(
                        newThanhTien
                    ); // formatCurrency() được sử dụng để định dạng giá trị theo định dạng tiền tệ mong muốn.

                    // Cập nhật hiển thị tổng giá trị đơn hàng product
                    totalOrderProductElement.innerText = formatCurrency(newThanhTien);

                    // Cập nhật giá trị trong trường input ẩn
                    const newTotalOrderProductInput = trProduct.querySelector(
                        'input[name*="[newTotalOrderProduct]"]');
                    newTotalOrderProductInput.value = newThanhTien.toFixed(
                        0
                    ); // toFixed(2) đảm bảo rằng giá trị được hiển thị với chính xác hai chữ số sau dấu thập phân.

                    // Code tính toán tổng tiền của đơn hàng và cập nhật giá trị vào ô nhập tổng tiền
                    let totalOrder = 0;
                    document.querySelectorAll('.total-orderProduct').forEach(function(
                        totalOrderProductElement) {
                        totalOrder += parseFloat(totalOrderProductElement.textContent
                            .replace(/[^\d]+/g, ''));
                    });

                    const totalOrderElement = document.querySelector(
                        '.total-order input[name="total"]');
                    totalOrderElement.value = formatCurrency(totalOrder);

                    // Cập nhật giá trị của thẻ <p id="displayedTotalOrder">
                    const displayedTotalOrderElement = document.getElementById(
                        'displayedTotalOrder');
                    displayedTotalOrderElement.textContent = formatCurrency(totalOrder);

                    const orderId = window.location.pathname.split('/')
                        .pop(); // Trích xuất orderId từ URL

                    // Gửi yêu cầu AJAX để cập nhật total của orderProduct vào DB
                    const productId = this.dataset.productId;
                    const requestData = {
                        productId: productId,
                        newQuantity: newQuantity,
                        newTotalOrderProduct: parseFloat(newThanhTien.toFixed(
                            0)), // Ensure it is a float with 2 decimal places
                    };

                    console.log('Dữ liệu yêu cầu:',
                        requestData); // Ghi log dữ liệu yêu cầu để kiểm tra

                    // Gửi yêu cầu AJAX
                    const xhr = new XMLHttpRequest();
                    xhr.open('PUT', '/edit-order/' + orderId, true);
                    xhr.setRequestHeader('Content-Type', 'application/json');
                    xhr.onload = function() {
                        if (xhr.status === 200) {
                            console.log('Cập nhật tổng tiền thành công!');
                        } else {
                            console.error('Cập nhật tổng tiền thất bại!');
                        }
                    };
                    xhr.send(JSON.stringify(requestData));
                });
            });
        });
    </script>

@endsection
