function toggleFeedback(id) {
    const el = document.getElementById(id);
    if(el) el.style.display = el.style.display === 'block' ? 'none' : 'block';
}

function showToast(msg, isSuccess = true) {
    let t = document.getElementById('toast');
    if (!t) return;
    t.textContent = msg;
    t.style.background = isSuccess ? '#10b981' : '#ef4444';
    t.style.color = 'white';
    t.style.display = 'flex';
    setTimeout(() => t.style.display = 'none', 3000);
}

function setujui(id) {
    const card = document.getElementById(id);
    if (card) {
        card.style.opacity = '0.5';
        card.style.pointerEvents = 'none';
        const badge = card.querySelector('.badge') || card.querySelector('.badge-status');
        if (badge) {
            badge.className = 'badge badge-green badge-status selesai';
            badge.textContent = 'Disetujui';
        }
    }
    showToast('Tugas disetujui. Sertifikat akan diterbitkan.', true);
}

function tolak(id) {
    const card = document.getElementById(id);
    if (card) {
        const badge = card.querySelector('.badge') || card.querySelector('.badge-status');
        if (badge) {
            badge.className = 'badge badge-red badge-status revisi';
            badge.textContent = 'Perlu Revisi';
        }
    }
    showToast('Tugas ditolak. Siswa akan diminta revisi.', false);
}

function kirimFeedback(tugasId, txtId) {
    const txt = document.getElementById(txtId).value.trim();
    if (!txt) { alert('Tulis feedback terlebih dahulu.'); return; }
    showToast('Feedback berhasil dikirim ke siswa.', true);
    document.getElementById(txtId).value = '';
    const fbId = txtId.replace('fbtxt', 'fb');
    if (document.getElementById(fbId)) document.getElementById(fbId).style.display = 'none';
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