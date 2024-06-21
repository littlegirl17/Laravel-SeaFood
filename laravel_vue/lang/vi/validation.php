<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Các dòng ngôn ngữ dưới đây chứa các thông báo lỗi mặc định được sử dụng bởi
    | lớp validator. Một số quy tắc này có nhiều phiên bản khác nhau như
    | quy tắc kích thước. Bạn có thể điều chỉnh từng thông báo ở đây.
    |
    */

    'accepted' => 'Trường :attribute phải được chấp nhận.',
    'accepted_if' => 'Trường :attribute phải được chấp nhận khi :other là :value.',
    'active_url' => 'Trường :attribute phải là một URL hợp lệ.',
    'after' => 'Trường :attribute phải là ngày sau ngày :date.',
    'after_or_equal' => 'Trường :attribute phải là ngày sau hoặc bằng :date.',
    'alpha' => 'Trường :attribute chỉ được chứa các ký tự chữ cái.',
    'alpha_dash' => 'Trường :attribute chỉ được chứa các ký tự chữ cái, số, dấu gạch ngang và gạch dưới.',
    'alpha_num' => 'Trường :attribute chỉ được chứa các ký tự chữ cái và số.',
    'array' => 'Trường :attribute phải là một mảng.',
    'ascii' => 'Trường :attribute chỉ được chứa các ký tự alphanumeric và ký tự đặc biệt.',
    'before' => 'Trường :attribute phải là ngày trước ngày :date.',
    'before_or_equal' => 'Trường :attribute phải là ngày trước hoặc bằng :date.',
    'between' => [
        'array' => 'Trường :attribute phải có từ :min đến :max phần tử.',
        'file' => 'Trường :attribute phải có kích thước từ :min đến :max kilobytes.',
        'numeric' => 'Trường :attribute phải nằm giữa :min và :max.',
        'string' => 'Trường :attribute phải có từ :min đến :max ký tự.',
    ],
    'boolean' => 'Trường :attribute phải là true hoặc false.',
    'can' => 'Trường :attribute chứa một giá trị không được phép.',
    'confirmed' => 'Xác nhận trường :attribute không khớp.',
    'current_password' => 'Mật khẩu không chính xác.',
    'date' => 'Trường :attribute phải là một ngày hợp lệ.',
    'date_equals' => 'Trường :attribute phải là một ngày bằng :date.',
    'date_format' => 'Trường :attribute phải khớp với định dạng :format.',
    'decimal' => 'Trường :attribute phải có :decimal chữ số thập phân.',
    'declined' => 'Trường :attribute phải bị từ chối.',
    'declined_if' => 'Trường :attribute phải bị từ chối khi :other là :value.',
    'different' => 'Trường :attribute và :other phải khác nhau.',
    'digits' => 'Trường :attribute phải có :digits chữ số.',
    'digits_between' => 'Trường :attribute phải có từ :min đến :max chữ số.',
    'dimensions' => 'Trường :attribute có kích thước hình ảnh không hợp lệ.',
    'distinct' => 'Trường :attribute có giá trị trùng lặp.',
    'doesnt_end_with' => 'Trường :attribute không được kết thúc bằng các giá trị sau: :values.',
    'doesnt_start_with' => 'Trường :attribute không được bắt đầu bằng các giá trị sau: :values.',
    'email' => 'Trường :attribute phải là một địa chỉ email hợp lệ.',
    'ends_with' => 'Trường :attribute phải kết thúc bằng một trong các giá trị sau: :values.',
    'enum' => 'Lựa chọn :attribute không hợp lệ.',
    'exists' => 'Lựa chọn :attribute không hợp lệ.',
    'extensions' => 'Trường :attribute phải có một trong các phần mở rộng sau: :values.',
    'file' => 'Trường :attribute phải là một tập tin.',
    'filled' => 'Trường :attribute phải có giá trị.',
    'gt' => [
        'array' => 'Trường :attribute phải có nhiều hơn :value phần tử.',
        'file' => 'Trường :attribute phải lớn hơn :value kilobytes.',
        'numeric' => 'Trường :attribute phải lớn hơn :value.',
        'string' => 'Trường :attribute phải có nhiều hơn :value ký tự.',
    ],
    'gte' => [
        'array' => 'Trường :attribute phải có ít nhất :value phần tử.',
        'file' => 'Trường :attribute phải lớn hơn hoặc bằng :value kilobytes.',
        'numeric' => 'Trường :attribute phải lớn hơn hoặc bằng :value.',
        'string' => 'Trường :attribute phải có ít nhất :value ký tự.',
    ],
    'hex_color' => 'Trường :attribute phải là một mã màu hex hợp lệ.',
    'image' => 'Trường :attribute phải là một hình ảnh.',
    'in' => 'Lựa chọn :attribute không hợp lệ.',
    'in_array' => 'Trường :attribute phải tồn tại trong :other.',
    'integer' => 'Trường :attribute phải là một số nguyên.',
    'ip' => 'Trường :attribute phải là một địa chỉ IP hợp lệ.',
    'ipv4' => 'Trường :attribute phải là một địa chỉ IPv4 hợp lệ.',
    'ipv6' => 'Trường :attribute phải là một địa chỉ IPv6 hợp lệ.',
    'json' => 'Trường :attribute phải là một chuỗi JSON hợp lệ.',
    'list' => 'Trường :attribute phải là một danh sách.',
    'lowercase' => 'Trường :attribute phải là chữ thường.',
    'lt' => [
        'array' => 'Trường :attribute phải có ít hơn :value phần tử.',
        'file' => 'Trường :attribute phải nhỏ hơn :value kilobytes.',
        'numeric' => 'Trường :attribute phải nhỏ hơn :value.',
        'string' => 'Trường :attribute phải có ít hơn :value ký tự.',
    ],
    'lte' => [
        'array' => 'Trường :attribute không được có nhiều hơn :value phần tử.',
        'file' => 'Trường :attribute phải nhỏ hơn hoặc bằng :value kilobytes.',
        'numeric' => 'Trường :attribute phải nhỏ hơn hoặc bằng :value.',
        'string' => 'Trường :attribute phải có ít hơn hoặc bằng :value ký tự.',
    ],
    'mac_address' => 'Trường :attribute phải là một địa chỉ MAC hợp lệ.',
    'max' => [
        'array' => 'Trường :attribute không được có nhiều hơn :max phần tử.',
        'file' => 'Trường :attribute không được lớn hơn :max kilobytes.',
        'numeric' => 'Trường :attribute không được lớn hơn :max.',
        'string' => 'Trường :attribute không được lớn hơn :max ký tự.',
    ],
    'max_digits' => 'Trường :attribute không được có nhiều hơn :max chữ số.',
    'mimes' => 'Trường :attribute phải là một tập tin có loại: :values.',
    'mimetypes' => 'Trường :attribute phải là một tập tin có loại: :values.',
    'min' => [
        'array' => 'Trường :attribute phải có ít nhất :min phần tử.',
        'file' => 'Trường :attribute phải lớn hơn hoặc bằng :min kilobytes.',
        'numeric' => 'Trường :attribute phải lớn hơn hoặc bằng :min.',
        'string' => 'Trường :attribute phải có ít nhất :min ký tự.',
    ],
    'min_digits' => 'Trường :attribute phải có ít nhất :min chữ số.',
    'missing' => 'Trường :attribute phải thiếu.',
    'missing_if' => 'Trường :attribute phải thiếu khi :other là :value.',
    'missing_unless' => 'Trường :attribute phải thiếu trừ khi :other là :value.',
    'missing_with' => 'Trường :attribute phải thiếu khi :values hiện diện.',
    'missing_with_all' => 'Trường :attribute phải thiếu khi :values hiện diện.',
    'multiple_of' => 'Trường :attribute phải là bội số của :value.',
    'not_in' => 'Lựa chọn :attribute không hợp lệ.',
    'not_regex' => 'Định dạng của trường :attribute không hợp lệ.',
    'numeric' => 'Trường :attribute phải là một số.',
    'password' => [
        'letters' => 'Trường :attribute phải chứa ít nhất một chữ cái.',
        'mixed' => 'Trường :attribute phải chứa ít nhất một chữ cái viết hoa và một chữ cái viết thường.',
        'numbers' => 'Trường :attribute phải chứa ít nhất một số.',
        'symbols' => 'Trường :attribute phải chứa ít nhất một ký tự đặc biệt.',
        'uncompromised' => ':attribute đã xuất hiện trong một rò rỉ dữ liệu. Vui lòng chọn một :attribute khác.',
    ],
    'present' => 'Trường :attribute phải có mặt.',
    'present_if' => 'Trường :attribute phải có mặt khi :other là :value.',
    'present_unless' => 'Trường :attribute phải có mặt trừ khi :other là :value.',
    'present_with' => 'Trường :attribute phải có mặt khi :values hiện diện.',
    'present_with_all' => 'Trường :attribute phải có mặt khi :values hiện diện.',
    'prohibited' => 'Trường :attribute bị cấm.',
    'prohibited_if' => 'Trường :attribute bị cấm khi :other là :value.',
    'prohibited_unless' => 'Trường :attribute bị cấm trừ khi :other nằm trong :values.',
    'prohibits' => 'Trường :attribute cấm :other có mặt.',
    'regex' => 'Định dạng của trường :attribute không hợp lệ.',
    'required' => 'Trường :attribute là bắt buộc.',
    'required_array_keys' => 'Trường :attribute phải chứa các mục cho: :values.',
    'required_if' => 'Trường :attribute là bắt buộc khi :other là :value.',
    'required_if_accepted' => 'Trường :attribute là bắt buộc khi :other được chấp nhận.',
    'required_if_declined' => 'Trường :attribute là bắt buộc khi :other bị từ chối.',
    'required_unless' => 'Trường :attribute là bắt buộc trừ khi :other nằm trong :values.',
    'required_with' => 'Trường :attribute là bắt buộc khi :values hiện diện.',
    'required_with_all' => 'Trường :attribute là bắt buộc khi :values hiện diện.',
    'required_without' => 'Trường :attribute là bắt buộc khi :values không hiện diện.',
    'required_without_all' => 'Trường :attribute là bắt buộc khi không có :values nào hiện diện.',
    'same' => 'Trường :attribute phải khớp với :other.',
    'size' => [
        'array' => 'Trường :attribute phải chứa :size mục.',
        'file' => 'Trường :attribute phải có kích thước :size kilobytes.',
        'numeric' => 'Trường :attribute phải là :size.',
        'string' => 'Trường :attribute phải có :size ký tự.',
    ],
    'starts_with' => 'Trường :attribute phải bắt đầu bằng một trong các giá trị sau: :values.',
    'string' => 'Trường :attribute phải là một chuỗi.',
    'timezone' => 'Trường :attribute phải là một múi giờ hợp lệ.',
    'unique' => ':attribute đã được sử dụng.',
    'uploaded' => ':attribute tải lên không thành công.',
    'uppercase' => 'Trường :attribute phải là chữ hoa.',
    'url' => 'Trường :attribute phải là một URL hợp lệ.',
    'ulid' => 'Trường :attribute phải là một ULID hợp lệ.',
    'uuid' => 'Trường :attribute phải là một UUID hợp lệ.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */
    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Thuộc tính Tùy chỉnh cho Kiểm tra
    |--------------------------------------------------------------------------
    |
    | Những dòng ngôn ngữ sau được sử dụng để thay thế các vị trí
    | thuộc tính của chúng tôi bằng một cái gì đó dễ đọc hơn như
    | "Địa chỉ E-Mail" thay vì "email". Điều này giúp chúng ta làm cho
    | thông báo của chúng tôi mạnh mẽ hơn.
    |
    */

    'attributes' => [],


];