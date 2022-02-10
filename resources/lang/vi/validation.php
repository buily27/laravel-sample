<?php

return [
    'required' => 'Trường này không được để trống',
    'email' => 'Sai định dạng email',
    'mimes' => 'Ảnh chỉ được có đuôi jpg, jpeg, png',
    'name' => [
        'min' => "Phải nhập tối thiểu :min kí tự",
        'max' => "Chỉ được nhập tối đa :max kí tự"
    ],
    'max' => [
        'string' => 'Không được nhập quá :max kí tự',
        'size' => 'Ảnh phải có dung lượng nhỏ hơn :max',
    ],
    'department_min' => 'Không được ít hơn :min ký tự',
    'department_max' => 'Tối đa chỉ được :max kí tự',
    'regex' => [
        'phone' => 'Số điện thoại phải có 10 số'
    ],
    'role' => 'Yêu cầu chọn chức vụ',
    'department' => 'Yêu cầu chọn phòng ban',
    'unique' => [
        'username' => 'Email đã bị trùng',
        'phone' => 'Số điện thoại đã bị trùng',
        'department' => 'Tên phòng ban đã bị trùng'
    ],
    'password' => [
        'min' => "Phải nhập tối thiểu :min kí tự",
        'max' => "Chỉ được nhập tối đa :max kí tự",
        'regex' => 'Phải gồm 1 chữ, 1 chữ số, 1 kí tự đặc biệt',
        'confirm' => "Mật khẩu và xác nhận phải trùng nhau",
        'old' => 'Mật khẩu cũ không chính xác',
    ],
    'dob_before' => 'Ngày sinh phải là trước hôm nay',
    'exists' => 'Giá trị không tồn tại! Mời nhập lại!',
];
