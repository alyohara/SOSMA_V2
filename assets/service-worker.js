
importScripts('https://storage.googleapis.com/workbox-cdn/releases/6.2.0/workbox-sw.js');
workbox.routing.registerRoute(
	({request}) => request.destination === 'image',
	new workbox.strategies.CacheFirst()
);
workbox.routing.registerRoute(
	({request}) => request.destination === 'script',
	new workbox.strategies.CacheFirst()
);
workbox.routing.registerRoute(
	({request}) => request.destination === 'style',
	new workbox.strategies.CacheFirst()
);
workbox.routing.registerRoute(
	({request}) => request.destination === 'document',
	new workbox.strategies.CacheFirst()
);
workbox.routing.registerRoute(
	({request}) => request.destination === 'font',
	new workbox.strategies.CacheFirst()
);
workbox.routing.registerRoute(
	({request}) => request.destination === 'manifest',
	new workbox.strategies.CacheFirst()
);
workbox.routing.registerRoute(
	({request}) => request.destination === 'media',
	new workbox.strategies.CacheFirst()
);
workbox.routing.registerRoute(
	({request}) => request.destination === 'other',
	new workbox.strategies.CacheFirst()
);
workbox.routing.registerRoute(
	({request}) => request.destination === 'xhr',
	new workbox.strategies.CacheFirst()
);

