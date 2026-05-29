// =====================
// TAB SWITCHING (Admin Dashboard)
// =====================
function switchTab(btn, id) {
    document.querySelectorAll('.admin-tab').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    ['tab-pengguna','tab-mentor','tab-tugas'].forEach(t => {
        const el = document.getElementById(t);
        if (el) el.style.display = t === id ? 'block' : 'none';
    });
}

// =====================
// MODAL
// =====================
function openModal(id) { 
    const el = document.getElementById(id);
    if (el) el.classList.add('show'); 
}
function closeModal(id) { 
    const el = document.getElementById(id);
    if (el) el.classList.remove('show'); 
}

// =====================
// TOAST NOTIFICATION
// =====================
function showToast(msg, ok) {
    const t = document.getElementById('toast');
    if (!t) return;
    t.textContent = msg;
    t.style.background = ok ? '#10b981' : '#ef4444';
    t.style.color = 'white';
    t.style.display = 'flex';
    setTimeout(() => t.style.display = 'none', 3000);
}

// =====================
// USER (SISWA) MANAGEMENT
// =====================
function hapusUser(btn) {
    if (!confirm('Yakin ingin menghapus pengguna ini?')) return;
    const row = btn.closest('tr');
    row.style.opacity = '0';
    row.style.transition = 'opacity 0.3s';
    setTimeout(() => row.remove(), 300);
    showToast('Pengguna berhasil dihapus.', false);
}

function editUser(nama, id, role) {
    const nameInput = document.getElementById('edit-name');
    const statusSelect = document.getElementById('edit-status');
    if (nameInput) nameInput.value = nama;
    if (statusSelect && role) {
        for (let opt of statusSelect.options) {
            if (opt.value === role) { opt.selected = true; break; }
        }
    }
    const titleEl = document.getElementById('modal-edit-title');
    if (titleEl) titleEl.textContent = 'Edit: ' + nama;
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

// =====================
// MENTOR MANAGEMENT
// =====================
function hapusMentor(btn) {
    if (!confirm('Yakin ingin menghapus mentor ini?')) return;
    const row = btn.closest('tr');
    row.style.opacity = '0';
    row.style.transition = 'opacity 0.3s';
    setTimeout(() => row.remove(), 300);
    showToast('Mentor berhasil dihapus.', false);
}

function editMentor(nama, id) {
    const nameInput = document.getElementById('edit-name');
    if (nameInput) nameInput.value = nama;
    const titleEl = document.getElementById('modal-edit-title');
    if (titleEl) titleEl.textContent = 'Edit Mentor: ' + nama;
    openModal('modal-edit');
}

function simpanMentor() {
    const nama = document.getElementById('new-mentor-name');
    if (!nama || !nama.value.trim()) { alert('Isi nama mentor terlebih dahulu.'); return; }
    closeModal('modal-tambah-mentor');
    showToast('Mentor baru berhasil ditambahkan.', true);
}

// =====================
// KURSUS MANAGEMENT
// =====================
function hapusKursus(btn) {
    if (!confirm('Yakin ingin menghapus kursus ini?')) return;
    const row = btn.closest('tr');
    row.style.opacity = '0';
    row.style.transition = 'opacity 0.3s';
    setTimeout(() => row.remove(), 300);
    showToast('Kursus berhasil dihapus.', false);
}

function editKursus(nama) {
    const nameInput = document.getElementById('edit-name');
    if (nameInput) nameInput.value = nama;
    const titleEl = document.getElementById('modal-edit-title');
    if (titleEl) titleEl.textContent = 'Edit Kursus: ' + nama;
    openModal('modal-edit');
}

function simpanKursus() {
    const nama = document.getElementById('new-course-name');
    if (!nama || !nama.value.trim()) { alert('Isi nama kursus terlebih dahulu.'); return; }
    closeModal('modal-tambah-kursus');
    showToast('Kursus baru berhasil ditambahkan.', true);
}

// =====================
// LOGOUT MODAL
// =====================
function bukaModalLogout(e) {
    if (e) e.preventDefault();
    const el = document.getElementById('modalLogout');
    if (el) el.classList.add('show');
}
function tutupModalLogout() {
    const el = document.getElementById('modalLogout');
    if (el) el.classList.remove('show');
}