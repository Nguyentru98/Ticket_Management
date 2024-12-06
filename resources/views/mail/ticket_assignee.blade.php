<!DOCTYPE html>
<html>
<head>
    <title>Yêu cầu xử lý</title>
    {{-- ($ticket,$userHandler,$requester) --}}
</head>
<body>
    <h3>Dear: {{$userHandler->name}}</h3>
    <br>
    <p>Một yêu cầu hỗ trợ mới đã được gửi từ người dùng <strong>{{$requester->name}}</strong>. Dưới đây là thông tin chi tiết về ticket:</p>
    <p><strong>Mã ticket:</strong> {{$ticket->id}} </p>
    <p><strong>Tiêu đề:</strong>  <span>{{$ticket->title}}</span></p>
    <p><strong>Mô tả:</strong> {{$ticket->description}}</p>
    <p><strong>Ngày gửi yêu cầu: </strong>{{$ticket->created_at}}</p>
    <p><strong>Người phê duyệt: </strong>Admin</p>
    <p><strong>Người xử lý: </strong>{{$userHandler->name}}</p>
    <p>Vui lòng xem xét và phê duyệt yêu cầu này. Nếu cần thêm thông tin hoặc tài liệu, bạn có thể liên hệ trực tiếp với <strong>{{$requester->name}}</strong> qua email: {{$requester->email}}</p>
    <br>
    <p>Cảm ơn sự hỗ trợ của bạn!</p>
    <p>Trân trọng !</p>
    <br>
    <button>Qua app -></button>
</body>
</html>
