<!DOCTYPE html>
<html>
<head>
    <title>Yêu cầu xử lý</title>
    {{-- ($ticket,$userSuport,$requester) --}}
</head>
<body>
    <h3>Dear: {{$requester->name}}</h3>
    <br>
    <p>Một yêu cầu hỗ trợ của bạn đã được xử lý. Dưới đây là thông tin chi tiết về ticket:</p>
    <p><strong>Mã ticket:</strong> {{$ticket->id}} </p>
    <p><strong>Tiêu đề:</strong>  <span>{{$ticket->title}}</span></p>
    <p><strong>Mô tả:</strong> {{$ticket->description}}</p>
    <p><strong>Ngày gửi yêu cầu: </strong>{{$ticket->created_at}}</p>
    <p><strong>Người phê duyệt: </strong>Admin</p>
    <p><strong>Người xử lý: </strong>{{$userSuport->name}}</p>
    <p><strong>Trạng thái: <strong>Hoàn thành</strong></p>
    <p>Nếu cần thêm thông tin hoặc thắc mắc nào, bạn có thể liên hệ trực tiếp với <strong>{{$userSuport->name}}</strong> qua email: {{$userSuport->email}}</p>
    <br>
    <p>Trân trọng !</p>
    <br>
    <button>Qua app -></button>
</body>
</html>