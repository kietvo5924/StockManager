@extends('layouts.main')

@section('title', 'Giới Thiệu')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6">
                <h2>Giới Thiệu Về Công Ty</h2>
                <p class="lead">Chào mừng đến với <strong>Công Ty XYZ</strong> – nơi cung cấp giải pháp quản lý kho hàng và
                    bán hàng quần áo toàn diện cho các doanh nghiệp.</p>
                <p>
                    Chúng tôi chuyên cung cấp các hệ thống phần mềm để giúp các doanh nghiệp quản lý kho hàng, theo dõi sản
                    phẩm và tăng cường hiệu quả bán hàng. Với sứ mệnh mang đến giải pháp tối ưu nhất, chúng tôi cam kết hỗ
                    trợ bạn từ việc quản lý tồn kho đến việc phát triển kinh doanh.
                </p>
                <p>
                    <strong>Công Ty XYZ</strong> có đội ngũ chuyên gia giàu kinh nghiệm trong ngành công nghiệp bán lẻ và
                    quản lý kho. Chúng tôi hiểu rằng mỗi doanh nghiệp đều có những nhu cầu đặc thù, vì vậy chúng tôi luôn
                    sẵn sàng tùy chỉnh giải pháp để phù hợp với nhu cầu riêng của bạn.
                </p>
                <p>
                    Hãy liên hệ với chúng tôi để tìm hiểu thêm về các sản phẩm và dịch vụ mà chúng tôi cung cấp. Chúng tôi
                    luôn sẵn sàng hỗ trợ bạn!
                </p>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <img src="https://via.placeholder.com/500x300" class="card-img-top" alt="Office Image">
                    <div class="card-body">
                        <h5 class="card-title">Hình Ảnh Văn Phòng</h5>
                        <p class="card-text">
                            Đây là hình ảnh văn phòng làm việc của chúng tôi, nơi đội ngũ của chúng tôi làm việc chăm chỉ để
                            mang đến những giải pháp tốt nhất cho khách hàng.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <h3>Quản Lý Kho Hàng và Bán Hàng</h3>
            <p>
                Hệ thống của chúng tôi cung cấp các công cụ quản lý kho hàng và bán hàng chuyên nghiệp. Bạn có thể dễ dàng
                theo dõi số lượng sản phẩm, quản lý đơn hàng, và phân tích doanh số bán hàng.
            </p>
            <ul>
                <li><strong>Quản lý tồn kho:</strong> Theo dõi số lượng sản phẩm trong kho, cảnh báo khi hàng tồn kho giảm
                    dưới mức tối thiểu.</li>
                <li><strong>Quản lý đơn hàng:</strong> Xử lý đơn hàng nhanh chóng và chính xác, theo dõi trạng thái đơn hàng
                    từ khi đặt đến khi giao hàng.</li>
                <li><strong>Báo cáo và phân tích:</strong> Cung cấp các báo cáo chi tiết về doanh số bán hàng, lợi nhuận và
                    hiệu quả của các sản phẩm.</li>
                <li><strong>Hỗ trợ khách hàng:</strong> Đội ngũ hỗ trợ khách hàng sẵn sàng giúp đỡ bạn 24/7 để giải đáp mọi
                    thắc mắc và hỗ trợ kỹ thuật.</li>
            </ul>
        </div>

        <a href="{{ route('contact') }}" class="btn btn-primary mt-4">Liên Hệ Với Chúng Tôi</a>
    </div>
@endsection
