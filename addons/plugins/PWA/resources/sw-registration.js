if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('/pwa/sw', { scope: '/' })
            .then((reg) => console.log('Service Worker Registered successfully!'))
            .catch((err) => console.log('Registration failed:', err));
    });
}