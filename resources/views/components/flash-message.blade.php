@if (session('success'))
    {{-- Ghi chú (Tiếng Việt):
        - Component flash-message dùng để hiển thị thông báo tạm thời (thường là success).
        - Có thể đóng bằng nút hoặc tự ẩn nếu thêm JS để fade out.
    --}}
    <div class="flash-message-container">
        <div class="flash-message flash-message--success" data-flash-message>
            <div class="flash-message__icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="flash-message__content">
                {{ session('success') }}
            </div>
            <button type="button" class="flash-message__close" aria-label="Close" data-close-flash>
                &times;
            </button>
        </div>
    </div>
@endif


