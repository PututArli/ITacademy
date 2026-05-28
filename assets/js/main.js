document.addEventListener("DOMContentLoaded", function() {
    const nav = document.getElementById('navbar');
    if (nav) {
        window.addEventListener('scroll', () => {
            nav.style.background = window.scrollY > 20 ? 'rgba(10,14,26,0.97)' : 'rgba(10,14,26,0.8)';
        });
    }

    document.querySelectorAll('a[href^="#"]').forEach(a => {
        a.addEventListener('click', e => {
            e.preventDefault();
            const targetId = a.getAttribute('href');
            const el = document.querySelector(targetId);
            if (el) {
                el.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });

    const successData = document.getElementById('successData');
    if (successData && successData.dataset.message) {
        Swal.fire({
            title: 'Berhasil!',
            text: successData.dataset.message,
            icon: 'success',
            confirmButtonText: 'Lanjut Login',
            background: 'var(--bg-card)',
            color: 'var(--text-primary)',
            confirmButtonColor: 'var(--accent-blue)'
        }).then(() => {
            window.location.href = 'index.php?page=login';
        });
    }
});