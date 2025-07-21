const NOTIF_URL = 'http://localhost/audit-scanner/get-notif';

self.addEventListener('install', event => {
  console.log('[SW] Installed');
  self.skipWaiting();
});

self.addEventListener('activate', event => {
  console.log('[SW] Activated');
  event.waitUntil(self.clients.claim());
});

self.addEventListener('message', async event => {
  if (event.data === 'get-notifications') {
    try {
      const response = await fetch(NOTIF_URL);
      const data = await response.json();

      const allClients = await self.clients.matchAll();
      allClients.forEach(client => {
        client.postMessage({ type: 'notifications', data });
      });
    } catch (err) {
      console.error('[SW] Fetch failed', err);
    }
  }
});
