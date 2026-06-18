const CACHE_NAME = 'pwa-v1';
const OFFLINE_URL = '/addons/plugins/PWA/resources/offline.html';

self.addEventListener('install', (e) => {
    e.waitUntil(
        caches.open(CACHE_NAME).then((cache) => {
            return cache.add(OFFLINE_URL);
        })
    );
});

self.addEventListener('fetch', (e) => {
    if (e.request.url.includes('/user/')) {
        return; 
    }
    if (e.request.mode === 'navigate') {
        e.respondWith(
            fetch(e.request).catch(() => {
                return caches.match(OFFLINE_URL).then((response) => {
                    return response || new Response('You are offline.', { 
                        headers: {'Content-Type': 'text/html'} 
                    });
                });
            })
        );
    } else {
    if (e.request.url.includes('/user/login') || e.request.url.includes('/api/')) {
        return; 
    }

    e.respondWith(
        fetch(e.request).catch(() => {
            return caches.match(e.request).then((response) => {
                return response || new Response(null, { status: 404 });
            });
        })
    );
}
});