const themeBtn = document.getElementById('themeBtn');

window.addEventListener('load', () => {
    // Carregar Tema
    if (localStorage.getItem('temaEscuro') === 'true') {
        document.body.classList.add('dark-mode');
        themeBtn.innerText = '☀️ Light';
    }
});
themeBtn.onclick = () => {
    const isDark = document.body.classList.toggle('dark-mode');
    themeBtn.innerText = isDark ? '☀️ Light' : '🌙 Dark';
    localStorage.setItem('temaEscuro', isDark);
};