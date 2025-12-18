// admin-modal.js
// Mục đích: cung cấp các hàm tiện ích quản lý modal dùng chung cho trang admin.
// Ghi chú tiếng Việt được bổ sung để giúp bảo trì mã cho nhóm.

// Mở modal (hiển thị phần tử có id = modalId)
function openModal(modalId) {
    const modal = document.getElementById(modalId);
    if (!modal) return;
    modal.style.display = 'block';
}

// Đóng modal (ẩn phần tử có id = modalId)
function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (!modal) return;
    modal.style.display = 'none';
}

// Đóng tất cả modal khi click ra ngoài nội dung modal
document.addEventListener('click', function(event) {
    // Nếu click vào phần tử có class 'modal-content' hoặc bên trong nó thì bỏ qua
    const modals = document.querySelectorAll('.modal');
    modals.forEach(modal => {
        if (modal.style.display === 'block') {
            const content = modal.querySelector('.modal-content');
            if (content && !content.contains(event.target) && !modal.contains(event.target.closest('[data-modal-ignore]'))) {
                // Click ngoài modal-content -> đóng modal
                modal.style.display = 'none';
            }
        }
    });
});

// Đóng modal khi nhấn phím Escape
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' || e.key === 'Esc') {
        document.querySelectorAll('.modal').forEach(modal => {
            if (modal.style.display === 'block') modal.style.display = 'none';
        });
    }
});

// Tự động thêm sự kiện cho các nút đóng có thuộc tính data-modal-close="<modalId>"
document.addEventListener('click', function(e) {
    const btn = e.target.closest('[data-modal-close]');
    if (btn) {
        const modalId = btn.getAttribute('data-modal-close');
        if (modalId) closeModal(modalId);
    }
});

// Tự động thêm sự kiện cho các nút mở có thuộc tính data-modal-open="<modalId>"
document.addEventListener('click', function(e) {
    const btn = e.target.closest('[data-modal-open]');
    if (btn) {
        const modalId = btn.getAttribute('data-modal-open');
        if (modalId) openModal(modalId);
    }
});
