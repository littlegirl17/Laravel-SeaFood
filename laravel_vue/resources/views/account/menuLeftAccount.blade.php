<div class="menuLeftAccount menuLeftAccount_back">
    <ul>
        <li><i class="fa-regular fa-user pe-1"></i>Tài khoản của tôi</li>
        <li><a href="{{ route('account.profile') }}">Hồ sơ</a></li>
        <li><a href="{{ route('account.address') }}">Địa chỉ</a></li>
        <li><a href="{{ route('account.password') }}">Đổi mật khẩu</a></li>
        <li>
            <span class="toggle-submenu">Đơn mua</span>
            <ul class="sub_menuLeftAccount">
                <li><a href="{{ route('account.purchase') }}">Tất cả</a></li>
                <li><a href="">Chờ thanh toán</a></li>
                <li><a href="">Vận chuyển</a></li>
                <li><a href="">Hoàn thành</a></li>
                <li><a href="">Đã hủy</a></li>
            </ul>
        </li>
    </ul>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const submenuToggle = document.querySelector('.toggle-submenu');
        const submenu = document.querySelector('.sub_menuLeftAccount');
        submenuToggle.addEventListener('click', function(e) {
            e.preventDefault(); // Ngăn chặn hành động mặc định của liên kết
            submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
        })
    });
</script>
