function switchTab(btn, id) {
    document.querySelectorAll('.admin-tab').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    ['tab-pengguna','tab-mentor','tab-tugas'].forEach(t => {
        const el = document.getElementById(t);
        if (el) el.style.display = t === id ? 'block' : 'none';
    });
}

function openModal(id) { 
    const el = document.getElementById(id);
    if (el) el.classList.add('show'); 
}
function closeModal(id) { 
    const el = document.getElementById(id);
    if (el) el.classList.remove('show'); 
}

function showToast(msg, ok) {
    const t = document.getElementById('toast');
    if (!t) return;
    t.textContent = msg;
    t.style.background = ok ? '#10b981' : '#ef4444';
    t.style.color = 'white';
    t.style.display = 'flex';
    setTimeout(() => t.style.display = 'none', 3000);
}

function hapusUser(btn) {
    if (!confirm('Yakin ingin menghapus pengguna ini?')) return;
    const row = btn.closest('tr');
    row.style.opacity = '0';
    row.style.transition = 'opacity 0.3s';
    setTimeout(() => row.remove(), 300);
    showToast('Pengguna berhasil dihapus.', false);
}

function editUser(nama) {
    document.getElementById('edit-name').value = nama;
    document.getElementById('modal-edit-title').textContent = 'Edit: ' + nama;
    openModal('modal-edit');
}

function simpanEdit() {
    closeModal('modal-edit');
    showToast('Data berhasil diperbarui.', true);
}

function simpanUser() {
    const nama = document.getElementById('new-user-name').value;
    if (!nama.trim()) { alert('Isi nama terlebih dahulu.'); return; }
    closeModal('modal-tambah-user');
    showToast('Pengguna baru berhasil ditambahkan.', true);
}

function simpanMentor() {
    const nama = document.getElementById('new-mentor-name').value;
    if (!nama.trim()) { alert('Isi nama terlebih dahulu.'); return; }
    closeModal('modal-tambah-mentor');
    showToast('Mentor baru berhasil ditambahkan.', true);
}

function hapusKursus(btn) {
    if (!confirm('Yakin ingin menghapus kursus ini?')) return;
    const row = btn.closest('tr');
    row.style.opacity = '0';
    row.style.transition = 'opacity 0.3s';
    setTimeout(() => row.remove(), 300);
    showToast('Kursus berhasil dihapus.', false);
}

function bukaModalLogout(e) {
    if (e) e.preventDefault();
    const el = document.getElementById('modalLogout');
    if (el) el.classList.add('show');
}
function tutupModalLogout() {
    const el = document.getElementById('modalLogout');
    if (el) el.classList.remove('show');
}