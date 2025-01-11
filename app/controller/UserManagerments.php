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
            $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password']; // Thêm xác nhận mật khẩu
            $admin = $_POST['admin']; // Lấy giá trị admin từ form (admin hoặc user)

            // Kiểm tra nếu dữ liệu hợp lệ
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

            // Mã hóa mật khẩu trước khi lưu vào cơ sở dữ liệu
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Thêm người dùng mới vào cơ sở dữ liệu, bao gồm cả admin
            if ($this->userManagermentModel->addUser($name, $email, $hashedPassword, $admin)) {
                Session::set('success', 'User added successfully!');
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
            $admin = $_POST['role'];  // Lấy giá trị role (admin hoặc user)
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

            // Cập nhật người dùng
            if ($this->userManagermentModel->updateUser($user_id, $name, $email, $hashedPassword, $admin, $active)) {
                Session::set('success', 'User updated successfully!');
                Redirect::to('/userManagerments');
            } else {
                $data['errRole'] = "Failed to update user.";
                $this->view('userManagerments.update', $data);
            }
        } else {
            // Nếu chưa gửi form, chỉ cần hiển thị form với dữ liệu hiện tại
            $this->view('userManagerments.edit', $data);
        }
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
}
