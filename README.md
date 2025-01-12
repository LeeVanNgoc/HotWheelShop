# HotwheelShop

## Mô Tả

HotwheelShop là một trang web cho phép người dùng tìm kiếm, xem thông tin, và mua bán ô tô. Dự án bao gồm các chức năng cho cả **Customer** (khách hàng) và **Admin** (quản trị viên) để quản lý các sản phẩm và đơn hàng.
Dự án được thiết kết theo mô hình MVC

## Chức Năng

### Phần cho Customer

1. **Đăng ký:** Cho phép người dùng tạo tài khoản trên hệ thống để trở thành thành viên, có quyền truy cập các chức năng của website.
2. **Đăng nhập:** Cho phép người dùng nhập thông tin tài khoản để truy cập vào hệ thống, với quyền hạn đã đăng ký hoặc xác nhận.
3. **Xem sản phẩm:** Người dùng có thể duyệt qua danh sách sản phẩm, xem chi tiết về các mặt hàng mà website cung cấp.
4. **Tìm sản phẩm:** Chức năng tìm kiếm giúp người dùng tìm ra các sản phẩm dựa trên các từ khóa hoặc bộ lọc cụ thể.
5. **Thêm sản phẩm vào giỏ hàng:** Chức năng cho phép người dùng chọn sản phẩm và thêm vào giỏ hàng để mua sau.
6. **Thanh toán:** Người dùng thực hiện thanh toán cho các sản phẩm đã chọn trong giỏ hàng, hoàn tất giao dịch mua hàng.
7. **Chỉnh sửa hồ sơ:** Người dùng có thể chỉnh sửa thông tin cá nhân của mình như tên, địa chỉ, số điện thoại, email,... trong hệ thống.

### Phần cho Admin

8. **Quản lý sản phẩm:** Admin có quyền thêm, sửa, xóa sản phẩm, cập nhật thông tin về sản phẩm trên website.
9. **Quản lý nhà sản xuất:** Admin có thể thêm, sửa, xóa thông tin về các nhà sản xuất hoặc thương hiệu sản phẩm trên hệ thống.
10. **Quản lý loại sản phẩm:** Admin có thể quản lý các loại sản phẩm, phân loại và tổ chức sản phẩm trong các nhóm, danh mục cụ thể.
11. **Quản lý đơn hàng:** Admin có quyền theo dõi, xử lý, cập nhật tình trạng đơn hàng và thông tin liên quan đến giao dịch.
12. **Quản lý người dùng:** Admin có thể quản lý các tài khoản người dùng, bao gồm việc thêm, xóa, sửa thông tin người dùng và phân quyền sử dụng hệ thống.

## Công Nghệ Sử Dụng

- **Frontend:** HTML, CSS, JavaScript, Bootstrap
- **Backend:** PHP, JavaScript
- **Cơ sở dữ liệu:** MySQL

## Yêu cầu hệ thống

- PHP >= 8.2
- MySQL
- Composer
- XAMPP hoặc bất kỳ server cục bộ nào hỗ trợ PHP và MySQL.

## Cài Đặt

1. **Clone repository:**
   ```bash
   git clone https://github.com/LeeVanNgoc/HotwheelShop.git
   ```
2. **Cài đặt các thư viện thông qua Composer:**
   ```bash
   composer install
   ```
3. **Tạo cơ sở dữ liệu và nhập file hotwheelshop.sql:**

- Mở phpMyAdmin hoặc công cụ quản lý MySQL.
- Tạo một database mới (ví dụ: hotwheelshop).
- Nhập file hotwheelshop.sql vào database vừa tạo.

4. **Chạy ứng dụng:**

- Đưa dự án vào thư mục htdocs của XAMPP.
- Mở trình duyệt và truy cập:
  http://localhost/HotWheelShop/home
