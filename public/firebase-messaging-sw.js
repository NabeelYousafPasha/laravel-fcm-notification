/*
Give the service worker access to Firebase Messaging.
Note that you can only use Firebase Messaging here, other Firebase libraries are not available in the service worker.
*/
importScripts("https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js");
importScripts(
    "https://www.gstatic.com/firebasejs/7.23.0/firebase-messaging.js"
);

firebase.initializeApp({
    apiKey: "AIzaSyDj9jhsdjsaPwfdC5WlXu4P9fYML2uyiblvzWXktM",
    authDomain: "someapp-5e66d.firebaseapp.com",
    projectId: "someapp-5e66d",
    storageBucket: "someapp-5e66d.appspot.com",
    messagingSenderId: "923706469457",
    appId: "1:923706469457:web:eb8dhsdgdh1cdaef61f747f2dc70",
    measurementId: "G-9FXFsdghshd8EJH4K"
});

self.addEventListener('push', function (event) {
    console.log('[Service Worker] Push Received', event.data.text());

    try {
      const pushData = event.data.json();
      const notification = pushData.notification;

      const options = {
        body: notification.body,
      };

      event.waitUntil(self.registration.showNotification(notification.title, options));
    } catch (error) {
      console.error('Error parsing push notification:', error);
    }
  });

  self.addEventListener('notificationclick', function (event) {
    console.log('[Service Worker] Notification clicked');
    event.notification.close();

    const clickedPromise = clients.openWindow('http://127.0.0.1:8000/');
    event.waitUntil(clickedPromise);
  });


const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function (payload) {
    console.log(
        "[firebase-messaging-sw.js] Received background message ",
        payload
    );
    // Customize notification here
    const notificationTitle = "Background Message Title";
    const notificationOptions = {
        body: "Background Message body.",
        icon: "/itwonders-web-logo.png",
    };

    return self.registration.showNotification(
        notificationTitle,
        notificationOptions
    );
});


