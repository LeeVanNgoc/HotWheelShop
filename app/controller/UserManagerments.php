<?php

class UserManagerments extends Controller {

    private $userManagermentModel;

    public function __construct() {
         new Session;
        $this->userManagermentModel = $this->model('UserManagerment'); // Khởi tạo model
    }

    /*>>>>>>>>>>>>>>>>>>>>*/
    #<--->   index    <--->#
    /*<<<<<<<<<<<<<<<<<<<<*/
    public function index() {
        Auth::adminAuth();
        $data['title1'] = 'User Managerment'; // Tiêu đề trang
        $data['userManagerments'] = $this->userManagermentModel->getAllUsers(); // Lấy danh sách người dùng từ model
        $this->view('userManagerments.all', $data); // Truyền dữ liệu ra view
    }

public function add() {
    Auth::adminAuth(); // Kiểm tra quyền Admin
    Csrf::CsrfToken(); // Tạo và kiểm tra CSRF token
    $data['title1'] = 'Add User';

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addUser'])) {
        // Nhận dữ liệu từ form
        $name = filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm_password'];
        $admin = $_POST['admin'];
        $active = isset($_POST['active']) ? 1 : 0; // Kiểm tra trạng thái active (checkbox)

        // Kiểm tra dữ liệu hợp lệ
        if (empty($name) || empty($email) || empty($password) || empty($confirmPassword) || empty($admin)) {
            $data['error'] = "Please fill in all fields.";
            $this->view('userManagerments.add', $data);
            return;
        }

        if ($password !== $confirmPassword) {
            $data['error'] = "Passwords do not match.";
            $this->view('userManagerments.add', $data);
            return;
        }

        if ($this->userManagermentModel->findUserByEmail($email)) {
            $data['error'] = "Email already exists!";
            $this->view('userManagerments.add', $data);
            return;
        }

        // Xử lý tải ảnh lên
        $imageName = "default.png"; // Ảnh mặc định
        if (!empty($_FILES['profile_image']['name'])) {
            $imageTmpPath = $_FILES['profile_image']['tmp_name'];
            $imageName = time() . "_" . basename($_FILES['profile_image']['name']);
            $imagePath = "uploads/" . $imageName;

            if (!move_uploaded_file($imageTmpPath, $imagePath)) {
                $data['error'] = "Failed to upload image.";
                $this->view('userManagerments.add', $data);
                return;
            }
        }

        // Mã hóa mật khẩu trước khi lưu vào cơ sở dữ liệu
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Thêm người dùng vào cơ sở dữ liệu, đã xác nhận và có trạng thái active
        if ($this->userManagermentModel->addUser($name, $email, $hashedPassword, $admin, 1, $active, $imageName)) {
            Session::set('success', 'User added successfully and auto-confirmed!');
            Redirect::to('/userManagerments');
        } else {
            $data['error'] = "Failed to add user.";
            $this->view('userManagerments.add', $data);
        }
    } else {
        // Hiển thị form thêm người dùng
        $this->view('userManagerments.add');
    }
}


    // ✅ Xóa logic xác nhận email, chỉ dùng confirm() để đăng nhập tự động
    public function confirm($v = null) {
        Auth::userGuest();
        $data['title1'] = 'Confirm';

        if (Session::name('email') != null && Session::name('email') != '') {
            // ✅ Tự động đăng nhập nếu user đã được tạo
            $email = Session::name('email');
            $user = $this->userManagermentModel->findUserByEmail($email);

            if ($user) {
                Session::set('success', 'Your account has been auto-confirmed!');
                Session::set('user_id', $user->user_id);
                Session::set('user_name', $user->full_name);
                Session::set('user_img', $user->image);
                Session::clear('email');
                Redirect::to('users/profile');
            }
        } else {
            Redirect::to('users/login');
        }
    }

    public function edit($user_id) {
        Auth::adminAuth(); // Kiểm tra quyền Admin
        Csrf::CsrfToken(); // Tạo và kiểm tra CSRF token
        $data['title1'] = 'Edit User';

        // Lấy thông tin người dùng từ DB
        $user = $this->userManagermentModel->getUserById($user_id);

        // Kiểm tra nếu không tìm thấy người dùng
        if (!$user) {
            Session::set('error', 'User not found!');
            Redirect::to('/userManagerments');
            return;
        }

        // Truyền thông tin người dùng vào biến data
        $data['user'] = $user;

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['editUser'])) {
            // Nhận dữ liệu từ form
            $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];
            $role = $_POST['role'];  // Lấy giá trị role (admin hoặc user)
            $active = isset($_POST['active']) ? 1 : 0; // Kiểm tra nếu có checkbox active

            // Kiểm tra tính hợp lệ của dữ liệu
            if (empty($name) || empty($email)) {
                $data['errName'] = "Name is required.";
                $data['errEmail'] = "Email is required.";
                $this->view('userManagerments.update', $data);
                return;
            }

            if ($password && $password !== $confirmPassword) {
                $data['errPassword'] = "Passwords do not match.";
                $this->view('userManagerments.update', $data);
                return;
            }

            // Nếu có mật khẩu mới, mã hóa và cập nhật
            if ($password) {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            } else {
                $hashedPassword = $user->password; // Giữ mật khẩu cũ nếu không có mật khẩu mới
            }

            // Kiểm tra ảnh đại diện (nếu có)
            if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
                $image = $this->uploadAvatar($user_id); // Gọi hàm uploadAvatar để upload ảnh
            } else {
                $image = $user->image; // Nếu không thay đổi ảnh, giữ ảnh cũ
            }

            // Cập nhật thông tin người dùng vào cơ sở dữ liệu
            if ($this->userManagermentModel->updateUser($user_id, $name, $email, $hashedPassword, $role, $active, $image)) {
                Session::set('success', 'User updated successfully!');
                Redirect::to('/userManagerments');
            } else {
                $data['errRole'] = "Failed to update user.";
                $this->view('userManagerments.update', $data);
            }
        } else {
            $this->view('userManagerments.edit', $data);
        }
    }

    // Hàm xử lý upload avatar trực tiếp
    private function uploadAvatar($id) {
        $image = $_FILES['profile_image']['name'];
        $imageTmp = $_FILES['profile_image']['tmp_name'];
        $imageType = $_FILES['profile_image']['type'];

        if (!empty($image)) {
            $uploadDir = dirname(ROOT) . '/public/uploads/';
            $imageExt = pathinfo($image, PATHINFO_EXTENSION);
            $imageName = time() . '.' . $imageExt;

            if (!in_array($imageExt, ['jpg', 'png', 'jpeg', 'gif'])) {
                return 'Invalid image format';
            }

            move_uploaded_file($imageTmp, $uploadDir . $imageName);

            // Nếu có ảnh cũ, xóa ảnh cũ trước khi cập nhật ảnh mới
            if (!empty($image)) {
                $currentImagePath = $uploadDir . $image;
                if (file_exists($currentImagePath)) {
                    unlink($currentImagePath);
                }
            }

            // Cập nhật ảnh mới trong cơ sở dữ liệu
            $this->userManagermentModel->updateAvatar($id, $imageName);
            return $imageName;
        }
        return 'default.jpg'; // Trả về ảnh mặc định nếu không có ảnh
    }


    // Xóa người dùng
    public function delete($id) {
        Auth::adminAuth();
        Csrf::CsrfToken();
        $data['title1'] = 'Delete User';
        if ($this->userManagermentModel->deleteUser($id)) {
            Session::set('success', 'User deleted successfully!');
        } else {
            Session::set('error', 'Failed to delete user!');
        }
        Redirect::to('/userManagerments');
    }

    // Kích hoạt hoặc vô hiệu hóa người dùng
    public function toggleStatus($id) {
        Auth::adminAuth();
        Csrf::CsrfToken();
        if ($this->userManagermentModel->toggleUserStatus($id)) {
            Session::set('success', 'User status updated successfully!');
        } else {
            Session::set('error', 'Failed to update user status!');
        }
        Redirect::to('/userManagerments');
    }

    public function show($id) {
        Auth::adminAuth(); // Kiểm tra quyền Admin
        Csrf::CsrfToken(); // Kiểm tra CSRF token

        // Lấy thông tin người dùng từ DB
        $user = $this->userManagermentModel->getUserById($id);

        // Kiểm tra nếu không tìm thấy người dùng
        if (!$user) {
            Session::set('error', 'User not found!');
            Redirect::to('/userManagerments');
            return;
        }

        // Truyền thông tin người dùng vào biến data
        $data = [
            'title1' => 'User Details',
            'user'   => $user
        ];

        // Hiển thị trang chi tiết người dùng
        $this->view('userManagerments.show', $data);
    }
}
