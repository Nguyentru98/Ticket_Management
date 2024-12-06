<!DOCTYPE html>
<html>
<head>
    <title>Yêu cầu xử lý</title>
    {{-- ($ticket,$userHandler,$requester) --}}
</head>
<body>
    <h3>Dear: {{$requester->name}}</h3>
    <br>
    <p>Yêu cầu hỗ trợ của bạn đã được phê duyệt và giao cho <strong>{{$userHandler->name}}</strong> :</p>
    <p><strong>Mã ticket:</strong> {{$ticket->id}} </p>
    <p><strong>Tiêu đề:</strong>  <span>{{$ticket->title}}</span></p>
    <p><strong>Mô tả:</strong> {{$ticket->description}}</p>
    <p><strong>Ngày gửi yêu cầu: </strong>{{$ticket->created_at}}</p>
    <p><strong>Người phê duyệt: </strong>Admin</p>
    <p><strong>Người xử lý: </strong>{{$userHandler->name}}</p>
    <p><strong>Trạng thái: </strong>Đang xử lý</p>
    <p>Trong quá trình xử lý. Nếu cần thêm thông tin hoặc tài liệu, bạn có thể liên hệ trực tiếp với <strong>{{$userHandler->name}}</strong> qua email: {{$userHandler->email}}</p>
    <br>
    <p>Trân trọng !</p>
    <br>
    <button>Qua app -></button>
</body>
</html>
